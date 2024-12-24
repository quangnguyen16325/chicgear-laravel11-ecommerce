<?php

namespace App\Livewire;

use App\Models\Address;
use App\Models\DiscountCode;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\UserDiscount;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB; 
use Illuminate\Http\Request;

class CheckoutComponent extends Component
{
    public $fullname;
    public $email;
    public $selectedAddress;
    public $addresses;
    public $paymentOption;
    public $order_notes;
    public $discountCode;

    public function mount()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login'); 
        }

        $this->fullname = $user->name;
        $this->email = $user->email;
        $this->addresses = Address::where('user_id', $user->id)->get();

        $defaultAddress = $this->addresses->where('is_default', 1)->first();
        $this->selectedAddress = $defaultAddress ? $defaultAddress->id : ($this->addresses->first()->id ?? null);
    }

    public function processPayment()
    {
        $total = floatval(str_replace(',', '', Cart::instance('cart')->total()));
        $discountAmount = session('discount_amount', 0); 
        $finalTotal = $total - $discountAmount;

        if ($finalTotal == 0) {
            $this->storeOrder(); 
            // session()->flash('success_message', 'Đơn hàng của bạn đã được lưu thành công!');
            // return redirect()->route('thankyou'); 
        }

        if ($this->paymentOption === 'momo') {
            return $this->processQRMomoPayment($total);
        } elseif ($this->paymentOption === 'vnpay') {
            return $this->processVNPAYPayment($total);
        } elseif ($this->paymentOption === 'card') {
            return $this->processATMMomoPayment($total);
        } else {
            $this->storeOrder(); 
            // session()->flash('success_message', 'Đơn hàng của bạn đã được lưu thành công!');
            // return redirect()->route('thankyou');
        }
    }


    public function storeOrder()
    {
        $this->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'paymentOption' => 'required|in:cod,card,momo,vnpay',
            'selectedAddress' => 'required|integer|exists:addresses,id',
        ]);

        foreach (Cart::instance('cart')->content() as $item) {
            $product = Product::find($item->id);
            if (!$product || $product->quantity < $item->qty) {
                session()->flash('error_message', "Sản phẩm '{$item->name}' đã hết hàng hoặc không đủ số lượng.");
                return;
            }
        }

        $taxPercentage = config('cart.tax') ;
        $total = floatval(str_replace(',', '', Cart::instance('cart')->total()));
        $discount = DiscountCode::where('code', $this->discountCode)->first();

        // Lấy mã giảm giá từ session (nếu có)
        $discountCode = session()->get('discount_code');
        $discountAmount = 0;

        if ($discount && $discount->distributed_to_all) {
            UserDiscount::create([
                'user_id' => auth()->id(),
                'discount_code_id' => $discount->id,
                'used' => false,
            ]);
        }

        if ($discountCode) {
            $userDiscount = UserDiscount::where('user_id', auth()->id())
                ->whereHas('discountCode', function ($query) use ($discountCode) {
                    $query->where('code', $discountCode)
                        ->where('is_active', true);
                })
                ->where('used', false)
                ->first();
    
            if ($userDiscount) {
                $discount = $userDiscount->discountCode;

                $discountAmount = ($discount->percentage / 100) * $total; // Giảm giá theo số tiền cố định
                $total -= $discountAmount;

                $discount->decrement('quantity', 1); 
                $discount->increment('used_quantity', 1); 

                $userDiscount->used = true;
                $userDiscount->save(); 

            }
        }

        // if ($this->paymentOption === 'vnpay') {
        //     return $this->processVNPAYPayment($total);
        // } 
        // if ($this->paymentOption === 'momo') {
        //     return $this->processMomoPayment($total);
        // }
        // if ($this->paymentOption === 'momo') {
        //     return $this->processQRMomoPayment($total);
        // }

        DB::beginTransaction();
        try {
            $order = Order::create([
                'user_id' => auth()->id(),
                'shipping_address_id' => $this->selectedAddress,
                'fullname' => $this->fullname,
                'email' => $this->email,
                'order_notes' => $this->order_notes,
                'payment_option' => $this->paymentOption, 
                'total' => $total, 
                'status' => 'pending',
                'tax_percentage' => $taxPercentage,
            ]);

            // dd($order);

            foreach (Cart::instance('cart')->content() as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->id,
                    'quantity' => $item->qty,
                    'price' => $item->price,
                ]);

                $product = Product::find($item->id);
                if ($product) {
                    $product->update([
                        'quantity' => $product->quantity - $item->qty,
                        'sold_quantity' => $product->sold_quantity + $item->qty,
                    ]);
                }
            }

            $this->removeDiscount();
            Cart::instance('cart')->destroy();

            DB::commit();

            return redirect()->route('thankyou')->with('success_message', 'Đặt hàng thành công!');
        } catch (\Exception $e) {
            DB::rollback();
    
            return redirect()->route('thankyou')->with('error', 'Đặt hàng thất bại!');
        }
    }

    public function processVNPAYPayment($total)
    {
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('vnpay.return');
        $vnp_TmnCode = "UYEOT0YO"; // Mã website tại VNPAY
        $vnp_HashSecret = "MANDBY7V8RF29VJPL3I5WIAZELS174A9"; // Chuỗi bí mật

        $vnp_TxnRef = time(); // Mã đơn hàng
        $vnp_OrderInfo = "Thanh toán đơn hàng tại cửa hàng";
        $vnp_OrderType = "billpayment";
        $vnp_Amount = $total * 100; // Số tiền thanh toán (nhân 100 để chuyển sang VNĐ)
        $vnp_Locale = "vn";
        $vnp_BankCode = "NCB";

        $inputData = [
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => request()->ip(),
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        ];

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        ksort($inputData);
        $query = "";
        $hashdata = "";
        $i = 0;
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if ($vnp_HashSecret) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        session([
            'selectedAddress' => $this->selectedAddress,
            'paymentOption' => $this->paymentOption,
            'fullname' => $this->fullname,
            'email' => $this->email,
            'order_notes' => $this->order_notes,
        ]);

        return redirect($vnp_Url);
    }

    public function processQRMomoPayment($total){

        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";

        $discountAmount = session('discount_amount', 0); 
        $finalTotal = $total - $discountAmount;

        $taxPercentage = config('cart.tax') ;
        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua MoMo";
        $amount = $finalTotal;
        $orderId = time() ."";
        $redirectUrl = route('momo.return');
        $ipnUrl = "https://example.com/ipn";
        // $redirectUrl = "http://laravel-app:8000/cart";
        // $ipnUrl = "https://webhook.site/b3088a6a-2d17-4f8d-a383-71389a6c600b"; 
        $extraData = "";
        $requestId = time() . "";
        $requestType = "captureWallet";

        $rawHash = "accessKey=$accessKey&amount=$amount&extraData=$extraData&ipnUrl=$ipnUrl&orderId=$orderId&orderInfo=$orderInfo&partnerCode=$partnerCode&redirectUrl=$redirectUrl&requestId=$requestId&requestType=$requestType";
        $signature = hash_hmac("sha256", $rawHash, $secretKey);

        $data = [
            'partnerCode' => $partnerCode,
            // 'partnerName' => "Test",
            'partnerName' => $this->fullname,
            'storeId' => "ChicGearStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature,
            'ipnUrl' => $ipnUrl,
        ];

        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);

        session([
            'selectedAddress' => $this->selectedAddress,
            'paymentOption' => $this->paymentOption,
            'fullname' => $this->fullname,
            'email' => $this->email,
            'order_notes' => $this->order_notes,
        ]);

        if (isset($jsonResult['payUrl'])) {
            return redirect($jsonResult['payUrl']); 
        }

        session()->flash('error', 'Không thể thực hiện thanh toán. Vui lòng thử lại.');  
    }

    public function processATMMomoPayment($total){
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";

        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua ATM";
        $amount = $total;
        $orderId = time() ."";
        $redirectUrl = route('momo.return');
        $ipnUrl = "https://webhook.site/b3088a6a-2d17-4f8d-a383-71389a6c600b";
        $extraData = "";
        $requestId = time() . "";
        $requestType = "payWithCC";

        $rawHash = "accessKey=$accessKey&amount=$amount&extraData=$extraData&ipnUrl=$ipnUrl&orderId=$orderId&orderInfo=$orderInfo&partnerCode=$partnerCode&redirectUrl=$redirectUrl&requestId=$requestId&requestType=$requestType";
        $signature = hash_hmac("sha256", $rawHash, $secretKey);

        $data = [
            'partnerCode' => $partnerCode,
            // 'partnerName' => "Test",
            'partnerName' => $this->fullname,
            'storeId' => "ChicGearStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature,
            'ipnUrl' => $ipnUrl,
        ];

        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);  

        session([
            'selectedAddress' => $this->selectedAddress,
            'paymentOption' => $this->paymentOption,
            'fullname' => $this->fullname,
            'email' => $this->email,
            'order_notes' => $this->order_notes,
        ]);

        if (isset($jsonResult['payUrl'])) {
            return redirect($jsonResult['payUrl']); 
        }

    }

    public function processMomoPayment($total)
    {
        $endpoint = 'https://test-payment.momo.vn/v2/gateway/api/create';
        $accessKey = 'F8BBA842ECF85';
        $secretKey = 'K951B6PE1waDMi640xX08PD3vg6EkVlz';
        $redirectUrl = route('momo.return');
        $ipnUrl = 'https://webhook.site/b3088a6a-2d17-4f8d-a383-71389a6c600b';
        $partnerCode = 'MOMO';
        $orderInfo = 'Thanh toán đơn hàng ChicGear Store';
        $requestType = 'payWithMethod';
        $partnerName = 'MoMo Payment';
        $storeId = 'Test Store';
        $orderGroupId = '';
        $autoCapture = true;
        $lang = 'vi';

        $orderId = time() . "";
        $requestId = time() . "";
        $extraData = "";

        // Chuỗi rawHash để tạo chữ ký
        $rawHash = "accessKey=" . $accessKey .
                "&amount=" . $total .
                "&extraData=" . $extraData .
                "&ipnUrl=" . $ipnUrl .
                "&orderId=" . $orderId .
                "&orderInfo=" . $orderInfo .
                "&partnerCode=" . $partnerCode .
                "&redirectUrl=" . $redirectUrl .
                "&requestId=" . $requestId .
                "&requestType=" . $requestType;

        // Tạo chữ ký
        $signature = hash_hmac("sha256", $rawHash, $secretKey);

        // Dữ liệu gửi đến API của MoMo
        $data = [
            'partnerCode' => $partnerCode,
            'partnerName' => $partnerName,
            'storeId' => $storeId,
            'requestId' => $requestId,
            'amount' => $total,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'requestType' => $requestType,
            'ipnUrl' => $ipnUrl,
            'lang' => $lang,
            'redirectUrl' => $redirectUrl,
            'autoCapture' => $autoCapture,
            'extraData' => $extraData,
            'orderGroupId' => $orderGroupId,
            'signature' => $signature
        ];

        // Gửi yêu cầu POST đến MoMo
        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);

        // Kiểm tra phản hồi và xử lý
        if (isset($jsonResult['payUrl'])) {
            return redirect($jsonResult['payUrl']); // Chuyển hướng đến trang thanh toán MoMo
        }

        $errorMessage = isset($jsonResult['message']) ? $jsonResult['message'] : 'Không thể thực hiện thanh toán. Vui lòng thử lại.';
        session()->flash('error', $errorMessage);
    }

    private function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data),
        ]);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);

        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            session()->flash('error', 'Không thể kết nối với MoMo. Lỗi: ' . curl_error($ch));
            curl_close($ch);
            return;
        }

        curl_close($ch);
        return $result;
    }

    public function momoReturn(Request $request)
    {
        // dd($request->resultCode);
        if ($request->resultCode == '0') { 
            // $this->paymentOption = 'momo';
            $this->paymentOption = session('paymentOption');
            $this->selectedAddress = session('selectedAddress');
            $this->fullname = session('fullname');
            $this->email = session('email');
            $this->order_notes = session('order_notes');

            // dd($request->all(), $this->paymentOption, $this->selectedAddress);
            $this->storeOrder();
            // session()->flash('success_message', 'Thanh toán qua MoMo thành công!');
            session()->flash('success_message', 'Thanh toán qua MoMo thành công!');
            return redirect()->route('thankyou');
        } else { 
            // session()->flash('error', 'Thanh toán qua MoMo thất bại! Lý do: ' . $this->getMomoErrorMessage($request->resultCode));
            session()->flash('error', 'Thanh toán qua MoMo thất bại!');
            return redirect()->route('thankyou');
        }
    }

    public function vnpayReturn(Request $request)
    {
        if ($request->vnp_ResponseCode == '00') { 
            // $this->paymentOption = 'momo';
            $this->paymentOption = session('paymentOption');
            $this->selectedAddress = session('selectedAddress');
            $this->fullname = session('fullname');
            $this->email = session('email');
            $this->order_notes = session('order_notes');

            $this->storeOrder();
            session()->flash('success_message', 'Thanh toán qua MoMo thành công!');
            return redirect()->route('thankyou');
        } else { 
            // session()->flash('error', 'Thanh toán qua MoMo thất bại! Lý do: ' . $this->getMomoErrorMessage($request->resultCode));
            session()->flash('error', 'Thanh toán qua VNPay thất bại!');
            return redirect()->route('thankyou');
        }
    }

    public function applyDiscount()
    {
        $this->validate([
            'discountCode' => 'required|string|exists:discount_codes,code',
        ]);

        $discount = DiscountCode::where('code', $this->discountCode)->first();
        if (!$discount || !$discount->is_active) {
            session()->flash('error', 'Mã giảm giá không hợp lệ hoặc đã hết hiệu lực.');
            return;
        }

        // Kiểm tra số lượng mã giảm giá còn không
        if ($discount->quantity <= 0) {
            $userDiscount = UserDiscount::where('user_id', auth()->id())
            ->where('discount_code_id', $discount->id)
            ->first();
            if ($userDiscount && !$userDiscount->used) {
                session()->put('discount_code', $this->discountCode);
            } else {
                session()->flash('error', 'Mã giảm giá đã hết lượt sử dụng.');
                return;
            }
        }

        // Kiểm tra nếu mã giảm giá có trạng thái `distributed_to_all`
        if ($discount->distributed_to_all) {
            $userDiscount = UserDiscount::where('user_id', auth()->id())
            ->where('discount_code_id', $discount->id)
            ->first();
            // dd($discount->code);
            // dd($userDiscount);
            // Kiểm tra mã giảm giá đã được sử dụng hay chưa
            if ($userDiscount && $userDiscount->used) {
                session()->flash('error', 'Mã giảm giá đã được sử dụng.');
                return;
            }

            // Áp dụng mã giảm giá và lưu vào bảng `user_discount`
            session()->put('discount_code', $this->discountCode);


            // Tính toán số tiền giảm
            $discountAmount = 0;
            if ($discount->percentage) {
                // Nếu là tỷ lệ phần trăm, tính toán theo tổng tiền
                // dd(Cart::instance('cart')->total());
                $totalAmount = Cart::instance('cart')->total(); // Lấy tổng tiền từ session
                $totalAmount = str_replace([',', '.00'], '', $totalAmount); 
                $totalAmount = (float) $totalAmount;
                // dd($totalAmount);
                $discountAmount = ($totalAmount * $discount->percentage) / 100;
                // dd($discountAmount);
            } else {
                // Nếu không có tỷ lệ phần trăm, sử dụng giá trị giảm cố định nếu có
                $discountAmount = $discount->value ?? 0;
            }

            // Lưu số tiền giảm vào session
            session(['discount_amount' => $discountAmount]);

            // Cập nhật tổng tiền mới
            $newTotal = (float) Cart::instance('cart')->total() * 1000 - $discountAmount;
            // dd($newTotal);
            session(['total_amount' => $newTotal]);

            // UserDiscount::create([
            //     'user_id' => auth()->id(),
            //     'discount_code_id' => $discount->id,
            //     'used' => false,
            // ]);

            // $discount->update(['used' => false]);

            session()->flash('success', 'Mã giảm giá đã được áp dụng thành công!');
            return;
        } 

        // Nếu mã giảm giá không có trạng thái `distributed_to_all`, kiểm tra bảng `user_discount`
        $userDiscount = UserDiscount::where('user_id', auth()->id())
            ->where('discount_code_id', $discount->id)
            ->first();

        if (!$userDiscount) {
            session()->flash('error', 'Bạn không có quyền sử dụng mã giảm giá này.');
            return;
        }

        // Kiểm tra nếu mã giảm giá đã được sử dụng
        if ($userDiscount->used) {
            session()->flash('error', 'Mã giảm giá đã được sử dụng.');
            return;
        }

        session()->put('discount_code', $this->discountCode);
        // $userDiscount->update(['used' => true]);
        // Tính toán số tiền giảm
        $discountAmount = 0;
        if ($discount->percentage) {
            $totalAmount = Cart::instance('cart')->total(); // Lấy tổng tiền từ session
            $totalAmount = str_replace([',', '.00'], '', $totalAmount); 
            $totalAmount = (float) $totalAmount;
            // dd($totalAmount);
            $discountAmount = ($totalAmount * $discount->percentage) / 100;
        } else {
            $discountAmount = $discount->value ?? 0;
        }

        // Lưu số tiền giảm vào session
        session(['discount_amount' => $discountAmount]);

        // Cập nhật tổng tiền mới
        $newTotal = (float) Cart::instance('cart')->total() * 1000 - $discountAmount;
        session(['total_amount' => $newTotal]);

        session()->flash('success', 'Mã giảm giá đã được áp dụng thành công!');
    }

    public function removeDiscount()
    {
        // Xóa session đã lưu
        session()->forget('discount_code');
        session()->forget('discount_amount');

        // Cập nhật giá trị discountCode về mặc định
        $this->discountCode = '';

        session()->flash('success', 'Mã giảm giá đã được hủy.');
    }

    public function render()
    {
        return view('livewire.checkout-component');
    } 
}



<div>
    <style>
        input[type="radio"] {
            margin: 0; 
            width: 18px; 
            height: 18px; 
            transform: scale(1); 
            accent-color: #007bff; 
            cursor: pointer;
        }

        .card-body {
            padding: 10px; 
            cursor: pointer;
        }

        .form-group input {
            font-size: 15px;
        }

        #paymentError {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }

    </style>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">Trang chủ</a>
                    <span></span> <a href="{{ route('shop') }}">Cửa hàng</a>
                    <span></span> <a href="{{ route('shop.cart') }}">Giỏ hàng</a> 
                    <span></span> Thanh toán
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            {{-- <form method="POST" action="{{ route('order.store') }}" id="orderForm"> --}}
            {{-- <form wire:submit.prevent="storeOrder" id="orderForm"> --}}
                <div class="container">
                    <div class="row mb-4">
                        <div class="col-lg-6 mb-sm-15">
                            <div class="toggle_info">
                                <span>
                                    <i class="fi-rs-user mr-2"></i>
                                    <span class="text-muted">Đã có tài khoản?</span>
                                    <a href="{{ route('login') }}" class="text-primary" style="text-decoration: none;">Nhấn vào đây để đăng nhập</a>
                                </span>
                            </div>
                        </div>                    
                        <div class="col-lg-6">
                            <div class="toggle_info">
                                <span><i class="fi-rs-user mr-10"></i><span class="text-muted">Chưa có tài khoản?</span> 
                                    <a href="{{ route('register') }}" class="collapsed" aria-expanded="false">Nhấn vào đây để đăng ký</a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="divider mt-5 mb-20"></div>
                        </div>
                    </div>
                    @if (session()->has('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                
                    @if (session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                
                    {{-- <form wire:submit.prevent="applyDiscount">
                        <div class="mb-2 d-flex">
                            <div class="flex-grow-1">
                                <label for="discountCode" class="block text-gray-700">Mã giảm giá</label> 
                                <input type="text" id="discountCode" wire:model="discountCode" class="form-input mt-1 block w-full" placeholder="Nhập mã giảm giá">
                                @error('discountCode') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded mb-4 ml-2 mt-7">
                                    Áp dụng
                                </button>
                            </div>
                        </div>
                    </form> --}}
                    <div class="mb-30 mt-5">
                        <div class="heading_s1 mb-3">
                            <h4>Áp dụng mã giảm giá</h4>
                        </div>
                        <div class="total-amount">
                            <div class="left">
                                <div class="coupon">
                                    <form wire:submit.prevent="applyDiscount">
                                        <div class="form-row row justify-content-center">
                                            <div class="form-group col-lg-6">
                                                <input type="text" id="discountCode" wire:model="discountCode" class="font-medium" name="Coupon" placeholder="Điền mã giảm giá của bạn">
                                                @error('discountCode') <span class="text-red-500">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="form-group col-lg-6 d-flex">
                                                <button type="submit" class="btn btn-sm mr-2 me-2"><i class="fi-rs-label mr-10"></i>Áp dụng</button>
                                                <button type="button" wire:click="removeDiscount" class="btn btn-sm btn-danger"><i class="fi-rs-trash mr-10"></i>Hủy áp dụng</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
                <form wire:submit.prevent="processPayment" id="orderForm">
                {{-- @csrf --}}
                <div class="container">
                    <div class="row">
                        @if(Session::has('error_message'))
                            <div class="alert alert-danger">
                                <strong>{{ Session::get('error_message') }}</strong>
                            </div>
                        @endif
                        {{-- <div class="col-lg-6 mb-sm-15">
                            <div class="toggle_info">
                                <span>
                                    <i class="fi-rs-user mr-2"></i>
                                    <span class="text-muted">Đã có tài khoản?</span>
                                    <a href="{{ route('login') }}" class="text-primary" style="text-decoration: none;">Nhấn vào đây để đăng nhập</a>
                                </span>
                            </div>
                        </div>                    
                        <div class="col-lg-6">
                            <div class="toggle_info">
                                <span><i class="fi-rs-user mr-10"></i><span class="text-muted">Chưa có tài khoản?</span> 
                                    <a href="{{ route('register') }}" class="collapsed" aria-expanded="false">Nhấn vào đây để đăng ký</a>
                                </span>
                            </div>
                        </div> --}}
                    </div>
                    {{-- <div class="row">
                        <div class="col-12">
                            <div class="divider mt-50 mb-50"></div>
                        </div>
                    </div> --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-25">
                                <h4>Thông tin thanh toán</h4>
                            </div>
                            <div class="form-group">
                                <input type="text" required="" name="fullname" wire:model="fullname" placeholder="Họ và tên*" readonly>
                            </div>
                            <div class="form-group">
                                <input type="text" required="" name="email" wire:model="email" placeholder="Địa chỉ email *" readonly>
                            </div>
                            <div class="form-group">
                                <label for="shipping_address">Địa chỉ giao hàng</label>
                                <div id="shipping_address" class="d-flex flex-wrap justify-content-start gap-3 mt-3">
                                    @if($addresses->isEmpty())
                                        <p class="text-danger">
                                            Bạn chưa có địa chỉ để giao hàng nào, vui lòng <a href="{{ route('user.address.create') }}" class="text-primary" style="text-decoration: none;">thêm tại đây</a>.
                                        </p>
                                    @else
                                        @foreach($addresses as $address)
                                            <div class="hero-card box-shadow-outer-6 wow fadeIn animated hover-up d-flex text-center mb-3" style="width: 100%;">
                                                <div class="card-body d-flex align-items-center" style="cursor: pointer;">
                                                    <input type="radio"
                                                        name="shipping_address_id" 
                                                        value="{{ $address->id }}" 
                                                        id="address-{{ $address->id }}" 
                                                        wire:model="selectedAddress" 
                                                        style="margin-right: 10px; transform: scale(1.2);">
                                                    <div class="d-flex flex-column">
                                                        <label for="address-{{ $address->id }}" style="cursor: pointer;">
                                                            <h5 class="card-title" style="margin-bottom: 5px;">{{ $address->address }}</h5>
                                                            <p class="card-text" style="margin-bottom: 5px;">SĐT: {{ $address->phone }}</p>
                                                            @if($address->is_default)
                                                                <p class="default-tag text-danger" style="margin-bottom: 0;">(Mặc định)</p>
                                                            @endif
                                                        </label>
                                                    </div>
                                                </div>
                                                {{-- <div class="radio-container">
                                                    <!-- Radio Button -->
                                                    <input type="radio"
                                                        name="shipping_address_id" 
                                                        value="{{ $address->id }}" 
                                                        id="address-{{ $address->id }}" 
                                                        wire:model="selectedAddress">
                                            
                                                    <!-- Address Content -->
                                                    <div class="card-body">
                                                        <h5 class="card-title">{{ $address->address }}</h5>
                                                        <p class="card-text">SĐT: {{ $address->phone }}</p>
                                                        @if($address->is_default)
                                                            <p class="default-tag">(Mặc định)</p>
                                                        @endif
                                                    </div>
                                                </div> --}}
                                            </div>
                                        @endforeach
                                    @endif
                                </div>                          
                            </div>
                            <div class="mb-20">
                                <h5>Thông tin bổ sung</h5>
                            </div>
                            <div class="form-group mb-30">
                                <textarea rows="5" name="order_notes" placeholder="Ghi chú đơn hàng" wire:model="order_notes"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="order_review">
                                <div class="mb-20">
                                    <h4>Đơn hàng của bạn</h4>
                                </div>
                                <div class="table-responsive order_table text-center">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th colspan="2">Sản phẩm</th>
                                                <th>Tổng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach (Cart::instance('cart')->content() as $item)
                                                <tr>
                                                    <td class="image product-thumbnail"><img src="{{ asset('assets/imgs/products') }}/{{ $item->model->image }}" alt="#"></td>
                                                    <td>
                                                        <h5><a href="product-details.html">{{ $item->model->name }}</a></h5><span class="product-qty">x {{ $item->qty }}</span>
                                                    </td>
                                                    <td>{{ number_format($item->subtotal, 0, '', '.') }}đ</td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <th>Tổng phụ</th>
                                                <td class="product-subtotal" colspan="2">{{ number_format((float) str_replace(',', '', Cart::subtotal())) }}đ</td>
                                            </tr>
                                            <tr>
                                                <th>VAT({{ config('cart.tax') }}%)</th>
                                                <td class="product-subtotal" colspan="2">{{ number_format((float) str_replace(',', '', Cart::tax())) }}đ</td>
                                            </tr>
                                            <tr>
                                                <th>Phí vận chuyển</th>
                                                <td colspan="2"><em>Miễn phí vận chuyển</em></td>
                                            </tr>
                                            <tr>
                                                <th>Mã giảm giá</th>
                                                <td colspan="2">
                                                    {{-- {{ dd(session()->all()); }} --}}
                                                    @if(session()->has('discount_amount'))
                                                        <em>{{ number_format(session('discount_amount'), 0, '', '.') }}đ</em>
                                                    @else
                                                        <em>Chưa áp dụng</em>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Tổng cộng</th>
                                                {{-- <td colspan="2" class="product-subtotal"><span class="font-xl text-brand fw-900">{{ number_format((float) str_replace(',', '', Cart::total())) }}đ</span></td> --}}
                                                <td colspan="2" class="product-subtotal">
                                                    <span class="font-xl text-brand fw-900">
                                                        @if(session()->has('discount_amount'))
                                                            {{ number_format((float) str_replace(',', '', Cart::total()) - session('discount_amount'), 0, '', '.') }}đ
                                                        @else
                                                            {{ number_format((float) str_replace(',', '', Cart::total()), 0, '', '.') }}đ
                                                        @endif
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                {{-- <div class="form-group">
                                    <label for="discount_code">Mã giảm giá</label>
                                    <input type="text" name="discount_code" wire:model="discountCode" id="discount_code" placeholder="Nhập mã giảm giá" class="form-control">
                                    @error('discountCode') <span class="text-danger">{{ $message }}</span> @enderror
                                </div> --}}

                                {{-- <div>
                                    @if (session()->has('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                
                                    @if (session()->has('error'))
                                        <div class="alert alert-danger">
                                            {{ session('error') }}
                                        </div>
                                    @endif
                                
                                    <form wire:submit.prevent="applyDiscount">
                                        <div class="mb-4">
                                            <label for="discountCode" class="block text-gray-700">Mã giảm giá</label>
                                            <input type="text" id="discountCode" wire:model="discountCode" class="form-input mt-1 block w-full" placeholder="Nhập mã giảm giá">
                                            @error('discountCode') <span class="text-red-500">{{ $message }}</span> @enderror
                                        </div>
                                
                                        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">
                                            Áp dụng
                                        </button>
                                    </form>
                                </div>                                --}}
                                <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                                <div class="payment_method">
                                    <div class="mb-25">
                                        <h5>Phương thức thanh toán</h5>
                                    </div>
                                    <div class="payment_option">
                                        <div class="custome-radio">
                                            <input class="form-check-input" type="radio" name="payment_option" id="exampleRadios3" value="cod" wire:model="paymentOption">
                                            <label class="form-check-label" for="exampleRadios3">Thanh toán khi nhận hàng</label>
                                        </div>
                                        <div class="custome-radio">
                                            <input class="form-check-input" type="radio" name="payment_option" id="exampleRadios4" value="card" wire:model="paymentOption">
                                            <label class="form-check-label" for="exampleRadios4">Thanh toán bằng thẻ</label>
                                        </div>
                                        <div class="custome-radio">
                                            <input class="form-check-input" type="radio" name="payment_option" id="exampleRadios5" value="momo" wire:model="paymentOption">
                                            <label class="form-check-label" for="exampleRadios5">Thanh toán qua Momo</label>
                                        </div>
                                        <div class="custome-radio">
                                            <input class="form-check-input" type="radio" name="payment_option" id="exampleRadios6" value="vnpay" wire:model="paymentOption">
                                            <label class="form-check-label" for="exampleRadios6">Thanh toán qua VNPAY</label>
                                        </div>
                                    </div>
                                </div>

                                @error('paymentOption')
                                <div id="paymentError" style="color: red;">
                                    Vui lòng chọn phương thức thanh toán.
                                </div>
                                @enderror

                                <button type="submit" class="btn btn-fill-out btn-block mt-30 btn-primary">Đặt hàng</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>           
        </section>
    </main>
</div>

<script>

    console.log('JavaScript loaded'); 

    function selectRadio(radioId) {
        var radio = document.getElementById(radioId);
        if (radio) {
            radio.checked = true;
        }
    }

</script>
{{-- <script> 
    function selectRadio(id) { 
        document.getElementById(id).checked = true; 
        const cards = document.querySelectorAll('.hero-card'); 
        cards.forEach(card => card.style.border = '2px solid #ddd'); 
        document.getElementById(id).closest('.hero-card').style.border = '2px solid #007bff'; 
        document.getElementById(id).closest('.hero-card').style.boxShadow = '0 0 10px rgba(0, 123, 255, 0.6)'; 
    } 
    document.addEventListener('DOMContentLoaded', function () { 
        const radios = document.querySelectorAll('input[name="shipping_address_id"]'); 
        radios.forEach(radio => { 
            radio.addEventListener('change', function () { 
                const cards = document.querySelectorAll('.hero-card'); 
                cards.forEach(card => card.style.border = '2px solid #ddd'); 
                if (radio.checked) { 
                    radio.closest('.hero-card').style.border = '2px solid #007bff'; 
                    radio.closest('.hero-card').style.boxShadow = '0 0 10px rgba(0, 123, 255, 0.6)'; 
                } 
            }); 
        }); 
    }); 
</script> --}}
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
    </style>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">Trang chủ</a>
                    <span></span> Cửa hàng
                    <span></span> Thanh toán
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mb-sm-15">
                        <div class="toggle_info">
                            {{-- <span><i class="fi-rs-user mr-10"></i><span class="text-muted">Đã có tài khoản?</span> <a href="#loginform" data-bs-toggle="collapse" class="collapsed" aria-expanded="false">Nhấn vào đây để đăng nhập</a></span> --}}
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
                        <div class="divider mt-50 mb-50"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-25">
                            <h4>Thông tin thanh toán</h4>
                        </div>
                        <form method="post" action="{{ route('order.store') }}">
                            @csrf
                            <div class="form-group">
                                <input type="text" required="" name="fullname" wire:model="fullname" placeholder="Họ và tên*" readonly>
                            </div>
                            <div class="form-group">
                                <input type="text" required="" name="email" wire:model="email" placeholder="Địa chỉ email *" readonly>
                            </div>
                            <div class="form-group">
                                <label for="shipping_address">Địa chỉ giao hàng</label>
                                <div id="shipping_address" class="d-flex flex-wrap justify-content-start gap-3 mt-3">
                                    @foreach($addresses as $address)
                                        <div class="hero-card box-shadow-outer-6 wow fadeIn animated hover-up d-flex text-center mb-3" style="width: 100%;" onclick="selectRadio('address-{{ $address->id }}')">
                                            <div class="card-body d-flex align-items-center" style="cursor: pointer;">
                                                <!-- Thêm id cho radio -->
                                                {{-- <input type="radio" name="shipping_address" value="{{ $address->id }}" id="address-{{ $address->id }}" wire:model="selectedAddress" style="margin-right: 10px; transform: scale(1);"> --}}
                                                {{-- <input type="radio"
                                                    name="shipping_address" 
                                                    value="{{ $address->id }}" 
                                                    id="address-{{ $address->id }}" 
                                                    wire:model="selectedAddress" 
                                                    style="margin-right: 10px; transform: scale(1);">
                                                
                                                <div class="d-flex flex-column align-items-start">
                                                    <h5 class="card-title" style="margin-bottom: 5px;">{{ $address->address }}</h5>
                                                    <p class="card-text" style="margin-bottom: 5px;">SĐT: {{ $address->phone }}</p>
                                                    @if($address->is_default)
                                                        <p class="default-tag text-danger" style="margin-bottom: 0;">(Mặc định)</p>
                                                    @endif
                                                </div> --}}
                                                <input type="radio"
                                                    name="shipping_address" 
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
                                        </div>
                                    @endforeach
                                </div>                          
                            </div>
                            <div class="mb-20">
                                <h5>Thông tin bổ sung</h5>
                            </div>
                            <div class="form-group mb-30">
                                <textarea rows="5" name="order_notes" placeholder="Ghi chú đơn hàng"></textarea>
                            </div>
                        {{-- </form>                         --}}
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
                                            <th>Tổng cộng</th>
                                            <td colspan="2" class="product-subtotal"><span class="font-xl text-brand fw-900">{{ number_format((float) str_replace(',', '', Cart::total())) }}đ</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                            <div class="payment_method">
                                <div class="mb-25">
                                    <h5>Phương thức thanh toán</h5>
                                </div>
                                <div class="payment_option">
                                    {{-- <div class="custome-radio">
                                        <input class="form-check-input" required="" type="radio" name="payment_option" id="exampleRadios3">
                                        <label class="form-check-label" for="exampleRadios3" data-bs-toggle="collapse" data-target="#cashOnDelivery" aria-controls="cashOnDelivery">Thanh toán khi nhận hàng</label>                                        
                                    </div>
                                    <div class="custome-radio">
                                        <input class="form-check-input" required="" type="radio" name="payment_option" id="exampleRadios4">
                                        <label class="form-check-label" for="exampleRadios4" data-bs-toggle="collapse" data-target="#cardPayment" aria-controls="cardPayment">Thanh toán bằng thẻ</label>                                        
                                    </div>
                                    <div class="custome-radio">
                                        <input class="form-check-input" required="" type="radio" name="payment_option" id="exampleRadios5">
                                        <label class="form-check-label" for="exampleRadios5" data-bs-toggle="collapse" data-target="#paypal" aria-controls="paypal">Thanh toán qua Momo</label>                                        
                                    </div> --}}
                                    <div class="custome-radio">
                                        <input class="form-check-input" required="" type="radio" name="payment_option" id="exampleRadios3" value="cod">
                                        <label class="form-check-label" for="exampleRadios3">Thanh toán khi nhận hàng</label>
                                    </div>
                                    <div class="custome-radio">
                                        <input class="form-check-input" required="" type="radio" name="payment_option" id="exampleRadios4" value="card">
                                        <label class="form-check-label" for="exampleRadios4">Thanh toán bằng thẻ</label>
                                    </div>
                                    <div class="custome-radio">
                                        <input class="form-check-input" required="" type="radio" name="payment_option" id="exampleRadios5" value="momo">
                                        <label class="form-check-label" for="exampleRadios5">Thanh toán qua Momo</label>
                                    </div>
                                    
                                </div>
                            </div>
                            {{-- <a href="" type="submit" class="btn btn-fill-out btn-block mt-30">Đặt hàng</a>  --}}
                            <button type="submit" class="btn btn-fill-out btn-block mt-30">Đặt hàng</button> 
                        </div>
                    </div>
                </form>

                    {{-- <div class="mb-25">
                        <h4>Thông tin thanh toán</h4>
                    </div>
                    <form method="POST" action="{{ route('order.store') }}">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="fullname" placeholder="Họ và tên*" value="{{ Auth::user()->name ?? '' }}" required>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" placeholder="Địa chỉ email *" value="{{ Auth::user()->email ?? '' }}" required>
                        </div>
                        <div class="form-group">
                            <label for="shipping_address">Địa chỉ giao hàng</label>
                            <div id="shipping_address" class="d-flex flex-wrap justify-content-start gap-3 mt-3">
                                @foreach($addresses as $address)
                                    <div class="hero-card box-shadow-outer-6 wow fadeIn animated hover-up d-flex text-center mb-3" style="width: 100%;" onclick="selectRadio('address-{{ $address->id }}')">
                                        <div class="card-body d-flex align-items-center">
                                            <input type="radio" name="shipping_address" value="{{ $address->id }}" id="address-{{ $address->id }}" wire:model="selectedAddress" style="margin-right: 10px;">
                                            <div class="d-flex flex-column align-items-start">
                                                <h5 class="card-title">{{ $address->address }}</h5>
                                                <p class="card-text">SĐT: {{ $address->phone }}</p>
                                                @if($address->is_default)
                                                    <p class="default-tag text-danger">(Mặc định)</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group mb-30">
                            <textarea name="note" rows="5" placeholder="Ghi chú đơn hàng"></textarea>
                        </div>
                </div>

                <div class="col-md-6">
                    <div class="order_review">
                        <h4>Đơn hàng của bạn</h4>
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
                                                <h5><a href="product-details.html">{{ $item->model->name }}</a></h5>
                                                <span class="product-qty">x {{ $item->qty }}</span>
                                            </td>
                                            <td>{{ number_format($item->subtotal, 0, '', '.') }}đ</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <th>Tổng phụ</th>
                                        <td colspan="2">{{ number_format((float) Cart::subtotal()) }}đ</td>
                                    </tr>
                                    <tr>
                                        <th>VAT({{ config('cart.tax') }}%)</th>
                                        <td colspan="2">{{ number_format((float) Cart::tax()) }}đ</td>
                                    </tr>
                                    <tr>
                                        <th>Tổng cộng</th>
                                        <td colspan="2">{{ number_format((float) Cart::total()) }}đ</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="payment_option">
                            <div class="custome-radio">
                                <input class="form-check-input" type="radio" name="payment_option" value="cash" id="cash">
                                <label class="form-check-label" for="cash">Thanh toán khi nhận hàng</label>
                            </div>
                            <div class="custome-radio">
                                <input class="form-check-input" type="radio" name="payment_option" value="card" id="card">
                                <label class="form-check-label" for="card">Thanh toán bằng thẻ</label>
                            </div>
                            <div class="custome-radio">
                                <input class="form-check-input" type="radio" name="payment_option" value="momo" id="momo">
                                <label class="form-check-label" for="momo">Thanh toán qua Momo</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-fill-out btn-block mt-30">Đặt hàng</button>
                    </div>
                </div>
                </form> --}}

                </div>
            </div>
        </section>
    </main>
</div>

<script>
    function selectRadio(radioId) {
        var radio = document.getElementById(radioId);
        if (radio) {
            radio.checked = true;
        }
    }
</script>

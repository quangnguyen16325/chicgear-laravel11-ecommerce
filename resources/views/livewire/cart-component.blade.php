<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">Trang chủ</a>
                    <span></span> <a href="{{ route('shop') }}">Cửa hàng</a>
                    <span></span> Giỏ hàng
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            @if (Session::has('success_message'))
                                <div class="alert alert-success">
                                    <strong>{{ Session::get('success_message') }}</strong>
                                </div>
                            @endif
                            @if(Cart::instance('cart')->count() > 0)
                            <table class="table shopping-summery text-center clean">
                                <thead>
                                    <tr class="main-heading">
                                        <th scope="col">Hình ảnh</th>
                                        <th scope="col">Tên</th>
                                        <th scope="col">Giá</th>
                                        <th scope="col">Số lượng</th>
                                        <th scope="col">Tổng phụ</th>
                                        <th scope="col">Xóa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (Cart::instance('cart')->content() as $item)
                                    <tr>
                                        <td class="image product-thumbnail"><img src="{{ asset('assets/imgs/products/'. $item->model->image) }}" alt="#"></td>
                                        <td class="product-des product-name">
                                            <h5 class="product-name"><a href="{{ route('product.details',['slug'=>$item->model->slug])}}">{{ $item->model->name }}</a></h5>
                                            {{-- <p class="font-xs">Maboriosam in a tonto nesciung eget<br> distingy magndapibus.
                                            </p> --}}
                                        </td>
                                        <td class="price" data-title="Price"><span>{{ number_format($item->model->regular_price, 0, '', '.') }}đ </span></td>
                                        <td class="text-center" data-title="Stock">
                                            <div class="detail-qty border radius  m-auto">
                                                <a href="#" class="qty-down" wire:click.prevent="decreaseQuantity('{{ $item->rowId }}')"><i class="fi-rs-angle-small-down"></i></a>
                                                <span class="qty-val">{{ $item->qty }}</span>
                                                <a href="#" class="qty-up" wire:click.prevent="increaseQuantity('{{ $item->rowId }}')"><i class="fi-rs-angle-small-up"></i></a>
                                            </div>
                                        </td>
                                        <td class="text-right" data-title="Cart">
                                            <span>{{ number_format($item->subtotal, 0, '', '.') }}đ</span>
                                        </td>
                                        <td class="action" data-title="Remove"><a href="#" class="text-muted" wire:click.prevent="destroy('{{ $item->rowId }}')"><i class="fi-rs-trash"></i></a></td>
                                    </tr>
                                    @endforeach
                                    
                                    <tr>
                                        <td colspan="6" class="text-end">
                                            <a href="#" class="text-muted" wire:click.prevent="clearAll()"> <i class="fi-rs-cross-small"></i> Xóa giỏ hàng</a>
                                        </td>
                                    </tr> 
                                </tbody>
                            </table>
                            @else
                                <p>Không có sản phẩm nào trong giỏ hàng</p>
                            @endif
                        </div>
                        <div class="cart-action text-end">
                            <a href="{{ route('shop.cart') }}" class="btn  mr-10 mb-sm-15"><i class="fi-rs-shuffle mr-10"></i>Cập nhật giỏ hàng</a>
                            <a href="{{ route('shop') }}" class="btn "><i class="fi-rs-shopping-bag mr-10"></i>Tiếp tục mua sắm</a>
                        </div>
                        <div class="divider center_icon mt-50 mb-50"><i class="fi-rs-fingerprint"></i></div>
                        <div class="row mb-50">
                            <div class="col-lg-6 col-md-12">
                                <div class="heading_s1 mb-3">
                                    <h4>Tính phí vận chuyển</h4>
                                </div>
                                <p class="mt-15 mb-30">Phí cố định: <span class="font-xl text-brand fw-900">0%</span></p>
                                <form class="field_form shipping_calculator">
                                    <div class="form-row">
                                        <div class="form-group col-lg-12">
                                            <div class="custom_select">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row row">
                                        <div class="form-group col-lg-6">
                                            <input required="required" placeholder="Tỉnh / Thành phố" name="name" type="text">
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <input required="required" placeholder="Quận / Huyện" name="name" type="text">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-lg-12">
                                            <button class="btn  btn-sm"><i class="fi-rs-shuffle mr-10"></i>Cập nhật</button>
                                        </div>
                                    </div>
                                </form>
                                {{-- <div class="mb-30 mt-50">
                                    <div class="heading_s1 mb-3">
                                        <h4>Áp dụng mã giảm giá</h4>
                                    </div>
                                    <div class="total-amount">
                                        <div class="left">
                                            <div class="coupon">
                                                <form action="#" target="_blank">
                                                    <div class="form-row row justify-content-center">
                                                        <div class="form-group col-lg-6">
                                                            <input class="font-medium" name="Coupon" placeholder="Điền mã giảm giá của bạn">
                                                        </div>
                                                        <div class="form-group col-lg-6">
                                                            <button class="btn  btn-sm"><i class="fi-rs-label mr-10"></i>Áp dụng</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="border p-md-4 p-30 border-radius cart-totals">
                                    <div class="heading_s1 mb-3">
                                        <h4>Tổng giỏ hàng</h4>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td class="cart_total_label">Tổng phụ giỏ hàng</td>
                                                    <td class="cart_total_amount"><span class="font-lg fw-900 text-brand">{{ number_format((float) str_replace(',', '', Cart::subtotal())) }}đ</span></td>
                                                </tr>
                                                <tr>
                                                    {{-- config/cart.php --}}
                                                    <td class="cart_total_label">VAT({{ config('cart.tax') }}%)</td>
                                                    <td class="cart_total_amount"><span class="font-lg fw-900 text-brand">{{ number_format((float) str_replace(',', '', Cart::tax())) }}đ</span></td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td class="cart_total_label">Phí vận chuyển</td>
                                                    <td class="cart_total_amount"> <i class="ti-gift mr-5"></i> Miễn phí vận chuyển</td>
                                                </tr>
                                                <tr>
                                                    <td class="cart_total_label">Tổng</td>
                                                    <td class="cart_total_amount"><strong><span class="font-xl fw-900 text-brand">{{ number_format((float) str_replace(',', '', Cart::total())) }}đ</span></strong></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <a href="{{ route('shop.checkout') }}" class="btn "> <i class="fi-rs-box-alt mr-10"></i> Tiến hành thanh toán</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>

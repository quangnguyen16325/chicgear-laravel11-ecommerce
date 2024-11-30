<div class="header-action-icon-2">
    <a class="mini-cart-icon" href="{{ route('shop.cart') }}">
        <img alt="cart" src="{{ asset('assets/imgs/theme/icons/icon-cart.svg') }}">
        @php
            $cartItems = Cart::instance('cart')->content();
            $uniqueItemsCount = $cartItems->count();
        @endphp
        @if ($uniqueItemsCount > 0)
            <span class="pro-count blue">{{ $uniqueItemsCount }}</span>
        @endif
    </a>
    <div class="cart-dropdown-wrap cart-dropdown-hm2">
        <ul>
            @foreach (Cart::instance('cart')->content() as $item)
            <li>
                <div class="shopping-cart-img">
                    <a href="{{ route('product.details',['slug'=>$item->model->slug])}}">
                        <img alt="{{ $item->model->name }}" 
                        src="{{ asset('assets/imgs/products') }}/{{ $item->model->image }}">
                    </a>
                </div>
                <div class="shopping-cart-title">
                    <h4><a href="{{ route('product.details',['slug'=>$item->model->slug])}}">{{ substr($item->model->name,0,20) }}...</a></h4>
                    <h4><span>{{ $item->qty }} × </span>{{ number_format($item->model->regular_price, 0, '', '.') }}đ</h4>
                </div>
                {{-- <div class="shopping-cart-delete">
                    <a href="#"><i class="fi-rs-cross-small"></i></a>
                </div> --}}
            </li>
            @endforeach
        </ul>
        <div class="shopping-cart-footer">
            <div class="shopping-cart-total">
                <h4>Tổng <span>{{ number_format((float) str_replace(',', '', Cart::instance('cart')->total())) }}đ</span></h4>
            </div>
            <div class="shopping-cart-button">
                <a href="{{ route('shop.cart') }}" class="outline">Xem Giỏ hàng</a>
                <a href="{{ route('shop.checkout') }}">Thanh toán</a>
            </div>
        </div>
    </div>
</div>
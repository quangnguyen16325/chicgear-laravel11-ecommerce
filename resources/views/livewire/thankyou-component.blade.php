<div>
    <div class="container">
        <div class="alert alert-success mt-5">
            @if (Session::has('success_message'))
                <h4>Đặt hàng thành công!</h4>
                {{-- <strong>{{ Session::get('success_message') }}</strong> --}}
                <p>Cảm ơn bạn đã mua sắm tại cửa hàng của chúng tôi.</p>
                <a href="{{ route('shop') }}" class="btn btn-primary">Tiếp tục mua sắm</a>
            @elseif (Session::has('error'))
                <h4>Thanh toán thất bại!</h4>
                <p>Bạn có thể thanh toán lại tại đây.</p>
                <strong>{{ Session::get('error') }}</strong><br>
                <a href="{{ route('shop.checkout') }}" class="btn btn-primary">Thanh toán lại</a>
            @endif
            {{-- <h4>Đặt hàng thành công!</h4>
            <p>Cảm ơn bạn đã mua sắm tại cửa hàng của chúng tôi.</p>
            <a href="{{ route('shop') }}" class="btn btn-primary">Tiếp tục mua sắm</a> --}}
        </div>
    </div>
</div>

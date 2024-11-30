<div>
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="/" rel="nofollow">Trang chủ</a>                    
                <span></span>Trang cá nhân
            </div>
        </div>
    </div>
    <div class="user-dashboard container mt-5">
        <!-- Content -->
        <div class="content">
            <h3 class="dashboard-title text-center mb-2 mt-4">Trang cá nhân</h3>
            <p class="welcome-message text-center text-muted">Chào mừng {{ $user->name }} đến với trang cá nhân của bạn!</p>

            <div class="content-container flex-grow-1 p-4">
                <!-- Row with 3 columns -->
                <div class="row mt-1">
                    <div class="col-md-4">
                        <div class="hero-card box-shadow-outer-6 wow fadeIn animated mb-30 hover-up d-flex text-center">
                            <div class="card-body">
                                <h5 class="card-title">Thông tin cá nhân</h5>
                                <p class="card-text">Chào mừng bạn, {{ $user->name }}</p>
                                <a href="{{ route('user.profile') }}" class="small mt-3 hover-link">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="hero-card box-shadow-outer-6 wow fadeIn animated mb-30 hover-up d-flex text-center">
                            <div class="card-body">
                                <h5 class="card-title">Đơn hàng của bạn</h5>
                                <p class="card-text">Bạn có {{ $orderCount ?? 0 }} đơn hàng</p>
                                <a href="{{ route('user.order') }}" class="small mt-3 hover-link">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="hero-card box-shadow-outer-6 wow fadeIn animated mb-30 hover-up d-flex text-center">
                            <div class="card-body">
                                <h5 class="card-title">Mã giảm giá</h5>
                                <p class="card-text">Bạn có 0 mã giảm giá</p>
                                <a href="#" class="small mt-3 hover-link">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Row with 2 columns -->
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="hero-card box-shadow-outer-6 wow fadeIn animated mb-30 hover-up d-flex text-center">
                            <div class="card-body">
                                <h5 class="card-title">Lịch sử mua sắm</h5>
                                <p class="card-text">Xem lịch sử mua sắm của bạn</p>
                                <a href="{{ route('user.order.histories') }}" class="small mt-3 hover-link">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="hero-card box-shadow-outer-6 wow fadeIn animated mb-30 hover-up d-flex text-center">
                            <div class="card-body">
                                <h5 class="card-title">Thông báo</h5>
                                <p class="card-text">Xem thông báo mới nhất</p>
                                <a href="#" class="small mt-3 hover-link">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Khuyến mãi hoặc các mục khác -->
                <div class="card mt-4">
                    <div class="card-body">
                        <h5 class="card-title">Khuyến mãi hiện tại</h5>
                        <p class="card-text">Xem các chương trình khuyến mãi đặc biệt dành cho bạn!</p>
                        <a href="#" class="small mt-3 hover-link">Xem chi tiết</a>
                    </div>
                </div>
            </div>            
        </div>
    </div>    
</div>

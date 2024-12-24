<!DOCTYPE html>
<html class="no-js" lang="vi">

<head>
    <meta charset="utf-8">
<title>Chicgear Shop</title>
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta property="og:title" content="">
<meta property="og:type" content="">
<meta property="og:url" content="">
<meta property="og:image" content="">
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/imgs/theme/favicon.ico') }}">
<link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/override.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
@livewireStyles
</head>

<body>
    <header class="header-area header-style-1 header-height-2">
        <div class="header-top header-top-ptb-1 d-none d-lg-block">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-3 col-lg-4">
                        <div class="header-info">
                        <!-- <ul>
                                <li>
                                    <a class="language-dropdown-active" href="#"> <i class="fi-rs-world"></i> English <i class="fi-rs-angle-small-down"></i></a>
                                    <ul class="language-dropdown">
                                        <li><a href="#"><img src="assets/imgs/theme/flag-fr.png" alt="">Français</a></li>
                                        <li><a href="#"><img src="assets/imgs/theme/flag-dt.png" alt="">Deutsch</a></li>
                                        <li><a href="#"><img src="assets/imgs/theme/flag-ru.png" alt="">Pусский</a></li>
                                    </ul>
                                </li>                                
                            </ul> -->
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-4">
                        <div class="text-center">
                            <div id="news-flash" class="d-inline-block">
                                <ul>
                                    <li>Giảm giá lên đến 50% cho các sản phẩm <a href="{{ route('shop') }}">Xem chi tiết</a></li>
                                    <li>Ưu đãi tuyệt vời - Tiết kiệm nhiều hơn với mã giảm giá!</li>
                                    <li>Trang sức, tiết kiệm lên đến 35% hôm nay! <a href="{{ route('shop') }}"> Mua ngay</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4">
                        <div class="header-info header-info-right">
                            @auth
                            <ul>                                
                                <li><i class="fi-rs-user"></i> {{ Auth::user()->name }}/ 
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" style="font-weight: bold">Đăng xuất</a>
                                    </form>
                                </li>
                            </ul>  
                            @else
                            <ul>                                
                                <li><i class="fi-rs-key"></i><a href="{{ route('login') }}" style="font-weight: bold">Đăng nhập </a>  / <a href="{{ route('register') }}" style="font-weight: bold">Đăng ký</a></li>
                            </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
            <div class="container">
                <div class="header-wrap">
                    <div class="logo logo-width-1">
                        <a href="/"><img src="{{ asset('assets/imgs/logo/logo.png') }}" alt="logo"></a>
                    </div>
                    <div class="header-right">
                        @livewire('header-search-component')
                        <div class="header-action-right">
                            <div class="header-action-2">
                                @livewire('wishlist-icon-component')
                                @livewire('cart-icon-component')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom header-bottom-bg-color sticky-bar">
            <div class="container">
                <div class="header-wrap header-space-between position-relative">
                    <div class="logo logo-width-1 d-block d-lg-none">
                        <a href="index.html"><img src="assets/imgs/logo/logo.png" alt="logo"></a>
                    </div>
                    <div class="header-nav d-none d-lg-flex">
                        <div class="main-categori-wrap d-none d-lg-block">
                            <a class="categori-button-active" href="#">
                                <span class="fi-rs-apps"></span> Danh mục
                            </a>
                            <div class="categori-dropdown-wrap categori-dropdown-active-large">
                                <ul class="categories-list">
                                    @foreach($categories as $category)
                                        <li><a href="{{ route('product.category',['slug'=>$category->slug]) }}" class="surfsidemedia-font-dress fw-bold">{{ $category->name }}</a></li>
                                    @endforeach
                                </ul>
                                {{-- <div class="more_categories">Xem thêm...</div> --}}
                            </div>
                        </div>
                        <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block">
                            <nav>
                                <ul>
                                    <li><a class="active" href="/">Trang chủ</a></li>
                                    <li><a href="{{ route('about') }}">Giới thiệu</a></li>
                                    <li><a href="{{ route('shop') }}">Cửa hàng</a></li>
                                    <li><a href="{{ route('blog') }}">Bài viết </a></li>                                    
                                    <li><a href="{{ route('contact') }}">Liên hệ</a></li>
                                    @auth
                                        <li><a href="#">Tài khoản của tôi<i class="fi-rs-angle-down"></i></a>
                                            @if(Auth::user()->utype == 'ADM' || Auth::user()->utype == 'ADM-M')
                                                <ul class="sub-menu">
                                                    <li><a href="{{ route('admin.dashboard') }}">Trang tổng quan</a></li>
                                                    <li><a href="{{ route('admin.profile') }}">Trang cá nhân</a></li>
                                                    <li><a href="{{ route('admin.products') }}">Sản phẩm</a></li>
                                                    <li><a href="{{ route('admin.categories') }}">Danh mục</a></li>
                                                    <li><a href="{{ route('admin.home.slider') }}">Slider</a></li>
                                                    <li><a href="{{ route('admin.discount_codes') }}">Mã giảm giá</a></li>
                                                    <li><a href="{{ route('admin.order') }}">Đơn hàng</a></li>
                                                    <li><a href="{{ route('admin.users') }}">Người dùng</a></li>                                            
                                                </ul>
                                            @else
                                                <ul class="sub-menu">
                                                    <li><a href="{{ route('user.dashboard') }}">Trang khách hàng</a></li>                                          
                                                </ul>
                                            @endif
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="hotline d-none d-lg-block">
                        <p><i class="fi-rs-smartphone"></i><span>Liên hệ</span> 1800-702-205 </p>
                    </div>
                    <p class="mobile-promotion">Chúc mừng <span class="text-brand">Ngày của Mẹ</span>. Giảm giá lớn lên đến 40%</p>
                    <div class="header-action-right d-block d-lg-none">
                        <div class="header-action-2">
                            <div class="header-action-icon-2">
                                @livewire('wishlist-icon-component')
                            </div>
                            <div class="header-action-icon-2">
                                @livewire('cart-icon-component')
                            </div>
                            <div class="header-action-icon-2 d-block d-lg-none">
                                <div class="burger-icon burger-icon-white">
                                    <span class="burger-icon-top"></span>
                                    <span class="burger-icon-mid"></span>
                                    <span class="burger-icon-bottom"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="mobile-header-active mobile-header-wrapper-style">
        <div class="mobile-header-wrapper-inner">
            <div class="mobile-header-top">
                <div class="mobile-header-logo">
                    <a href="index.html"><img src="assets/imgs/logo/logo.png" alt="logo"></a>
                </div>
                <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                    <button class="close-style search-close">
                        <i class="icon-top"></i>
                        <i class="icon-bottom"></i>
                    </button>
                </div>
            </div>
            <div class="mobile-header-content-area">
                <div class="mobile-search search-style-3 mobile-header-border">
                    @livewire('header-search-component')
                </div>
                <div class="mobile-menu-wrap mobile-header-border">
                    <div class="main-categori-wrap mobile-header-border">
                        <a class="categori-button-active-2" href="#">
                            <span class="fi-rs-apps"></span> Các Danh mục
                        </a>
                        <div class="categori-dropdown-wrap categori-dropdown-active-small">
                            <ul>
                                @foreach ($categories as $category)
                                    <li><a href="{{ route('product.category',['slug'=>$category->slug]) }}">{{ $category->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- mobile menu start -->
                    <nav>
                        <ul class="mobile-menu">
                            <li class="menu-item-has-children"><span class="menu-expand"></span><a href="/">Trang chủ</a></li>
                            <li class="menu-item-has-children"><span class="menu-expand"></span><a href="{{ route('shop') }}">Cửa hàng</a></li>
                            
                            <li class="menu-item-has-children"><span class="menu-expand"></span><a href="{{ route('blog') }}">Bài viết</a></li>
                        </ul>
                    </nav>
                    <!-- mobile menu end -->
                </div>
                <div class="mobile-header-info-wrap mobile-header-border">
                    <div class="single-mobile-header-info mt-30">
                        <a href="{{ route('about') }}"> Giới thiệu </a>
                    </div>
                    <div class="single-mobile-header-info">
                        <a href="{{ route('login') }}">Đăng nhập </a>                        
                    </div>
                    <div class="single-mobile-header-info">                        
                        <a href="{{ route('register') }}">Đăng ký</a>
                    </div>
                    <div class="single-mobile-header-info">
                        <a href="#">1800-702-205 </a>
                    </div>
                </div>
                <div class="mobile-social-icon">
                    <h5 class="mb-15 text-grey-4">Theo dõi chúng tôi</h5>
                    <a href="https://www.facebook.com/Quang163/" target="_blank"><img src="{{ asset('assets/imgs/theme/icons/icon-facebook.svg') }}" alt="Facebook"></a>
                    <a href="#"><img src="{{ asset('assets/imgs/theme/icons/icon-twitter.svg') }}" alt=""></a>
                    <a href="https://www.instagram.com/wg.nyn631/" target="_blank"><img src="{{ asset('assets/imgs/theme/icons/icon-instagram.svg') }}" alt=""></a>
                    <a href="#"><img src="{{ asset('assets/imgs/theme/icons/icon-pinterest.svg') }}" alt=""></a>
                    <a href="#"><img src="{{ asset('assets/imgs/theme/icons/icon-youtube.svg') }}" alt=""></a>
                </div>
            </div>
        </div>
    </div>        

    {{ $slot }}

    <footer class="main">
        <section class="newsletter p-30 text-white wow fadeIn animated">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7 mb-md-3 mb-lg-0">
                        <div class="row align-items-center">
                            <div class="col flex-horizontal-center">
                                <img class="icon-email" src="{{ asset('assets/imgs/theme/icons/icon-email.svg') }}" alt="">
                                <h4 class="font-size-20 mb-0 ml-3">Đăng ký nhận bản tin</h4>
                            </div>
                            <div class="col my-4 my-md-0 des">
                                <h5 class="font-size-15 ml-4 mb-0">...và nhận ngay <strong>mã giảm giá 25% cho đơn hàng đầu tiên.</strong></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <!-- Subscribe Form -->
                        <form class="form-subcriber d-flex wow fadeIn animated">
                            <input type="email" class="form-control bg-white font-small" placeholder="Điền Email của bạn">
                            <button class="btn bg-dark text-white" type="submit">Đăng ký</button>
                        </form>
                        <!-- End Subscribe Form -->
                    </div>
                </div>
            </div>
        </section>
        <section class="section-padding footer-mid">
            <div class="container pt-15 pb-20">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="widget-about font-md mb-md-5 mb-lg-0">
                            <div class="logo logo-width-1 wow fadeIn animated">
                                <a href="index.html"><img src="{{ asset('assets/imgs/logo/logo.png') }}" alt="logo"></a>
                            </div>
                            <h5 class="mt-20 mb-10 fw-600 text-grey-4 wow fadeIn animated">Liên hệ</h5>
                            <p class="wow fadeIn animated">
                                <strong>Địa chỉ: </strong>470 Trần Đại Nghĩa
                            </p>
                            <p class="wow fadeIn animated">
                                <strong>Điện thoại: </strong>1800-702-205
                            </p>
                            <p class="wow fadeIn animated">
                                <strong>Email: </strong>quangnn.23ite@vku.udn.vn
                            </p>
                            <h5 class="mb-10 mt-30 fw-600 text-grey-4 wow fadeIn animated">Theo dõi chúng tôi</h5>
                            <div class="mobile-social-icon wow fadeIn animated mb-sm-5 mb-md-0">
                                <a href="https://www.facebook.com/Quang163/" target="_blank"><img src="{{ asset('assets/imgs/theme/icons/icon-facebook.svg') }}" alt="Facebook"></a>
                                <a href="#"><img src="{{ asset('assets/imgs/theme/icons/icon-twitter.svg') }}" alt=""></a>
                                <a href="https://www.instagram.com/wg.nyn631/" target="_blank"><img src="{{ asset('assets/imgs/theme/icons/icon-instagram.svg') }}" alt=""></a>
                                <a href="#"><img src="{{ asset('assets/imgs/theme/icons/icon-pinterest.svg') }}" alt=""></a>
                                <a href="#"><img src="{{ asset('assets/imgs/theme/icons/icon-youtube.svg') }}" alt=""></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3">
                        <h5 class="widget-title wow fadeIn animated">Giới thiệu</h5>
                        <ul class="footer-list wow fadeIn animated mb-sm-5 mb-md-0">
                            <li><a href="#">Về chúng tôi</a></li>
                            <li><a href="#">Thông tin giao hàng</a></li>
                            <li><a href="#">Chính sách bảo mật</a></li>
                            <li><a href="#">Điều khoản &amp; Điều kiện</a></li>
                            <li><a href="#">Liên hệ với chúng tôi</a></li>
                        </ul>
                    </div>                    
                    <div class="col-lg-2 col-md-3">
                        <h5 class="widget-title wow fadeIn animated">Tài khoản của tôi</h5>
                        <ul class="footer-list wow fadeIn animated">
                            <li><a href="{{ route('admin.dashboard') }}">Tài Khoản Của Tôi</a></li>
                            <li><a href="{{ route('shop.cart') }}">Xem Giỏ Hàng</a></li>
                            <li><a href="{{ route('shop.wishlist') }}">Danh Sách Yêu Thích</a></li>
                            <li><a href="#">Theo Dõi Đơn Hàng</a></li>
                            <li><a href="#">Đơn Hàng</a></li>
                        </ul>
                    </div>                    
                    <div class="col-lg-4 mob-center">
                        <h5 class="widget-title wow fadeIn animated">Cài đặt ứng dụng</h5>
                        <div class="row">
                            <div class="col-md-8 col-lg-12">
                                <p class="wow fadeIn animated">Từ App Store hoặc Google Play</p>
                                <div class="download-app wow fadeIn animated mob-app">
                                    <a href="#" class="hover-up mb-sm-4 mb-lg-0"><img class="active" src="{{ asset('assets/imgs/theme/app-store.jpg') }}" alt="App Store"></a>
                                    <a href="#" class="hover-up"><img src="{{ asset('assets/imgs/theme/google-play.jpg') }}" alt="Google Play"></a>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-12 mt-md-3 mt-lg-0">
                                <p class="mb-20 wow fadeIn animated">Cổng thanh toán an toàn</p>
                                <img class="wow fadeIn animated" src="{{ asset('assets/imgs/theme/payment-method.png') }}" alt="Phương thức thanh toán">
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
        </section>
        <div class="container pb-20 wow fadeIn animated mob-center">
            <div class="row">
                <div class="col-12 mb-20">
                    <div class="footer-bottom"></div>
                </div>
                <div class="col-lg-6">
                    <p class="float-md-left font-sm text-muted mb-0">
                        <a href="#">Chính sách bảo mật</a> | <a href="#">Điều khoản & Điều kiện</a>
                    </p>
                </div>
                <div class="col-lg-6">
                    <p class="text-lg-end text-start font-sm text-muted mb-0">
                        &copy; Bản quyền thuộc về <strong class="text-brand">Chicgear Store</strong>
                    </p>
                </div>
            </div>
        </div>
        
    </footer>    
    <!-- Vendor JS-->
<script src="{{ asset('assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/slick.js') }}"></script>
<script src="{{ asset('assets/js/plugins/jquery.syotimer.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/wow.js') }}"></script>
<script src="{{ asset('assets/js/plugins/jquery-ui.js') }}"></script>
<script src="{{ asset('assets/js/plugins/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('assets/js/plugins/magnific-popup.js') }}"></script>
<script src="{{ asset('assets/js/plugins/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/waypoints.js') }}"></script>
<script src="{{ asset('assets/js/plugins/counterup.js') }}"></script>
<script src="{{ asset('assets/js/plugins/jquery.countdown.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/images-loaded.js') }}"></script>
<script src="{{ asset('assets/js/plugins/isotope.js') }}"></script>
<script src="{{ asset('assets/js/plugins/scrollup.js') }}"></script>
<script src="{{ asset('assets/js/plugins/jquery.vticker-min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/jquery.theia.sticky.js') }}"></script>
<script src="{{ asset('assets/js/plugins/jquery.elevatezoom.js') }}"></script>
<!-- Template  JS -->
<script src="{{ asset('assets/js/main.js?v=3.3') }}"></script>
<script src="{{ asset('assets/js/shop.js?v=3.3') }}"></script>
@livewireScripts
@stack('scripts')
</body>
</html>
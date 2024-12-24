<div>
    <style>
        .truncate-text {
            white-space: nowrap; 
            overflow: hidden;   
            text-overflow: ellipsis; 
            max-width: 100%;    
        }
        
        .truncate-two-lines {
            display: -webkit-box;        
            -webkit-box-orient: vertical; 
            overflow: hidden;            
            text-overflow: ellipsis;    
            -webkit-line-clamp: 2;       
            line-height: 1.5em;        
            max-height: 3em;            
        }


    </style>

    <main class="main">
        <section class="home-slider position-relative pt-50">
            <div class="hero-slider-1 dot-style-1 dot-style-1-position-1">
                @foreach ($slides as $slide)
                    <div class="single-hero-slider single-animation-wrap">
                        <div class="container">
                            <div class="row align-items-center slider-animated-1">
                                <div class="col-lg-5 col-md-6">
                                    <div class="hero-slider-content-2">
                                        <h4 class="animated">{{ $slide->top_title }}</h4>
                                        <h2 class="animated fw-900">{{ $slide->title }}</h2>
                                        <h1 class="animated fw-900 text-brand">{{ $slide->sub_title }}</h1>
                                        <p class="animated">{{ $slide->offer }}</p>
                                        <a class="animated btn btn-brush btn-brush-3" href="{{ $slide->link }}"> Mua ngay </a>
                                    </div>
                                </div>
                                <div class="col-lg-7 col-md-6">
                                    <div class="single-slider-img single-slider-img-1">
                                        <img class="animated slider-1-1" src="{{ asset('assets/imgs/slider') }}/{{ $slide->image }}" alt="{{ $slide->title }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach              
            </div>
            <div class="slider-arrow hero-slider-1-arrow"></div>
        </section>
        <section class="featured section-padding position-relative">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                        <div class="banner-features wow fadeIn animated hover-up">
                            <img src="assets/imgs/theme/icons/feature-1.png" alt="">
                            <h4 class="bg-1">Miễn phí vận chuyển</h4>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                        <div class="banner-features wow fadeIn animated hover-up">
                            <img src="assets/imgs/theme/icons/feature-2.png" alt="">
                            <h4 class="bg-3">Đặt hàng Online</h4>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                        <div class="banner-features wow fadeIn animated hover-up">
                            <img src="assets/imgs/theme/icons/feature-3.png" alt="">
                            <h4 class="bg-2">Tiết kiệm tiền</h4>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                        <div class="banner-features wow fadeIn animated hover-up">
                            <img src="assets/imgs/theme/icons/feature-4.png" alt="">
                            <h4 class="bg-4">Khuyến mãi</h4>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                        <div class="banner-features wow fadeIn animated hover-up">
                            <img src="assets/imgs/theme/icons/feature-5.png" alt="">
                            <h4 class="bg-5">Mua sắm vui vẻ</h4>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                        <div class="banner-features wow fadeIn animated hover-up">
                            <img src="assets/imgs/theme/icons/feature-6.png" alt="">
                            <h4 class="bg-6">Hỗ trợ 24/7</h4>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="product-tabs section-padding position-relative wow fadeIn animated">
            <div class="bg-square"></div>
            <div class="container">
                <div class="tab-header">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="nav-tab-one" data-bs-toggle="tab" data-bs-target="#tab-one" type="button" role="tab" aria-controls="tab-one" aria-selected="true">Nổi bật</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="nav-tab-two" data-bs-toggle="tab" data-bs-target="#tab-two" type="button" role="tab" aria-controls="tab-two" aria-selected="false">Bán chạy</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="nav-tab-three" data-bs-toggle="tab" data-bs-target="#tab-three" type="button" role="tab" aria-controls="tab-three" aria-selected="false">Sản phẩm mới</button>
                        </li>
                    </ul>
                    <a href="{{ route('shop') }}" class="view-more d-none d-md-flex">Xem thêm<i class="fi-rs-angle-double-small-right"></i></a>
                </div>
                <!--End nav-tabs-->
                <div class="tab-content wow fadeIn animated" id="myTabContent">
                    <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                        <div class="row product-grid-4">
                            @foreach ($fproducts as $fproduct)
                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 col-6">
                                    <div class="product-cart-wrap mb-30">
                                        <div class="product-img-action-wrap">
                                            <div class="product-img product-img-zoom">
                                                <a href="{{ route('product.details',['slug'=>$fproduct->slug])}}">
                                                    <img class="default-img" src="{{ asset('assets/imgs/products/'. $fproduct->image) }}" alt="{{ $fproduct->name }}">
                                                    {{-- <img class="hover-img" src="assets/imgs/shop/product-1-2.jpg" alt=""> --}}
                                                </a>
                                            </div>
                                            <div class="product-action-1">
                                                {{-- <a aria-label="Quick view" class="action-btn hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                                <a aria-label="Add To Wishlist" class="action-btn hover-up" href="wishlist.php"><i class="fi-rs-heart"></i></a>
                                                <a aria-label="Compare" class="action-btn hover-up" href="compare.php"><i class="fi-rs-shuffle"></i></a> --}}
                                            </div>
                                            <div class="product-badges product-badges-position product-badges-mrg">
                                                <span class="hot">Nổi bật</span>
                                            </div>
                                        </div>
                                        <div class="product-content-wrap">
                                            <div class="product-category">
                                                <a href="{{ route('shop') }}">ChicGear</a>
                                            </div>
                                            <h2 class="truncate-text">
                                                <a href="{{ route('product.details',['slug'=>$fproduct->slug])}}" title="{{ $fproduct->name }}">{{ $fproduct->name }}</a>
                                            </h2>
                                            <div class="rating-result" title="90%">
                                                <span>
                                                    <span>90%</span>
                                                </span>
                                            </div>
                                            <div class="product-price">
                                                <span>{{ number_format($fproduct->regular_price, 0, '', '.') }}đ </span>
                                                {{-- <span class="old-price">$245.8</span> --}}
                                            </div>
                                            <div class="product-action-1 show">
                                                <a aria-label="Thêm vào Giỏ hàng" 
                                                    class="action-btn hover-up" 
                                                    href="#" 
                                                    wire:click.prevent="store({{ $fproduct->id }},'{{ $fproduct->name }}',{{ $fproduct->regular_price }})">
                                                    <i class="fi-rs-shopping-bag-add"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!--End product-grid-4-->
                    </div>
                    <!--En tab one (Featured)-->
                    <div class="tab-pane fade" id="tab-two" role="tabpanel" aria-labelledby="tab-two">
                        <div class="row product-grid-4">
                            @foreach ($topSellingProducts as $topproduct)
                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 col-6">
                                    <div class="product-cart-wrap mb-30">
                                        <div class="product-img-action-wrap">
                                            <div class="product-img product-img-zoom">
                                                <a href="{{ route('product.details',['slug'=>$topproduct->slug])}}">
                                                    <img class="default-img" src="{{ asset('assets/imgs/products/'. $topproduct->image) }}" alt="{{ $topproduct->name }}">
                                                    {{-- <img class="hover-img" src="assets/imgs/shop/product-1-2.jpg" alt=""> --}}
                                                </a>
                                            </div>
                                            <div class="product-action-1">
                                                {{-- <a aria-label="Quick view" class="action-btn hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                                <a aria-label="Add To Wishlist" class="action-btn hover-up" href="wishlist.php"><i class="fi-rs-heart"></i></a>
                                                <a aria-label="Compare" class="action-btn hover-up" href="compare.php"><i class="fi-rs-shuffle"></i></a> --}}
                                            </div>
                                            <div class="product-badges product-badges-position product-badges-mrg">
                                                <span class="best">Bán chạy</span>
                                            </div>
                                        </div>
                                        <div class="product-content-wrap">
                                            <div class="product-category">
                                                <a href="{{ route('shop') }}">ChicGear</a>
                                            </div>
                                                <h2 class="truncate-text">
                                                    <a href="{{ route('product.details',['slug'=>$topproduct->slug])}}" title="{{ $topproduct->name }}">{{ $topproduct->name }}</a>
                                                </h2>
                                            <div class="rating-result" title="90%">
                                                <span>
                                                    <span>90%</span>
                                                </span>
                                            </div>
                                            <div class="product-price">
                                                <span>{{ number_format($topproduct->regular_price, 0, '', '.') }}đ </span>
                                                {{-- <span class="old-price">$245.8</span> --}}
                                            </div>
                                            <div class="product-action-1 show">
                                                <a aria-label="Thêm vào Giỏ hàng" 
                                                    class="action-btn hover-up" 
                                                    href="#" 
                                                    wire:click.prevent="store({{ $topproduct->id }},'{{ $topproduct->name }}',{{ $topproduct->regular_price }})">
                                                    <i class="fi-rs-shopping-bag-add"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!--End product-grid-4-->
                    </div>
                    <!--En tab two (Popular)-->
                    <div class="tab-pane fade" id="tab-three" role="tabpanel" aria-labelledby="tab-three">
                        <div class="row product-grid-4">
                            @foreach ($lproducts as $lproduct)
                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 col-6">
                                    <div class="product-cart-wrap mb-30">
                                        <div class="product-img-action-wrap">
                                            <div class="product-img product-img-zoom">
                                                <a href="{{ route('product.details',['slug'=>$lproduct->slug])}}">
                                                    <img class="default-img" src="{{ asset('assets/imgs/products/'. $lproduct->image) }}" alt="{{ $lproduct->name }}">
                                                    {{-- <img class="hover-img" src="assets/imgs/shop/product-1-2.jpg" alt=""> --}}
                                                </a>
                                            </div>
                                            <div class="product-action-1">
                                                {{-- <a aria-label="Quick view" class="action-btn hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                                <a aria-label="Add To Wishlist" class="action-btn hover-up" href="wishlist.php"><i class="fi-rs-heart"></i></a>
                                                <a aria-label="Compare" class="action-btn hover-up" href="compare.php"><i class="fi-rs-shuffle"></i></a> --}}
                                            </div>
                                            <div class="product-badges product-badges-position product-badges-mrg">
                                                <span class="new">Mới</span>
                                            </div>
                                        </div>
                                        <div class="product-content-wrap">
                                            <div class="product-category">
                                                <a href="{{ route('shop') }}">ChicGear</a>
                                            </div>
                                            <h2 class="truncate-text">
                                                <a href="{{ route('product.details',['slug'=>$lproduct->slug])}}" title="{{ $lproduct->name }}">{{ $lproduct->name }}</a>
                                            </h2>
                                            <div class="rating-result" title="90%">
                                                <span>
                                                    <span>90%</span>
                                                </span>
                                            </div>
                                            <div class="product-price">
                                                <span>{{ number_format($lproduct->regular_price, 0, '', '.') }}đ </span>
                                                {{-- <span class="old-price">$245.8</span> --}}
                                            </div>
                                            <div class="product-action-1 show">
                                                <a aria-label="Thêm vào Giỏ hàng" 
                                                    class="action-btn hover-up" 
                                                    href="#" 
                                                    wire:click.prevent="store({{ $lproduct->id }},'{{ $lproduct->name }}',{{ $lproduct->regular_price }})">
                                                    <i class="fi-rs-shopping-bag-add"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!--End product-grid-4-->
                    </div>
                    <!--En tab three (New added)-->
                </div>
                <!--End tab-content-->
            </div>
        </section>
        <section class="banner-2 section-padding pb-0">
            <div class="container">
                <div class="banner-img banner-big wow fadeIn animated f-none">
                    <img src="assets/imgs/banner/banner-4.png" alt="">
                    <div class="banner-text d-md-block d-none">
                        <h4 class="mb-15 mt-40 text-brand">Ưu đãi mùa mới</h4>
                        <h1 class="fw-600 mb-20">Tỏa sáng với bộ sưu tập <br> thời trang mới nhất</h1>
                        <a href="{{ route('shop') }}" class="btn">Khám phá ngay <i class="fi-rs-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </section>
        <section class="popular-categories section-padding mt-15 mb-25">
            <div class="container wow fadeIn animated">
                <h3 class="section-title mb-20"><span>Danh mục</span> thịnh hành</h3>
                <div class="carausel-6-columns-cover position-relative">
                    <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow" id="carausel-6-columns-arrows"></div>
                    <div class="carausel-6-columns" id="carausel-6-columns">
                        @foreach ($pcategories as $pcategory)
                            <div class="card-1">
                                <figure class=" img-hover-scale overflow-hidden">
                                    <a href="{{ route('product.category',['slug'=>$pcategory->slug]) }}"><img src="{{ asset('assets/imgs/categories') }}/{{ $pcategory->image }}" alt="{{ $pcategory->name }}" height="180"></a>
                                </figure>
                                <h5><a href="{{ route('product.category',['slug'=>$pcategory->slug]) }}">{{ $pcategory->name }}</a></h5>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <section class="banners mb-15">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="banner-img wow fadeIn animated">
                            <img src="assets/imgs/banner/banner-1.png" alt="">
                            <div class="banner-text">
                                <span>Ưu Đãi Thông Minh</span>
                                <h4>Giảm 20% cho <br> Túi Xách Nữ</h4>
                                <a href="{{ route('shop') }}">Mua Ngay <i class="fi-rs-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="banner-img wow fadeIn animated">
                            <img src="assets/imgs/banner/banner-2.png" alt="">
                            <div class="banner-text">
                                <span>Giảm Giá Hấp Dẫn</span>
                                <h4>Bộ Sưu Tập Mùa Hè <br> Tuyệt Vời</h4>
                                <a href="{{ route('shop') }}">Mua Ngay <i class="fi-rs-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 d-md-none d-lg-flex">
                        <div class="banner-img wow fadeIn animated mb-sm-0">
                            <img src="assets/imgs/banner/banner-3.png" alt="">
                            <div class="banner-text">
                                <span>Sản Phẩm Mới</span>
                                <h4>Khám Phá Các <br> Ưu Đãi Hôm Nay</h4>
                                <a href="{{ route('shop') }}">Mua Ngay <i class="fi-rs-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>        
        <section class="section-padding">
            <div class="container wow fadeIn animated">
                <h3 class="section-title mb-20"><span>Sản phẩm</span> mới</h3>
                <div class="carausel-6-columns-cover position-relative">
                    <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow" id="carausel-6-columns-2-arrows"></div>
                    <div class="carausel-6-columns carausel-arrow-center" id="carausel-6-columns-2">
                        @foreach ($lproducts as $lproduct)
                            <div class="product-cart-wrap small hover-up">
                                <div class="product-img-action-wrap">
                                    <div class="product-img product-img-zoom">
                                        <a href="{{ route('product.details',['slug'=>$lproduct->slug])}}">
                                            <img class="default-img" src="{{ asset('assets/imgs/products/'. $lproduct->image) }}" alt="">
                                            {{-- <img class="hover-img" src="{{ asset('assets/imgs/shop/product-') }}{{ $lproduct->id }}-2.jpg" alt=""> --}}
                                        </a>
                                    </div>
                                    <div class="product-action-1">
                                        {{-- <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal">
                                            <i class="fi-rs-eye"></i></a>
                                        <a aria-label="Add To Wishlist" class="action-btn small hover-up" href="wishlist.php" tabindex="0"><i class="fi-rs-heart"></i></a>
                                        <a aria-label="Compare" class="action-btn small hover-up" href="compare.php" tabindex="0"><i class="fi-rs-shuffle"></i></a> --}}
                                    </div>
                                    <div class="product-badges product-badges-position product-badges-mrg">
                                        <span class="new">Mới</span>
                                    </div>
                                </div>
                                <div class="product-content-wrap">
                                    <h2 class="truncate-two-lines">
                                        <a href="{{ route('product.details',['slug'=>$lproduct->slug])}}" title="{{ $lproduct->name }}">{{ $lproduct->name }}</a>
                                    </h2>
                                    <div class="rating-result" title="90%">
                                        <span>
                                        </span>
                                    </div>
                                    <div class="product-price">
                                        <span>{{ number_format($lproduct->regular_price, 0, '', '.') }}đ </span>
                                        {{-- <span class="old-price">$245.8</span> --}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <!--End product-cart-wrap-2-->
                    </div>
                </div>
            </div>
        </section>
       
        <section class="section-padding">
            <div class="container">
                <h3 class="section-title mb-20 wow fadeIn animated"><span>Thương Hiệu</span> Nổi Bật</h3>
                <div class="carausel-6-columns-cover position-relative wow fadeIn animated">
                    <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow" id="carausel-6-columns-3-arrows"></div>
                    <div class="carausel-6-columns text-center" id="carausel-6-columns-3">
                        <div class="brand-logo">
                            <img class="img-grey-hover" src="assets/imgs/banner/brand-1.png" alt="">
                        </div>
                        <div class="brand-logo">
                            <img class="img-grey-hover" src="assets/imgs/banner/brand-2.png" alt="">
                        </div>
                        <div class="brand-logo">
                            <img class="img-grey-hover" src="assets/imgs/banner/brand-3.png" alt="">
                        </div>
                        <div class="brand-logo">
                            <img class="img-grey-hover" src="assets/imgs/banner/brand-4.png" alt="">
                        </div>
                        <div class="brand-logo">
                            <img class="img-grey-hover" src="assets/imgs/banner/brand-5.png" alt="">
                        </div>
                        <div class="brand-logo">
                            <img class="img-grey-hover" src="assets/imgs/banner/brand-6.png" alt="">
                        </div>
                        <div class="brand-logo">
                            <img class="img-grey-hover" src="assets/imgs/banner/brand-3.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
    </main>
</div>

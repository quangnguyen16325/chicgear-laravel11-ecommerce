<div>
    <div class="admin-dashboard container mt-5">
        <!-- Content -->
        <div class="content">
            <h3 class="dashboard-title text-center mb-2 mt-4">Trang quản trị</h3>
            <p class="welcome-message text-center text-muted">Chào mừng {{ $user->name }} đến với trang quản trị!</p>
            <div class="content-container flex-grow-1 p-4">
                <!-- Row with 3 columns -->
                <div class="row mt-1">
                    <div class="col-md-4">
                        <div class="hero-card box-shadow-outer-6 wow fadeIn animated mb-30 hover-up d-flex text-center">
                                <div class="card-body">
                                    <h5 class="card-title">Sản phẩm</h5>
                                    <p class="card-text">Quản lý {{ $productCount ?? 0 }} sản phẩm</p>
                                    <a href="{{ route('admin.products') }}" class="small mt-3 hover-link">Xem chi tiết</a>
                                </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="hero-card box-shadow-outer-6 wow fadeIn animated mb-30 hover-up d-flex text-center">
                                <div class="card-body">
                                    <h5 class="card-title">Danh mục</h5>
                                    <p class="card-text">Quản lý {{ $categoryCount ?? 0 }} danh mục</p>
                                    <a href="{{ route('admin.categories') }}" class="small mt-3 hover-link">Xem chi tiết</a>
                                </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="hero-card box-shadow-outer-6 wow fadeIn animated mb-30 hover-up d-flex text-center">
                                <div class="card-body">
                                    <h5 class="card-title">Người dùng</h5>
                                    <p class="card-text">Quản lý {{ $userCount ?? 0 }} người dùng</p>
                                    <a href="{{ route('admin.users') }}" class="small mt-3 hover-link">Xem chi tiết</a>
                                </div>
                        </div>
                    </div>
                </div>
                
                <!-- Row with 3 columns -->
                <div class="row mt-1"> 
                    <div class="col-md-4">
                        <div class="hero-card box-shadow-outer-6 wow fadeIn animated mb-30 hover-up d-flex text-center">
                                <div class="card-body">
                                    <h5 class="card-title">Đơn hàng</h5>
                                    <p class="card-text">Quản lý {{ $orderCount ?? 0 }} đơn hàng</p>
                                    <a href="{{ route('admin.order') }}" class="small mt-3 hover-link">Xem chi tiết</a>
                                </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="hero-card box-shadow-outer-6 wow fadeIn animated mb-30 hover-up d-flex text-center">
                                <div class="card-body">
                                    <h5 class="card-title">Lịch sử đơn hàng</h5>
                                    <p class="card-text">Có {{ $orderHistoryCount ?? 0 }} lịch sử đơn hàng</p>
                                    <a href="{{ route('admin.order.history') }}" class="small mt-3 hover-link">Xem chi tiết</a>
                                </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="hero-card box-shadow-outer-6 wow fadeIn animated mb-30 hover-up d-flex text-center">
                                <div class="card-body">
                                    <h5 class="card-title">Slider</h5>
                                    <p class="card-text">Quản lý {{ $sliderCount ?? 0 }} sliders</p>
                                    <a href="{{ route('admin.home.slider') }}" class="small mt-3 hover-link">Xem chi tiết</a>
                                </div>
                        </div>
                    </div>
                    {{-- <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="hero-card box-shadow-outer-6 wow fadeIn animated mb-30 hover-up d-flex text-center">
                                <div class="card-body">
                                    <h5 class="card-title">Thông báo</h5>
                                    <p class="card-text">Xem thông báo mới nhất</p>
                                    <a href="#" class="small mt-3 hover-link">Xem chi tiết</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="hero-card box-shadow-outer-6 wow fadeIn animated mb-30 hover-up d-flex text-center">
                                    <div class="card-body">
                                        <h5 class="card-title">Mã giảm giá</h5>
                                        <p class="card-text">Quản lý 0 mã giảm giá</p>
                                        <a href="#" class="small mt-3 hover-link">Xem chi tiết</a>
                                    </div>
                            </div>
                        </div>
                    </div> --}}
                </div>    
                <div class="row mt-1">
                    <div class="col-md-6">
                        <div class="hero-card box-shadow-outer-6 wow fadeIn animated mb-30 hover-up d-flex text-center">
                            <div class="card-body">
                                <h5 class="card-title">Thông báo</h5>
                                <p class="card-text">Xem thông báo mới nhất</p>
                                <a href="#" class="small mt-3 hover-link">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="hero-card box-shadow-outer-6 wow fadeIn animated mb-30 hover-up d-flex text-center">
                                <div class="card-body">
                                    <h5 class="card-title">Mã giảm giá</h5>
                                    <p class="card-text">Quản lý {{ $discountCount ?? 0 }} mã giảm giá</p>
                                    <a href="{{ route('admin.discount_codes') }}" class="small mt-3 hover-link">Xem chi tiết</a>
                                </div>
                        </div>
                    </div>
                </div>            
                <!-- Revenue Chart -->
                <div class="card mt-4">
                    <div class="card-body">
                        <h5 class="card-title">Biểu đồ doanh thu</h5>
                        <canvas id="revenueChart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>            
        </div>
    </div> 

    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('livewire:load', () => {
            const ctx = document.getElementById('revenueChart').getContext('2d');
            const revenueChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($labels),
                    datasets: [{
                        label: 'Doanh thu cửa hàng',
                        data: @json($data), 
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderWidth: 2,
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Doanh thu hàng tháng của cửa hàng'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return value.toLocaleString() + '₫'; 
                                }
                            }
                        }
                    }
                }
            });
        });
    </script> --}}

</div>

{{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('revenueChart').getContext('2d');
    const revenueChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7'],
            datasets: [{
                label: 'Doanh thu cửa hàng',
                data: [20000000, 25000000, 28000000, 22000000, 30000000, 35000000, 40000000], 
                borderColor: 'rgba(75, 192, 192, 1)', 
                backgroundColor: 'rgba(75, 192, 192, 0.2)', 
                borderWidth: 2, 
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Doanh thu hàng tháng của cửa hàng Chicgear' 
                }
            },
            scales: {
                y: {
                    beginAtZero: true, 
                    ticks: {
                        callback: function(value) {
                            return value.toLocaleString() + '₫'; 
                        }
                    }
                }
            }
        }
    });
</script> --}}

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($labels),
                datasets: [{
                    label: 'Doanh thu cửa hàng',
                    data: @json($data), 
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 2,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Doanh thu hàng tháng của ChicGear Store'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString() + '₫'; 
                            }
                        }
                    }
                }
            }
        });
    </script>

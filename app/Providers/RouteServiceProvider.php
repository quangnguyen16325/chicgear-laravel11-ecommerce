<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Đây là URL mặc định sau khi người dùng đăng nhập thành công.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * Khởi tạo route bindings, mẫu và bất kỳ cấu hình nào khác.
     */
    public function boot()
    {
        $this->configureRateLimiting();
        // Tải các route đã được định nghĩa
        $this->routes(function () {
            // Định nghĩa các route API
            Route::middleware('api')
                 ->prefix('api')
                 ->group(base_path('routes/api.php'));

            // Định nghĩa các route web
            Route::middleware('web')
                 ->group(base_path('routes/web.php'));
        });
    }

    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}

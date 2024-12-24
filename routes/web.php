<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Livewire\AboutComponent;
use App\Livewire\Admin\AdminAddCategoryComponent;
use App\Livewire\Admin\AdminAddDiscountCodesComponent;
use App\Livewire\Admin\AdminAddHomeSlideComponent;
use App\Livewire\Admin\AdminAddProductComponent;
use App\Livewire\Admin\AdminCategoriesComponent;
use App\Livewire\Admin\AdminDashboardComponent;
use App\Livewire\Admin\AdminDiscountCodesComponent;
use App\Livewire\Admin\AdminDiscountCodesDetailsComponent;
use App\Livewire\Admin\AdminDistributeDiscountCodeComponent;
use App\Livewire\Admin\AdminEditCategoryComponent;
use App\Livewire\Admin\AdminEditDiscountCodesComponent;
use App\Livewire\Admin\AdminEditHomeSlideComponent;
use App\Livewire\Admin\AdminEditProductComponent;
use App\Livewire\Admin\AdminEditUserComponent;
use App\Livewire\Admin\AdminHomeSliderComponent;
use App\Livewire\Admin\AdminOrderComponent;
use App\Livewire\Admin\AdminOrderDetailsComponent;
use App\Livewire\Admin\AdminOrderHistoryComponent;
use App\Livewire\Admin\AdminProductComponent;
use App\Livewire\Admin\AdminProfileComponent;
use App\Livewire\Admin\AdminUserManagementComponent;
use App\Livewire\BlogComponent;
use App\Livewire\CategoryComponent;
use App\Livewire\SearchComponent;
use App\Livewire\ShopComponent;
use App\Livewire\CheckoutComponent;
use App\Livewire\CartComponent;
use App\Livewire\ContactComponent;
use App\Livewire\DetailsComponent;
use App\Livewire\HomeComponent;
use App\Livewire\ThankyouComponent;
use App\Livewire\User\UserAddAddressComponent;
use App\Livewire\User\UserDashboardComponent;
use App\Livewire\User\UserDiscountCodesComponent;
use App\Livewire\User\UserEditAddressComponent;
use App\Livewire\User\UserEditProfileComponent;
use App\Livewire\User\UserOrderComponent;
use App\Livewire\User\UserOrderDetailsComponent;
use App\Livewire\User\UserOrderHistoryComponent;
use App\Livewire\User\UserOrderHistoryDetailsComponent;
use App\Livewire\User\UserProfileComponent;
use App\Livewire\WishlistComponent;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', HomeComponent::class)->name('home.index');

Route::get('/shop', ShopComponent::class)->name('shop');
Route::get('/product/{slug}', DetailsComponent::class)->name('product.details');
Route::get('/cart', CartComponent::class)->name('shop.cart');
Route::get('/wishlist', WishlistComponent::class)->name('shop.wishlist');
Route::get('/checkout', CheckoutComponent::class)->name('shop.checkout');
Route::get('/product-category/{slug}', CategoryComponent::class)->name('product.category');
Route::get('/search', SearchComponent::class)->name('product.search');
Route::get('/about',AboutComponent::class)->name('about');
Route::get('/blog', BlogComponent::class)->name('blog');
Route::get('/contact', ContactComponent::class)->name('contact');
Route::get('/thankyou', ThankyouComponent::class)->name('thankyou');
// Route::get('/vnpay-return', function (Request $request) {
//     if ($request->vnp_ResponseCode == '00') {
//         session()->flash('success_message', 'Thanh toán qua VNPAY thành công!');
//     } else {
//         session()->flash('error', 'Thanh toán qua VNPAY thất bại!');
//     }
//     return redirect()->route('thankyou');
// })->name('vnpay.return');
// Route::get('/momo-return', function (Request $request) {
//     if ($request->resultCode == '0') {
//         session()->flash('success_message', 'Thanh toán qua MoMo thành công!');
//     } else {
//         session()->flash('error', 'Thanh toán qua MoMo thất bại!');
//     }

//     return redirect()->route('thankyou');
// })->name('momo.return');
Route::get('/momo-return', [CheckoutComponent::class, 'momoReturn'])->name('momo.return');
Route::get('/vnpay-return', [CheckoutComponent::class, 'vnpayReturn'])->name('vnpay.return');
    
Route::post('/order',[OrderController::class, 'store'])->name('order.store');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/user/dashboard', UserDashboardComponent::class)->name('user.dashboard');
    Route::get('/user/profile', UserProfileComponent::class)->name('user.profile');
    Route::get('/user/profile/edit', UserEditProfileComponent::class)->name('user.profile.edit');
    Route::get('/user/address/edit/{address_id}', UserEditAddressComponent::class)->name('user.address.edit');
    Route::get('/user/address/add', UserAddAddressComponent::class)->name('user.address.create');
    Route::get('/user/orders', UserOrderComponent::class)->name('user.order');
    Route::get('/user/order/details/{order_id}', UserOrderDetailsComponent::class)->name('user.order.details');
    Route::get('/user/order/histories', UserOrderHistoryComponent::class)->name('user.order.histories');
    Route::get('/order/history/details/{orderId}', UserOrderHistoryDetailsComponent::class)->name('user.order.history.details');
    Route::get('/user/discount-codes', UserDiscountCodesComponent::class)->name('user.discount_codes');
});

Route::middleware(['auth', 'authadmin'])->group(function () {
    Route::get('/admin/dashboard', AdminDashboardComponent::class)->name('admin.dashboard');
    Route::get('/admin/categories', AdminCategoriesComponent::class)->name('admin.categories');
    Route::get('/admin/category/add', AdminAddCategoryComponent::class)->name('admin.category.add');
    Route::get('/admin/category/edit/{category_id}', AdminEditCategoryComponent::class)->name('admin.category.edit');
    Route::get('/admin/products', AdminProductComponent::class)->name('admin.products');
    Route::get('/admin/product/add', AdminAddProductComponent::class)->name('admin.product.add');
    Route::get('/admin/product/edit/{product_id}', AdminEditProductComponent::class)->name('admin.product.edit');
    Route::get('/admin/slider', AdminHomeSliderComponent::class)->name('admin.home.slider');
    Route::get('/admin/slider/add', AdminAddHomeSlideComponent::class)->name('admin.home.slide.add');
    Route::get('/admin/slider/edit/{slide_id}', AdminEditHomeSlideComponent::class)->name('admin.home.slide.edit');
    Route::get('/admin/users', AdminUserManagementComponent::class)->name('admin.users');
    Route::get('/admin/users/edit/{user_id}', AdminEditUserComponent::class)->name('admin.user.edit');
    Route::get('/admin/profile', AdminProfileComponent::class)->name('admin.profile');
    Route::get('/admin/order', AdminOrderComponent::class)->name('admin.order');
    Route::get('/admin/orders/details/{order_id}', AdminOrderDetailsComponent::class)->name('admin.order.details');
    Route::get('/admin/order/history', AdminOrderHistoryComponent::class)->name('admin.order.history');
    Route::get('/admin/discount-codes', AdminDiscountCodesComponent::class)->name('admin.discount_codes');
    Route::get('/admin/discount-codes/add', AdminAddDiscountCodesComponent::class)->name('admin.discount_codes.add');
    Route::get('/admin/discount-codes/edit/{discount_id}', AdminEditDiscountCodesComponent::class)->name('admin.discount_code.edit');
    Route::get('/admin/distribute-discount_code', AdminDistributeDiscountCodeComponent::class)->name('admin.distribute_discount_code');
    Route::get('/admin/discount-codes/{discount_id}/details', AdminDiscountCodesDetailsComponent::class)->name('admin.discount_code.details');


});

Route::middleware('auth')->group(function () { 
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

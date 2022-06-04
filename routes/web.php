<?php
use App\Http\Livewire\HomeComponent;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{
Route::get('/',HomeComponent::class);
Route::get('/shop', \App\Http\Livewire\ShopComponent::class);
Route::get('/checkout', \App\Http\Livewire\CheckoutComponent::class);
Route::get('/cart', \App\Http\Livewire\CartComponent::class)->name('product.cart');
Route::get('product/{slug}',\App\Http\Livewire\DetailComponent::class)->name('product.detail');
Route::get('/about-us',\App\Http\Livewire\AboutComponent::class );
Route::get('/contact',\App\Http\Livewire\ContactComponent::class );
Route::get('/products_category/{category_slug}',\App\Http\Livewire\CategoryComponent::class)->name('product.category');
Route::get('search',\App\Http\Livewire\SearchComponent::class)->name('product.search');


//Route::middleware(['auth:sanctum', config('jetstream.auth_session'),'verified'])->group(function () {
//    Route::get('/dashboard', function () {
//        return view('dashboard');
//    })->name('dashboard');
//});

Route::middleware(['auth:sanctum', 'verified' ,'authAdmin'])->group(function () {
    Route::get('/dashboard', \App\Http\Livewire\Admin\AdminDashboardComponent::class)->name('admin.dashboard');
    Route::get('/dashboard/categories', \App\Http\Livewire\Admin\CategoryComponent::class)->name('admin.categories');
    Route::get('/dashboard/products', \App\Http\Livewire\Admin\ProductComponent::class)->name('admin.products');

});
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/user/profile', \App\Http\Livewire\User\UserDashboardComponent::class)->name('user.dashboard');
});
});

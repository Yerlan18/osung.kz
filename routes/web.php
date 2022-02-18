<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\ShipController;
use App\Http\Controllers\Frontend\LanguageController;
use App\Http\Controllers\Frontend\CartController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\User\WhishlistController;
use App\Http\Controllers\User\CartpageController;
use App\Http\Controllers\User\CheckoutController;

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



Route::group(['prefix' => 'admin', 'middleware' => ['admin:admin']], function () {
    Route::get('/login', [AdminController::class, 'loginForm']);
    Route::post('/login', [AdminController::class, 'store'])->name('admin.login');
});




Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
    return view('admin.index');
})->name('dashboard')->middleware('auth:admin');


// Admin All routes
Route::middleware(['auth:admin'])->group(function () {



    Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');

    Route::get('/admin/profile', [AdminProfileController::class, 'AdminProfile'])->name('admin.profile');

    Route::get('/admin/profile/edit', [AdminProfileController::class, 'AdminProfileEdit'])->name('admin.profile.edit');

    Route::post('/admin/profile/store', [AdminProfileController::class, 'AdminProfileStore'])->name('admin.profile.store');

    Route::get('/admin/change/password', [AdminProfileController::class, 'ChangePassword'])->name('change.password');

    Route::post('/admin/update/password', [AdminProfileController::class, 'UpdatePassword'])->name('update.profile.password');
});



Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    $user = Auth::user();
    return view('dashboard', compact('user'));
})->name('dashboard');

Route::get('/', [IndexController::class, 'MainPage']);

Route::get('/user/logout', [IndexController::class, 'ULogout'])->name('user.logout');

Route::get('/user/profile/fr', [IndexController::class, 'UserProfile'])->name('profile.user');

Route::post('/user/profile/store', [IndexController::class, 'UserProfileStore'])->name('user.profile.store');

Route::get('/user/profile/changepassword', [IndexController::class, 'PasswordUpdate'])->name('change.password.user');

Route::post('/user/profile/updatepass', [IndexController::class, 'PChange'])->name('user.password.changing');


// Brands routes


Route::prefix('brand')->group(function () {
    Route::get('/view', [BrandController::class, 'Viewbrand'])->name('all.brand');
    Route::post('/store', [BrandController::class, 'BrandStore'])->name('brand.store');
    Route::get('/item/{id}', [BrandController::class, 'ViewUpdate']);
    Route::post('/update', [BrandController::class, 'BrandUpdate'])->name('brand.update');
    Route::get('/item/delete/{id}', [BrandController::class, 'DeleteItem']);
});

Route::prefix('category')->group(function () {
    Route::get('/view', [CategoryController::class, 'Viewcategory'])->name('all.categories');
    Route::post('/store', [CategoryController::class, 'CategoryStore'])->name('category.store');
    Route::get('/item/{id}', [CategoryController::class, 'CategoryUpdate']);
    Route::post('/update/{id}', [CategoryController::class, 'CatUpdate']);
    Route::get('/item/delete/{id}', [CategoryController::class, 'DeleteCategory']);


    Route::get('/sub/view', [SubCategoryController::class, 'ViewSubcategory'])->name('all.subcategories');
    Route::post('/sub/store', [SubCategoryController::class, 'SubCategoryStore'])->name('subcategory.store');
    Route::get('/sub/{id}', [SubCategoryController::class, 'SubCategoryUpdate']);
    Route::post('/sub/update/{id}', [SubCategoryController::class, 'SubCatUpdate']);
    Route::get('/sub/delete/{id}', [SubCategoryController::class, 'DeleteSubCategory']);


    Route::get('/sub/sub/view', [SubCategoryController::class, 'ViewSubSubcategory'])->name('all.subsubcategories');

    Route::get('/subcategory/ajax/{category_id}', [SubCategoryController::class, 'GetSubCategory']);

    Route::get('/sub-subcategory/ajax/{subcategory_id}', [SubCategoryController::class, 'GetSubSubCategory']);


    Route::post('/sub/sub/store', [SubCategoryController::class, 'SubSubCategoryStore'])->name('subsubcategory.store');

    Route::get('/sub/sub/{id}', [SubCategoryController::class, 'EditSububCategory']);

    Route::post('/sub/sub/update', [SubCategoryController::class, 'SubSubCategoryUpdate'])->name('subsubcategory.update');

    Route::get('/sub/sub/delete/{id}', [SubCategoryController::class, 'SubSubCategoryDelete']);
});


Route::prefix('product')->group(function () {
    Route::get('/add', [ProductController::class, 'AddProduct'])->name('add-product');
    Route::post('/store', [ProductController::class, 'StoreProduct'])->name('product.store');
    Route::get('/manage', [ProductController::class, 'ManageProduct'])->name('manage-product');
    Route::get('/edit/{id}', [ProductController::class, 'EditProduct']);
    Route::post('/update/info', [ProductController::class, 'UpdateProduct'])->name('update-product');
    Route::post('/update/img', [ProductController::class, 'UpdateImgProduct'])->name('update-product-img');

    Route::post('/update/thm', [ProductController::class, 'UpdateThumbnail'])->name('update-product-thumb');

    Route::get('/multiimg/delete/{id}', [ProductController::class, 'DeleteMultiImg'])->name('product.multiimg.delete');

    Route::get('/inactive/{id}', [ProductController::class, 'ProductInactive']);
    Route::get('/active/{id}', [ProductController::class, 'ProductActive']);
    Route::get('/deleteitem/{id}', [ProductController::class, 'ProductDeleting']);
});


Route::prefix('slider')->group(function () {
    Route::get('/view', [SliderController::class, 'ViewSlider'])->name('manage-slider');
    Route::post('/store', [SliderController::class, 'SliderStore'])->name('slider.store');
    Route::get('/item/{id}', [SliderController::class, 'SliderUpdate']);
    Route::post('/update', [SliderController::class, 'SSLUpdate'])->name('slider.update');
    Route::get('/item/delete/{id}', [SliderController::class, 'DeleteSlider']);

    Route::get('/inactive/{id}', [SliderController::class, 'SliderInactive']);
    Route::get('/active/{id}', [SliderController::class, 'SliderActive']);
});


Route::get('language/ru', [LanguageController::class, 'Ru'])->name('rus.language');
Route::get('language/en', [LanguageController::class, 'Eng'])->name('eng.language');

Route::get('product/details/{id}/{slug}', [IndexController::class, 'ProductDetails']);


Route::get('product/tag/{id}', [IndexController::class, 'ProductTags']);


Route::get('subcategory/product/{id}/{slug}', [IndexController::class, 'ProductSubWise']);
Route::get('subsubcategory/product/{id}/{slug}', [IndexController::class, 'ProductSubSubWise']);


Route::get('/product/view/modal/{id}', [IndexController::class, 'ProductViewAjax']);

Route::post('/cart/data/store/{id}', [CartController::class, 'ProductStoreAjax']);


Route::get('/minicart/product/info/', [CartController::class, 'ProductMinicartInfo']);

Route::get('/user/cart-remove/{id}', [CartController::class, 'RemoveCartProduct']);



Route::group(['prefix' => 'user', 'middleware' => ['auth', 'user'], 'namespace' => 'User'], function () {
    Route::post('/whishlist/item/add/{data}', [WhishlistController::class, 'AddToWishList']);

    Route::get('/user/wishlist/listofitems/', [WhishlistController::class, 'ViewWishlist'])->name('wishlist');

    Route::get('/get-wishlist-product', [WhishlistController::class, 'GetWishlistProduct']);

    Route::get('/remove/item/wishlist/{data}', [WhishlistController::class, 'RemoveItemWishlist']);

    Route::get('/myItems/cartpage/list/', [CartpageController::class, 'MyCartItemsFrom']);

    Route::get('/all/cartpage/items', [CartpageController::class, 'AllCartItems'])->name('AllCartItems');
});


Route::get('/increment/cart/quantity/{data}', [CartpageController::class, 'IncrementCartitem']);
Route::get('/decrement/cart/quantity/{data}', [CartpageController::class, 'DecrementCartitem']);



Route::group(['prefix' => 'coupons'], function () {
    Route::get('/discount/rate/', [CouponController::class, 'ManageCoupon'])->name('manage-coupon');
    Route::post('/store/add/', [CouponController::class, 'StoreCoupon'])->name('coupon.store');
    Route::get('/inactive/rate/{id}', [CouponController::class, 'CouponInactive']);
    Route::get('/active/rate/{id}', [CouponController::class, 'CouponActive']);

    Route::get('/item/edit/{id}', [CouponController::class, 'CouponEdit']);
    Route::get('/item/delete/{id}', [CouponController::class, 'CouponActive']);
    Route::get('/item/delete/{id}', [CouponController::class, 'CouponDelete']);
    Route::post('/update/item/{id}', [CouponController::class, 'UpdateCoupon']);
});



Route::prefix('ship')->group(function () {
    Route::get('/discount/rate/', [ShipController::class, 'ManageShipping'])->name('manage-ship');
    Route::post('/store/add/', [ShipController::class, 'StoreArea'])->name('ship.store');
    Route::get('/item/edit/{id}', [ShipController::class, 'ShipEdit']);
    Route::get('/item/delete/{id}', [ShipController::class, 'ShipDelete']);
    Route::post('/update/item/{id}', [ShipController::class, 'UpdateShipping']);


    Route::get('/managing/district/', [ShipController::class, 'ManageDistrict'])->name('manage-district');
    Route::post('/district/store/add/', [ShipController::class, 'StoreDistrict'])->name('district.store');


    Route::get('/district/edit/{id}', [ShipController::class, 'DistrictEdit']);
    Route::get('/district/delete/{id}', [ShipController::class, 'DistrictDelete']);
    Route::post('/district/update/{id}', [ShipController::class, 'UpdateDistrict']);



    Route::get('/managing/state/area/', [ShipController::class, 'ManageState'])->name('manage-state');
    Route::post('/somearea/store/add/', [ShipController::class, 'StoreState'])->name('state.store');

    Route::get('/state/edit/{id}', [ShipController::class, 'StateEdit']);
    Route::get('/state/delete/{id}', [ShipController::class, 'StateDelete']);
    Route::post('/state/update/{id}', [ShipController::class, 'UpdateState']);

    Route::get('/state/subcategory/ajax/{id}', [ShipController::class, 'AjaxState']);
});

Route::post('/coupon-apply', [CartController::class, 'CouponApply']);

Route::get('/coupon-calculation/ajax/', [CartController::class, 'CouponCalculation']);

Route::get('/remove-coupon/ajax/request', [CartController::class, 'CouponRemove']);

Route::get('/checkout', [CartController::class, 'CheckoutView'])->name('checkout');

Route::get('/state/sub-subcategory/ajax/{id}', [CartController::class, 'GetStateForCh']);



Route::post('/checkout/submit/paybox', [CheckoutController::class, 'StoreCheckout'])->name('checkout.submit');

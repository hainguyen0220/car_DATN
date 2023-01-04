<?php

use App\Http\Controllers\GoogleController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\CategoryDetailController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\GaraController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\GraphController;
use App\Http\Controllers\User\AccountController as UserAccountController;
use App\Http\Controllers\User\CarController as UserCarController;
use App\Http\Controllers\User\OrderController;
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

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AccountController::class, 'index'])->name('login');
Route::post('/login', [AccountController::class, 'login'])->name('post.login');

Route::get('/register', [AccountController::class, 'getRegister'])->name('register');
Route::post('/register', [AccountController::class, 'register'])->name('post.register');

Route::get('login-google', [GoogleController::class, 'redirect'])->name('login.google');
Route::get('login-google-callback', [GoogleController::class, 'callback']);

Route::get('check-forgot-password', [AccountController::class, 'showCheckForgotPassword'])->name('check.forgot.password');
Route::post('check-forgot-password', [AccountController::class, 'checkForgotPassword'])->name('check.forgot.password');

Route::get('forgot-password', [AccountController::class, 'showForgotPassword'])->name('forgot.password');
Route::post('forgot-password', [AccountController::class, 'forgotPassword'])->name('forgot.password');

Route::get('/active/{email}/{token}', [AccountController::class, 'active'])->name('active.account');

Route::get('/logout', [AccountController::class, 'logout'])->name('post.logout');

Route::get('download-avatar', [AccountController::class, 'downloadAvatar'])->name('download.image');

Route::get('get-category-detail', [CategoryController::class, 'getCategoryDetail'])->name('get.category.detail');




Route::middleware('admin')->group(function () {

    Route::get('dashboard', [AdminOrderController::class, 'getIndex'])->name('dashboard');
    Route::get('list-order', [AdminOrderController::class, 'showData'])->name('dashboard.data');
    Route::get('order-detail/{id}', [AdminOrderController::class, 'getOrderDetail'])->name('order.detail');
    Route::get('update-order/{id}', [AdminOrderController::class, 'updateOrderDetail'])->name('update.order.detail');


    Route::get('test', function () {
        return view('admin');
    });

    //Account

    Route::get('/info-admin/{id}', [AccountController::class, 'info'])->name('info.account.admin');
    Route::post('/info-admin', [AccountController::class, 'updateInfo'])->name('update.info.admin');

    Route::get('/create-pass2/{id}', [AccountController::class, 'showPassword2'])->name('create.pass.2.admin');
    Route::post('/create-pass2', [AccountController::class, 'createPassword2'])->name('post.create.pass.2.admin');

    Route::get('/update-account/{id}', [AccountController::class, 'showUpdateAccount'])->name('update.account');
    Route::post('/update-account', [AccountController::class, 'updateAccount'])->name('post.update.account');

    Route::post('/update-multiple-account', [AccountController::class, 'updateMultipleAccount'])->name('post.update.multiple.account');

    Route::get('/reset-pass/{id}', [AccountController::class, 'showResetPassword'])->name('reset.pass.admin');
    Route::post('/reset-pass', [AccountController::class, 'resetPassword'])->name('post.reset.pass.admin');

    Route::post('/reset-pass-2', [AccountController::class, 'resetPassword2'])->name('post.reset.pass.2.admin');


    Route::get('/list-user', [AccountController::class, 'listAccount'])->name('list.user');
    Route::post('/list-user', [AccountController::class, 'listAccount'])->name('post.search.user');

    //Category

    Route::get('/category', [CategoryController::class, 'listCategory'])->name('list.category');
    Route::post('/category', [CategoryController::class, 'listCategory'])->name('post.list.category');

    Route::get('/create-category', [CategoryController::class, 'showCreateCategory'])->name('create.category');
    Route::post('/create-category', [CategoryController::class, 'createCategory'])->name('post.create.category');

    Route::get('/update-category/{id}', [CategoryController::class, 'showUpdateCategory'])->name('show.update.category');
    Route::post('/update-category', [CategoryController::class, 'updateCategory'])->name('post.update.category');

    Route::get('/category-detail', [CategoryDetailController::class, 'listCategoryDetail'])->name('list.category.detail');
    Route::post('/category-detail', [CategoryDetailController::class, 'listCategoryDetail'])->name('post.list.category.detail');

    Route::get('/create-category-detail', [CategoryDetailController::class, 'showCreateCategoryDetail'])->name('create.category.detail');
    Route::post('/create-category-detail', [CategoryDetailController::class, 'createCategoryDetail'])->name('post.create.category.detail');

    Route::get('/update-category-detail/{id}', [CategoryDetailController::class, 'showUpdateCategoryDetail'])->name('show.update.category.detail');
    Route::post('/update-category-detail', [CategoryDetailController::class, 'updateCategoryDetail'])->name('post.update.category.detail');

    Route::get('/delete-category/{id}', [CategoryController::class, 'deleteCategory'])->name('delete.category');

    //Author

    Route::get('/author', [AuthorController::class, 'listAuthor'])->name('list.author');
    Route::post('/author', [AuthorController::class, 'listAuthor'])->name('post.list.author');

    Route::get('/create-author', [AuthorController::class, 'showCreateAuthor'])->name('create.author');
    Route::post('/create-author', [AuthorController::class, 'createAuthor'])->name('post.create.author');

    Route::get('/update-author/{id}', [AuthorController::class, 'showUpdateAuthor'])->name('show.update.author');
    Route::post('/update-author', [AuthorController::class, 'updateAuthor'])->name('post.update.author');

    //gara

    Route::get('/gara', [GaraController::class, 'listGara'])->name('list.gara');
    Route::post('/gara', [GaraController::class, 'listGara'])->name('post.list.gara');

    Route::get('/create-gara', [GaraController::class, 'showCreateGara'])->name('create.gara');
    Route::post('/create-gara', [GaraController::class, 'createGara'])->name('post.create.gara');

    Route::get('/update-gara/{id}', [GaraController::class, 'showUpdateGara'])->name('show.update.gara');
    Route::post('/update-gara', [GaraController::class, 'updateGara'])->name('post.update.gara');

    //car

    Route::get('/car', [CarController::class, 'listCar'])->name('list.car');
    Route::post('/car', [CarController::class, 'listCar'])->name('post.list.car');

    Route::get('/create-car', [CarController::class, 'showCreateCar'])->name('show.create.car');
    Route::post('/create-car', [CarController::class, 'createCar'])->name('create.car');

    Route::get('/update-car/{id}', [CarController::class, 'showUpdateCar'])->name('show.update.car');
    Route::post('/update-car/{id}', [CarController::class, 'updateCar'])->name('update.car');

    Route::get('/info-car/{id}', [CarController::class, 'showInfoCar'])->name('show.info.car');

    Route::get('/delete-car/{id}', [CarController::class, 'deleteCar'])->name('delete.car');

    //Author

    Route::get('/slider', [SliderController::class, 'showSlider'])->name('list.slider');
    Route::post('/create-slider', [SliderController::class, 'createSlider'])->name('create.slider');
    Route::get('/delete-slider/{id}', [SliderController::class, 'deleteSlider'])->name('delete.slider');

    //Blog

    Route::get('/blog1', [BlogController::class, 'index'])->name('blog.index');
    Route::get('/blogcreate', [BlogController::class, 'create'])->name('blog.create');
    Route::post('/blogstore', [BlogController::class, 'store'])->name('blog.store');
    Route::get('/blogedit/{id}', [BlogController::class, 'edit'])->name('blog.edit');
    Route::post('/blogupdate/{id}', [BlogController::class, 'update'])->name('blog.update');
    Route::get('/blogdelete/{id}', [BlogController::class, 'delete'])->name('blog.delete');


    //discount

    Route::get('/discount', [DiscountController::class, 'index'])->name('discount.index');
    Route::get('/discountcreate', [DiscountController::class, 'create'])->name('discount.create');
    Route::post('/discountstore', [DiscountController::class, 'store'])->name('discount.store');
    Route::get('/discountedit/{id}', [DiscountController::class, 'edit'])->name('discount.edit');
    Route::post('/discountupdate/{id}', [DiscountController::class, 'update'])->name('discount.update');
    Route::get('/discountdelete/{id}', [DiscountController::class, 'delete'])->name('discount.delete');

    //Excel

    Route::post('/export-order', [AdminOrderController::class, 'exportOrder'])->name('export.order');
    Route::post('/import-car', [CarController::class, 'importCar'])->name('import.car');

    //Route

    Route::get('/show-map', [GraphController::class, 'showMap'])->name('list.show');


    //Route

});



Route::middleware('user')->group(function () {
    Route::get('index', function () {
        return view('user.index');
    })->name('index');

    Route::get('/info-user/{id}', [UserAccountController::class, 'info'])->name('info.account.user');
    Route::post('/info-user', [UserAccountController::class, 'updateInfo'])->name('update.info');
    Route::get('/reset-password/{id}', [UserAccountController::class, 'showResetPassword'])->name('reset.password.user');
    Route::post('/reset-password', [UserAccountController::class, 'updateInfo'])->name('update.info');
    Route::post('/reset-password', [AccountController::class, 'resetPassword'])->name('post.reset.pass.user');
    Route::post('/reset-password-2', [AccountController::class, 'resetPassword2'])->name('post.reset.pass.2.user');

    Route::get('/create-password-2/{id}', [UserAccountController::class, 'showCreatePassword2'])->name('create.pass.2.user');
    Route::post('/create-password-2', [AccountController::class, 'createPassword2'])->name('post.create.pass.2.user');

    Route::get('/car-detail/{id}', [UserCarController::class, 'getCarDetail'])->name('show.car.detail');
    Route::get('/search', [UserCarController::class, 'searchCar'])->name('search.car');
    Route::post('/search', [UserCarController::class, 'searchCar'])->name('post.search.car');

    //Cart

    Route::get('cart', [CartController::class, 'showCart'])->name('show.cart');
    Route::get('add-cart/{id}', [CartController::class, 'addCart'])->name('add.cart');
    Route::get('delete-cart/{id}', [CartController::class, 'deleteCart'])->name('delete.cart');
    Route::get('update-cart/{id}/{type}', [CartController::class, 'updateCart'])->name('update.cart');

    //Order

    Route::get('order', [OrderController::class, 'showOrder'])->name('show.order');
    Route::post('order', [OrderController::class, 'order'])->name('order');
    Route::get('list-oder', [OrderController::class, 'listOrder'])->name('list.order');
    Route::get('give-car-back/{id}', [OrderController::class, 'giveCarBack'])->name('give.car.back');

    //blog
    Route::get('blog', [BlogController::class, 'showBlog'])->name('show.blog');
});

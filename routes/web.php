<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ComboController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\DishesController;
// use App\Http\Controllers\Admin\IngredientController;
// use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\FeedbackController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ReservationController;
// use App\Http\Controllers\Admin\CustomerController;
// use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\TableController;
// use App\Http\Controllers\Admin\ReservationTableController;
// use App\Http\Controllers\Admin\ReservationHistoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




route::get("/", function () {
    return view("client.index");
})->name("index.client");
route::get("/menu", function () {
    return view("client.menu");
})->name("menu.client");
route::get("/booking", function () {
    return view("client.booking");
})->name("booking.client");
route::get("/about", function () {
    return view("client.about");
})->name("about.client");
route::get("/gallery", function () {
    return view("client.gallery");
})->name("gallery.client");
route::get("/blog", function () {
    return view("client.blog");
})->name("blog.client");
route::get("/contact", function () {
    return view("client.contact");
})->name("contact.client");
route::get("/blog-single", function () {
    return view("client.blog-single");
})->name("blog-single.client")   ;


Route::get('admin', [AdminController::class, 'index']);
Route::prefix('admin')->name('admin.')->group(function () {

    Route::resource('table', TableController::class);
    Route::resource('reservation', ReservationController::class);
    //     Route::resource('reservationTable', ReservationTableController::class);
    //     Route::resource('reservationHistory', ReservationHistoryController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('dishes', DishesController::class);
    Route::resource('combo', ComboController::class);
    Route::resource('payment', PaymentController::class);
    Route::resource('order', OrderController::class);
    Route::resource('coupon', CouponController::class);
    route::resource('feedback', FeedbackController::class);
    Route::resource('user', UserController::class);
    Route::resource('role', RoleController::class);
    //     Route::resource('ingredient', IngredientController::class);
    Route::resource('dashboard', DashboardController::class);
    //     Route::get('/logon', [AdminController::class, 'logon'])->name('logon');
    //     Route::post('/logon', [AdminController::class, 'postlogon'])->name('admin.logon');

});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CartController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PageController;


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
Route::resource('product', ProductController::class);
Route::resource('cart', CartController::class);
Route::resource('customer', CustomerController::class);
Route::resource('dashboard', DashboardController::class);
Route::resource('page', PageController::class);
Route::get('/logon', [AdminController::class, 'logon'])->name('logon');
Route::post('/logon', [AdminController::class, 'postlogon'])->name('admin.logon');






<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ComboController;
use App\Http\Controllers\Admin\DishesController;
use App\Http\Controllers\Admin\IngredientController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\ReservationTableController;
use App\Http\Controllers\Admin\ReservationHistoryController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin', [AdminController::class, 'index']);

// Route::prefix('admin')->middleware('admin')->group(function () {
//     Route::get('/', [DashBoardController::class, 'index'])->name('admin.index');

    Route::resource('table', TableController::class);
    Route::resource('reservation', ReservationController::class);
    Route::resource('reservationTable', ReservationTableController::class);
    Route::resource('reservationHistory', ReservationHistoryController::class);

    Route::resource('category', CategoryController::class);
    Route::resource('dishes', DishesController::class);
    Route::resource('combo', ComboController::class);
    Route::resource('payment', PaymentController::class);
    Route::resource('staff', StaffController::class);
    Route::resource('user', UserController::class);
    Route::resource('ingredient', IngredientController::class);

    Route::resource('customer', CustomerController::class);
    Route::resource('dashboard', DashboardController::class);
    Route::resource('page', PageController::class);

    Route::get('/logon', [AdminController::class, 'logon'])->name('logon');
    Route::post('/logon', [AdminController::class, 'postlogon'])->name('admin.logon');
// });

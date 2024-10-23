<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ComboController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\DishesController;
use App\Http\Controllers\Admin\FeedbackController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Client\OnlineCheckoutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CalendarController;
use App\Http\Controllers\Admin\IngredientController;
use App\Http\Controllers\Admin\IngredientTypeController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\ReservationHistoryController;
use App\Http\Controllers\Admin\ReservationTableController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\MemberController;
use App\Http\Controllers\Client\MenuController;
use App\Http\Controllers\Pos\PosController;
use App\Http\Controllers\ProfileController;


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



Route::get('/', [HomeController::class, 'index'])->name('client.index');
Route::get('/menu', [MenuController::class, 'index'])->name('menu');

Route::get('/api/menu/filter', [MenuController::class, 'filterByCategory']);

Route::get('/menu/category/{category}', [MenuController::class, 'filterByCategory'])->name('menu.category');

//member
Route::get('/member', [MemberController::class, 'show'])->name('client.member');
Route::post('/update-member', [MemberController::class, 'update'])->name('member.update');
Route::post('/change-password', [MemberController::class, 'changePassword'])->name('member.changePassword');
Route::post('/member/update-booking', [MemberController::class, 'updateBooking'])->name('member.updateBooking');

// login
Route::get('/home', [HomeController::class, 'index'])->middleware('auth');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.client');




// account
// Route::get('/account', [AccountController::class, 'show'])->name('account.show');
// Route::post('/update-account', [AccountController::class, 'update'])->name('account.update');
// Route::post('/change-password', [AccountController::class, 'changePassword'])->name('account.changePassword');

// route::get("/menu", function () {
//     return view("client.menu");
// })->name("menu.client");

route::get(
    "/booking",
    [ReservationController::class, 'showTime']
)->name("booking.client");
route::get(
    "/customerInformation",
    [ReservationController::class, "showInformation"]
)->name("customerInformation.client");
route::post(
    "/createReservation",
    [ReservationController::class, "createReservation"]
)->name("createReservation.client");
route::get(
    "deposit",
    [ReservationController::class, "showDeposit"]
)->name("deposit.client");
route::post(
    "MOMOCheckout",
    action: [OnlineCheckoutController::class, "onlineCheckout"]
)->name("MOMOCheckout.client");



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
})->name("blog-single.client");
route::get(
    "reservationSuccessfully",
    [ReservationController::class, "reservationSuccessfully"]
)->name("reservationSuccessfully.client");


Route::get('/customerInformation', [ReservationController::class, 'showInformation'])->name('customer.information');








Route::get('/pos', [PosController::class, 'index']);
Route::post('/create-order', [PosController::class, 'createOrder']);

Route::post('/add-dish-to-order', [PosController::class, 'addDishToOrder']);

Route::post('/load-more-dishes', [PosController::class, 'loadMoreDishes']);
Route::get('/api/tables/{tableId}/order', [TableController::class, 'getOrderForReservedTable']);
Route::get('/reservations', [ReservationController::class, 'showReservations'])
    ->name('reservations.upcoming');
Route::get('/reservations/late', [PosController::class, 'getLateReservations'])
    ->name('reservations.late');
Route::post('/reservations', [PosController::class, 'store'])->name('reservations.store');
Route::delete('/order/{order_id}/item/{item_id}', [PosController::class, 'deleteOrderItem']);;











Route::post('/Ppayment/{table_number}', [PosController::class, 'Ppayment'])->name('Ppayment');




// // Process the offline payment (POST)
// Route::post('/payment/offline', [PosController::class, 'processPaymentOffline'])->name('processPaymentOffline');


// // Process the online payment (POST)
// Route::post('/payment/online', [PosController::class, 'processPaymentOnline'])->name('processPaymentOnline');


// Route::get('/receipt', [PosController::class, 'showReceipt'])->name('pos.receipt');


























Route::get('admin', [AdminController::class, 'index']);
Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/', function () {
        return view('auth.login');
    });

    Route::resource('table', TableController::class);
    // Trash - Xoá mềm - Khôi Phục
    Route::get('tables/trash', [TableController::class, 'trash'])->name('tables.trash');
    Route::patch('table/{id}/restore', [TableController::class, 'restore'])->name('table.restore');
    Route::delete('table/{id}/force-delete', [TableController::class, 'forceDelete'])->name('table.forceDelete');

    /// xếp bàn cho khách
    Route::get('reservation/{reservationId}/assign-tables', [ReservationController::class, 'assignTables'])->name('reservation.assignTables');
    Route::get('reservation/assign-table', [ReservationController::class, 'assignTable'])->name('assignTable');
    Route::post('reservation/submit-table', [ReservationController::class, 'submitTable'])->name('submit.tables');
    Route::post('reservation/submit-move-table', [ReservationController::class, 'submitMoveTable'])->name('submit.Movetables');

    /// xếp bàn cho khách
    Route::get('reservation/{reservationId}/assign-tables', [ReservationController::class, 'assignTables'])->name('reservation.assignTables');
    Route::get('reservation/assign-table', [ReservationController::class, 'assignTable'])->name('assignTable');
    Route::post('reservation/submit-table', [ReservationController::class, 'submitTable'])->name('submit.tables');
    Route::post('reservation/submit-move-table', [ReservationController::class, 'submitMoveTable'])->name('submit.Movetables');

    Route::resource('reservation', ReservationController::class);
    Route::post('reservation/cancel/{id}', [ReservationController::class, 'cancel'])->name('reservation.cancel');
    Route::resource('reservationTable', ReservationTableController::class);
    Route::resource('reservationHistory', ReservationHistoryController::class);



    Route::resource('category', CategoryController::class);
    // Trash - Xoá mềm - Khôi Phục
    Route::get('category-trash', [CategoryController::class, 'trash'])->name('category.trash');
    Route::patch('category-restore/{id}', [CategoryController::class, 'restore'])->name('category.restore');
    Route::delete('category-force-delete/{id}', [CategoryController::class, 'forceDelete'])->name('category.forceDelete');


    Route::resource('dishes', DishesController::class);
    // Trash - Xoá mềm - Khôi Phuc
    Route::get('dishes-trash', [DishesController::class, 'trash'])->name('dishes.trash');
    Route::patch('dishes-restore/{id}', [DishesController::class, 'restore'])->name('dishes.restore');
    Route::delete('dishes-force-delete/{id}', [DishesController::class, 'forceDelete'])->name('dishes.forceDelete');


    Route::resource('combo', ComboController::class);
    // Trash - Xoá mềm - Khôi Phuc
    Route::get('combo-trash', [ComboController::class, 'trash'])->name('combo.trash');
    Route::patch('combo-restore/{id}', [ComboController::class, 'restore'])->name('combo.restore');
    Route::delete('combo-force-delete/{id}', [ComboController::class, 'forceDelete'])->name('combo.forceDelete');


    Route::resource('payment', PaymentController::class);
    // Trash - Xoá mềm - Khôi Phuc
    Route::get('payment-trash', [PaymentController::class, 'trash'])->name('payment.trash');
    Route::patch('payment-restore/{id}', [PaymentController::class, 'restore'])->name('payment.restore');
    Route::delete('payment-force-delete/{id}', [PaymentController::class, 'forceDelete'])->name('payment.forceDelete');


    Route::resource('order', OrderController::class);
    // Trash - Xoá mềm - Khôi Phuc
    Route::get('order-trash', [OrderController::class, 'trash'])->name('order.trash');
    Route::patch('order-restore/{id}', [OrderController::class, 'restore'])->name('order.restore');
    Route::delete('order-force-delete/{id}', [OrderController::class, 'forceDelete'])->name('order.forceDelete');


    Route::resource('coupon', CouponController::class);
    // Trash - Xoá mềm - Khôi Phuc
    Route::get('coupon-trash', [CouponController::class, 'trash'])->name('coupon.trash');
    Route::patch('coupon-restore/{id}', [CouponController::class, 'restore'])->name('coupon.restore');
    Route::delete('coupon-force-delete/{id}', [CouponController::class, 'forceDelete'])->name('coupon.forceDelete');


    route::resource('feedback', FeedbackController::class);

    //permission user
    Route::resource('user', UserController::class);
    // Trash - Xoá mềm - Khôi Phuc
    Route::get('user-trash', [UserController::class, 'trash'])->name('user.trash');
    Route::patch('user-restore/{id}', [UserController::class, 'restore'])->name('user.restore');
    Route::delete('user-force-delete/{id}', [UserController::class, 'forceDelete'])->name('user.forceDelete');

    //permission role
    Route::resource('role', RoleController::class);
    // Trash - Xoá mềm - Khôi Phuc
    Route::get('role-trash', [RoleController::class, 'trash'])->name('role.trash');
    Route::patch('role-restore/{id}', [RoleController::class, 'restore'])->name('role.restore');
    Route::delete('role-force-delete/{id}', [RoleController::class, 'forceDelete'])->name('role.forceDelete');

    // Route::resource('permission', PermissionController::class);
    Route::resource('supplier', SupplierController::class);
    Route::resource('ingredientType', IngredientTypeController::class);
    Route::resource('ingredient', IngredientController::class);
    Route::resource('dashboard', DashboardController::class);
    Route::resource('accountSetting', SettingController::class);
    // Lịch
    Route::resource('calendar', CalendarController::class);

    //permission route
    Route::get('/admin/permission', [PermissionController::class, 'index'])->name('permissions.index');
    Route::get('/admin/permission/create', [PermissionController::class, 'create'])->name('permissions.create');
    Route::post('/admin/permission', [PermissionController::class, 'store'])->name('permissions.store');
    Route::get('/admin/permission/{id}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
    Route::put('/admin/permission/{id}', [PermissionController::class, 'update'])->name('permissions.update');
    Route::delete('admin/permission/{id}', [PermissionController::class, 'destroy'])->name('permissions.destroy');

    //roles route
    // Route::get('/admin/permission', [PermissionController::class, 'index'])->name('permissions.index');
    // Route::get('/admin/permission/create', [PermissionController::class, 'create'])->name('permissions.create');
    // Route::post('/admin/permission', [PermissionController::class, 'store'])->name('permissions.store');
    // Route::get('/admin/permission/{id}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
    // Route::put('/admin/permission/{id}', [PermissionController::class, 'update'])->name('permissions.update');
    // Route::delete('admin/permission/{id}', [PermissionController::class, 'destroy'])->name('permissions.destroy');



    //permission route
    Route::get('/admin/permission', [PermissionController::class, 'index'])->name('permissions.index');
    Route::get('/admin/permission/create', [PermissionController::class, 'create'])->name('permissions.create');
    Route::post('/admin/permission', [PermissionController::class, 'store'])->name('permissions.store');
    Route::get('/admin/permission/{id}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
    Route::put('/admin/permission/{id}', [PermissionController::class, 'update'])->name('permissions.update');
    Route::delete('admin/permission/{id}', [PermissionController::class, 'destroy'])->name('permissions.destroy');

    //roles route
    // Route::get('/admin/permission', [PermissionController::class, 'index'])->name('permissions.index');
    // Route::get('/admin/permission/create', [PermissionController::class, 'create'])->name('permissions.create');
    // Route::post('/admin/permission', [PermissionController::class, 'store'])->name('permissions.store');
    // Route::get('/admin/permission/{id}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
    // Route::put('/admin/permission/{id}', [PermissionController::class, 'update'])->name('permissions.update');
    // Route::delete('admin/permission/{id}', [PermissionController::class, 'destroy'])->name('permissions.destroy');


});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



// Route::get('/', function () {
//     return view('welcome');
// });


require __DIR__ . '/auth.php';

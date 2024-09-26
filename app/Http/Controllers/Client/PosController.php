<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Combo;
use App\Models\Dishes;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PosController extends Controller
{
    public function index(Request $request)
    {
        // // Kiểm tra nếu có loại được chọn (category)
        // $category = $request->get('category', 'all');  // Mặc định là 'all'

        // if ($category == 'all') {
        //     $dishes = DB::table('dishes')->get();
        // } else {
        //     $dishes = DB::table('dishes')->where('category_id', $category)->get();
        // }

        // $categories = DB::table('categories')->get();
        // $combos = DB::table('combos')->take(6)->get();

        // return view('pos.pos', compact('combos', 'categories', 'dishes'));


    }

   // Lấy danh sách đơn đặt bàn sắp đến và quá hạn
   public function getUpcomingAndOverdueReservations()
   {
       $now = Carbon::now();

       // Lấy các đơn đặt bàn sắp đến hạn trong vòng 30 phút tới
       $upcomingReservations = Reservation::where('reservation_date', '=', $now->toDateString())
           ->where('reservation_time', '>=', $now->toTimeString())
           ->where('reservation_time', '<=', $now->copy()->addMinutes(30)->toTimeString())
           ->where('status', 'Pending')
           ->get();

       // Lấy các đơn đã quá hạn 15 phút
       $waitingReservations = Reservation::where('reservation_date', '=', $now->toDateString())
           ->where('reservation_time', '<', $now->toTimeString())
           ->where('reservation_time', '>=', $now->copy()->subMinutes(15)->toTimeString())
           ->where('status', 'Pending')
           ->get();

       // Cập nhật trạng thái đơn đã quá hạn thành "Cancelled" và lấy lại danh sách đơn đã hủy
       $overdueReservations = Reservation::where('reservation_date', '=', $now->toDateString())
           ->where('reservation_time', '<', $now->copy()->subMinutes(15)->toTimeString())
           ->where('status', 'Pending')
           ->update(['status' => 'Cancelled']);

       // Lấy danh sách đơn đã hủy sau khi cập nhật
       $overdueReservations = Reservation::where('reservation_date', '=', $now->toDateString())
           ->where('status', 'Cancelled')
           ->get();

       return view('pos.reservations', compact('upcomingReservations', 'waitingReservations', 'overdueReservations'));
   }

}

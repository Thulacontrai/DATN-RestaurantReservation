<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Reservation;
use App\Models\Table;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard with general statistics from reservations.
     */
    public function index()
    {
        $title = 'Dashboard';

        // Tổng số bàn và danh mục món ăn
        $tableCount = Table::count(); // Số lượng bàn
        $categoryCount = Category::count(); // Số lượng danh mục món ăn
        $userCount = User::count(); // Tổng số người dùng
        $orderCount = Order::count(); // Tổng số đơn hàng

        // Tổng số đặt bàn và doanh thu từ đặt bàn
        $reservationCount = Reservation::count(); // Tổng số đặt bàn

        // Doanh thu từ đặt cọc trong tháng hiện tại
        $totalRevenue = Reservation::whereMonth('created_at', Carbon::now()->month)->sum('deposit_amount');

        // Số lượng đặt bàn trong tháng hiện tại
        $totalBookings = Reservation::whereMonth('created_at', Carbon::now()->month)->count();

        // Tỉ lệ hủy đặt bàn trong tháng hiện tại
        $cancelledBookings = Reservation::whereMonth('created_at', Carbon::now()->month)
            ->where('status', 'Cancelled') // Trạng thái 'Cancelled' giả định cho đơn hàng hủy
            ->count();
        $cancellationRate = $totalBookings > 0 ? ($cancelledBookings / $totalBookings) * 100 : 0;

        // Số lượng khách trong tháng hiện tại
        $totalCustomers = Reservation::whereMonth('created_at', Carbon::now()->month)->sum('guest_count');

        // Doanh thu tháng này và tăng trưởng doanh thu so với tháng trước
        $salesThisMonth = number_format($totalRevenue);
        $previousMonthRevenue = Reservation::whereMonth('created_at', Carbon::now()->subMonth()->month)->sum('deposit_amount');
        $salesGrowth = $previousMonthRevenue > 0 ? (($totalRevenue - $previousMonthRevenue) / $previousMonthRevenue) * 100 : 0;

        // Dữ liệu cho biểu đồ
        $bookingData = [];
        $revenueData = [];
        for ($i = 1; $i <= 12; $i++) {
            $bookingData[] = Reservation::whereMonth('created_at', $i)->count();
            $revenueData[] = Reservation::whereMonth('created_at', $i)->sum('deposit_amount');
        }

        // Pass data to view
        return view('admin.dashboard.index', compact(
            'title',
            'tableCount',
            'categoryCount',
            'userCount',
            'orderCount',
            'reservationCount',
            'totalBookings',
            'totalRevenue',
            'cancellationRate',
            'totalCustomers',
            'salesThisMonth',
            'salesGrowth',
            'bookingData',   // Truyền dữ liệu đặt bàn theo tháng
            'revenueData'    // Truyền dữ liệu doanh thu theo tháng
        ));
    }


    public function show($id = null)
    {
        return view('admin.dashboard.index', compact('id'));
    }

    /**
     * Get monthly statistics for the dashboard (for charts or reports).
     */
    public function report(Request $request)
    {
        return view('admin.dashboard.report', compact('request'));
    }
}

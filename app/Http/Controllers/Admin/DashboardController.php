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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard with general statistics from reservations.
     */
    public function index(Request $request)
    {
        $title = 'Thống Kê';

        // Lấy dữ liệu doanh thu từ bảng orders
        $revenues = DB::table('orders')
            ->selectRaw('MONTH(created_at) as month, SUM(total_amount) as total_revenue') // Sửa total_price thành total_amount
            ->groupByRaw('MONTH(created_at)')
            ->get();

        $orders = Order::latest()->take(10)->get(); // Lấy 10 đơn hàng mới nhất

        // Logic tổng hợp dữ liệu cho view
        $tableCount = Table::count(); // Số lượng bàn
        $categoryCount = Category::count(); // Số lượng danh mục món ăn
        $userCount = User::count(); // Tổng số người dùng
        $orderCount = Order::count(); // Tổng số đơn hàng

        $reservationCount = Reservation::count(); // Tổng số đặt bàn
        $totalRevenue = Reservation::sum('deposit_amount') / 1000000; // Tính tổng doanh thu và chia cho 1 triệu

        $totalBookings = Reservation::whereMonth('created_at', Carbon::now()->month)->count();

        $cancelledBookings = Reservation::whereMonth('created_at', Carbon::now()->month)
            ->where('status', 'Cancelled')
            ->count();
        $cancellationRate = $totalBookings > 0 ? ($cancelledBookings / $totalBookings) * 100 : 0;

        $totalCustomers = Reservation::whereMonth('created_at', Carbon::now()->month)->sum('guest_count');

        $salesThisMonth = number_format($totalRevenue);
        $previousMonthRevenue = Reservation::whereMonth('created_at', Carbon::now()->subMonth()->month)->sum('deposit_amount');
        $salesGrowth = $previousMonthRevenue > 0 ? (($totalRevenue - $previousMonthRevenue) / $previousMonthRevenue) * 100 : 0;

        // Dữ liệu cho biểu đồ khách cọc và không cọc
        $depositData = [
            'coc' => Reservation::whereMonth('created_at', Carbon::now()->month)->where('deposit_amount', '>', 0)->sum('deposit_amount'),
            'khongCoc' => Reservation::whereMonth('created_at', Carbon::now()->month)->where('deposit_amount', '=', 0)->sum('deposit_amount'),
        ];

        // Lấy dữ liệu cho biểu đồ doanh thu và số lượng đặt bàn theo tháng
        $bookingData = [];
        $revenueData = [];
        $statusData = [
            'Confirmed' => [],
            'Cancelled' => [],
            'Pending' => []
        ];

        for ($i = 1; $i <= 12; $i++) {
            // Tổng số đặt bàn theo tháng
            $bookingData[] = Reservation::whereMonth('created_at', $i)->count();

            // Doanh thu theo tháng
            $revenueData[] = Reservation::whereMonth('created_at', $i)->sum('deposit_amount');

            // Dữ liệu trạng thái đặt bàn
            $statusData['Confirmed'][] = Reservation::whereMonth('created_at', $i)->where('status', 'Confirmed')->count();
            $statusData['Cancelled'][] = Reservation::whereMonth('created_at', $i)->where('status', 'Cancelled')->count();
            $statusData['Pending'][] = Reservation::whereMonth('created_at', $i)->where('status', 'Pending')->count();
        }

        // Tính toán số lượng khách cọc và không cọc (sử dụng deposit_amount thay vì deposit_status)
        $coc = Reservation::where('deposit_amount', '>', 0)->count(); // Khách đã cọc
        $khongCoc = Reservation::where('deposit_amount', '=', 0)->count(); // Khách chưa cọc

        // Tính toán trạng thái đặt bàn với các trạng thái mới: Confirmed, Pending, checked-in, Cancelled, Refund
        $confirmed = Reservation::whereMonth('created_at', Carbon::now()->month)->where('status', 'Confirmed')->count();
        $pending = Reservation::whereMonth('created_at', Carbon::now()->month)->where('status', 'Pending')->count();
        $checkedIn = Reservation::whereMonth('created_at', Carbon::now()->month)->where('status', 'Checked-in')->count();  // Chỉnh lại tên 'checked-in' đúng chính tả
        $cancelled = Reservation::whereMonth('created_at', Carbon::now()->month)->where('status', 'Cancelled')->count();
        $refund = Reservation::whereMonth('created_at', Carbon::now()->month)->where('status', 'Refund')->count();  // Chỉnh lại tên biến 'Refund' không viết hoa đầu



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
            'bookingData',
            'revenueData',
            'revenues',
            'orders',
            'statusData', // Pass thêm dữ liệu trạng thái cho biểu đồ
            'depositData', // Pass dữ liệu khách cọc và không cọc cho biểu đồ
            'confirmed',
            'pending',
            'checkedIn',
            'cancelled',
            'refund',
            'coc',
            'khongCoc' // Pass thêm các biến này
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

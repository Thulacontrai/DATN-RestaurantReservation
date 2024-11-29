<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Table;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard with general statistics.
     */
    public function index()
    {
        $startDate = Carbon::now()->startOfMonth(); // Lấy ngày đầu tháng
        $endDate = Carbon::now(); // Ngày hiện tại

        // General counts for dashboard summary
        $tableCount = Table::count(); // Số lượng bàn
        $categoryCount = Category::count(); // Số lượng danh mục món ăn
        $orderCount = Order::count(); // Tổng số đơn hàng
        $userCount = User::count(); // Tổng số người dùng

        // Tổng doanh thu trong tháng này (Gross Revenue)
        $totalRevenue = Order::where('status', 'completed')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('total_amount'); // Tổng doanh thu từ các đơn hàng đã hoàn thành

        // Doanh thu ròng trong tháng này (Net Revenue)
        $netRevenue = Order::where('status', 'completed')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum(DB::raw('total_amount - final_amount'));

        // Tổng thu nhập từ bảng payments
        $totalEarnings = Payment::where('status', 'completed') // Lọc các thanh toán hoàn thành
            ->whereBetween('created_at', [$startDate, $endDate]) // Lọc theo khoảng thời gian
            ->sum('transaction_amount'); // Tính tổng thu nhập (sử dụng cột 'transaction_amount' trong bảng payments)

        // Số lượng khách hàng mới
        $newCustomers = User::whereBetween('created_at', [$startDate, $endDate])
            ->count(); // Đếm tất cả người dùng mới





        // // Số đơn hoàn thành trong tháng này
        // $completedOrders = Order::where('status', 'completed')
        //     ->whereBetween('created_at', [$startDate, $endDate])
        //     ->count();

        // // Số đơn hủy trong tháng này
        // $cancelledOrders = Order::where('status', 'cancelled')
        //     ->whereBetween('created_at', [$startDate, $endDate])
        //     ->count();

        // Pass data to view
        return view('admin.dashboard.index', compact(
            'tableCount',
            'categoryCount',
            'orderCount',
            'userCount',
            'totalRevenue', // Tổng doanh số (Gross Revenue)
            'netRevenue',   // Doanh thu ròng (Net Revenue)
            'totalEarnings', // Tổng thu nhập
            'newCustomers',
            // 'completedOrders',
            // 'cancelledOrders'
        ));
    }




    public function show($id = null)
    {
        return view('admin.dashboard.index', compact('id'));
    }

    /**
     * Get monthly statistics for the dashboard (for charts or reports).
     */
    public function getMonthlyStatistics()
    {
        $currentYear = Carbon::now()->year;

        // Default months array
        $months = range(1, 12);

        // Doanh số bán hàng (total_amount) theo tháng
        $sales = Order::selectRaw('MONTH(created_at) as month, SUM(total_amount) as total_sales')
            ->whereYear('created_at', $currentYear)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total_sales', 'month')
            ->toArray();

        // Doanh thu thực tế (final_amount) theo tháng, sau khi trừ giảm giá
        $finalSales = Order::selectRaw('MONTH(created_at) as month, SUM(final_amount) as total_final_sales')
            ->whereYear('created_at', $currentYear)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total_final_sales', 'month')
            ->toArray();

        // Số đơn hàng theo trạng thái (completed, cancelled, pending, etc.)
        $orderStatuses = Order::selectRaw('MONTH(created_at) as month, status, COUNT(*) as order_count')
            ->whereYear('created_at', $currentYear)
            ->groupBy('month', 'status')
            ->orderBy('month')
            ->get()
            ->groupBy('month')
            ->map(fn($statusGroup) => $statusGroup->keyBy('status')->toArray())
            ->toArray();

        // Thống kê theo loại đơn hàng (order_type)
        $orderTypes = Order::selectRaw('MONTH(created_at) as month, order_type, COUNT(*) as order_type_count')
            ->whereYear('created_at', $currentYear)
            ->groupBy('month', 'order_type')
            ->orderBy('month')
            ->get()
            ->groupBy('month')
            ->map(fn($typeGroup) => $typeGroup->keyBy('order_type')->toArray())
            ->toArray();

        // Chuẩn bị dữ liệu trả về với các giá trị mặc định cho tất cả các tháng
        $data = [
            'sales' => array_map(fn($month) => $sales[$month] ?? 0, $months),
            'final_sales' => array_map(fn($month) => $finalSales[$month] ?? 0, $months),
            'order_statuses' => array_map(
                fn($month) => [
                    'completed' => $orderStatuses[$month]['completed']['order_count'] ?? 0,
                    'cancelled' => $orderStatuses[$month]['cancelled']['order_count'] ?? 0,
                    'pending' => $orderStatuses[$month]['pending']['order_count'] ?? 0,
                    'other' => array_sum(array_map(fn($status) => $status['order_count'], array_diff_key($orderStatuses[$month], ['completed' => 1, 'cancelled' => 1, 'pending' => 1]))),
                ],
                $months
            ),
            'order_types' => array_map(
                fn($month) => [
                    'delivery' => $orderTypes[$month]['delivery']['order_type_count'] ?? 0,
                    'pickup' => $orderTypes[$month]['pickup']['order_type_count'] ?? 0,
                    'other' => array_sum(array_map(fn($type) => $type['order_type_count'], array_diff_key($orderTypes[$month], ['delivery' => 1, 'pickup' => 1]))),
                ],
                $months
            ),
        ];

        // Trả về dữ liệu dưới dạng JSON
        return response()->json($data);
    }


    public function report(Request $request)
    {
        return view('admin.dashboard.report', compact('request'));
    }
}

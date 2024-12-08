<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Báo Cáo Thống Kê';

        // Lấy dữ liệu doanh thu từ bảng orders
        $revenues = DB::table('orders')
            ->selectRaw('MONTH(created_at) as month, SUM(total_amount) as total_revenue')
            ->groupByRaw('MONTH(created_at)')
            ->get();

        // Lấy dữ liệu cho biểu đồ doanh thu và số lượng đặt bàn theo tháng
        $bookingData = [];
        $revenueData = [];

        for ($i = 1; $i <= 12; $i++) {
            // Tổng số đặt bàn theo tháng
            $bookingData[] = Reservation::whereMonth('created_at', $i)->count();

            // Doanh thu theo tháng
            $revenueData[] = Reservation::whereMonth('created_at', $i)->sum('deposit_amount');
        }

        // Dữ liệu cho biểu đồ khách cọc và không cọc
        $depositData = [
            'coc' => Reservation::whereMonth('created_at', Carbon::now()->month)->where('deposit_amount', '>', 0)->sum('deposit_amount'),
            'khongCoc' => Reservation::whereMonth('created_at', Carbon::now()->month)->where('deposit_amount', '=', 0)->sum('deposit_amount'),
        ];

        // Tổng hợp dữ liệu cho view
        $totalRevenue = Reservation::whereMonth('created_at', Carbon::now()->month)->sum('deposit_amount');
        $salesThisMonth = number_format($totalRevenue);
        $previousMonthRevenue = Reservation::whereMonth('created_at', Carbon::now()->subMonth()->month)->sum('deposit_amount');
        $salesGrowth = $previousMonthRevenue > 0 ? (($totalRevenue - $previousMonthRevenue) / $previousMonthRevenue) * 100 : 0;

        // Pass data to view
        return view('admin.dashboard.reports.index', compact(
            'title',
            'revenues',
            'bookingData',
            'revenueData',
            'salesThisMonth',
            'salesGrowth',
            'depositData'
        ));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InventoryTransaction;
use App\Models\InventoryStock;
use Illuminate\Http\Request;

class InventoryDBController extends Controller
{
    public function index()
    {
        // Lấy dữ liệu theo tuần và tháng cho các giao dịch
        $weeklyData = InventoryTransaction::selectRaw('status, COUNT(*) as total_count, WEEK(created_at) as week')
            ->groupBy('status', 'week')
            ->get();

        $monthlyData = InventoryTransaction::selectRaw('status, COUNT(*) as total_count, MONTH(created_at) as month')
            ->groupBy('status', 'month')
            ->get();

        // Lấy dữ liệu top 5 sản phẩm có số lượng stock cao nhất
        $topProducts = InventoryStock::with('ingredient')
            ->orderBy('quantity_stock', 'desc')
            ->take(5)
            ->get();

        // Dữ liệu cho biểu đồ
        $labels = $topProducts->map(function ($product) {
            return $product->ingredient->name;  // Tên sản phẩm
        });

        $series = $topProducts->map(function ($product) {
            return $product->quantity_stock;  // Số lượng tồn kho
        });

        // Dữ liệu giao dịch
        $weeklyCompleted = 0;
        $weeklyCanceled = 0;
        $monthlyCompleted = 0;
        $monthlyCanceled = 0;

        foreach ($weeklyData as $transaction) {
            if ($transaction->status == 'hoàn thành') {
                $weeklyCompleted += $transaction->total_count;
            } elseif ($transaction->status == 'Hủy') {
                $weeklyCanceled += $transaction->total_count;
            }
        }

        foreach ($monthlyData as $transaction) {
            if ($transaction->status == 'hoàn thành') {
                $monthlyCompleted += $transaction->total_count;
            } elseif ($transaction->status == 'Hủy') {
                $monthlyCanceled += $transaction->total_count;
            }
        }

        // Dữ liệu cho biểu đồ giao dịch
        $transactionData = [
            [
                'name' => 'Hoàn thành',
                'data' => $weeklyData->where('status', 'hoàn thành')->map(function($item) {
                    return ['x' => $item->week, 'y' => $item->total_count];
                })->toArray(),
            ],
            [
                'name' => 'Đã hủy',
                'data' => $weeklyData->where('status', 'Hủy')->map(function($item) {
                    return ['x' => $item->week, 'y' => $item->total_count];
                })->toArray(),
            ],
        ];

        return view('admin.dashboard.inventoryDashboard.index', [
            'weeklyCompleted' => $weeklyCompleted,
            'weeklyCanceled' => $weeklyCanceled,
            'monthlyCompleted' => $monthlyCompleted,
            'monthlyCanceled' => $monthlyCanceled,
            'transactionData' => $transactionData,
            'labels' => $labels,
            'series' => $series, 
        ]);
    }
}

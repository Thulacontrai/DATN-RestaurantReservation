<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Table;
use App\Models\User;
use App\Traits\TraitCRUD;

class DashboardController extends Controller
{
    use TraitCRUD;


    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        $tableCount = Table::count();
        $categoryCount = Category::count();
        $orderCount = Order::count();
        $userCount = User::count();
        return view('admin.dashboard.index', compact('tableCount', 'categoryCount', 'orderCount', 'userCount'));
    }
    /**
     * Display the dashboard with a specific ID, if provided.
     */
    public function show($id = null)
    {
        return view('admin.dashboard.index', compact('id'));
    }
}

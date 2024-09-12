<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\TraitCRUD;

class DashboardController extends Controller
{
    use TraitCRUD;


    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        return view('admin.dashboard.index');
    }
    /**
     * Display the dashboard with a specific ID, if provided.
     */
    public function show($id = null)
    {
        return view('admin.dashboard.index', compact('id'));
    }
}

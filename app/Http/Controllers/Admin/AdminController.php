<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        return view('admin.dashboard.index');
    }

    /**
     * Display the login page.
     */
    public function logon()
    {
        return view('admin.logon'); 
    }
}

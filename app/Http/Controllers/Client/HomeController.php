<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Combo;
use App\Models\Dishes;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $dishes = Dishes::paginate(10);
        $combos = Combo::all();

        return view('client.index', compact('dishes', 'combos'));
    }
}

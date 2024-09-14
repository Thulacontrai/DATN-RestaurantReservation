<?php

namespace App\Http\Controllers\Client;


use App\Models\Combo;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Dishes;
use GuzzleHttp\Psr7\Request;

class MenuController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $dishes = Dishes::paginate(6);
        $combos = Combo::all();
        return view('client.menu', compact('categories', 'dishes', 'combos'));
    }

    // public function filterByCategory(Request $request)
    // {
    //     $categoryId = $request->input('category_id');

    //     // Filter based on the selected category
    //     if ($categoryId == 1) {
    //         $items = Dishes::where('category_id', 1)->get();
    //     } elseif ($categoryId == 2) {
    //         $items = Dishes::where('category_id', 2)->get();
    //     } elseif ($categoryId == 3) {
    //         $items = Dishes::where('category_id', 3)->get(); 
    //     } else {
    //         $items = Dishes::all(); // Show all items if no category is selected
    //     }

    //     return response()->json([
    //         'items' => $items
    //     ]);
    // }


}

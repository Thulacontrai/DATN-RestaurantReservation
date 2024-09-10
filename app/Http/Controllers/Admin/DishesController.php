<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Dishes;
use Illuminate\Http\Request;

class DishesController extends Controller
{
    public function index(Request $request)
    {
        $query = Dishes::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        $dishes = $query->paginate(10);

        return view('admin.dish.dishes.index', compact('dishes'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.dish.dishes.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'status' => 'required|string|in:available,out_of_stock,reserved,in_use,completed,cancelled',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        Dishes::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'status' => $request->status,
            'image' => $request->hasFile('image') ? $request->file('image')->store('dish_images', 'public') : null,
        ]);

        return redirect()->route('admin.dishes.index')->with('success', 'Món ăn đã được thêm thành công!');
    }

    public function edit($id)
    {
        $dish = Dishes::findOrFail($id);
        $categories = Category::all();
        return view('admin.dish.dishes.edit', compact('dish', 'categories'));

    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'status' => 'required|string|in:available,out_of_stock,reserved,in_use,completed,cancelled',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $dish = Dishes::findOrFail($id);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('dish_images', 'public');
            $dish->image = $imagePath;
        }

        $dish->update([
            'name' => $request->input('name'),
            'category_id' => $request->input('category_id'),
            'price' => $request->input('price'),
            'quantity' => $request->input('quantity'),
            'status' => $request->input('status'),
        ]);

        return redirect()->route('admin.dishes.index')->with('success', 'Món ăn đã được cập nhật thành công!');
    }

    public function show($id)
    {
        $dish = Dishes::findOrFail($id);
        return view('admin.dish.dishes.detail', compact('dish'));
    }

    public function destroy($id)
    {
        $dish = Dishes::findOrFail($id);
        $dish->delete();

        return redirect()->route('admin.dishes.index')->with('success', 'Món ăn đã được xóa thành công!');
    }
}

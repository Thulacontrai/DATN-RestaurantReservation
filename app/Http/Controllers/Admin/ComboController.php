<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Combo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ComboController extends Controller
{
    public function index(Request $request)
    {
        $query = Combo::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        $combos = $query->paginate(10);

        return view('admin.dish.combo.index', compact('combos'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.dish.combo.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'quantity_dishes' => 'required|integer|min:1',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('combo_images', 'public');
        }

        Combo::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $imagePath,
            'quantity_dishes' => $request->quantity_dishes,
        ]);

        return redirect()->route('combo.index')->with('success', 'Combo đã được thêm thành công!');
    }

    public function edit($id)
    {
        $combo = Combo::findOrFail($id);
        $categories = Category::all();

        return view('admin.dish.combo.edit', compact('combo', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $combo = Combo::findOrFail($id);
        $combo->update($request->all());

        return redirect()->route('combo.index')->with('success', 'Combo đã được cập nhật thành công!');
    }

    public function show($id)
    {
        $combo = Combo::findOrFail($id);

        return view('admin.dish.combo.detail', compact('combo'));
    }

    public function destroy($id)
    {
        $combo = Combo::findOrFail($id);

        if ($combo->image) {
            Storage::delete('public/' . $combo->image);
        }

        $combo->delete();

        return redirect()->route('combo.index')->with('success', 'Combo đã được xóa thành công!');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Combo;
use App\Traits\TraitCRUD;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ComboController extends Controller
{
    use TraitCRUD;

    protected $model = Combo::class;
    protected $viewPath = 'admin.dish.combo';
    protected $routePath = 'admin.combo';


    public function index(Request $request)
    {
        $query = $this->model::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        $combos = $query->paginate(10);

        return view($this->viewPath . '.index', compact('combos'));
    }


    public function create()
    {
        $categories = Category::all();
        return view($this->viewPath . '.create', compact('categories'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'             => 'required|string|max:255',
            'price'            => 'required|numeric',
            'description'      => 'nullable|string',
            'image'            => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'quantity_dishes'  => 'required|integer|min:1',
        ]);

        // Kiểm tra tên combo đã tồn tại hay chưa
        $existingCombo = Combo::where('name', $request->name)->first();
        if ($existingCombo) {
            return redirect()->back()->withInput()->with('error', 'Tên combo đã tồn tại. Vui lòng đặt tên khác.');
        }

        DB::transaction(function () use ($request) {
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('combo_images', 'public');
            }

            $this->model::create([
                'name'             => $request->name,
                'price'            => $request->price,
                'description'      => $request->description,
                'image'            => $imagePath,
                'quantity_dishes'  => $request->quantity_dishes,
            ]);
        });

        return redirect()->route($this->routePath . '.index')->with('success', 'Combo đã được thêm thành công!');
    }


    public function edit($id)
    {
        $combo = $this->model::findOrFail($id);
        $categories = Category::all();

        return view($this->viewPath . '.edit', compact('combo', 'categories'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name'             => 'required|string|max:255',
            'price'            => 'required|numeric',
            'description'      => 'nullable|string',
            'image'            => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'quantity_dishes'  => 'required|integer|min:1',
        ]);

        // Kiểm tra tên combo đã tồn tại nhưng loại trừ combo hiện tại
        $existingCombo = Combo::where('name', $request->name)->where('id', '!=', $id)->first();
        if ($existingCombo) {
            return redirect()->back()->withInput()->with('error', 'Tên combo đã tồn tại. Vui lòng đặt tên khác.');
        }

        DB::transaction(function () use ($request, $id) {
            $combo = $this->model::findOrFail($id);

            if ($request->hasFile('image')) {
                if ($combo->image) {
                    Storage::delete('public/' . $combo->image);
                }
                $imagePath = $request->file('image')->store('combo_images', 'public');
                $combo->image = $imagePath;
            }

            $combo->update($request->except('image'));
        });

        return redirect()->route($this->routePath . '.index')->with('success', 'Combo đã được cập nhật thành công!');
    }

    public function show($id)
    {
        $combo = $this->model::findOrFail($id);

        return view($this->viewPath . '.detail', compact('combo'));
    }


    public function trash()
    {
        $combos = Combo::onlyTrashed()->paginate(10);
        return view($this->viewPath . '.trash', compact('combos'));
    }

    public function restore($id)
    {
        $combo = Combo::withTrashed()->findOrFail($id);
        $combo->restore();

        return redirect()->route($this->routePath . '.trash')->with('success', 'Combo đã được khôi phục thành công!');
    }

    public function forceDelete($id)
    {
        $combo = Combo::withTrashed()->findOrFail($id);

        if ($combo->image) {
            Storage::delete('public/' . $combo->image);
        }

        $combo->forceDelete(); 

        return redirect()->route($this->routePath . '.trash')->with('success', 'Combo đã được xóa vĩnh viễn!');
    }
}

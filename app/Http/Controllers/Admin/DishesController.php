<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Dishes;
use App\Traits\TraitCRUD;
use Illuminate\Http\Request;

class DishesController extends Controller
{
    public function __construct()
    {
        // Gán middleware cho các phương thức
        $this->middleware('permission:Xem món ăn', ['only' => ['index']]);
        $this->middleware('permission:Tạo mới món ăn', ['only' => ['create']]);
        $this->middleware('permission:Sửa món ăn', ['only' => ['edit']]);
        $this->middleware('permission:Xóa món ăn', ['only' => ['destroy']]);
        
    }


    use TraitCRUD;

    protected $model = Dishes::class;
    protected $viewPath = 'admin.dishes';
    protected $routePath = 'admin.dishes';

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
            'description' => 'nullable|string',
            'status' => 'required|string|in:available,out_of_stock,reserved,in_use,completed,cancelled',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Kiểm tra xem tên món ăn đã tồn tại hay chưa
        if (Dishes::where('name', $request->name)->exists()) {
            return redirect()->route('admin.dishes.create')->with('error', 'Tên món ăn đã tồn tại. Vui lòng đặt tên khác.');
        }

        // Kiểm tra xem ảnh món ăn đã tồn tại hay chưa (nếu có tải lên ảnh)
        if ($request->hasFile('image') && Dishes::where('image', $request->file('image')->hashName())->exists()) {
            return redirect()->route('admin.dishes.create')->with('error', 'Ảnh món ăn đã tồn tại. Vui lòng tải lên hình ảnh khác.');
        }

        // Tạo mới món ăn
        Dishes::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'description' => $request->description,
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
            'description' => 'nullable|string',
            'status' => 'required|string|in:available,out_of_stock,reserved,in_use,completed,cancelled',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $dish = Dishes::findOrFail($id);

        // Kiểm tra tên món ăn đã tồn tại chưa, ngoại trừ món ăn hiện tại
        if (Dishes::where('name', $request->name)->where('id', '!=', $id)->exists()) {
            return redirect()->route('admin.dishes.edit', $id)->with('error', 'Tên món ăn đã tồn tại. Vui lòng đặt tên khác.');
        }

        // Kiểm tra xem ảnh món ăn đã tồn tại hay chưa (nếu có tải lên ảnh)
        if ($request->hasFile('image') && Dishes::where('image', $request->file('image')->hashName())->where('id', '!=', $id)->exists()) {
            return redirect()->route('admin.dishes.edit', $id)->with('error', 'Ảnh món ăn đã tồn tại. Vui lòng tải lên hình ảnh khác.');
        }

        // Cập nhật món ăn
        $dish->update([
            'name' => $request->input('name'),
            'category_id' => $request->input('category_id'),
            'price' => $request->input('price'),
            'quantity' => $request->input('quantity'),
            'description' => $request->input('description'),
            'status' => $request->input('status'),
            'image' => $request->hasFile('image') ? $request->file('image')->store('dish_images', 'public') : $dish->image,
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
        // $dish = Dishes::findOrFail($id);

        // // // Kiểm tra nếu món ăn thuộc danh mục còn tồn tại món ăn khác
        // // if ($dish->category && $dish->category->dishes()->count() > 1) {
        // //     return redirect()->route('admin.dishes.index')->with('error', 'Không thể xóa món ăn này vì danh mục của nó vẫn còn các món ăn khác.');
        // // }
        $dish = Dishes::findOrFail($id);

        // Kiểm tra trạng thái của món ăn
        if ($dish->status == 'reserved' || $dish->status == 'in_use') {
            return redirect()->route('admin.dishes.index')->with('error', 'Món ăn đã được đặt trước hoặc đang sử dụng, không thể thao tác xóa !.');
        }

        // Thực hiện xóa món ăn
        $dish->delete();

        return redirect()->route('admin.dishes.index')->with('success', 'Món ăn đã được xóa thành công!');
    }


    public function trash()
    {
        $dishes = Dishes::onlyTrashed()->paginate(10); // Lấy tất cả món ăn bị xóa mềm
        return view('admin.dish.dishes.trash', compact('dishes'));
    }

    public function restore($id)
    {
        $dish = Dishes::withTrashed()->findOrFail($id);
        $dish->restore(); // Khôi phục món ăn

        return redirect()->route('admin.dishes.trash')->with('success', 'Món ăn đã được khôi phục thành công!');
    }

    public function forceDelete($id)
    {
        $dish = Dishes::withTrashed()->findOrFail($id);
        $dish->forceDelete(); // Xóa vĩnh viễn

        return redirect()->route('admin.dishes.trash')->with('success', 'Món ăn đã được xóa vĩnh viễn!');
    }
}

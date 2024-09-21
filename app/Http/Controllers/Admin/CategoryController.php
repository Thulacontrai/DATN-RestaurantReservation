<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Traits\TraitCRUD;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use TraitCRUD;

    protected $model = Category::class;
    protected $viewPath = 'admin.dish.category';
    protected $routePath = 'admin.category';

    public function index(Request $request)
    {
        $query = Category::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        $categories = $query->paginate(10);

        return view('admin.dish.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.dish.category.create');
    }

    public function store(Request $request)
    {
        Category::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return redirect()->route('admin.category.index')->with('success', 'Category đã được thêm thành công!');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('admin.dish.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update($request->all());

        return redirect()->route('admin.category.index')->with('success', 'Category đã được cập nhật thành công!');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        // Kiểm tra xem danh mục có món ăn nào không
        if ($category->dishes()->count() > 0) {
            // Nếu có món ăn, trả về thông báo lỗi
            return redirect()->route('admin.category.index')->with('error', 'Không thể xóa danh mục này vì vẫn còn món ăn thuộc danh mục.');
        }

        // Nếu không có món ăn, tiến hành xóa mềm
        $category->delete();

        return redirect()->route('admin.category.index')->with('success', 'Category đã được xóa mềm thành công!');
    }

    // Hiển thị thùng rác
    public function trash()
    {
        $categories = Category::onlyTrashed()->paginate(10); // Lấy ra các danh mục đã bị xóa mềm

        return view('admin.dish.category.trash', compact('categories'));
    }

    // Khôi phục
    public function restore($id)
    {
        $category = Category::withTrashed()->findOrFail($id); // Lấy danh mục từ thùng rác
        $category->restore(); // Khôi phục danh mục

        return redirect()->route('admin.category.trash')->with('success', 'Category đã được khôi phục thành công!');
    }

    // Xóa vĩnh viễn
    public function forceDelete($id)
    {
        $category = Category::withTrashed()->findOrFail($id); // Lấy danh mục từ thùng rác
        $category->forceDelete(); // Xóa vĩnh viễn

        return redirect()->route('admin.category.trash')->with('success', 'Category đã được xóa vĩnh viễn!');
    }
}

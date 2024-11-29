<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Dishes;
use App\Models\Ingredient;
use App\Models\Recipe;
use App\Traits\TraitCRUD;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

        if ($request->filled('dish_name')) {
            $query->where('name', 'like', '%' . $request->dish_name . '%');
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

         // Kiểm tra và áp dụng trạng thái active/inactive nếu có
         if ($request->filled('is_active')) {
            $isActive = $request->is_active;
            $query->where('is_active', $isActive); // Lọc theo trạng thái
        } else {
            // Nếu không có tham số, lấy cả active và inactive dish
            // Mặc định sẽ lấy cả hai
        }

        $dishes = $query->paginate(10);

        if ($request->ajax()) {
            return response()->json([
                'html' => view('admin.dish.dishes.partials.dishes_table', compact('dishes'))->render(),
            ]);
        }

        $categories = Category::all();
        return view('admin.dish.dishes.index', compact('dishes', 'categories'));
    }


    public function create()
    {
        $categories = Category::all(); // Lấy tất cả các loại món ăn
        $ingredients = Ingredient::all(); // Lấy tất cả nguyên liệu

        return view('admin.dish.dishes.create', compact('categories', 'ingredients')); // Truyền cả hai biến vào view
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'status' => 'required|string|in:available,out_of_stock,reserved,in_use,completed,cancelled',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'ingredient_id' => 'required|array',
            'ingredient_id.*' => 'exists:ingredients,id',
            'ingredient_quantity' => 'required|array',
            'ingredient_quantity.*' => 'required|numeric|min:0',
        ]);

        if (Dishes::where('name', $request->name)->exists()) {
            return redirect()->route('admin.dishes.create')->with('error', 'Tên món ăn đã tồn tại. Vui lòng đặt tên khác.');
        }

        $dish = Dishes::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'description' => $request->description,
            'status' => $request->status,
            'image' => $request->hasFile('image') ? $request->file('image')->store('dish_images', 'public') : null,
        ]);

        // Kiểm tra và lưu nguyên liệu vào bảng recipes
        if (!empty($request->ingredient_id) && !empty($request->ingredient_quantity)) {
            // Kiểm tra sự tồn tại của dish_id
            if (!Dishes::find($dish->id)) {
                return redirect()->back()->withErrors(['dish' => 'Món ăn không tồn tại.']);
            }

            // Kiểm tra sự tồn tại của các ingredient_id
            foreach ($request->ingredient_id as $ingredientId) {
                if (!Ingredient::find($ingredientId)) {
                    return redirect()->back()->withErrors(['ingredient' => 'Nguyên liệu ID ' . $ingredientId . ' không tồn tại.']);
                }
            }

            // Kết hợp ingredient_id và ingredient_quantity
            $ingredients = array_combine($request->ingredient_id, $request->ingredient_quantity);

            if ($ingredients) {
                foreach ($ingredients as $ingredientId => $quantity) {
                    try {
                        Recipe::create([
                            'dish_id' => $dish->id,
                            'ingredient_id' => $ingredientId,
                            'quantity_need' => $quantity,
                        ]);
                    } catch (\Exception $e) {
                        Log::error('Lỗi khi lưu nguyên liệu: ' . $e->getMessage(), [
                            'dish_id' => $dish->id,
                            'ingredient_id' => $ingredientId,
                            'quantity_need' => $quantity,
                        ]);
                        return redirect()->back()->withErrors(['ingredient' => 'Lỗi khi lưu nguyên liệu ID: ' . $ingredientId . '. Lỗi: ' . $e->getMessage()]);
                    }
                }
            } else {
                return redirect()->back()->withErrors(['ingredients' => 'Phải có nguyên liệu và định lượng.']);
            }
        } else {
            return redirect()->back()->withErrors(['ingredients' => 'Phải có nguyên liệu và định lượng.']);
        }

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

            'description' => $request->input('description'),
            'status' => $request->input('status'),
            'image' => $request->hasFile('image') ? $request->file('image')->store('dish_images', 'public') : $dish->image,
        ]);

        return redirect()->route('admin.dishes.index')->with('success', 'Món ăn đã được cập nhật thành công!');
    }



    public function show($id)
    {
        $dish = Dishes::with('recipes.ingredient')->findOrFail($id);
        return view('admin.dish.dishes.detail', compact('dish'));
    }





    public function editIngredients($id)
    {
        // Lấy món ăn cùng nguyên liệu thông qua mối quan hệ
        $dish = Dishes::with('recipes.ingredient')->findOrFail($id);

        // Lấy tất cả nguyên liệu để hiển thị trong dropdown
        $ingredients = Ingredient::all();

        return view('admin.dish.dishes.edit-ingredients', compact('dish', 'ingredients'));
    }

    public function updateIngredients(Request $request, $id)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'ingredients' => 'required|array',
            'quantities' => 'required|array',
            'recipe_ids' => 'required|array',
        ]);

        // Tìm món ăn cần cập nhật
        $dish = Dishes::findOrFail($id);

        // Cập nhật từng nguyên liệu
        foreach ($request->ingredients as $index => $ingredientId) {
            $recipeId = $request->recipe_ids[$index];
            $quantity = $request->quantities[$index];

            // Tìm công thức tương ứng
            $recipe = Recipe::findOrFail($recipeId);

            // Cập nhật thông tin vào công thức
            $recipe->ingredient_id = $ingredientId; // Cập nhật ID nguyên liệu
            $recipe->quantity_need = $quantity;

            // Lưu thay đổi
            $recipe->save();
        }

        return redirect()->route('admin.dishes.show', $dish->id)->with('success', 'Cập nhật nguyên liệu thành công!');
    }


    public function addIngredient(Request $request, $dishId)
{
    // Xác thực dữ liệu đầu vào
    $request->validate([
        'new_ingredient' => 'required|array',
        'new_quantity' => 'required|array',
        // 'new_unit' => 'required|array',
    ]);

    // Tìm món ăn cần thêm nguyên liệu
    $dish = Dishes::findOrFail($dishId);

    // Thêm từng nguyên liệu mới vào món ăn
    foreach ($request->new_ingredient as $index => $ingredientId) {
        $quantity = $request->new_quantity[$index];
        // $unit = $request->new_unit[$index];

        // Tạo một công thức mới cho món ăn, chỉ lưu ingredient_id và quantity_need
        $dish->recipes()->create([
            'ingredient_id' => $ingredientId,
            'quantity_need' => $quantity,
        ]);
    }

    return redirect()->route('admin.dishes.show', $dish->id)->with('success', 'Nguyên liệu đã được thêm thành công.');
}



    public function deleteIngredient($recipeId)
    {
        // Tìm công thức
        $recipe = Recipe::findOrFail($recipeId);

        // Xóa công thức
        $recipe->delete();

        // Chuyển hướng về trang trước đó với thông báo thành công
        return redirect()->back()->with('success', 'Xóa nguyên liệu thành công!');
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


    public function toggleStatus(Request $request, $id)
    {
        try {
            $dish = Dishes::findOrFail($id); // Lấy dish theo ID
            $dish->is_active = $request->input('is_active'); // Cập nhật trạng thái
            $dish->save();

            return response()->json(['success' => true, 'message' => 'Trạng thái đã được cập nhật thành công.']);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['success' => false, 'message' => 'Có lỗi xảy ra trong quá trình cập nhật trạng thái.']);
        }
    }
}

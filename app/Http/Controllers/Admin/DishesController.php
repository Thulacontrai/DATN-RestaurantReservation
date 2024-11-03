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

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        $dishes = $query->paginate(10);

        return view('admin.dish.dishes.index', compact('dishes'));
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
        $dish = Dishes::with('recipes.ingredient')->findOrFail($id);
        return view('admin.dish.dishes.edit-ingredients', compact('dish'));
    }

    public function updateIngredients(Request $request, $id)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'ingredients' => 'required|array',
            'quantities' => 'required|array',
        ]);

        // Tìm món ăn cần cập nhật
        $dish = Dishes::findOrFail($id);

        // Cập nhật từng nguyên liệu
        foreach ($request->ingredients as $index => $ingredient) {
            $recipeId = $request->recipe_ids[$index]; // Lấy id của công thức
            $quantity = $request->quantities[$index]; // Lấy số lượng

            // Tìm công thức tương ứng
            $recipe = Recipe::findOrFail($recipeId);

            // Cập nhật tên nguyên liệu (nếu bạn muốn lưu tên nguyên liệu vào cơ sở dữ liệu)
            // Giả sử bạn có một trường 'name' trong bảng ingredients để lưu tên
            $recipe->ingredient->name = $ingredient; // Cập nhật tên nguyên liệu
            $recipe->quantity_need = $quantity; // Cập nhật số lượng

            // Lưu thay đổi
            $recipe->ingredient->save();
            $recipe->save();
        }

        // Chuyển hướng về trang chi tiết món ăn với thông báo thành công
        return redirect()->route('admin.dishes.show', $dish->id)->with('success', 'Cập nhật nguyên liệu thành công!');
    }



    public function addIngredient(Request $request, Dishes $dish)
    {
        // Validate the incoming request
        $request->validate([
            'new_ingredient' => 'required|string|max:255',
            'new_quantity' => 'required|numeric|min:0',
            'new_unit' => 'required|string|max:50',
        ]);

        // Find or create the ingredient
        $ingredient = Ingredient::firstOrCreate(
            ['name' => $request->new_ingredient],
            ['unit' => $request->new_unit] // Set the unit when creating a new ingredient
        );

        // Create a new recipe for the dish
        $dish->recipes()->create([
            'ingredient_id' => $ingredient->id, // Use the ID of the found or created ingredient
            'quantity_need' => $request->new_quantity,
        ]);

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






    // public function updateIngredients(Request $request, $id)
    // {
    //     // Log entry to check method call and dish ID
    //     Log::info('Calling updateIngredients with ID: ' . $id);

    //     // Validate request data
    //     $validatedData = $request->validate([
    //         'ingredients' => 'required|array',
    //         'ingredients.*.id' => 'required|exists:recipes,id',
    //         'ingredients.*.quantity' => 'nullable|numeric|min:0.1',
    //         'ingredients.*.delete' => 'nullable|boolean'
    //     ]);

    //     // Check if the dish exists
    //     $dish = Dishes::find($id);
    //     if (!$dish) {
    //         Log::error('Dish not found with ID: ' . $id);
    //         return response()->json(['message' => 'Dish not found'], 404);
    //     }

    //     $ingredients = $validatedData['ingredients'];
    //     Log::info('Ingredients received: ' . json_encode($ingredients));

    //     $deletedIds = [];
    //     $updatedIds = [];

    //     DB::beginTransaction();
    //     try {
    //         foreach ($ingredients as $ingredient) {
    //             $recipe = Recipe::find($ingredient['id']);

    //             if (!$recipe) {
    //                 Log::warning("Ingredient not found with ID: {$ingredient['id']}");
    //                 continue;
    //             }

    //             if (isset($ingredient['delete']) && $ingredient['delete'] === true) {
    //                 $recipe->delete();
    //                 $deletedIds[] = $ingredient['id'];
    //                 Log::info("Successfully deleted ingredient with ID: {$ingredient['id']}");
    //             } elseif (isset($ingredient['quantity'])) {
    //                 $recipe->quantity_need = $ingredient['quantity'];
    //                 $recipe->save();
    //                 $updatedIds[] = $ingredient['id'];
    //                 Log::info("Successfully updated ingredient ID: {$ingredient['id']} with quantity: {$ingredient['quantity']}");
    //             } else {
    //                 Log::warning('Quantity missing for ingredient ID: ' . $ingredient['id']);
    //             }
    //         }

    //         DB::commit();

    //         return response()->json([
    //             'message' => 'Ingredients updated successfully',
    //             'updated_ids' => $updatedIds,
    //             'deleted_ids' => $deletedIds
    //         ]);

    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         Log::error("Failed to update ingredients: " . $e->getMessage());
    //         return response()->json(['message' => 'Failed to update ingredients'], 500);
    //     }
    // }































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

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ingredient;
use App\Models\IngredientType;
use App\Models\Supplier;
use App\Traits\TraitCRUD;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IngredientController extends Controller
{
    public function __construct()
    {
        // Gán middleware cho các phương thức
        $this->middleware('permission:Xem nguyên liệu', ['only' => ['index']]);
        $this->middleware('permission:Tạo mới nguyên liệu', ['only' => ['create']]);
        $this->middleware('permission:Sửa nguyên liệu', ['only' => ['edit']]);
        $this->middleware('permission:Xóa nguyên liệu', ['only' => ['destroy']]);
        
    }

    use TraitCRUD;

    protected $model = Ingredient::class;
    protected $viewPath = 'admin.ingredient';
    protected $routePath = 'admin.ingredient';

    public function index()
    {
        $ingredients = Ingredient::paginate(10);
        return view('admin.ingredientType.ingredient.index', compact('ingredients'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        $ingredientTypes = IngredientType::all();

        return view('admin..ingredientType.ingredient.create', compact('suppliers', 'ingredientTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'supplier_id' => 'required|exists:suppliers,id',
            'price' => 'required|numeric',
            'unit' => 'required|string|max:50',
            'ingredient_type_id' => 'required|exists:ingredient_types,id',
        ]);

        DB::transaction(function () use ($request) {
            Ingredient::create($request->all());
        });

        return redirect()->route('admin.ingredient.index')->with('success', 'Nguyên liệu đã được tạo thành công.');
    }

    public function edit($id)
    {
        $ingredient = Ingredient::findOrFail($id);
        $suppliers = Supplier::all();
        $ingredientTypes = IngredientType::all();

        return view('admin..ingredientType.ingredient.edit', compact('ingredient', 'suppliers', 'ingredientTypes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'supplier_id' => 'required|exists:suppliers,id',
            'price' => 'required|numeric',
            'unit' => 'required|string|max:50',
            'ingredient_type_id' => 'required|exists:ingredient_types,id',
        ]);

        DB::transaction(function () use ($request, $id) {
            $ingredient = Ingredient::findOrFail($id);
            $ingredient->update($request->all());
        });

        return redirect()->route('admin.ingredient.index')->with('success', 'Nguyên liệu đã được cập nhật thành công.');
    }

    public function show($id)
    {
        $ingredient = Ingredient::findOrFail($id);

        return view('admin.ingredientType.ingredient.show', compact('ingredient'));
    }


    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $ingredient = Ingredient::findOrFail($id);
            $ingredient->delete();
        });

        return redirect()->route('admin.ingredient.index')->with('success', 'Nguyên liệu đã được xóa thành công.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\IngredientType;
use App\Traits\TraitCRUD;
use Illuminate\Http\Request;

class IngredientTypeController extends Controller
{
    use TraitCRUD;

    protected $model = IngredientType::class;
    protected $viewPath = 'admin.ingredientType';
    protected $routePath = 'admin.ingredientType';

    public function index()
    {
        $ingredientTypes = IngredientType::paginate(10);
        return view('admin.ingredientType.index', compact('ingredientTypes'));
    }

    public function create()
    {
        return view('admin.ingredientType.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:ingredient_types',
        ]);

        IngredientType::create($request->all());

        return redirect()->route('admin.ingredientType.index')
            ->with('success', 'Loại nguyên liệu đã được tạo thành công.');
    }

    public function edit($id)
    {
        $ingredientType = IngredientType::findOrFail($id);
        return view('admin.ingredientType.edit', compact('ingredientType'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:ingredient_types,name,' . $id,
        ]);

        $ingredientType = IngredientType::findOrFail($id);
        $ingredientType->update($request->all());

        return redirect()->route('admin.ingredientType.index')
            ->with('success', 'Loại nguyên liệu đã được cập nhật thành công.');
    }

    public function destroy($id)
    {
        $ingredientType = IngredientType::findOrFail($id);
        $ingredientType->delete();

        return redirect()->route('admin.ingredientType.index')
            ->with('success', 'Loại nguyên liệu đã được xóa thành công.');
    }
}

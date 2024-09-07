<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Table;
use App\Http\Requests\StoreTableRequest;
use App\Http\Requests\UpdateTableRequest;
use App\Traits\TraitCRUD;
use Illuminate\Http\Request;

class TableController extends Controller
{
    use TraitCRUD;

    protected $model = Table::class;
    protected $viewPath = 'admin.tables';
    protected $routePath = 'table';

    public function index(Request $request)
    {
        $query = Table::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('table_type')) {
            $query->where('table_type', $request->table_type);
        }

        $tables = $query->paginate(10);
        return view('admin.tables.index', compact('tables'));
    }

    public function store(StoreTableRequest $request)
    {
        Table::create($request->validated());

        return redirect()->route('table.index')->with('success', 'Bàn đã được thêm thành công!');
    }

    public function edit($id)
    {
        $table = Table::findOrFail($id);

        return view('admin.tables.edit', compact('table'));
    }

    public function update(UpdateTableRequest $request, $id)
    {
        $table = Table::findOrFail($id);
        $table->update($request->validated());

        return redirect()->route('table.index')->with('success', 'Bàn đã được cập nhật thành công!');
    }

    public function destroy($id)
    {
        $table = Table::findOrFail($id);
        $table->forceDelete();

        return redirect()->route('table.index')->with('success', 'Bàn đã được xóa hoàn toàn!');
    }
}

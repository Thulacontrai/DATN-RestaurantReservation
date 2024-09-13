<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Traits\TraitCRUD;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    use TraitCRUD;

    protected $model = Permission::class;
    protected $viewPath = 'admin.user.permission';
    protected $routePath = 'admin.permission';


    public function create()
    {
        return view($this->viewPath . '.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'permission_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        DB::transaction(function () use ($request) {
            $this->model::create($request->all());
        });

        return redirect()->route($this->routePath . '.index')->with('success', 'Quyền hạn đã được thêm mới thành công.');
    }



    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return view($this->viewPath . '.edit', compact('permission'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'permission_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        DB::transaction(function () use ($request, $id) {
            $permission = Permission::findOrFail($id);
            $permission->update($request->all());
        });

        return redirect()->route($this->routePath . '.index')->with('success', 'Quyền hạn đã được cập nhật thành công.');
    }




    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $permission = Permission::findOrFail($id);
            $permission->delete();
        });

        return redirect()->route($this->routePath . '.index')->with('success', 'Quyền hạn đã được xóa thành công.');
    }
}

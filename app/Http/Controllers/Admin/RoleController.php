<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    public function index()
    {
        $roles = Role::paginate(10);
        return view('admin.user.role.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.user.role.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'role_name' => 'required|string|max:255|unique:roles',
            'description' => 'nullable|string',
        ]);

        Role::create($request->all());

        return redirect()->route('admin.role.index')->with('success', 'Role đã được tạo thành công.');
    }

    public function edit(Role $role)
    {
        return view('admin.user.role.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'role_name' => 'required|string|max:255|unique:roles,role_name,' . $role->id,
            'description' => 'nullable|string',
        ]);

        $role->update($request->all());

        return redirect()->route('admin.role.index')->with('success', 'Role đã được cập nhật thành công.');
    }


    public function destroy(Role $role)
    {

        $role->forceDelete();

        return redirect()->route('admin.role.index')->with('success', 'Bàn đã được xóa hoàn toàn!');
    }
}

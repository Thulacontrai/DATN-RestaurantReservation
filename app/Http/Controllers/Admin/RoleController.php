<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Traits\TraitCRUD;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    use TraitCRUD;


    public function __construct()
    {
        // Gán middleware cho các phương thức
        $this->middleware('permission:Xem vai trò', ['only' => ['index']]);
        $this->middleware('permission:Tạo mới vai trò', ['only' => ['create']]);
        $this->middleware('permission:sửa vai trò', ['only' => ['edit']]);
        $this->middleware('permission:Xóa vai trò', ['only' => ['destroy']]);
       
    }

    protected $model = Role::class;
    protected $viewPath = 'admin.role';
    protected $routePath = 'admin.role';


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
        // Check if the role has any users associated with it
        if ($role->users()->count() > 0) {
            return redirect()->route('admin.role.index')->with('error', 'Role không thể xóa vì vẫn có người dùng được phân quyền này.');
        }

        $role->delete(); // Soft delete the role

        return redirect()->route('admin.role.index')->with('success', 'Role đã được chuyển vào thùng rác.');
    }

    public function trash()
{
    $roles = Role::onlyTrashed()->paginate(10); // Retrieve only soft-deleted roles
    return view('admin.user.role.trash', compact('roles'));
}


public function restore($id)
{
    $role = Role::withTrashed()->findOrFail($id);
    $role->restore();

    return redirect()->route('admin.role.trash')->with('success', 'Role đã được khôi phục thành công.');
}


public function forceDelete($id)
{
    $role = Role::withTrashed()->findOrFail($id);


    if ($role->users()->count() > 0) {
        return redirect()->route('admin.role.trash')->with('error', 'Không thể xóa vai trò này vì có người dùng đang sử dụng vai trò');
    }

    $role->forceDelete();

    return redirect()->route('admin.role.trash')->with('success', 'Role đã bị xóa vĩnh viễn.');
}

}

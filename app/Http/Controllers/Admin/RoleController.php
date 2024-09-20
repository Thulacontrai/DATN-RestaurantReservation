<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class RoleController extends Controller
{

    public function __construct()
    {
        // Gán middleware cho các phương thức
        $this->middleware('permission:Xem người dùng', ['only' => ['index']]);
        $this->middleware('permission:Tạo mới người dùng', ['only' => ['create']]);
        $this->middleware('permission:sửa người dùng', ['only' => ['edit']]);
        $this->middleware('permission:Xóa người dùng', ['only' => ['destroy']]);
       
    }

    public function index()
    {
        $roles = Role::orderBy('name', 'ASC')->paginate(10);
        return view('admin.user.role.index', [
            'roles' => $roles
        ]);
    }
    public function create()
    {
        $permissions = Permission::orderBy('name', 'DESC')->get();
        return view('admin.user.role.create', [
            'permissions' => $permissions
        ]);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles|min:3'
        ]);
        if ($validator->passes()) {
            // dd($request->permission);
            $role = Role::create(['name' => $request->name]);

            if (!empty($request->permission)) {
                foreach ($request->permission as $name) {
                    $role->givePermissionTo($name);
                }
            }

            return redirect()->route('admin.role.index')->with('success', 'Thêm vai trò thành công');
        } else {
            return redirect()->route('admin.role.create')->withInput()->withErrors($validator);
        }
    }



    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $hasPermissions = $role->permissions->pluck('name');
        $permissions = Permission::orderBy('name', 'DESC')->get();
        // dd($hasPermissions);
        return view('admin.user.role.edit', [
            'permissions' => $permissions,
            'hasPermissions' => $hasPermissions,
            'role' => $role
        ]);
    }

    public function update($id, Request $request)
    {
        $role = Role::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name,' . $id . ',id'
        ]);
        if ($validator->passes()) {
            // dd($request->name);
            // $role = Role::create(['name' => $request->name]);

            $role->name = $request->name;
            $role->save();

            if (!empty($request->permission)) {
                $role->syncPermissions($request->permission);
            }else{
                $role->syncPermissions([]);
            }

            return redirect()->route('admin.role.index')->with('success', 'Sửa vai trò thành công');
        } else {
            return redirect()->route('admin.role.edit', $id)->withInput()->withErrors($validator);
        }
    }
    public function destroy(Role $role) {
        if ($role == null) {
            return response()->json(['status' => false, 'message' => 'Không có vai trò.']);
        }
    
        $role->delete();
        session()->flash('success', 'Xóa thành công.');
    
        return response()->json(['status' => true, 'message' => 'Xóa thành công.']);
    }
    

}

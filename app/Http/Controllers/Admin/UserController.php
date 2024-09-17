<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Traits\TraitCRUD;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    use TraitCRUD;

    protected $model = User::class;
    protected $viewPath = 'admin.user';
    protected $routePath = 'admin.user';

    public function index()
    {
        $users = User::with('role')->get();
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|max:15|unique:users',
            'address' => 'nullable|string|max:255',
            'gender' => 'required|in:male,female,other',
            'date_of_birth' => 'required|date',
            'hire_date' => 'nullable|date',
            'position' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive',
            'role_id' => 'required|integer|exists:roles,id',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $avatarPath = $request->hasFile('avatar') ? $request->file('avatar')->store('avatars', 'public') : null;

        $defaultPassword = Hash::make('defaultpassword');
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'hire_date' => $request->hire_date,
            'position' => $request->position,
            'role_id' => $request->role_id,
            'avatar' => $avatarPath,
            'status' => $request->status,
            'password' => $defaultPassword,
        ]);

        return redirect()->route('admin.user.index')->with('success', 'Người dùng đã được tạo thành công.');
    }



    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.detail', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('admin.user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required',
            'address' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'date_of_birth' => 'nullable|date',
            'gender' => 'required|in:male,female,other',
            'avatar' => 'nullable|image|max:2048',
            'hire_date' => 'nullable|date',
            'position' => 'nullable|string|max:255',
            'role_id' => 'required|integer|exists:roles,id',
            // 'password' => 'required|string|min:8|confirmed',
        ]);

        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $validated['avatar'] = $avatarPath;
        }

        // if ($request->filled('password')) {
        //     $validated['password'] = Hash::make($request->password);
        // }

        $user->update($validated);

        return redirect()->route('admin.user.index')->with('success', 'Người dùng đã cập nhật thành công');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Sử dụng customer_id thay vì user_id
        if ($user->reservations()->count() > 0) {
            return redirect()->route('admin.user.index')->with('error', 'Không thể xóa tài khoản khách hàng vì còn đặt bàn đang hoạt động.');
        }

        // Kiểm tra ràng buộc cha con
        if ($user->children()->count() > 0 || $user->parent()->exists()) {
            return redirect()->route('admin.user.index')->with('error', 'Không thể xóa tài khoản vì có mối quan hệ cha con.');
        }

        $user->delete(); // Xóa mềm

        return redirect()->route('admin.user.index')->with('success', 'Người dùng đã được chuyển vào thùng rác');
    }



    public function trash()
    {
        $users = User::onlyTrashed()->with('role')->get();
        return view('admin.user.trash', compact('users'));
    }



    public function restore($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();

        return redirect()->route('admin.user.trash')->with('success', 'Người dùng đã được khôi phục thành công');
    }
}

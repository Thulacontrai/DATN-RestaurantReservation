<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Traits\TraitCRUD;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;


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

        $roles = Role::orderBy('name', 'ASC')->get();
        return view('admin.user.create',[
            'roles' => $roles
        ]);

    }

    public function store(Request $request)
    {

         
        $validator = Validator::make($request->all(),[
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email', // Bỏ qua email hiện tại
            'phone' => 'nullable|digits_between:10,15', // Thêm validation cho phone nếu cần
            'status' => 'required|in:active,inactive',
            'password' => 'required|min:5|same:confirm_password',
            'confirm_password' => 'required',

        ]);
    
        if ($validator->fails()) {
            return redirect()->route('admin.user.create')->withInput()->withErrors($validator);
        }
    
        // Chỉ cập nhật thông tin nếu có thay đổi\
        $user = new User();
        $user->name = $request->name;
        if ($request->email != $user->email) {
            $user->email = $request->email; // Chỉ cập nhật email nếu có thay đổi
        }
        $user->phone = $request->phone; // Cập nhật phone
        $user->status = $request->status; // Cập nhật trạng thái
        $user->password = Hash::make($request->password); 
        $user->status = $request->status; 
        $user->save();
    
        $user->syncRoles($request->role); // Cập nhật vai trò
    
        return redirect()->route('admin.user.index')->with('success', 'Thêm Người dùng Thành công');

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

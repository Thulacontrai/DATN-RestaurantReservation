<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{

    public function __construct()
    {
        // Gán middleware cho các phương thức
        $this->middleware('permission:Xem người dùng', ['only' => ['index']]);
        $this->middleware('permission:Tạo mới người dùng', ['only' => ['create']]);
        $this->middleware('permission:Sửa người dùng', ['only' => ['edit']]);
        $this->middleware('permission:Xóa người dùng', ['only' => ['destroy']]);
        
    }

     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::latest()->paginate(10);
        return view('admin.user.index', [
            'users' => $user
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {


        $roles = Role::orderBy('name', 'ASC')->get();
        return view('admin.user.create',[
            'roles' => $roles
        ]);


    }

    /**
     * Store a newly created resource in storage.
     */
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
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $roles = Role::orderBy('name', 'ASC')->get();

        $hasRoles = $user->roles ? $user->roles->pluck('id') : collect();

        // dd($hasRoles);
        return view('admin.user.edit', [
            'user' => $user,
            'roles' => $roles,
            'hasRoles' => $hasRoles
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
    
        $validator = Validator::make($request->all(),[
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,' . $id, // Bỏ qua email hiện tại
            'phone' => 'nullable|digits_between:10,15', // Thêm validation cho phone nếu cần
            'status' => 'required|in:active,inactive',
        ]);
    
        if ($validator->fails()) {
            return redirect()->route('admin.user.edit', $id)->withInput()->withErrors($validator);
        }
    
        // Chỉ cập nhật thông tin nếu có thay đổi
        $user->name = $request->name;
        if ($request->email != $user->email) {
            $user->email = $request->email; // Chỉ cập nhật email nếu có thay đổi
        }
        $user->phone = $request->phone; // Cập nhật phone
        $user->status = $request->status; // Cập nhật trạng thái
        $user->save();
    
        $user->syncRoles($request->role); // Cập nhật vai trò
    
        return redirect()->route('admin.user.index')->with('success', 'Chỉnh sửa Người dùng Thành công');
    }
    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

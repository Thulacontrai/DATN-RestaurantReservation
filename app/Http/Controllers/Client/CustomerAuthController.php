<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class CustomerAuthController extends Controller
{   
    public function showRegisterForm()
    {
        return view('client.RegisterLoginOTP');
    }

    public function register(Request $request)
{
    // Xác thực thông tin người dùng
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        // 'phone' => 'required|unique:users',
       // Thêm kiểm tra phone không trùng lặp
        'password' => 'required|string|min:8|confirmed',
    ]);

    // Tạo người dùng mới và mã hóa mật khẩu
    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'password' => bcrypt($request->password), // Mã hóa mật khẩu
    ]);

    // Chuyển hướng đến trang đăng nhập
    return redirect()->route('login.form')->with('success', 'Đăng ký thành công! Bạn có thể đăng nhập.');
}

    
    
    public function showLoginForm()
    {
        return view('client.loginOTP');
    }

    public function login(Request $request)
    {
        // Xác thực thông tin đầu vào
        $request->validate([
            'phone' => 'required|string',
            'password' => 'required|string',
        ]);
    
        // Thông tin đăng nhập: sử dụng 'phone' và 'password'
        $credentials = ['phone' => $request->phone, 'password' => $request->password];
    
        // Kiểm tra thông tin xác thực
        if (Auth::attempt($credentials)) {
            // Đăng nhập thành công
            return redirect()->route('client.index')->with('success', 'Đăng nhập thành công!');
        }
    
        // Thông tin không đúng, trả về thông báo lỗi
        return back()->withErrors(['phone' => 'Thông tin xác thực không đúng. Vui lòng thử lại.']);
    }
    
    
    
    
    public function verifyCode(Request $request)
    {
        $request->validate([
            'verificationCode' => 'required|string',
        ]);
    
        try {
            $confirmationResult = session('confirmationResult');
    
            if (!$confirmationResult) {
                return back()->withErrors(['verificationCode' => 'Mã OTP đã hết hạn hoặc không hợp lệ.']);
            }
    
            $confirmationResult->confirm($request->verificationCode);
    
            // Sau khi xác thực OTP thành công, chuyển hướng về trang chủ
            return redirect()->route('client.index')->with('success', 'Xác thực thành công!');
            
        } catch (InvalidToken $e) {
            return back()->withErrors(['verificationCode' => 'Mã OTP không hợp lệ!']);
        } catch (\Exception $e) {
            return back()->withErrors(['verificationCode' => 'Có lỗi xảy ra! Vui lòng thử lại.']);
        }
    }

    public function checkAccount(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        // Kiểm tra xem có tài khoản với email và password không
        $user = User::where('email', $request->email)->first();
    
        if ($user && Hash::check($request->password, $user->password)) {
            // Trả về thành công, cho phép gửi OTP
            return response()->json(['success' => true]);
        } else {
            // Sai thông tin tài khoản hoặc mật khẩu
            return response()->json(['success' => false, 'message' => 'Email hoặc mật khẩu không chính xác.']);
        }
    }
    
    

    
    
    
    

    public function logout()
    {
        Auth::logout();
        return redirect()->route('client.index')->with('success', 'Bạn đã đăng xuất.');
    }
    
}

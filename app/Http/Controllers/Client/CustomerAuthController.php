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
        // Đăng nhập thành công - chuyển sang trang OTP
        session(['phone' => $request->phone]); // Lưu số điện thoại vào session để xác thực OTP
        return redirect()->route('otp.verify.form')->with('success', 'Đăng nhập thành công! Vui lòng xác thực OTP.');
    }

    // Thông tin không đúng, trả về thông báo lỗi
    return back()->withErrors(['phone' => 'Thông tin xác thực không đúng. Vui lòng thử lại.']);
}

    
    
    
    
public function verifyCode(Request $request)
{
    $request->validate([
        'verificationCode' => 'required|string',
        'email' => 'required|email',
    ]);

    try {
        $user = User::where('email', $request->email)->first();
        
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Không tìm thấy tài khoản với email này.']);
        }
        
        Auth::login($user);
        
        // Lưu session
        $request->session()->regenerate();

        return response()->json(['success' => true, 'message' => 'Xác thực OTP thành công và đăng nhập.']);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'Có lỗi xảy ra khi xác thực OTP. Vui lòng thử lại.']);
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
    
    


    public function loginSuccess(Request $request)
    {
        // Xác thực OTP thành công
        $user = User::where('email', $request->email)->first(); // hoặc phương thức khác để lấy người dùng
    
        if ($user) {
            Auth::login($user); // Đăng nhập người dùng
            return redirect()->route('client.index'); // Chuyển hướng đến trang chính
        }
    
        return back()->withErrors(['message' => 'Đăng nhập không thành công']);
    }
    
    
    
    
    
    

    public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('client.index');
}
    
}

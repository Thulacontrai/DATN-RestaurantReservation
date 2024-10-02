<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function show()
    {
        // Dữ liệu mẫu, có thể lấy từ database
        $accountData = [
            'name' => 'Nguyễn Văn A',
            'email' => 'nguyenvana@example.com',
            'phone' => '0123456789',
        ];

        return view('account', compact('accountData'));
    }
    public function update(Request $request)
    {
        // Xử lý cập nhật thông tin tài khoản ở đây
        // Ví dụ: Cập nhật tên, số điện thoại, email...

        return back()->with('success', 'Thông tin tài khoản đã được cập nhật');
    }

    public function changePassword(Request $request)
    {
        // Xử lý thay đổi mật khẩu ở đây

        return back()->with('success', 'Mật khẩu đã được thay đổi');
    }
}

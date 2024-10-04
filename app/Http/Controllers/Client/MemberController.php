<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function show()
{
    // Giả lập dữ liệu thành viên, bạn có thể lấy từ database
    $memberData = [
        'name' => 'Chang Anh',
        'email' => 'chang@example.com',
        'phone' => '0123456789',
        'avatar' => 'https://i.pinimg.com/736x/63/2d/04/632d048703fae719fb1e8e3ea43939d5.jpg', // URL hình đại diện
        'total_spend' => '3.137.000đ',
        'reward_points' => 34800,
        'expiring_points' => 11500,
        'expiry_date' => '02/10/2024',
        'membership_level' => 'VIP Pro',
        'next_level_target' => 3000000,
        'current_progress' => 3137000,
    ];

    return view('client.member', compact('memberData'));
}
public function update(Request $request)
    {

        return back()->with('success', 'Thông tin tài khoản đã được cập nhật');
    }

    public function changePassword(Request $request)
    {

        return back()->with('success', 'Mật khẩu đã được thay đổi');
    }

}

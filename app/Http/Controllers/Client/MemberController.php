<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        // 'expiry_date' => '02/10/2024',
        'membership_level' => 'VIP Pro',
        'next_level_target' => 3000000,
        'current_progress' => 3137000,
        'location' => 'Việt Nam',
        'member_since' => 'Tháng 9 năm 2024',
        'reservations' => [
            [
                'restaurant' => 'InterContinental Hanoi Landmark72',
                'status' => 'Đã xác nhận đặt chỗ',
                'date' => date('Y-m-d', strtotime(now())), // Định dạng ngày
                'time' => date('H:i', strtotime(now())), // Định dạng giờ
                'people' => 2,
                'table_name' => 'N5',
            ],
            [
                'restaurant' => 'Nhà hàng B',
                'status' => 'Chưa xác nhận',
                'date' => '2024-10-18',
                'time' => '19:00',
                'people' => 4
            ],
            [
                'restaurant' => 'Nhà hàng B',
                'status' => 'Chưa xác nhận',
                'date' => '2024-10-18',
                'time' => '10:00',
                'people' => 4
            ],
            [
                'restaurant' => 'Nhà hàng B',
                'status' => 'Chưa xác nhận',
                'date' => '2024-10-18',
                'time' => '19:00',
                'people' => 4
            ],
            [
                'restaurant' => 'Nhà hàng B',
                'status' => 'Chưa xác nhận',
                'date' => '2024-10-18',
                'time' => '19:00',
                'people' => 4
            ],
            [
                'restaurant' => 'Nhà hàng C',
                'status' => 'Đã hủy',
                'date' => '2024-10-20',
                'time' => '20:00',
                'people' => 3
            ],
        ]
    ];
    // // $reservations = Reservation::where('user_id', 1)->get();

    // // Truyền dữ liệu đặt chỗ đến view
    // // return view('member.profile', ['reservations' => $reservations]);


    return view('client.member', compact('memberData'));

    // $memberData = User::findOrFail($id); // Lấy dữ liệu thành viên theo ID
    // return view('client.member', compact('memberData')); // Trả về view kèm dữ liệu
}
public function update(Request $request)
{
    // Lấy người dùng hiện tại
    $user = Auth::user();

    // Xác thực các trường dữ liệu
    $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:15',
        'email' => 'required|email|max:255',
        'location' => 'nullable|string|max:255',
    ]);

    // Cập nhật thông tin người dùng
    $user->name = $request->name;
    $user->phone = $request->phone;
    $user->email = $request->email;
    $user->location = $request->location;
    // $user->save();

    return response()->json(['success' => true]);
}
}

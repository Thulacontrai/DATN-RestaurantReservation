<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function show()
    {
        // Giả lập dữ liệu thành viên, bạn có thể lấy từ database
        $member = auth()->user(); // Lấy thông tin người dùng đã đăng nhập
        
        // Nếu không có người dùng đã đăng nhập, chuyển hướng về trang đăng nhập hoặc xử lý lỗi
        if (!$member) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để xem trang này.');
        }
    
        // Lấy tất cả thông tin đơn đặt bàn của khách hàng
        $bookingData = Reservation::where('customer_id', $member->id)
            ->orderBy('reservation_date', 'desc') // Sắp xếp theo ngày đặt
            ->get(); // Lấy tất cả đơn đặt bàn
    
        return view('client.member', compact('member', 'bookingData')); // Truyền biến $member và $bookingData vào view
    }
    
    // Giả sử bạn có một phương thức trong MemberController


    
public function update(Request $request)
    {

        return back()->with('success', 'Thông tin tài khoản đã được cập nhật');
    }

    public function changePassword(Request $request)
    {

        return back()->with('success', 'Mật khẩu đã được thay đổi');
    }


    public function updateBooking(Request $request)
    {
        $validated = $request->validate([
            'user_name' => 'required|string|max:255',
            'user_phone' => 'required|string|max:15',
            'guest_count' => 'required|integer|min:1',
            'reservation_date' => 'required|date',
            'reservation_time' => 'required',
            'deposit_amount' => 'nullable|numeric',
            'note' => 'nullable|string',
        ]);
    
        $user = auth()->user(); // Lấy thông tin người dùng đã đăng nhập
    
        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        if (!$user) {
            // Nếu chưa đăng nhập, có thể bạn muốn tạo một tài khoản mới
            $user = User::create([
                'name' => $validated['user_name'],
                'phone' => $validated['user_phone'],
                'email' => null, // Nếu không có email, có thể để null hoặc dùng thông tin khác
                'status' => 'inactive', // Đặt trạng thái là inactive
                // Thêm các trường khác nếu cần thiết
            ]);
        }
    
        // Kiểm tra xem đơn đặt bàn đã tồn tại chưa, nếu có thì cập nhật
        $reservation = Reservation::where('customer_id', $user->id)
            ->where('reservation_date', $validated['reservation_date'])
            ->first();
    
        if ($reservation) {
            // Cập nhật thông tin đơn đặt bàn
            $reservation->update($validated);
        } else {
            // Nếu không tồn tại, tạo đơn mới
            $reservation = Reservation::create([
                'customer_id' => $user->id, // Gán ID của người dùng đã đăng nhập
                'user_name' => $validated['user_name'],
                'user_phone' => $validated['user_phone'],
                'guest_count' => $validated['guest_count'],
                'reservation_date' => $validated['reservation_date'],
                'reservation_time' => $validated['reservation_time'],
                'deposit_amount' => $validated['deposit_amount'] ?? 0,
                'note' => $validated['note'],
                'status' => 'active', // Hoặc trạng thái nào đó phù hợp
            ]);
        }
    
        return redirect()->route('member.profile')->with('success', 'Đơn đặt bàn đã được cập nhật thành công!');
    }
    
    
    
    
    

    public function showProfile()
    {
        $member = auth()->user(); // Lấy thông tin người dùng đã đăng nhập
    
        // Lấy tất cả thông tin đơn đặt bàn của khách hàng
        $bookingData = Reservation::where('customer_id', $member->id)
            ->orderBy('reservation_date', 'desc') // Sắp xếp theo ngày đặt
            ->get(); // Lấy tất cả đơn đặt bàn
    
        return view('client.member', compact('member', 'bookingData')); // Truyền biến $member và $bookingData vào view
    }
    
    
    


}

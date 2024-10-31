<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class MemberController extends Controller
{
    public function show()
{
    // Giả lập dữ liệu thành viên, bạn có thể lấy từ database
    try {
        $member = auth()->user(); // Lấy thông tin người dùng đã đăng nhập
    // Nếu không có người dùng đã đăng nhập, chuyển hướng về trang đăng nhập hoặc xử lý lỗi
    if (!$member) {
        return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để xem trang này.');
    }
        // Gọi API sử dụng file_get_contents
        $url = 'https://api.vietqr.io/v2/banks';
        $response = file_get_contents($url);

        if ($response === false) {
            return ['error' => 'Failed to fetch data'];
        }
        
        // Chuyển đổi JSON thành mảng
        $banks = json_decode($response, true);

        // Kiểm tra nếu có lỗi trong việc giải mã JSON
        if (json_last_error() !== JSON_ERROR_NONE) {
            return ['error' => 'Invalid JSON response'];
        }

        $bankList = $banks['data'];
        $bookingData = Reservation::where('customer_id', $member->id)
                ->orderBy('reservation_date', 'desc') // Sắp xếp theo ngày đặt
                ->paginate(3); // Lấy tất cả đơn đặt bàn
    } catch (\Exception $e) {
        return ['error' => $e->getMessage()]; // Xử lý lỗi
    }

    // dd($banks);
    
    
    // Lấy tất cả thông tin đơn đặt bàn của khách hàng
    

    return view('client.member', compact('member', 'bookingData','bankList'));
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

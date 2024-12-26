<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Models\Reservation;
use App\Models\User;
use Carbon\Carbon;
use Dflydev\DotAccessData\Data;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
                ->with('refund') // Eager load bản ghi hoàn tiền
                ->orderBy('created_at', 'desc') // Sắp xếp theo ngày đặt
                ->paginate(3);
            // dd($bookingData);
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()]; // Xử lý lỗi
        }

        // dd($banks);


        // Lấy tất cả thông tin đơn đặt bàn của khách hàng


        return view('client.member', compact('member', 'bookingData', 'bankList'));
    }

    public function update(Request $request)
    {
        // Validate dữ liệu
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|regex:/^[0-9]{10,11}$/',
        ]);

        // Cập nhật thông tin người dùng
        $member = Auth::user(); // Hoặc đối tượng member theo logic
        $member->update($validated);

        // Trả về JSON chứa thông tin đã cập nhật
        return response()->json([
            'name' => $member->name,
            'phone' => $member->phone,
        ]);
    }

    // Hiển thị danh sách đặt bàn
    public function reservations()
    {
        $reservations = Reservation::where('user_id', auth()->id())->get(); // Chỉ lấy dữ liệu của user đang đăng nhập
        return view('member', compact('reservations')); // Giao diện member.blade.php
    }

    // Cập nhật đặt bàn
    public function updateReservation(Request $request)
    {
        // dd($request->all());
        // $data=$request->all();
        //  return response()->json([
        //     'success' => true,
        //              'message' => 'OKKKKKK!',

        //              'data' => $data,
        //  ]);
        // $id = $request->reservationId;
        // DB::beginTransaction();


        $max_people_per_timeslot = 5; 
        // Xử lý và validate dữ liệu
        $validated = $request->all();
        // Cập nhật dữ liệu trong cơ sở dữ liệu
        $id = $request->reservationId;
        $guest_count=$request->guest_count;
        // Tìm đơn đặt bàn theo ID
        $reservation = Reservation::findOrFail($id);
         // Lấy thời gian hiện tại và thời gian check-in
    $currentTime = Carbon::now();
    $checkInTime = Carbon::parse($reservation->reservation_time);

   // Kiểm tra nếu thời gian nhận bàn nằm trong quá khứ
   if ($checkInTime->lessThanOrEqualTo($currentTime)) {
    return response()->json([
        'success' => false,
        'message' => 'Không thể cập nhật đơn đặt bàn với thời gian nhận bàn trong quá khứ.'
    ]);
}

// Tính khoảng cách thời gian
$timeDifference = $checkInTime->diffInMinutes($currentTime);

// Kiểm tra nếu còn dưới 2 tiếng (120 phút)
if ($timeDifference < 120) {
    return response()->json([
        'success' => false,
        'message' => 'Không thể cập nhật đơn đặt bàn, còn dưới 2 tiếng trước giờ nhận bàn.'
    ]);
}
        if (!$reservation) {
            return response()->json([
                'success' => false,
                'message' => 'Reservation not found.',
            ]);
        }

   // Lấy thông tin thời gian check-in và số lượng người từ request
   $newCheckInTime = Carbon::parse($request->reservation_time);
   $newNumberOfPeople = $request->guest_count;

   // Xác định khung giờ (giả sử khung giờ là 2 tiếng mỗi slot)
   $slotStartTime = $newCheckInTime->copy()->startOfHour();
   $slotEndTime = $slotStartTime->copy()->addHours(2);

   // Tính tổng số lượng người đã đặt trong khung giờ này
   $totalPeopleInSlot = Reservation::whereBetween('reservation_time', [$slotStartTime, $slotEndTime])
       ->sum('guest_count');

   // Trừ số người của đơn hiện tại (nếu đang ở trong khung giờ cũ)
   if ($reservation->reservation_time >= $slotStartTime && $reservation->reservation_time < $slotEndTime) {
       $totalPeopleInSlot -= $reservation->guest_count;
   }

   // Kiểm tra khả năng nhận thêm đơn
   if ($totalPeopleInSlot + $newNumberOfPeople > 150) {
       return response()->json([
            'success'=>false,
           'message' => 'Khung giờ này đã đầy, không thể nhận thêm đơn. Số lượng người tối đa: 150.'
       ]);
   }
        // Cập nhật dữ liệu với validate
        $reservation->update($validated);

        // Tính tiền cọc
        if ($reservation->guest_count >= 6) {
            $reservation->deposit_amount = $reservation->guest_count * 100000;
        } else {
            $reservation->deposit_amount = 0; // Đặt về 0 nếu không đạt điều kiện
        }

        // Lưu thay đổi vào cơ sở dữ liệu
        $reservation->save();

        // Trả về dữ liệu đã cập nhật
        return response()->json([
            'success' => true,
            'reservation' => $reservation,
            'message' => 'Cập nhật thành công!',
        ]);
    }




    public function editReservation($id)
    {
        $reservation = Reservation::where('id', $id)
            ->where('member_id', auth()->id())
            ->firstOrFail();

        return view('member', compact('reservation'));
    }

    public function rateReservation(Request $request, $id)
    {
        // dd($request->all());
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|max:1000',
        ]);

        Feedback::create([
            'reservation_id' => $id,
            'customer_id' => $request->customer_id,
            'content' => $validated['review'],
            'rating' => $validated['rating']
        ]);


        return response()->json([
            'message' => 'Đánh giá thành công!',
            'rating' => $validated['rating'],
            'content' => $validated['review'],
        ]);
    }


    // public function showReservation($id)
    // {
    //     $reservation = Reservation::where('id', $id)
    //         ->where('member_id', auth()->id()) // Đảm bảo quyền sở hữu
    //         ->firstOrFail();

    //     return view('member.reservation.show', compact('reservation'));
    // }
}
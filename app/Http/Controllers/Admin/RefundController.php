<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\InvoiceRefund;
use App\Models\Refund;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class RefundController extends Controller
{
    public function __construct()
    {
        // Gán middleware cho các phương thức
        $this->middleware('permission:Xem hoàn tiền', ['only' => ['index']]);
        $this->middleware('permission:Tạo mới hoàn tiền', ['only' => ['create']]);
        $this->middleware('permission:Sửa hoàn tiền', ['only' => ['edit']]);
        $this->middleware('permission:Xóa hoàn tiền', ['only' => ['destroy']]);

    }

    public function index()
    {
        $title = 'Hoàn Tiền';
        $refunds = Refund::with('reservation')
            ->whereIn('refunds.status', ['Request_Refund', 'Refund'])
            ->orWhereHas('reservation', function ($query) {
                $query->whereNotNull('deposit_amount')
                    ->where('reservations.status', 'Cancelled')
                    ->whereNull('reservations.deleted_at');
            })
            ->leftJoin('users', 'users.id', '=', 'refunds.confirmed_by')
            ->select('refunds.*', 'users.name as confirmed_by_name')
            ->paginate(10);


        return view('admin.refunds.index', compact('refunds', 'title'));
    }

    public function showRefundForm($reservationId)
    {
        $reservation = Reservation::findOrFail($reservationId);
        return view('refunds.create', compact('reservation'));
    }

    public function processRefund(Request $request, $reservationId)
    {
        $request->validate([
            'account_name' => 'required|string',
            'account_number' => 'required|integer',
            'refund_amount' => 'required|numeric|min:0',
            'bank_name' => 'required|string',
            'reason' => 'nullable|string',
        ]);

        $refund = Refund::create([
            'reservation_id' => $reservationId,
            'account_name' => $request->account_name,
            'account_number' => $request->account_number,
            'refund_amount' => $request->refund_amount,
            'bank_name' => $request->bank_name,
            'email' => $request->email,
            'reason' => $request->reason,
            'status' => 'Pending',
        ]);

        // Cập nhật trạng thái bàn
        $reservation = Reservation::find($reservationId);
        $reservation->status = "Refund";
        $reservation->save();

        return response()->json([
            'message' => 'Hoàn tiền đã được tạo và cập nhật trạng thái bàn.',
            'refund' => $refund,
        ]);
    }

    public function create($reservation_id)
    {
        $reservation = Reservation::find($reservation_id);

        if (!$reservation) {
            return redirect()->back()->withErrors('Không tìm thấy thông tin đặt chỗ.');
        }

        return view('admin.refunds.create', compact('reservation'));
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'account_name' => 'required|string',
            'account_number' => 'required|integer',
            'refund_amount' => 'required|numeric|min:0',
            'bank_name' => 'required|string',
            'email' => 'required|email',
            'reason' => 'nullable|string',

        ]);
        // dd($request->refund_amount);

        // Tạo bản ghi hoàn tiền
        $refund = Refund::create([
            'reservation_id' => $request->reservation_id,
            'account_name' => $request->account_name,
            'account_number' => $request->account_number,
            'refund_amount' => $request->refund_amount,
            'bank_name' => $request->bank_name,
            'email' => $request->email,
            'reason' => $request->reason,
            'confirmed_by' => $request->confirmed_by,
            // 'confirmed_at ' => $request->confirmed_at,
            'status' => 'Refund',

        ]);

        // Cập nhật trạng thái đặt chỗ thành "Đã hoàn cọc"
        $reservation = Reservation::find($request->reservation_id);
        $reservation->status = "Refund";
        $reservation->save();

        Mail::to($refund->email)->send(new InvoiceRefund($refund));
        // Chuyển hướng về trang danh sách đặt chỗ sau khi hoàn tiền thành công
        return redirect()->route('admin.reservation.index')->with('success', 'Hoàn tiền thành công.');
    }

    // XU LY THONG TIN KHI NGUOI DUNG YEU CAU HOAN TIEN
    public function storeCancellation(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'account_name' => 'required|string|max:255',
            'account_number' => 'required|numeric',
            'bankSelect' => 'required|string',
            'user_phone' => 'required|string',
            'email' => 'required|email',
            'reason' => 'nullable|string|max:500',
        ]);

        $refund = new Refund();
        $refund->reservation_id = $request->reservation_id;;
        $refund->account_name = $request->account_name;
        $refund->account_number = $request->account_number;
        $refund->refund_amount = $request->refund_amount;
        $refund->bank_name = $request->bankSelect;
        $refund->email = $request->email;
        $refund->reason = $request->reason;
        $refund->status = 'Request_Refund';
        $refund->save();

        $reservation = Reservation::find($request->reservation_id);
        if ($reservation) {
            $reservation->status = 'Cancelled';
            $reservation->save();
        }
        return redirect()->back()->with('status', 'Yêu cầu hủy đã được gửi thành công!');
    }

    // XÃ NHAN HOAN TIEN Ở TRANG REFUND
    public function updateStatus($id)
    {

        $refund = Refund::findOrFail($id);


        if ($refund->status == 'Request_Refund') {

            $refund->status = 'Refund';
            $refund->confirmed_by = auth()->user()->id;
            $refund->confirmed_at = now();
            $refund->save();

            Mail::to($refund->email)->send(new InvoiceRefund($refund));

            return redirect()->route('admin.refunds.index')->with('success', 'Đã xác nhận hoàn tiền và thông báo qua email');
        }

        return redirect()->route('admin.refunds.index')->with('error', 'Trạng thái không hợp lệ');
    }
}

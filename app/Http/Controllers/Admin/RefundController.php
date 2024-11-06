<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\InvoiceRefund;
use App\Models\Refund;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RefundController extends Controller
{
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

        // Nếu không tìm thấy đặt chỗ, trả về lỗi hoặc chuyển hướng
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
}

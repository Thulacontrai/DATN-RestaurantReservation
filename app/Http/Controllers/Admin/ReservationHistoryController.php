<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReservationHistory;
use App\Traits\TraitCRUD;
use Illuminate\Http\Request;

class ReservationHistoryController extends Controller
{

    use TraitCRUD;

    protected $model = ReservationHistory::class;
    protected $viewPath = 'admin.reservationHistory';
    protected $routePath = 'admin.reservationHistory';

    public function index()
{
    $reservationHistories = ReservationHistory::all();
    return view('admin.reservation.reservationHistory.index', compact('reservationHistories'));
}



    public function create()
    {
        return view('admin.reservation.reservationHistory.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'reservation_id' => 'required|integer|exists:reservations,id',
            'change_time' => 'required|date',
            'status' => 'required|in:pending,confirmed,cancelled,completed',
            'note' => 'nullable|string',
        ]);

        ReservationHistory::create($validated);

        return redirect()->route('admin.reservation.reservationHistory.index')->with('success', 'Lịch sử đặt chỗ đã được thêm thành công.');
    }

    public function show($id)
    {
        $reservationsHistory = ReservationHistory::findOrFail($id);
        return view('admin.reservation.reservationHistory.show', compact('reservationsHistory')); // Sửa tên biến
    }


    public function edit($id)
    {
        $reservationsHistory = ReservationHistory::findOrFail($id);
        return view('admin.reservation.reservationHistory.edit', compact('reservationsHistory')); // Sửa tên biến
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'reservation_id' => 'required|integer|exists:reservations,id',
            'change_time' => 'required|date',
            'status' => 'required|in:pending,confirmed,cancelled,completed',
            'note' => 'nullable|string',
        ]);

        $reservationsHistory = ReservationHistory::findOrFail($id);
        $reservationsHistory->update($validated);

        return redirect()->route('admin.reservation.reservationHistory.index')->with('success', 'Lịch sử đặt chỗ đã được cập nhật thành công.');
    }

    public function destroy($id)
    {
        $reservationsHistory = ReservationHistory::findOrFail($id);
        $reservationsHistory->delete();

        return redirect()->route('admin.reservation.reservationHistory.index')->with('success', 'Lịch sử đặt chỗ đã được xóa thành công.');
    }
}

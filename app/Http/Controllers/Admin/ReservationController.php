<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Reservation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    protected $model = Reservation::class;
    protected $viewPath = 'admin.reservation';
    protected $routePath = 'admin.reservation';

    public function index(Request $request)
    {
        $this->updateOverdueReservations(); // Cập nhật các đơn quá hạn

        $query = Reservation::query();

        // Lọc theo tên khách hàng
        if ($request->filled('customer_name')) {
            $query->whereHas('customer', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->customer_name . '%');
            });
        }

        // Lọc theo trạng thái
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Lọc theo ngày
        if ($request->filled('date')) {
            $query->whereDate('reservation_time', $request->date);
        }

        // Lọc theo thông báo
        if ($request->filled('notification_type')) {
            $now = Carbon::now();
            switch ($request->notification_type) {
                case 'upcoming': // Sắp đến hạn 30 phút
                    $query->whereBetween('reservation_time', [$now->toTimeString(), $now->copy()->addMinutes(30)->toTimeString()])
                        ->where('status', 'Pending');
                    break;

                case 'waiting': // Chờ khách đến trong vòng 15 phút
                    $query->whereBetween('reservation_time', [$now->copy()->subMinutes(15)->toTimeString(), $now->toTimeString()])
                        ->where('status', 'Pending');
                    break;

                case 'overdue': // Quá hạn và bị hủy
                    $query->where('reservation_time', '<', $now->copy()->subMinutes(15)->toTimeString())
                        ->where('status', 'Cancelled');
                    break;
            }
        }

        // Lấy danh sách đặt bàn với phân trang
        $reservations = $query->paginate(10);

        // Truyền các biến tới view
        return view('admin.reservation.index', [
            'upcomingReservations' => $this->getUpcomingReservations(),
            'waitingReservations' => $this->getWaitingReservations(),
            'overdueReservations' => $this->getOverdueReservations(),
            'reservations' => $reservations,
        ]);
    }

    // Cập nhật trạng thái đặt bàn quá hạn
    private function updateOverdueReservations()
    {
        $now = Carbon::now();

        Reservation::where('reservation_date', '=', $now->toDateString())
            ->where('reservation_time', '<', $now->copy()->subMinutes(15)->toTimeString())
            ->where('status', 'Pending')
            ->update(['status' => 'Cancelled']);
    }

    // Lấy danh sách đặt bàn sắp đến hạn
    private function getUpcomingReservations()
    {
        $now = Carbon::now();

        return Reservation::where('reservation_date', '=', $now->toDateString())
            ->where('reservation_time', '>=', $now->toTimeString())
            ->where('reservation_time', '<=', $now->copy()->addMinutes(30)->toTimeString())
            ->where('status', 'Pending')
            ->get();
    }

    // Lấy danh sách đặt bàn đang chờ
    private function getWaitingReservations()
    {
        $now = Carbon::now();

        return Reservation::where('reservation_date', '=', $now->toDateString())
            ->where('reservation_time', '<', $now->toTimeString())
            ->where('reservation_time', '>=', $now->copy()->subMinutes(15)->toTimeString())
            ->where('status', 'Pending')
            ->get();
    }

    // Lấy danh sách đặt bàn đã quá hạn
    private function getOverdueReservations()
    {
        $now = Carbon::now();

        return Reservation::where('reservation_date', '=', $now->toDateString())
            ->where('reservation_time', '<', $now->copy()->subMinutes(15)->toTimeString())
            ->where('status', 'Cancelled')
            ->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:users,id',
            'coupon_id' => 'nullable|exists:coupons,id',
            'reservation_time' => 'required|date',
            'guest_count' => 'required|integer|min:1',
            'deposit_amount' => 'nullable|numeric|min:0',
            'note' => 'nullable|string',
            'status' => 'in:Pending',
            'cancelled_reason' => 'nullable|string|max:255'
        ]);

        Reservation::create($validated);

        return redirect()->route('admin.reservation.index')->with('success', 'Reservation đã được tạo thành công.');
    }

    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);
        $customers = User::all();
        $coupons = Coupon::all();

        return view('admin.reservation.edit', compact('reservation', 'customers', 'coupons'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validate([
                'customer_name' => 'required|string|max:255',
                'reservation_time' => 'required|date_format:Y-m-d\TH:i',
                'guest_count' => 'required|integer|min:1',
                'note' => 'nullable|string',
                'status' => 'required|in:Confirmed,Pending,Cancelled',
                'cancelled_reason' => 'nullable|string|max:255',
            ]);

            $validated['deposit_amount'] = $request->input('guest_count') >= 6
                ? $request->input('guest_count') * 100000
                : 0;

            $validated['reservation_time'] = Carbon::createFromFormat('Y-m-d\TH:i', $request->reservation_time)
                ->format('Y-m-d H:i:s');

            $reservation = Reservation::findOrFail($id);
            $reservation->update($validated);

            DB::commit();
            return redirect()->route('admin.reservation.index')->with('success', 'Reservation updated successfully');
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return back()->withErrors($e->errors());
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['error' => "An error occurred while updating the reservation: " . $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $reservation = Reservation::with('customer')->findOrFail($id);
        return view('admin.reservation.show', compact('reservation'));
    }

    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return redirect()->route('admin.reservation.index')->with('success', 'Reservation deleted successfully');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Reservation;
use App\Models\User;
use App\Traits\TraitCRUD;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Whoops\Exception\Formatter;

class ReservationController extends Controller
{

    use TraitCRUD;

    protected $model = Reservation::class;
    protected $viewPath = 'admin.reservation';
    protected $routePath = 'admin.coupon';

    public function index(Request $request)
    {
        $reservations = Reservation::with('customer')
            ->when($request->customer_name, function ($query) use ($request) {
                $query->whereHas('customer', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->customer_name . '%');
                });
            })
            ->paginate(10);

        return view('admin.reservation.index', compact('reservations'));
    }

    public function create()
    {
        $customers = User::all();
        $coupons = Coupon::all();
        return view('admin.reservation.create', compact('customers', 'coupons'));
    }



    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:users,id',
            'coupon_id' => 'nullable|exists:coupons,id',
            'reservation_time' => 'required|date',
            'guest_count' => 'required|integer|min:1',
            'deposit_amount' => 'nullable|numeric|min:0',
            'total_amount' => 'required|numeric|min:0',
            'remaining_amount' => 'nullable|numeric|min:0',
            'note' => 'nullable|string',
            'status' => 'required|in:Confirmed,Pending,Cancelled',
            'cancelled_reason' => 'nullable|string|max:255'
        ]);

        Reservation::create($validated);

        return redirect()->route('admin.reservation.index')
            ->with('success', 'Reservation đã được tạo thành công.');
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
        try {
            $validated = $request->validate([
                'customer_id' => 'required|exists:users,id',
                'coupon_id' => 'nullable|exists:coupons,id',
                'reservation_time' => 'required|date',
                'guest_count' => 'required|integer|min:1',
                'deposit_amount' => 'nullable|numeric|min:0',
                'total_amount' => 'required|numeric|min:0',
                'remaining_amount' => 'nullable|numeric|min:0',
                'note' => 'nullable|string',
                'status' => 'required|in:Confirmed,Pending,Cancelled',
                'cancelled_reason' => 'nullable|string|max:255'
            ]);

            $reservation = Reservation::findOrFail($id);
            $reservation->update($validated);

            return redirect()->route('admin.reservation.index')->with('success', 'Reservation updated successfully');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
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

    public function showTime()
    {
        $now = Carbon::now('Asia/Ho_Chi_Minh')->copy()->addHours(2);

        Carbon::setLocale('vi');
        $today = Carbon::today();
        $days = [];
        for ($i = 0; $i < 3; $i++) {
            $days[] = $today->copy()->addDays($i);
        }
        $timeSlots = [];
        $startHour = 11;
        $endHour = 21;
        for ($hour = $startHour; $hour < $endHour; $hour++) {
            $timeSlots[] = Carbon::createFromTime($hour, 0)->format('H:i:s');
            $timeSlots[] = Carbon::createFromTime($hour, 30)->format('H:i:s');

        }
        return view('client.booking', compact('days', 'timeSlots', 'now'));
    }
    public function showInformation(Request $request)
    {
        $date = $request->query('date');
        $time = $request->query('time');
        return view('client.customer-information', compact('date', 'time'));
    }
    public function createReservation(Request $request)
    {
        if ($request->guest_count >= 6) {
            $customerInformation = $request->all();
            return redirect()->route('deposit.client', compact('customerInformation'));
        } else {
            DB::transaction(function () use ($request) {
                $user = User::create([
                    'name' => $request->user_name,
                    'phone' => $request->user_phone,
                    'password' => fake()->password(),
                    'status' => 'inactive'
                ]);
                $userId = $user->id;
                Reservation::create([
                    'customer_id' => $userId,
                    'user_name' => $request->user_name,
                    'user_phone' => $request->user_phone,
                    'guest_count' => $request->guest_count,
                    'note' => $request->note,
                    'reservation_date' => $request->reservation_date,
                    'reservation_time' => $request->reservation_time,
                ]);
            });
            return redirect()->route('client.index');
        }
    }
    public function showDeposit(Request $request)
    {
        $showDeposit = $request->customerInformation;
        $deposit = number_format($showDeposit['guest_count'] * 100000);
        return view('client.deposit', compact('showDeposit', 'deposit'));
    }
}

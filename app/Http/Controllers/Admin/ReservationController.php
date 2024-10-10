<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReservationRquest;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Reservation;
use App\Models\Table;
use App\Models\ReservationTable;
use App\Models\User;
use App\Traits\TraitCRUD;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Whoops\Exception\Formatter;
use Illuminate\Support\Str;


class ReservationController extends Controller
{

    use TraitCRUD;

    public function __construct()

    {
        // Gán middleware cho các phương thức
        $this->middleware('permission:Xem đặt bàn', ['only' => ['index']]);
        $this->middleware('permission:Tạo mới đặt bàn', ['only' => ['create']]);
        $this->middleware('permission:Sửa đặt bàn', ['only' => ['edit']]);
        $this->middleware('permission:Xóa đặt bàn', ['only' => ['destroy']]);

    }
    protected $model = Reservation::class;
    protected $viewPath = 'admin.reservation';
    protected $routePath = 'admin.reservation';

    public function index(Request $request)
    {


        $this->updateOverdueReservations($request); // Cập nhật các đơn quá hạn

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


    public function updateOverdueReservations(Request $request)
 
        $reservations = Reservation::with('customer')
            ->when($request->customer_name, function ($query) use ($request) {
                $query->whereHas('customer', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->customer_name . '%');
                });
            })
            ->paginate(10);

        $now = Carbon::now();

        // Cập nhật các đơn quá hạn thành 'Cancelled'
        Reservation::where('reservation_date', '=', $now->toDateString())
            ->where('reservation_time', '<', $now->copy()->subMinutes(15)->toTimeString())

            ->where('status', 'Confirmed')

            ->update(['status' => 'Cancelled']);

        // Đơn sắp đến hạn trong vòng 30 phút tới
        $upcomingReservations = Reservation::where('reservation_date', '=', $now->toDateString())
            ->where('reservation_time', '>=', $now->toTimeString())
            ->where('reservation_time', '<=', $now->copy()->addMinutes(30)->toTimeString())

            ->where('status', 'Confirmed')

            ->get();

        // Đơn đang chờ khách trong 15 phút
        $waitingReservations = Reservation::where('reservation_date', '=', $now->toDateString())
            ->where('reservation_time', '<', $now->toTimeString())
            ->where('reservation_time', '>=', $now->copy()->subMinutes(15)->toTimeString())

            ->where('status', 'Confirmed')
            ->get();

        // Đơn đã quá hạn
        $overdueReservations = Reservation::where('reservation_date', '=', $now->toDateString())
            ->where('reservation_time', '<', $now->copy()->subMinutes(15)->toTimeString())
            ->where('status', 'Cancelled')
            ->get();

        // Lấy tất cả danh sách đặt bàn
        $reservations = Reservation::all();
        $reservations = Reservation::paginate(10);

        // Truyền các biến tới view
        return view('admin.reservation.index', compact('upcomingReservations', 'waitingReservations', 'overdueReservations', 'reservations'));
    }

    public function checkUpcomingAndOverdueReservations()
    {
        $now = Carbon::now();

        Reservation::where('reservation_date', '=', $now->toDateString())
            ->where('reservation_time', '<', $now->copy()->subMinutes(15)->toTimeString())

            ->where('status', 'Confirmed')
            ->update(['status' => 'Cancelled']);
    }

    // Lấy danh sách đặt bàn sắp đến hạn
    private function getUpcomingReservations()
    {
        $now = Carbon::now();

        return Reservation::where('reservation_date', '=', $now->toDateString())
            ->where('reservation_time', '>=', $now->toTimeString())
            ->where('reservation_time', '<=', $now->copy()->addMinutes(30)->toTimeString())

            ->where('status', 'Confirmed')

            ->get();
    }

    // Lấy danh sách đặt bàn đang chờ
    private function getWaitingReservations()
    {
        $now = Carbon::now();

        return Reservation::where('reservation_date', '=', $now->toDateString())
            ->where('reservation_time', '<', $now->toTimeString())
            ->where('reservation_time', '>=', $now->copy()->subMinutes(15)->toTimeString())
            ->where('status', 'Confirmed')
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


        // ->update(['status' => 'Cancelled']); // Cập nhật trạng thái thành 'Hủy'



        return view('admin.reservation.check', compact('upcomingReservations', 'waitingReservations', 'overdueReservations'));
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

    public function cancel($id)
    {
        // Tìm đơn đặt chỗ
        $reservation = Reservation::findOrFail($id);

        // Cập nhật trạng thái đơn đặt chỗ thành 'Cancelled'
        $reservation->status = 'Cancelled';
        $reservation->save();

        return redirect()->route('admin.reservation.index')->with('success', 'Đơn đặt bàn đã được hủy thành công.');
    }



    public function show($id)
    {
        $reservation = Reservation::with('customer')->findOrFail($id);
        return view('admin.reservation.show', compact('reservation'));
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


    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return redirect()->route('admin.reservation.index')->with('success', 'Reservation deleted successfully');
    }





     public function createReservation(StoreReservationRquest $request)

    {
        // Kiểm tra số lượng khách, nếu >= 6 thì chuyển hướng đến trang đặt cọc
        if ($request->guest_count >= 6) {
            $customerInformation = $request->all();
            return redirect()->route('deposit.client', compact('customerInformation'));
        }


        // Thực hiện giao dịch đặt bàn
        $reservation = DB::transaction(function () use ($request) {
            if (auth()->check()) {
                // Khách hàng đã đăng nhập, lưu thông tin đặt bàn với ID người dùng hiện tại
                $user = auth()->user();
                return Reservation::create([
                    'customer_id' => $user->id,
                    'user_name' => $user->name,
                    'user_phone' => $user->phone,
                    'guest_count' => $request->guest_count,
                    'note' => $request->note,
                    'reservation_date' => $request->reservation_date,
                    'reservation_time' => $request->reservation_time,
                ]);
            } else {
                // Khách hàng chưa đăng nhập, tạo tài khoản tạm thời với trạng thái inactive
                $user = User::create([
                    'name' => $request->user_name,
                    'phone' => $request->user_phone,
                    'password' => fake()->password(),
                    'status' => 'inactive',
                ]);

                return Reservation::create([
//Cần xem lại
//         } else {
//             DB::transaction(function () use ($request) {

//                 $user = User::where('phone', $request->user_phone)->first();
//                 if (!isset($user) && $user == null) {
//                     $user = User::create([
//                         'name' => $request->user_name,
//                         'phone' => $request->user_phone,
//                         'password' => fake()->password(),
//                         'status' => 'inactive',
//                     ]);
//                 }
//                 Reservation::create([

                    'customer_id' => $user->id,
                    'user_name' => $request->user_name,
                    'user_phone' => $request->user_phone,
                    'guest_count' => $request->guest_count,
                    'note' => $request->note,
                    'reservation_date' => $request->reservation_date,
                    'reservation_time' => $request->reservation_time,
                ]);
            }
        });


        // Chuyển hướng đến trang thành công và truyền dữ liệu đặt bàn
        return redirect()->route('reservationSuccessfully.client', ['reservation' => $reservation]);

    }
    public function reservationSuccessfully(Request $request)
    {
        if ($request->query('extraData')) {
            $reservation = $request->query('extraData');
            $data = str_replace("'", '"', $reservation);
            $reservation = json_decode($data, true);

            DB::transaction(function () use ($reservation) {

                // Kiểm tra xem người dùng đã đăng nhập chưa
                if (Auth::check()) {
                    // Sử dụng thông tin của người dùng đã đăng nhập
                    $user = Auth::user();

                    // Tạo đặt bàn với thông tin của người dùng đã đăng nhập
                    Reservation::create([
                        'customer_id' => $user->id,
                        'user_name' => $reservation['user_name'],
                        'user_phone' => $reservation['user_phone'],
                        'guest_count' => $reservation['guest_count'],
                        'deposit_amount' => $reservation['deposit_amount'],
                        'note' => $reservation['note'],
                        'reservation_date' => $reservation['reservation_date'],
                        'reservation_time' => $reservation['reservation_time'],
                    ]);
                } else {
                    // Nếu chưa đăng nhập, kiểm tra xem số điện thoại đã tồn tại chưa
                    $existingUser = User::where('phone', $reservation['user_phone'])->first();

                    if ($existingUser) {
                        $user = $existingUser;
                    } else {
                        // Tạo user mới nếu chưa tồn tại
                        $user = User::create([
                            'name' => $reservation['user_name'],
                            'phone' => $reservation['user_phone'],
                            'password' => bcrypt(str::random(10)), // Tạo mật khẩu ngẫu nhiên
                            'status' => 'inactive',
                        ]);
                    }

                    // Tạo đặt bàn với thông tin user mới hoặc đã tồn tại
                    Reservation::create([
                        'customer_id' => $user->id,
                        'user_name' => $reservation['user_name'],
                        'user_phone' => $reservation['user_phone'],
                        'guest_count' => $reservation['guest_count'],
                        'deposit_amount' => $reservation['deposit_amount'],
                        'note' => $reservation['note'],
                        'reservation_date' => $reservation['reservation_date'],
                        'reservation_time' => $reservation['reservation_time'],
                    ]);
                }

// cần xem lại
//                 $user = User::where('phone', $reservation['user_phone'])->first();
//                 if (!isset($user) && $user == null) {
//                     $user = User::create([
//                         'name' => $reservation['user_name'],
//                         'phone' => $reservation['user_phone'],
//                         'password' => fake()->password(),
//                         'status' => 'inactive',
//                     ]);
//                 }
                Reservation::create([
                    'customer_id' => $user->id,
                    'user_name' => $reservation['user_name'],
                    'user_phone' => $reservation['user_phone'],
                    'guest_count' => $reservation['guest_count'],
                    'deposit_amount' => $reservation['deposit_amount'],
                    'note' => $reservation['note'],
                    'reservation_date' => $reservation['reservation_date'],
                    'reservation_time' => $reservation['reservation_time'],
                ]);

            });
        } else {
            $reservation = $request->reservation;
        }

        return view('client.reservation-successfully', compact('reservation'));
    }

    public function showDeposit(Request $request)
    {
        $showDeposit = $request->customerInformation;
        $deposit = $showDeposit['guest_count'] * 100000;
        return view('client.deposit', compact('showDeposit', 'deposit'));
    }
                  
    public function checkout($orderId, Request $request)
    {
        DB::transaction(function () use ($request, $orderId) {
            $itemsCount = DB::table('orders_items')->where('order_id', $orderId)->count();
            $order = Order::find($orderId);
            $table = Table::find($order->table_id);
            $itemNames = $request->item_name;
            $quantities = $request->quantity;
            foreach ($itemNames as $index => $itemName) {
                DB::table('orders_items')
                    ->where('order_id', $orderId)
                    ->where('dish_id', $itemName)
                    ->update(['quantity' => DB::raw('quantity - ' . $quantities[$index])]);
                DB::table('orders_items')
                    ->where('order_id', $orderId)
                    ->where('dish_id', $itemName)
                    ->where('quantity', '<=', '0')
                    ->delete();
            }
            if ($itemsCount == 0) {
                Order::where('id', '=', $orderId)
                    ->update(['status' => 'completed']);
                Table::where('id', '=', $table->id)
                    ->update(['status' => 'Available']);
                ReservationTable::where('reservation_id', $order->reservation_id)
                    ->where('table_id', $order->table_id)
                    ->update(['status' => 'available']);
                ;
            }
        });
        return redirect(route('pos.index'));
    }



    public function assignTables($reservationId)
    {
        $tables = Table::all();


        return view('admin.reservation.table_layout', compact('tables', 'reservationId'));
    }

    public function assignTable(Request $request)

    {
        dd($request->all());
        $reservationId = 1;
        $tables = Table::all();
        foreach ($tables as $table) {
            // Kiểm tra xem bàn có đang được đặt hay không
            $isReserved = Reservation::whereHas('tables', function ($query) use ($table) {
                $query->where('table_id', $table->id)
                    ->where('start_time', '<=', now()->toTimeString())
                    ->where('end_time', '>=', now()->toTimeString());
            })->exists();
            dd($isReserved);
            if ($isReserved) {
                dd('bàn đã được đăt');
            } else {
                dd('bàn  trống');
                echo "Bàn {$table->table_number} hiện đang trống.\n";
            }
        }


        return view('admin.reservation.table_layout', compact('tables', 'reservationId'));
    }

    public function submitTable(Request $request)

    {
        try {
            // Bắt đầu transaction
            DB::beginTransaction();
            $reservation = Reservation::query()->findOrFail($request->get('reservation_id'));
            $reservation_date = $reservation->reservation_date; //ngày nhận bàn
            $reservation_time = $reservation->reservation_time; //giờ nhận bàn
            $reservationDuration = 60; //thời gian sử dụng ướ   tính
            //tính thời gian kết thúc ước tính
            $endTime = Carbon::createFromFormat('H:i:s', $reservation_time)->addMinutes($reservationDuration)->toTimeString();
            $tables = $request->get('tables');
            foreach ($tables as $tableId) {
                // Kiểm tra trạng thái của bàn trong khoảng thời gian này
                $conflictReservations = Reservation::whereHas('tables', function ($query) use ($tableId, $reservation_date, $reservation_time, $endTime) {
                    $query->where('table_id', $tableId)
                        ->where('reservation_date', $reservation_date)
                        ->where(function ($q) use ($reservation_time, $endTime) {
                            $q->where('start_time', '<', $endTime)
                                ->where('end_time', '>', $reservation_time);
                        });
                })->count();
                // dd($conflictReservations);
                if ($conflictReservations > 0) {
                    // return confirm('bàn đã được đặt ');
                    continue;
                }

                // Cập nhật thông tin đặt bàn vào bảng reservation_table
                $reservation->tables()->attach($tableId, [
                    'reservation_date' => $reservation_date,
                    'start_time' => $reservation_time,
                    // 'end_time' => $endTime,
                    'status' => 'reserved'
                ]);
                //   dd([$reservation_date,$reservation_time,$reservationDuration,$endTime,$request->tables]);
                // Cập nhật trạng thái bàn trong bảng tables
                Table::where('id', $tableId)->update(['status' => 'reserved']);
                // echo "Đã xếp bàn $tableId cho đơn đặt bàn $reservation->reservation_id.\n";
            }

            $reservation->update(['status' => 'confirmed']);
            DB::commit();
            return redirect()->route('admin.reservation.index')->with('success', 'Xếp bàn thành công.');
        } catch (\Exception $e) {
            // Nếu có lỗi xảy ra, rollback và ghi log lỗi
            DB::rollBack();
            // Log::error('Error in table assignment: ' . $e->getMessage());
            return redirect()->back()->withErrors([
                'error' => 'Có lỗi xảy ra khi đặt bàn. Vui lòng thử lại sau.'
            ]);
        }
    }


    public function submitMoveTable(Request $request)
    {
        $tableId = $request->input('dataId');
        $reservationId = $request->input('reservationId');
        $reservationData = ReservationTable::where('reservation_id', $reservationId)->first();
        if ($reservationData) {
            Table::where('id', $reservationData->table_id)->update(['status' => 'Available']);
        }
        ReservationTable::where('reservation_id', $reservationId)->update(['table_id' => $tableId]);
        Table::where('id', $tableId)->update(['status' => 'Reserved']);
        return response()->json([
            'success' => true,
            'message' => 'Chuyển bàn thành công'
        ]);
    }


    public function cancelReservation(Request $request, $id)
    {
        try {
            // Lấy số điện thoại đã xác thực từ request
            $verifiedPhoneNumber = $request->input('phone_number');

            // Chuẩn hóa số điện thoại xác thực
            $normalizedVerifiedPhone = $this->normalizePhoneNumber($verifiedPhoneNumber);

            $reservation = Reservation::findOrFail($id);

            // Chuẩn hóa số điện thoại trong đơn đặt bàn
            $normalizedReservationPhone = $this->normalizePhoneNumber($reservation->user_phone);

            // Log để debug
            Log::info('Phone numbers comparison', [
                'original_verified' => $verifiedPhoneNumber,
                'original_reservation' => $reservation->user_phone,
                'normalized_verified' => $normalizedVerifiedPhone,
                'normalized_reservation' => $normalizedReservationPhone
            ]);

            // So sánh số điện thoại đã chuẩn hóa
            if ($normalizedVerifiedPhone !== $normalizedReservationPhone) {
                return response()->json([
                    'success' => false,
                    'message' => 'Số điện thoại xác thực không khớp với số điện thoại đặt bàn.'
                ], 403);
            }

            // Thực hiện hủy đặt bàn
            $reservation->status = 'cancelled';
            $reservation->save();

            return response()->json([
                'success' => true,
                'message' => 'Đặt bàn đã được hủy thành công.'
            ]);
        } catch (\Exception $e) {
            Log::error('Error cancelling reservation', [
                'reservation_id' => $id,
                'error' => $e->getMessage()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi hủy đặt bàn: ' . $e->getMessage()
            ], 500);
        }
    }

    // Hàm chuẩn hóa số điện thoại
    private function normalizePhoneNumber($phoneNumber)
    {
        // Loại bỏ tất cả ký tự không phải số
        $numbers = preg_replace('/[^0-9]/', '', $phoneNumber);

        // Nếu số điện thoại bắt đầu bằng 84, loại bỏ
        if (strpos($numbers, '84') === 0) {
            $numbers = substr($numbers, 2);
        }

        // Nếu số điện thoại không bắt đầu bằng 0, thêm vào
        if (strpos($numbers, '0') !== 0) {
            $numbers = '0' . $numbers;
        }

        return $numbers;
    }
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
            'reservation_id' => 'required|exists:reservations,id',
        ]);

        $inputOtp = $request->input('otp');
        $sessionOtp = Session::get('otp');

        if ($inputOtp == $sessionOtp) {
            $reservation = Reservation::find($request->input('reservation_id'));

            if ($reservation && $reservation->user_id == Auth::id()) {
                $reservation->delete();
                return response()->json(['success' => true, 'message' => 'Hủy đặt bàn thành công.']);
            } else {
                return response()->json(['success' => false, 'message' => 'Không tìm thấy đặt bàn hoặc bạn không có quyền hủy.']);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Mã OTP không đúng. Vui lòng thử lại.']);
        }
    }
}

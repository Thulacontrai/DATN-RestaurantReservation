<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReservationRquest;
use App\Models\Coupon;
use App\Models\Dishes;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Reservation;
use App\Models\Table;
use App\Models\OrderTable;
use App\Models\User;
use App\Traits\TraitCRUD;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;



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

        // $this->updateOverdueReservations(); // Cập nhật các đơn quá hạn

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
    public function apiIndex()
    {
        return response()->json(Reservation::all());
    }


    // Cập nhật trạng thái đặt bàn quá hạn

    private function updateOverdueReservations(Request $request)
    {
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
            ->where('status', 'Pending')
            ->update(['status' => 'Cancelled']);

        // Đơn sắp đến hạn trong vòng 30 phút tới
        $upcomingReservations = Reservation::where('reservation_date', '=', $now->toDateString())
            ->where('reservation_time', '>=', $now->toTimeString())
            ->where('reservation_time', '<=', $now->copy()->addMinutes(30)->toTimeString())
            ->where('status', 'Pending')
            ->get();

        // Đơn đang chờ khách trong 15 phút
        $waitingReservations = Reservation::where('reservation_date', '=', $now->toDateString())
            ->where('reservation_time', '<', $now->toTimeString())
            ->where('reservation_time', '>=', $now->copy()->subMinutes(15)->toTimeString())
            ->where('status', 'Pending')
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
        // ->update(['status' => 'Cancelled']); // Cập nhật trạng thái thành 'Hủy'

        return view('admin.reservation.check', compact('upcomingReservations', 'waitingReservations', 'overdueReservations'));
    }



    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'customer_id' => 'nullable|integer|exists:customers,id',
                'customer_name' => 'required|string|max:255',
                'user_phone' => 'required|string|max:20',
                'reservation_time' => 'required|date_format:H:i',
                'reservation_date' => 'required|date',
                'guest_count' => 'required|integer|min:1',
                'status' => 'nullable|in:Confirmed,Pending,checked-in,Cancelled',
                'note' => 'nullable|string|max:255',
            ]);

            $reservation = Reservation::create([
                'customer_id' => $validatedData['customer_id'] ?? 1,
                'user_name' => $validatedData['customer_name'],
                'user_phone' => $validatedData['user_phone'],
                'reservation_date' => $validatedData['reservation_date'],
                'reservation_time' => $validatedData['reservation_time'],
                'guest_count' => $validatedData['guest_count'],
                'status' => $validatedData['status'] ?? 'Pending',
                'note' => $validatedData['note'] ?? null,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Reservation created successfully',
                'data' => $reservation,
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred',
                'error' => $e->getMessage(),
            ], 500);
        }
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
        $data = $request->all();
        $date = $request->query('date');
        $time = $request->query('time');
        return view('client.customer-information', compact('date', 'time', 'data'));
    }


    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return redirect()->route('admin.reservation.index')->with('success', 'Reservation deleted successfully');
    }







    public function updateReservation(Request $request, $id)
    {
        try {
            // Tìm sự kiện theo ID
            $reservation = Reservation::findOrFail($id);

            // Xác thực dữ liệu đầu vào
            $validatedData = $request->validate([
                'reservation_date' => 'required|date',
                'reservation_time' => 'required|date_format:H:i:s',
                'status' => 'nullable|in:Pending,Cancelled', // Trạng thái tùy chọn, chỉ nhận các giá trị hợp lệ
            ]);

            // Cập nhật thông tin sự kiện
            $reservation->reservation_date = $validatedData['reservation_date'];
            $reservation->reservation_time = \Carbon\Carbon::createFromFormat('H:i:s', $validatedData['reservation_time'])->format('H:i:s');
            $reservation->status = $validatedData['status'] ?? $reservation->status; // Nếu không có trạng thái, giữ nguyên

            // Lưu vào cơ sở dữ liệu
            $reservation->save();

            return response()->json([
                'message' => 'Cập nhật thành công!',
                'reservation' => $reservation,
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Xử lý lỗi không tìm thấy sự kiện
            return response()->json([
                'message' => 'Không tìm thấy sự kiện với ID này!',
                'error' => $e->getMessage(),
            ], 404);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Xử lý lỗi xác thực
            return response()->json([
                'message' => 'Dữ liệu không hợp lệ!',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            // Xử lý lỗi khác
            return response()->json([
                'message' => 'Đã xảy ra lỗi khi cập nhật sự kiện!',
                'error' => $e->getMessage(),
            ], 500);
        }
    }






    public function updateCalendar(Request $request, $id)
    {
        try {
            // Xác thực dữ liệu
            $validatedData = $request->validate([
                'customer_name' => 'required|string|max:255', // ánh xạ tới user_name
                'user_phone' => 'required|string|max:15',
                'reservation_date' => 'required|date_format:Y-m-d',
                'guest_count' => 'required|integer|min:1',
                'notes' => 'nullable|string',
            ]);

            // Tìm đặt bàn theo ID
            $reservation = Reservation::findOrFail($id);

            // Cập nhật thông tin đặt bàn
            $reservation->user_name = $validatedData['customer_name']; // ánh xạ customer_name tới user_name
            $reservation->user_phone = $validatedData['user_phone'];
            $reservation->reservation_date = $validatedData['reservation_date'];
            $reservation->guest_count = $validatedData['guest_count'];
            $reservation->note = $validatedData['notes']; // ánh xạ notes tới cột note

            // Lưu vào cơ sở dữ liệu
            $reservation->save();

            return response()->json([
                'success' => true,
                'message' => 'Cập nhật thành công!',
                'data' => $reservation,
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Dữ liệu không hợp lệ.',
                'errors' => $e->errors(),
            ], 422);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy lịch đặt bàn.',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Đã xảy ra lỗi khi cập nhật.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }












    public function processReservationCancellation(Request $request, $id)
    {
        try {
            Log::info("Bắt đầu xử lý hủy đặt bàn với ID: $id");

            // Validate dữ liệu đầu vào
            $validatedData = $request->validate([
                'note' => 'required|string|max:255',
            ]);

            // Tìm đặt bàn theo ID
            $reservation = Reservation::findOrFail($id);
            Log::info("Tìm thấy đặt bàn: ", ['reservation' => $reservation]);

            // Kiểm tra trạng thái đặt bàn
            if ($reservation->status === 'Completed') {
                Log::warning("Không thể hủy đặt bàn đã hoàn thành", ['id' => $id]);
                return response()->json([
                    'success' => false,
                    'message' => 'Không thể hủy đặt bàn đã hoàn thành.',
                ], 400);
            }

            if ($reservation->status === 'Cancelled') {
                Log::warning("Đặt bàn đã bị hủy trước đó", ['id' => $id]);
                return response()->json([
                    'success' => false,
                    'message' => 'Đặt bàn đã bị hủy trước đó.',
                ], 400);
            }

            // Kiểm tra thời gian đặt bàn nếu trạng thái là pending
            if ($reservation->status === 'Pending') {
                if (!$reservation->reservation_date) {
                    Log::error("Thời gian đặt bàn không hợp lệ (null)", ['id' => $id]);
                    return response()->json([
                        'success' => false,
                        'message' => 'Thời gian đặt bàn không hợp lệ.',
                    ], 400);
                }

                $reservationDateTime = Carbon::parse($reservation->reservation_date);
                Log::info("Thời gian đặt bàn: $reservationDateTime, Thời gian hiện tại: " . now());

                if (now()->greaterThan($reservationDateTime)) {
                    Log::warning("Đặt bàn đã quá hạn nhưng vẫn được hủy", [
                        'id' => $id,
                        'reservation_date' => $reservationDateTime,
                    ]);
                    // Thêm thông báo vào lý do hủy
                    $validatedData['note'] .= ' (Hủy đặt bàn đã quá hạn)';
                }
            }

            // Cập nhật trạng thái và lý do hủy
            $reservation->note = $validatedData['note'];
            $reservation->status = 'Cancelled'; // Đảm bảo khớp với ENUM
            $reservation->updated_at = now(); // Cập nhật thời gian chỉnh sửa
            $reservation->save();

            Log::info("Hủy đặt bàn thành công với ID: $id");
            return response()->json([
                'success' => true,
                'message' => 'Đặt bàn đã được hủy thành công.',
                'data' => $reservation,
            ]);
        } catch (ModelNotFoundException $e) {
            Log::error("Không tìm thấy đặt bàn với ID: $id");
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy đặt bàn.',
            ], 404);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error("Dữ liệu không hợp lệ", ['errors' => $e->errors()]);
            return response()->json([
                'success' => false,
                'message' => 'Dữ liệu không hợp lệ.',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            Log::error("Lỗi khi hủy đặt bàn: " . $e->getMessage(), ['id' => $id]);
            return response()->json([
                'success' => false,
                'message' => 'Đã xảy ra lỗi khi hủy đặt bàn.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

































    public function createReservation(StoreReservationRquest $request)
    {
        // Kiểm tra số lượng khách, nếu >= 6 thì chuyển hướng đến trang đặt cọc
        if ($request->guest_count >= 6) {
            // Lưu thông tin khách hàng tạm thời để sử dụng ở trang cọc
            $customerInformation = $request->all();
            return redirect()->route('deposit.client', compact('customerInformation'));
        } else {
            // Thực hiện giao dịch đặt bàn mà không cần cọc
            $reservation = DB::transaction(function () use ($request) {
                $customer_id = null;


                if (auth()->check()) {
                    // Nếu đã đăng nhập, chỉ lấy customer_id
                    $customer_id = auth()->id();
                } else {

                    $user = User::where('phone', $request->user_phone)->first();
                    if (!isset($user) && $user == null) {
                        // Nếu chưa đăng nhập, tạo tài khoản tạm thời
                        $user = User::create([
                            'name' => $request->user_name,
                            'phone' => $request->user_phone,
                            'password' => bcrypt(Str::random(10)),
                            'status' => 'inactive',
                        ]);
                    }
                    $customer_id = $user->id;
                }

                // Luôn sử dụng thông tin từ form
                return Reservation::create([
                    'customer_id' => $customer_id,
                    'user_name' => $request->user_name,
                    'user_phone' => $request->user_phone,
                    'guest_count' => $request->guest_count,
                    'note' => $request->note,
                    'reservation_date' => $request->reservation_date,
                    'reservation_time' => $request->reservation_time,
                    // 'deposit_amount' => 0,  // Không cần cọc validate ss
                ]);
            });
            return redirect()->route('reservationSuccessfully.client')->with('reservation', $reservation);
        }
    }


    public function storeOtpSession(Request $request)
    {
        if ($request->otpVerified) {
            session(['otpVerified' => true]); // Lưu trạng thái OTP đã xác thực
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }


    // Hàm kiểm tra điều kiện cần OTP
    private function requireOtp($request)
    {
        // Ví dụ kiểm tra nếu số lượng người đặt bàn >= 6 thì cần OTP
        return $request->guest_count >= 6;
    }



    public function reservationSuccessfully(Request $request)
    {
        $reservation = session('reservation');
        if (isset($reservation) && $reservation != null) {
            return view('client.reservation-successfully', compact('reservation'));
        } else {
            return redirect()->route('booking.client');
        }
    }
    public function createReservationWithMomo(Request $request)
    {
        if ($request->query('extraData')) {
            if ($request->query('message') == 'Successful.') {
                $reservation = $request->query('extraData');
                $data = str_replace("'", '"', $reservation);
                $reservation = json_decode($data, true);
                DB::transaction(function () use ($reservation, $request) {

                    $customer_id = null;
                    if (auth()->check()) {
                        $customer_id = auth()->id();
                    } else {
                        $user = User::where('phone', $reservation['user_phone'])->first();
                        if (!isset($user) && $user == null) {
                            $user = User::create([
                                'name' => $reservation['user_name'],
                                'phone' => $reservation['user_phone'],
                                'password' => fake()->password(),
                                'status' => 'inactive',
                            ]);
                        }
                        $customer_id = $user->id;
                    }
                    Reservation::create([
                        'id' => $request->query('orderId'),
                        'customer_id' => $customer_id,
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
                return redirect()->back()->with('err', 'Thanh toán không thành công!');
            }
        } else {
            $reservation = $request->all();
            DB::transaction(function () use ($request) {
                $customer_id = null;
                if (auth()->check()) {
                    $customer_id = auth()->id();
                } else {
                    $user = User::where('phone', $request->user_phone)->first();
                    if (!isset($user) && $user == null) {
                        $user = User::create([
                            'name' => $request->user_name,
                            'phone' => $request->user_phone,
                            'password' => fake()->password(),
                            'status' => 'inactive',
                        ]);
                    }
                    $customer_id = $user->id;
                }
                Reservation::create([
                    'id' => $request->orderId,
                    'customer_id' => $customer_id,
                    'user_name' => $request->user_name,
                    'user_phone' => $request->user_phone,
                    'guest_count' => $request->guest_count,
                    'deposit_amount' => $request->deposit_amount,
                    'note' => $request->note,
                    'reservation_date' => $request->reservation_date,
                    'reservation_time' => $request->reservation_time,
                ]);
            });
        }
        return redirect()->route('reservationSuccessfully.client')->with('reservation', $reservation);
    }


    public function showDeposit(Request $request)
    {
        $showDeposit = $request->customerInformation;
        $deposit = $showDeposit['guest_count'] * 100000;
        $orderId = time();
        return view('client.deposit', compact('showDeposit', 'deposit', 'orderId'));
    }

    public function checkout($orderId, Request $request)
    {
        DB::transaction(function () use ($request, $orderId) {
            $itemsCount = DB::table('order_items')->where('order_id', $orderId)->count();
            $order = Order::find($orderId);
            $table = Table::find($order->table_id);
            $itemNames = $request->item_name;
            $quantities = $request->quantity;
            foreach ($itemNames as $index => $itemName) {
                DB::table('order_items')
                    ->where('order_id', $orderId)
                    ->where('item_id', $itemName)
                    ->update(['quantity' => DB::raw('quantity - ' . $quantities[$index])]);
                DB::table('order_items')
                    ->where('order_id', $orderId)
                    ->where('item_id', $itemName)
                    ->where('quantity', '<=', '0')
                    ->delete();
            }
            if ($itemsCount == 0) {
                Order::where('id', '=', $orderId)
                    ->update(['status' => 'completed']);
                Table::where('id', '=', $table->id)
                    ->update(['status' => 'Available']);
                OrderTable::where('reservation_id', $order->reservation_id)
                    ->where('table_id', $order->table_id)
                    ->update(['status' => 'available']);;
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

    // public function submitMoveTable(Request $request)
    // {
    //     $tableId = $request->input('dataId');
    //     $reservationId = $request->input('reservationId');
    //     $reservationData = ReservationTable::where('reservation_id', $reservationId)->first();
    //     if ($reservationData) {
    //         Table::where('id', $reservationData->table_id)->update(['status' => 'Available']);
    //     }
    //     ReservationTable::where('reservation_id', $reservationId)->update(['table_id' => $tableId]);
    //     Table::where('id', $tableId)->update(['status' => 'Reserved']);
    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Chuyển bàn thành công'
    //     ]);
    // }



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

    public function cancelReservationPopUp(Request $request)
    {
        try {
            $id = $request->id;
            $reservation = Reservation::findOrFail($id);
            $reservation->status = 'Cancelled';
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

    public function getBanks()
    {

        $client = new Client();
        $response = $client->get('https://api.vietqr.io/v2/banks');
        $data = json_decode($response->getBody(), true);

        if ($data['code'] == '00') {
            $banks = $data['data'];
            return view('test', compact('banks'));
        }

        return 'Lỗi khi lấy danh sách ngân hàng';
    }



    public function print($orderId, Request $request)
    {
        $final = 0;
        $data = $request->end_time;
        $order = Order::find($orderId);
        $table = Table::find($order->table_id);
        $reservation_table = OrderTable::where('reservation_id', $order->reservation_id)
            ->where('table_id', $order->table_id)
            ->first();
        $items = OrderItem::where('order_id', $orderId)->get();
        $item = $items->all();
        $dishIds = $items->pluck('item_id')->toArray();
        $dishes = Dishes::whereIn('id', $dishIds)->get();
        $staff = User::find($order->staff_id);
        return view('pos.printf', compact('dishes', 'final', 'data', 'order', 'table', 'staff', 'reservation_table', 'item'))->render();
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

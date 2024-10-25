<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use App\Models\Dishes;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Reservation;
use App\Models\Table;
use Carbon\Carbon;

use App\Models\ReservationTable;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PosController extends Controller
{

    // public function __construct()
    // {
    //     // Gán middleware cho các phương thức
    //     $this->middleware('permission:Xem pos', ['only' => ['index']]);
    //     $this->middleware('permission:Tạo mới pos', ['only' => ['create']]);
    //     $this->middleware('permission:Sửa pos', ['only' => ['edit']]);
    //     $this->middleware('permission:Xóa pos', ['only' => ['destroy']]);

    // }


    public function checkTable(Request $request)
    {
        $reservation = Reservation::findOrFail($request->reservation_id);
        $hasTable = $reservation->tables()->exists(); // Kiểm tra xem đơn đặt có bàn chưa
    
        return response()->json([
            'hasTable' => $hasTable
        ]);
    }
    
    public function convertToOrder(Request $request)
    {
        $reservation = Reservation::findOrFail($request->reservation_id);
    
        // Kiểm tra trạng thái của đơn đặt
        if ($reservation->status !== 'Confirmed') {
            return response()->json([
                'error' => 'Chỉ có thể chuyển đơn đã xác nhận.'
            ], 400);
        }
    
        // Nếu chưa có bàn, cần phải chọn bàn
        if (!$reservation->tables()->exists() && !$request->has('table_id')) {
            return response()->json([
                'error' => 'Bạn cần chọn bàn trước khi chuyển đơn.'
            ], 400);
        }
    
        // Gán bàn được chọn nếu đơn đặt chưa có bàn
        if ($request->has('table_id')) {
            $reservation->tables()->attach($request->table_id); // Thêm bàn vào reservation
        }
    
        $table = $reservation->tables()->first(); // Lấy bàn đầu tiên trong danh sách
    
        // Tạo order từ reservation
        $order = Order::create([
            'reservation_id' => $reservation->id,
            'table_id'       => $table->id,
            'customer_id'    => $reservation->customer_id,
            'total_amount'   => $reservation->deposit_amount,
            'order_type'     => 'dine_in',
            'status'         => 'pending',
            'discount_amount'=> 0,
            'final_amount'   => $reservation->deposit_amount,
        ]);
    
        // Cập nhật trạng thái của bàn và đơn đặt
        $table->status = 'occupied'; // Đánh dấu bàn là "occupied" sau khi được sử dụng
        $reservation->status = 'checked-in';
        $table->save();
        $reservation->save();
    
        return response()->json([
            'success' => 'Chuyển đơn thành công!',
            'order' => $order
        ]);
    }

    // Trang chính của POS, hiển thị bàn và món ăn
    public function index()
    {
        // Lấy thời gian hiện tại và các mốc thời gian cần thiết
        $now = now();
        $nextHalfHour = $now->copy()->addMinutes(30);
        $fifteenMinutesAgo = $now->copy()->subMinutes(15);

        // Lấy danh sách các bàn
        $tables = Table::withCount(['orders' => function ($query) {
            $query->whereIn('status', ['pending', 'in-progress']);
        }])->get();

        // Lấy danh sách món ăn
        $dishes = Dishes::all();
        $order = Order::latest()->first();



        // Lấy các đơn đặt bàn sắp đến trong 30 phút tới
        $upcomingReservations = Reservation::where('reservation_date', '=', today())
            ->where('reservation_time', '>=', $now->toTimeString())
            ->where('reservation_time', '<=', $nextHalfHour->toTimeString())
            ->get();

        // Lấy các đơn đặt bàn đã quá giờ nhưng vẫn trong khoảng 15 phút trước (chờ khách)
        $lateReservations = Reservation::where('reservation_date', '=', today())
            ->where('reservation_time', '<', $now->toTimeString())
            ->where('reservation_time', '>=', $fifteenMinutesAgo->toTimeString())
            ->where('status', 'Pending')
            ->get();

        // Lấy danh sách các bàn trống (available)
        $availableTables = Table::where('status', 'available')->get();

        // Truyền dữ liệu tới view
        return view('pos.index', [
            'tables' => $tables,
            'order' => $order,  // Truyền biến $order vào view
            'dishes' => $dishes,
            'upcomingReservations' => $upcomingReservations,
            'lateReservations' => $lateReservations,
            'availableTables' => $availableTables,  // Truyền danh sách bàn trống vào view
            'availableTablesCount' => $tables->where('status', 'available')->count(),
            'reservedTablesCount' => $tables->where('status', 'reserved')->count(),
            'occupiedTablesCount' => $tables->where('status', 'occupied')->count(),
            'totalTablesCount' => $tables->count(),
        ]);
    }

    public function showOrder($id)
    {
        $order = Order::with('table')->find($id); // Lấy đơn hàng cùng thông tin bàn
        return view('your-view-file', compact('order')); // Truyền dữ liệu $order sang view
    }


    // Phương thức upcomingReservations()
    public function upcomingReservations()
    {
        // Lấy thời gian hiện tại và thời gian 30 phút sau
        $now = now();
        $nextHalfHour = now()->addMinutes(30);

        // Lấy các đặt bàn trong khoảng thời gian từ hiện tại đến 30 phút sau
        $upcomingReservations = Reservation::whereBetween(DB::raw("CONCAT(reservation_date, ' ', reservation_time)"), [$now, $nextHalfHour])
            ->with('table') // Nếu bạn cần thông tin bàn, có thể kết hợp với bảng tables
            ->get();

        return response()->json([
            'success' => true,
            'upcomingReservations' => $upcomingReservations,
        ]);
    }



    // Tạo đơn hàng
    public function createOrder(Request $request)
    {
        $request->validate([
            'table_id' => 'required|exists:tables,id',
        ]);

        try {
            $table = Table::findOrFail($request->table_id);

            // Kiểm tra trạng thái của bàn
            if ($table->status === 'occupied' || $table->status === 'reserved') {
                return response()->json([
                    'success' => false,
                    'message' => 'Bàn này đang sử dụng hoặc đã được đặt trước. Không thể tạo thêm đơn hàng.',
                ], 400);
            }

            // Kiểm tra xem bàn đã có đơn hàng chưa
            if (Order::where('table_id', $table->id)->whereIn('status', ['pending', 'in-progress'])->exists()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Bàn này đã có đơn hàng đang hoạt động. Không thể tạo thêm đơn hàng mới.',
                ], 400);
            }

            // Tạo đơn hàng mới
            $order = Order::create([
                'table_id' => $table->id,
                'status' => 'pending',
                'total_amount' => 0,
                'discount_amount' => 0,
                'final_amount' => 0,
            ]);

            // Cập nhật trạng thái của bàn thành "reserved"
            $table->update(['status' => 'reserved']);

            return response()->json([
                'success' => true,
                'order' => $order,
                'table_number' => $table->table_number,
                'table_status' => $table->status,
            ]);
        } catch (\Exception $e) {
            Log::error('Lỗi khi tạo đơn hàng: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Đã xảy ra lỗi khi tạo đơn hàng.',
            ], 500);
        }
    }

    // Thêm món vào order_items
    public function addDishToOrder(Request $request)
{
    $request->validate([
        'order_id' => 'required|exists:orders,id',
        'dish_id' => 'required|exists:dishes,id',
        'quantity' => 'required|integer|min:1',
    ]);

    try {
        // Lấy đơn hàng và món ăn từ cơ sở dữ liệu
        $order = Order::findOrFail($request->order_id);
        $dish = Dishes::findOrFail($request->dish_id);

        // Kiểm tra món đã có trong đơn hàng chưa
        $existingOrderItem = OrderItem::where('order_id', $order->id)
            ->where('item_id', $dish->id)
            ->where('item_type', 'dish')
            ->first();

        // Cập nhật hoặc thêm món vào đơn hàng
        if ($existingOrderItem) {
            // Nếu món đã tồn tại, cập nhật số lượng và tổng giá
            $existingOrderItem->quantity += $request->quantity; // Cộng dồn số lượng
            $existingOrderItem->total_price = $existingOrderItem->quantity * $existingOrderItem->price; // Cập nhật tổng giá
            $existingOrderItem->save();  // Lưu cập nhật vào cơ sở dữ liệu
        } else {
            // Nếu món chưa có trong đơn hàng, thêm món mới vào
            $existingOrderItem = OrderItem::create([
                'order_id' => $order->id,
                'item_id' => $dish->id,
                'item_type' => 'dish',
                'quantity' => $request->quantity, // Lưu số lượng ban đầu
                'price' => $dish->price,
                'total_price' => $dish->price * $request->quantity, // Tính tổng giá
                'status' => 'preparing',
            ]);
        }

        // Cập nhật tổng số tiền của đơn hàng
        $order->total_amount += ($dish->price * $request->quantity); // Cập nhật tổng số tiền
        $order->final_amount = $order->total_amount; // Cập nhật tổng tiền cuối cùng
        $order->save();  // Lưu đơn hàng vào cơ sở dữ liệu

        return response()->json([
            'success' => true,
            'orderItem' => [
                'dishName' => $dish->name, // Thêm tên món ăn vào phản hồi
                'quantity' => $existingOrderItem->quantity,
                'total_price' => $existingOrderItem->total_price
            ],  // Trả về món vừa được thêm/cập nhật
            'totalAmount' => $order->total_amount,  // Cập nhật tổng tiền
        ]);
    } catch (\Exception $e) {
        // Ghi log lỗi nếu xảy ra vấn đề
        Log::error('Lỗi khi thêm món vào đơn hàng: ' . $e->getMessage());

        return response()->json([
            'success' => false,
            'message' => 'Đã xảy ra lỗi khi thêm món vào đơn hàng.',
        ], 500);
    }
}




    public function Ppayment($orderId, Request $request)
    {
        $order = Order::find($orderId);
        $reservation = Reservation::find($order->reservation_id);
        $table = Table::find($order->table_id);
        $reservation_table = ReservationTable::where('reservation_id', $order->reservation_id)
            ->where('table_id', $order->table_id)
            ->first();
        $order_items = Dishes::whereIn('id', $request->order_item)->get();
        $item = OrderItem::where('order_id', $orderId)->get();
        $items = $item->all();
        $dishIds = $item->pluck('item_id')->toArray();
        $dishes = Dishes::whereIn('id', $dishIds)->get();
        $staff_id = User::find($order->staff_id);
        $customer_id = User::find($order->customer_id);
        $order_item = $request->order_item;
        $final = 0;
        return view(
            'pos.payment',
            compact('dishes', 'final', 'items', 'orderId', 'order', 'reservation', 'table', 'reservation_table', 'order_items', 'staff_id', 'customer_id', 'order_item', )
        );
    }


    // Xóa món khỏi order_items
    public function deleteDishFromOrder($orderId, $dishId)
    {
        try {
            // Tìm đơn hàng và món ăn trong đơn hàng
            $order = Order::findOrFail($order_id);
            $orderItem = OrderItem::where('order_id', $order_id)->where('id', $item_id)->firstOrFail();

            // Trừ số tiền của món ăn bị xóa khỏi tổng tiền đơn hàng
            $order->total_amount -= $orderItem->total_price;
            $order->final_amount = $order->total_amount; // Cập nhật lại tổng tiền đơn hàng
            $order->save();

            // Xóa món ăn vĩnh viễn (forceDelete) khỏi cơ sở dữ liệu
            $orderItem->forceDelete();

            return response()->json([
                'success' => true,
                'message' => 'Món ăn đã được xóa khỏi đơn hàng.',
                'total_amount' => $order->total_amount, // Trả lại tổng tiền sau khi xóa
            ]);
        } catch (\Exception $e) {
            // Ghi log lỗi và trả về phản hồi lỗi
            Log::error('Lỗi khi xóa món ăn khỏi đơn hàng: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Đã xảy ra lỗi khi xóa món ăn.',
            ], 500);
        }
    }





    // Nạp thêm món ăn (phân trang món ăn qua AJAX)
    public function loadMoreDishes(Request $request)
    {
        if ($request->ajax()) {
            $page = $request->get('page', 1);
            $dishes = Dishes::paginate(8);

            $view = view('pos.partials.dish-items', compact('dishes'))->render();

            return response()->json(['dishes' => $view]);
        }

        return response()->json(['success' => false, 'message' => 'Request is not AJAX.'], 400);
    }

    // Lọc món ăn
    public function filterDishes(Request $request)
    {
        $query = Dishes::query();

        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->has('price_min') && $request->has('price_max')) {
            $query->whereBetween('price', [$request->price_min, $request->price_max]);
        }

        $dishes = $query->paginate(8);

        return response()->json(['dishes' => $dishes]);
    }

    // Hiển thị thông tin đơn hàng cho bàn đã đặt
    public function showOrderForReservedTable(Request $request)
    {
        $request->validate([
            'table_id' => 'required|exists:tables,id',
        ]);

        try {
            $table = Table::findOrFail($request->table_id);

            // Kiểm tra nếu trạng thái của bàn là "reserved"
            if ($table->status !== 'reserved') {
                return response()->json([
                    'success' => false,
                    'message' => 'Bàn này không ở trạng thái đã đặt.',
                ], 400);
            }

            // Tìm đơn hàng đã tạo cho bàn
            $order = Order::where('table_id', $table->id)
                ->whereIn('status', ['pending', 'in-progress', 'reserved'])
                ->first();

            if ($order) {
                $orderItems = OrderItem::where('order_id', $order->id)->get();
                $totalAmount = $orderItems->sum('total_price');

                return response()->json([
                    'success' => true,
                    'order' => $order,
                    'orderItems' => $orderItems,
                    'totalAmount' => $totalAmount,
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy đơn hàng cho bàn này.',
                ], 404);
            }
        } catch (\Exception $e) {
            Log::error('Lỗi khi hiển thị đơn hàng: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Đã xảy ra lỗi khi hiển thị đơn hàng.',
            ], 500);
        }
    }

    // Xác nhận đơn hàng
    public function confirmOrder(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
        ]);

        try {
            $order = Order::findOrFail($request->order_id);
            $order->status = 'in-progress';
            $order->save();

            return response()->json([
                'success' => true,
                'message' => 'Đơn hàng đã được xác nhận.',
            ]);
        } catch (\Exception $e) {
            Log::error('Lỗi khi xác nhận đơn hàng: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Đã xảy ra lỗi khi xác nhận đơn hàng.',
            ], 500);
        }
    }

    // Thanh toán đơn hàng
    public function payOrder(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
        ]);

        try {
            $order = Order::findOrFail($request->order_id);
            $order->status = 'completed';
            $order->save();

            // Cập nhật trạng thái bàn
            $table = Table::findOrFail($order->table_id);
            $table->status = 'available';
            $table->save();

            return response()->json([
                'success' => true,
                'message' => 'Đơn hàng đã được thanh toán thành công.',
            ]);
        } catch (\Exception $e) {
            Log::error('Lỗi khi thanh toán đơn hàng: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Đã xảy ra lỗi khi thanh toán đơn hàng.',
            ], 500);
        }
    }


    public function showReservations()
    {
        // Đảm bảo múi giờ nhất quán
        $now = Carbon::now();
        $next30Minutes = $now->copy()->addMinutes(30);

        // Lọc các đơn đặt bàn trong ngày hôm nay và thời gian cụ thể
        $upcomingReservations = Reservation::whereDate('reservation_date', today())
            ->whereBetween('reservation_time', [$now->toTimeString(), $next30Minutes->toTimeString()])
            ->orderBy('reservation_time', 'asc') // Thêm sắp xếp theo thời gian đặt trước
            ->get();

        // Trả về view với dữ liệu
        return view('pos.index', compact('upcomingReservations'));
    }


    public function getLateReservations()
    {
        $now = now();
        $fifteenMinutesAgo = $now->copy()->subMinutes(15);

        // Lấy các đơn đặt bàn đã quá giờ nhưng chưa quá 15 phút
        $lateReservations = Reservation::where('reservation_date', '=', today())
            ->where('reservation_time', '<', $now->toTimeString())
            ->where('reservation_time', '>=', $fifteenMinutesAgo->toTimeString())
            ->where('status', 'Pending')  // Giả sử đơn này có trạng thái 'Pending'
            ->orderBy('reservation_time', 'asc')
            ->get();

        return view('pos.index', [
            'lateReservations' => $lateReservations,
            // Các dữ liệu khác cần thiết...
        ]);
    }

    public function store(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'user_name' => 'required|string',
            'user_phone' => 'required|string',
            'reservation_date' => 'required|date',
            'reservation_time' => 'required|date_format:H:i',
            'table_number' => 'required|integer',
            'guest_count' => 'required|integer|min:1',
            'status' => 'required|string|in:Pending,Confirmed,Cancelled',
            // Các trường khác nếu cần
        ]);

        try {
            // Tạo đơn đặt bàn mới
            Reservation::create([
                'user_name' => $request->user_name,
                'user_phone' => $request->user_phone,
                'reservation_date' => $request->reservation_date,
                'reservation_time' => $request->reservation_time,
                'table_number' => $request->table_number,
                'guest_count' => $request->guest_count,
                'status' => $request->status,
                'note' => $request->note,
            ]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Lỗi khi thêm đặt bàn.']);
        }
    }





    // public function Ppayment($tableNumber, Request $request)
    // {
    //     try {
    //         $selectedItems = $request->input('items', []);
    // public function payment($tableNumber, Request $request)
    // {
    //     try {
    //         $selectedItems = $request->input('items', []);
    //         if (!is_array($selectedItems) || empty($selectedItems)) {
    //             return back()->with('error', 'No items selected for payment.');
    //         }
    //         return view('pos.payment', compact('tableNumber', 'selectedItems'));
    //     } catch (\Exception $e) {
    //         Log::error('Error loading payment page: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
    //         return back()->with('error', 'An error occurred while navigating to the payment page.');
    //     }
    // }
    // public function processPaymentOffline(Request $request)
    // {
    //     return $this->handlePayment($request, 'offline');
    // }
    // public function processPaymentOnline(Request $request)
    // {
    //     return $this->handlePayment($request, 'online');
    // }
    // private function handlePayment(Request $request, $paymentType)
    // {
    //     try {
    //         // Validate incoming request data
    //         $rules = [
    //             'paymentMethod' => 'required|string|in:cash,card,qr,momo,vnpay',
    //             'items' => 'required|array',
    //             'table' => 'required|string',
    //         ];
    //         if ($paymentType === 'online') {
    //             $rules = array_merge($rules, [
    //                 'cardNumber' => 'required_if:paymentMethod,card|numeric',
    //                 'expiryDate' => 'required_if:paymentMethod,card|date_format:m/y',
    //                 'cvc' => 'required_if:paymentMethod,card|digits:3',
    //             ]);
    //         }
    //         $request->validate($rules);
    //         // Extract necessary data
    //         $table = $request->input('table');
    //         $paymentMethod = $request->input('paymentMethod');
    //         $selectedItems = $request->input('items');
    //         $totalAmount = collect($selectedItems)->sum(function ($item) {
    //             return isset($item['quantity'], $item['price']) ? $item['quantity'] * $item['price'] : 0;
    //         });
    //         DB::beginTransaction();
    //         // Create payment record
    //         $payment = Payment::create([
    //             'reservation_id' => null,
    //             'bill_id' => 'BILL_' . time(),
    //             'transaction_amount' => $totalAmount,
    //             'refund_amount' => 0,
    //             'payment_method' => $paymentMethod,
    //             'status' => 'Pending',
    //             'transaction_status' => 'pending',
    //         ]);
    //         // Process payment status
    //         switch ($paymentMethod) {
    //             case 'cash':
    //             case 'card':
    //             case 'qr':
    //             case 'momo':
    //             case 'vnpay':
    //                 $payment->status = 'Completed';
    //                 $payment->transaction_status = 'completed';
    //                 break;
    //             default:
    //                 throw new \Exception("Unsupported payment method: " . $paymentMethod);
    //         }
    //         $payment->save();
    //         DB::commit();
    //         return view('pos.receipt', [
    //             'table' => $table,
    //             'selectedItems' => $selectedItems,
    //             'totalAmount' => $totalAmount
    //         ])->with('success', 'Payment successful.');
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         Log::error('Error processing payment: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
    //         return back()->with('error', 'An error occurred during payment. Please try again.');
    //     }
    // }


}



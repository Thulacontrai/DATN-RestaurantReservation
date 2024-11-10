<?php

namespace App\Http\Controllers\Pos;

use App\Events\MessageSent;
use App\Events\PosTableUpdated;
use App\Http\Controllers\Controller;
use App\Models\Dishes;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Reservation;
<<<<<<< HEAD
use App\Models\Table;
use Carbon\Carbon;
use App\Models\OrderTable;
=======
use App\Models\ReservationTable;
use App\Models\Table;
>>>>>>> 5cc51a89bb95b5109df530d2307b9d681decb08e
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PosController extends Controller
{
<<<<<<< HEAD
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
            'table_id' => $table->id,
            'customer_id' => $reservation->customer_id,
            'total_amount' => $reservation->deposit_amount,
            'order_type' => 'dine_in',
            'status' => 'pending',
            'discount_amount' => 0,
            'final_amount' => $reservation->deposit_amount,
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
=======


    // public function __construct()
    // {
    //     // Gán middleware cho các phương thức
    //     $this->middleware('permission:Xem pos', ['only' => ['index']]);
    //     $this->middleware('permission:Tạo mới pos', ['only' => ['create']]);
    //     $this->middleware('permission:Sửa pos', ['only' => ['edit']]);
    //     $this->middleware('permission:Xóa pos', ['only' => ['destroy']]);
        
    // }
>>>>>>> 5cc51a89bb95b5109df530d2307b9d681decb08e

    // Trang chính của POS, hiển thị bàn và món ăn

 

    public function index()
    {
        $tables = Table::all();
        $availableTablesCount = Table::where('status', 'available')->count();
        $reservedTablesCount = Table::where('status', 'reserved')->count();
        $occupiedTablesCount = Table::where('status', 'occupied')->count();
        $totalTablesCount = Table::count();
        
        $dishes = Dishes::query()->paginate(8);

<<<<<<< HEAD
        // Lấy danh sách các bàn
        $tables = Table::all();
        $orders = Order::with(['reservation', 'staff', 'tables', 'orderItems', 'customer'])->get();
        $dishes = Dishes::all();


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
        //lấy  danh sách đơn đặt bàn đã được xác nhận
        $reservations = Reservation::where('status', 'Confirmed')->paginate(5);
        // Truyền dữ liệu tới view
        return view('pos.index', [
            'tables' => $tables,
            'order' => $orders,
            'dishes' => $dishes,
            'upcomingReservations' => $upcomingReservations,
            'lateReservations' => $lateReservations,
            'availableTables' => $availableTables,
            'availableTablesCount' => Table::query()->where('status', 'available')->count(),
            'reservedTablesCount' => Table::query()->where('status', 'reserved')->count(),
            'occupiedTablesCount' => Table::query()->where('status', 'occupied')->count(),
            'totalTablesCount' => $tables->count(),
            'reservations' => $reservations,
        ]);
=======
        // Trả về view cùng với dữ liệu bàn và món ăn
        return view('pos.index', compact('tables', 'dishes', 'availableTablesCount', 'reservedTablesCount', 'occupiedTablesCount', 'totalTablesCount'));
>>>>>>> 5cc51a89bb95b5109df530d2307b9d681decb08e
    }

    // Tạo đơn hàng
    public function createOrder($id)
    {
        $table = Table::findOrFail($id);
        $order = Order::create([
            'table_id' => $id,
            'status' => 'pending',
            'total_amount' => 0,
            'discount_amount' => 0,
            'final_amount' => 0,
        ]);
        $order->tables()->attach(
            $id,
            ['start_time' => now()]
        );
        $table->update(['status' => 'Occupied']);
        $tables = Table::all();
        broadcast(new MessageSent($tables))->toOthers();
        return response()->json([
            'success' => 'success',
            'order' => $order->id,
            'table_number' => $table->table_number,
            'table_status' => $table->status,
        ]);
<<<<<<< HEAD
    }


    // Thêm món vào order_items
    public function addDishToOrder(Request $request)
    {
        $orderId = Table::findOrFail($request->table_id)->orders['0']->id;
        $order = Order::findOrFail($orderId);
        $dish = Dishes::findOrFail($request->dish_id);
        // Kiểm tra món đã có trong đơn hàng chưa
        $existingOrderItem = OrderItem::where('order_id', $orderId)
            ->where('item_id', $request->dish_id)
            ->where('item_type', '1')
            ->first();

        // Cập nhật hoặc thêm món vào đơn hàng
        if ($existingOrderItem) {
            // Nếu món đã tồn tại, cập nhật số lượng và tổng giá
            $existingOrderItem->quantity += 1; // Cộng dồn số lượng
            $existingOrderItem->total_price = $existingOrderItem->quantity * $existingOrderItem->price; // Cập nhật tổng giá
            $existingOrderItem->save();  // Lưu cập nhật vào cơ sở dữ liệu
            $order->total_amount += $existingOrderItem->price;
            $order->save();
        } else {
            // Nếu món chưa có trong đơn hàng, thêm món mới vào
            $existingOrderItem = OrderItem::create([
                'order_id' => $orderId,
                'item_id' => $request->dish_id,
                'item_type' => '1',
                'quantity' => 1,
                'price' => $dish->price,
                'total_price' => $dish->price,
                'status' => 'chờ cung ứng',
            ]);
            $order->total_amount += $existingOrderItem->price;
            $order->save();
        }

        // Cập nhật tổng số tiền của đơn hàng
        $order->total_amount += ($dish->price * $request->quantity); // Cập nhật tổng số tiền
        $order->final_amount = $order->total_amount; // Cập nhật tổng tiền cuối cùng
        $order->save();  // Lưu đơn hàng vào cơ sở dữ liệu
        $tables = Table::all();
        broadcast(new MessageSent($tables))->toOthers();
        $order = Order::findOrFail($orderId);
        $orderItems = Order::with(['orderItems', 'orderItems.dish'])->findOrFail($orderId);
        $tableId = Table::with('orders')->findOrFail($request->table_id);
        broadcast(new PosTableUpdated($order, $orderItems, $tableId))->toOthers();
        return response()->json([
            'success' => true,
        ]);

    }




=======

        try {
            // Tìm bàn
            $table = Table::findOrFail($request->table_id);

            // Kiểm tra trạng thái của bàn
            if ($table->status == 'occupied' || $table->status == 'reserved') {
                return response()->json([
                    'success' => false,
                    'message' => 'Bàn này đang sử dụng hoặc đã được đặt trước. Không thể tạo thêm đơn hàng.',
                ], 400); // 400: Bad Request
            }

            // Kiểm tra xem bàn đã có đơn hàng chưa (trạng thái pending hoặc in-progress)
            $existingOrder = Order::where('table_id', $table->id)
                ->whereIn('status', ['pending', 'in-progress'])
                ->first();

            if ($existingOrder) {
                return response()->json([
                    'success' => false,
                    'message' => 'Bàn này đã có đơn hàng đang hoạt động. Không thể tạo thêm đơn hàng mới.',
                ], 400); // 400: Bad Request
            }

            // Tạo đơn hàng mới nếu chưa có đơn nào và bàn đang trống
            $order = Order::create([
                'table_id' => $table->id,
                'status' => 'pending',
                'total_amount' => 0,
                'discount_amount' => 0,
                'final_amount' => 0,
            ]);

            // Cập nhật trạng thái của bàn thành "reserved"
            $table->status = 'reserved';
            $table->save(); // Lưu lại thay đổi

            return response()->json([
                'success' => true,
                'order' => $order,
                'table_number' => $table->table_number,
                'table_status' => $table->status // Trả về trạng thái bàn mới
            ]);
        } catch (\Exception $e) {
            Log::error('Lỗi khi tạo đơn hàng: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Đã xảy ra lỗi khi tạo đơn hàng.',
            ], 500); // 500: Internal Server Error
        }
    }



    // Thêm món vào order_items
    public function addDishToOrder(Request $request)
    {
        Log::info('Dữ liệu nhận được từ frontend: ', $request->all());

        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'dish_id' => 'required|exists:dishes,id',
            'quantity' => 'required|integer|min:1',
        ]);

        try {
            $order = Order::findOrFail($request->order_id);
            $dish = Dishes::findOrFail($request->dish_id);

            // Kiểm tra món đã có trong đơn hàng hay chưa
            $existingOrderItem = OrderItem::where('order_id', $order->id)
                ->where('item_id', $dish->id)
                ->where('item_type', 'dish')
                ->first();

            if ($existingOrderItem) {
                Log::info('Cập nhật số lượng món đã tồn tại trong đơn hàng.');
                $existingOrderItem->quantity += $request->quantity;
                $existingOrderItem->total_price = $existingOrderItem->quantity * $existingOrderItem->price;
                $existingOrderItem->save();
            } else {
                Log::info('Thêm món mới vào đơn hàng.');
                $orderItem = OrderItem::create([
                    'order_id' => $order->id,
                    'item_id' => $dish->id,
                    'item_type' => 'dish',
                    'quantity' => $request->quantity,
                    'price' => $dish->price,
                    'total_price' => $dish->price * $request->quantity,
                    'status' => 'preparing',
                ]);
            }

            // Cập nhật tổng số tiền của đơn hàng
            $order->total_amount += ($dish->price * $request->quantity);
            $order->final_amount = $order->total_amount;
            $order->save();

            Log::info("Cập nhật tổng tiền của đơn hàng: {$order->total_amount}");

            return response()->json([
                'success' => true,
                'orderItem' => $existingOrderItem ?? $orderItem,
                'totalAmount' => $order->total_amount,
            ]);
        } catch (\Exception $e) {
            Log::error('Lỗi khi thêm món vào đơn hàng: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Đã xảy ra lỗi khi thêm món vào đơn hàng.',
            ], 500);
        }
    }
>>>>>>> 5cc51a89bb95b5109df530d2307b9d681decb08e
    public function Ppayment($orderId, Request $request)
    {
        $order = Order::find($orderId);
        $reservation = Reservation::find($order->reservation_id);
        $table = Table::find($order->table_id);
        $reservation_table = OrderTable::where('reservation_id', $order->reservation_id)
            ->where('table_id', $order->table_id)
            ->first();
        $order_items = Dishes::whereIn('id', $request->order_item)->get();
        $quantity = $request->quantity;
        $price = $request->price;
        $staff_id = User::find($order->staff_id);
        $customer_id = User::find($order->customer_id);
        $total_amount = $request->total_amount;
        $order_item = $request->order_item;
        return view(
            'pos.payment',
            compact('orderId', 'order', 'reservation', 'table', 'reservation_table', 'order_items', 'quantity', 'price', 'staff_id', 'customer_id', 'total_amount', 'order_item', )
        );
    }

    // Xóa món khỏi order_items
    public function deleteDishFromOrder($orderId, $dishId)
    {
        try {
            $orderItem = OrderItem::where('order_id', $orderId)
                ->where('item_id', $dishId)
                ->where('item_type', 'dish')
                ->first();

            if (!$orderItem) {
                return response()->json([
                    'success' => false,
                    'message' => 'Món ăn không tồn tại trong đơn hàng.',
                ], 404);
            }

            // Lưu giá trị trước khi xóa để cập nhật tổng tiền
            $totalPriceToRemove = $orderItem->total_price;

            // Xóa món ăn khỏi đơn hàng
            $orderItem->delete();

            // Cập nhật tổng số tiền của đơn hàng dựa trên giá trị món vừa bị xóa
            $order = Order::findOrFail($orderId);
            $order->total_amount -= $totalPriceToRemove;
            $order->final_amount = $order->total_amount;
            $order->save();

            return response()->json([
                'success' => true,
                'message' => 'Đã xóa món khỏi đơn hàng.',
                'totalAmount' => $order->total_amount,
            ]);
        } catch (\Exception $e) {
            Log::error('Lỗi khi xóa món khỏi đơn hàng: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Đã xảy ra lỗi khi xóa món khỏi đơn hàng.',
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
    }

    // Trong PosController.php

    public function showOrderForReservedTable(Request $request)
    {
        $request->validate([
            'table_id' => 'required|exists:tables,id',
        ]);

        try {
            // Tìm bàn
            $table = Table::findOrFail($request->table_id);

            // Kiểm tra nếu trạng thái của bàn là "reserved"
            if ($table->status == 'reserved') {
                // Tìm đơn hàng đã tạo cho bàn
                $order = Order::where('table_id', $table->id)
                    ->whereIn('status', ['pending', 'in-progress', 'reserved']) // Các trạng thái hợp lệ cho đơn hàng
                    ->first();

                if ($order) {
                    // Lấy danh sách các món ăn đã được thêm vào đơn hàng
                    $orderItems = OrderItem::where('order_id', $order->id)->get();

                    // Tính tổng tiền của đơn hàng
                    $totalAmount = $orderItems->sum('total_price');

                    // Trả về phản hồi với thông tin đơn hàng và món ăn
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
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Bàn này không ở trạng thái đã đặt.',
                ], 400);
            }
        } catch (\Exception $e) {
            Log::error('Lỗi khi hiển thị đơn hàng cho bàn đã đặt: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Đã xảy ra lỗi khi hiển thị đơn hàng cho bàn đã đặt.',
            ], 500);
        }
    }



    public function getOrderForReservedTable(Request $request)
    {
        $request->validate([
            'table_id' => 'required|exists:tables,id',
        ]);

        try {
            // Tìm bàn theo ID
            $table = Table::findOrFail($request->table_id);

            // Kiểm tra trạng thái của bàn (đã đặt)
            if ($table->status == 'reserved') {
                // Tìm đơn hàng của bàn này
                $order = Order::where('table_id', $table->id)
                    ->whereIn('status', ['pending', 'reserved', 'in-progress'])
                    ->first();

                // Nếu tìm thấy đơn hàng
                if ($order) {
                    // Lấy danh sách các món ăn trong đơn hàng từ bảng order_items
                    $orderItems = OrderItem::where('order_id', $order->id)->get();

                    // Trả về dữ liệu đơn hàng và món ăn
                    return response()->json([
                        'success' => true,
                        'order' => $order,
                        'orderItems' => $orderItems,
                        'totalAmount' => $orderItems->sum('total_price'),
                    ]);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Không tìm thấy đơn hàng cho bàn này.',
                    ], 404);
                }
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Bàn này không ở trạng thái đã đặt.',
                ], 400);
            }
        } catch (\Exception $e) {
            Log::error('Lỗi khi lấy thông tin đơn hàng: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Đã xảy ra lỗi khi lấy thông tin đơn hàng.',
            ], 500);
        }
    }
    public function payment($tableNumber, Request $request)
    {
        try {
            $selectedItems = $request->input('items', []);

            if (!is_array($selectedItems) || empty($selectedItems)) {
                return back()->with('error', 'No items selected for payment.');
            }
            return view('pos.payment', compact('tableNumber', 'selectedItems'));
        } catch (\Exception $e) {
            Log::error('Error loading payment page: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return back()->with('error', 'An error occurred while navigating to the payment page.');
        }
    }
<<<<<<< HEAD

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
    public function orderDetails($id)
    {
        $table = Table::with(['orders', 'orders.orderItems', 'orders.orderItems.dish'])->find($id);
        $tableId = Table::find($id);
        $order = $table->orders->first();
        $table = Table::find($id)->orders->first();
        return response()->json([
            'success' => true,
            'order' => $table,
            'table' => $order,
            'tableId' => $tableId

        ]);
    }
    public function orderDetail($id)
    {
        $table = Table::with(['orders'])->find($id);
        $tableId = Table::find($id);
        $order = $table->orders->first();
        $table = Table::find($id)->orders->first();
        return response()->json([
            'success' => true,
            'order' => $table,
            'table' => $order,
            'tableId' => $tableId
        ]);
    }
    public function increaseQuantity(Request $request)
    {
        $orderId = Table::findOrFail($request->table_id)->orders['0']->id;
        $order = Order::findOrFail($orderId);
        $dish = Dishes::findOrFail($request->dish_id);
        // Kiểm tra món đã có trong đơn hàng chưa
        $existingOrderItem = OrderItem::where('order_id', $orderId)
            ->where('item_id', $request->dish_id)
            ->where('item_type', '1')
            ->first();

        // Cập nhật hoặc thêm món vào đơn hàng
        if ($existingOrderItem) {
            $existingOrderItem->quantity += 1;
            $existingOrderItem->total_price = $existingOrderItem->quantity * $existingOrderItem->price; // Cập nhật tổng giá
            $existingOrderItem->save();
            $order->total_amount += $existingOrderItem->price;
            $order->save();
        }

        // Cập nhật tổng số tiền của đơn hàng
        $order->total_amount += ($dish->price * $request->quantity); // Cập nhật tổng số tiền
        $order->final_amount = $order->total_amount; // Cập nhật tổng tiền cuối cùng
        $order->save();  // Lưu đơn hàng vào cơ sở dữ liệu
        $tables = Table::all();
        broadcast(new MessageSent($tables))->toOthers();
        $order = Order::findOrFail($orderId);
        $orderItems = Order::with(['orderItems', 'orderItems.dish'])->findOrFail($orderId);
        $tableId = Table::with('orders')->findOrFail($request->table_id);
        broadcast(new PosTableUpdated($order, $orderItems, $tableId))->toOthers();
        return response()->json([
            'success' => true,
        ]);

    }
    public function decreaseQuantity(Request $request)
    {
        $orderId = Table::findOrFail($request->table_id)->orders['0']->id;
        $order = Order::findOrFail($orderId);
        $dish = Dishes::findOrFail($request->dish_id);
        // Kiểm tra món đã có trong đơn hàng chưa
        $existingOrderItem = OrderItem::where('order_id', $orderId)
            ->where('item_id', $request->dish_id)
            ->where('item_type', '1')
            ->first();

        // Cập nhật hoặc thêm món vào đơn hàng
        if ($existingOrderItem) {
            $existingOrderItem->quantity -= 1;
            $existingOrderItem->total_price = $existingOrderItem->quantity * $existingOrderItem->price; // Cập nhật tổng giá
            $existingOrderItem->save();
            $order->total_amount -= $existingOrderItem->price;
            $order->save();
        }

        // Cập nhật tổng số tiền của đơn hàng
        $order->total_amount -= ($dish->price * $request->quantity); // Cập nhật tổng số tiền
        $order->final_amount = $order->total_amount; // Cập nhật tổng tiền cuối cùng
        $order->save();  // Lưu đơn hàng vào cơ sở dữ liệu
        $tables = Table::all();
        broadcast(new MessageSent($tables))->toOthers();
        $order = Order::findOrFail($orderId);
        $orderItems = Order::with(['orderItems', 'orderItems.dish'])->findOrFail($orderId);
        $tableId = Table::with('orders')->findOrFail($request->table_id);
        broadcast(new PosTableUpdated($order, $orderItems, $tableId))->toOthers();
        return response()->json([
            'success' => true,
        ]);

    }
    public function deleteItem(Request $request)
    {
        $orderId = Table::findOrFail($request->table_id)->orders['0']->id;
        $order = Order::findOrFail($orderId);
        $dish = Dishes::findOrFail($request->dish_id);
        // Kiểm tra món đã có trong đơn hàng chưa
        $existingOrderItem = OrderItem::where('order_id', $orderId)
            ->where('item_id', $request->dish_id)
            ->where('item_type', '1')
            ->first();

        // Cập nhật hoặc thêm món vào đơn hàng
        if ($existingOrderItem->status == 'đang chế biến' || $existingOrderItem->status == 'chờ cung ứng') {
            $existingOrderItem->status = 'hủy bếp';
            $existingOrderItem->status = 'hủy bếp';
        }else{
            $existingOrderItem->status = 'hủy';
        }
        $existingOrderItem->cancel_reason = $request->reason;
        $existingOrderItem->total_price = $existingOrderItem->quantity * $existingOrderItem->price; // Cập nhật tổng giá
        $existingOrderItem->save();
        $order->total_amount -= $existingOrderItem->price;
        $order->save();
        // Cập nhật tổng số tiền của đơn hàng
        $order->total_amount -= ($dish->price * $request->quantity); // Cập nhật tổng số tiền
        $order->final_amount = $order->total_amount; // Cập nhật tổng tiền cuối cùng
        $order->save();  // Lưu đơn hàng vào cơ sở dữ liệu
        $tables = Table::all();
        broadcast(new MessageSent($tables))->toOthers();
        $order = Order::findOrFail($orderId);
        $orderItems = Order::with(['orderItems', 'orderItems.dish'])->findOrFail($orderId);
        $tableId = Table::with('orders')->findOrFail($request->table_id);
        broadcast(new PosTableUpdated($order, $orderItems, $tableId))->toOthers();
        return response()->json([
            'success' => true,
        ]);
    }
=======
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
>>>>>>> 5cc51a89bb95b5109df530d2307b9d681decb08e
}



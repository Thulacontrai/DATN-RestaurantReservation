<?php

namespace App\Http\Controllers\Pos;

use App\Events\ProcessingDishes;
use App\Events\MessageSent;
use App\Events\PosTableUpdated;
use App\Events\ProvideDishes;
use App\Http\Controllers\Controller;
use App\Models\Dishes;
use App\Models\InventoryItem;
use App\Models\InventoryStock;
use App\Models\InventoryTransaction;
use App\Models\Kitchen;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Reservation;
use App\Models\Table;
use Carbon\Carbon;
use App\Models\OrdersTable;
use App\Models\Recipe;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PosController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'permission:access pos']);
    }

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

    // Trang chính của POS, hiển thị bàn và món ăn
    public function index()
    {
        // Lấy thời gian hiện tại và các mốc thời gian cần thiết
        $now = now();
        $nextHalfHour = $now->copy()->addMinutes(30);
        $fifteenMinutesAgo = $now->copy()->subMinutes(15);

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
    }


    // Thêm món vào order_items
    public function addDishToOrder(Request $request)
    {
        try {
            DB::beginTransaction();
            $reciep = Dishes::findOrFail($request->dish_id)->recipes;
            foreach ($reciep as $recipe) {
                $inventoryStock = InventoryStock::where('ingredient_id', $recipe->ingredient_id)->first();
                $inventoryStock->quantity_reserved += $recipe->quantity_need;
                if ($inventoryStock->quantity_reserved > $inventoryStock->quantity_stock) {
                    return response()->json([
                        'success' => false,
                    ]);
                }
                $inventoryStock->save();
            }
            $orderId = Table::findOrFail($request->table_id)
                ->orders
                ->where('status', 'pending')
                ->firstOrFail()
                ->id;
            $order = Order::findOrFail($orderId);
            $dish = Dishes::findOrFail($request->dish_id);
            // Kiểm tra món đã có trong đơn hàng chưa
            $existingOrderItem = OrderItem::where('order_id', $orderId)
                ->where('item_id', $request->dish_id)
                ->where('item_type', '1')
                ->where('status', '!=', 'hủy')
                ->first();

            // Cập nhật hoặc thêm món vào đơn hàng
            if ($existingOrderItem && $existingOrderItem->status != 'hủy') {
                if ($existingOrderItem->status == 'hoàn thành') {
                    $existingOrderItem->status = 'đang xử lý';
                }
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
                    'status' => 'chờ xử lý',
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
            $orderItem = OrderItem::where('order_id', $orderId)
                ->where(function ($query) {
                    $query->where('status', 'chờ xử lý')
                        ->orWhere('status', 'đang xử lý');
                })
                ->get();
            $checkoutBtn = false;
            $countItems = $orderItem->count();
            if ($countItems > 0) {
                $checkoutBtn = true;
            }
            $notiBtn = false;
            foreach ($orderItem as $item) {
                if ($item->quantity > $item->informed) {
                    $notiBtn = true;
                    break;
                } else {
                    $notiBtn = false;
                }
            }
            broadcast(new PosTableUpdated($order, $orderItems, $tableId, $notiBtn, $checkoutBtn))->toOthers();
            DB::commit();
            return response()->json([
                'success' => true,
            ]);
        } catch (Exception $e) {
            // Rollback nếu có lỗi xảy ra
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }




    public function Ppayment($tableId, Request $request)
    {
        $order = Table::findOrFail($tableId)
            ->orders
            ->where('status', 'pending')
            ->firstOrFail();
        $table = Table::find($tableId);
        $order_table = OrdersTable::where('order_id', $order->id)
            ->where('table_id', $tableId)
            ->first();
        $order_items = Order::find($order->id)
            ->orderItems
            ->where('status', '!=', 'hủy');
        $final = 0;
        return view(
            'pos.payment',
            compact('final', 'order', 'table', 'order_table', 'order_items')
        );
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


    public function reserToOrder($reservationId){
        // dd($reservationId);

        // $reservation = Reservation::with('orders')->findOrFail($reservationId);
        // $orders = $reservation->orders;
        $orders = Order::where('reservation_id', $reservationId)->get();
        // dd($orders);
        $tableIds = $orders->flatMap(function ($order) {
            return $order->tables->pluck('id');
        })->unique()->values();
        Table::whereIn('id', $tableIds)->update(['status' =>"Occupied"]);
            $tables = Table::with(['orders', 'orders.orderItems', 'orders.orderItems.dish'])
                   ->whereIn('id', $tableIds)
                   ->get();
            $order = $tables->first()->orders->first();
    
        // dd($orders,$tableIds,$tables,$order);
        
       return redirect()->route('pos.index');
        
    }
    public function orderDetails($id)
    {
        $table = Table::with(['orders', 'orders.orderItems', 'orders.orderItems.dish'])->find($id);
        $tableId = Table::find($id);
        $order = $table->orders->where('status', 'pending')->first();
        $table = Table::find($id)->orders->first();
        $orderId = Table::find($id)->orders->where('status', 'pending')->first()->id;
        $order = Order::findOrFail($orderId);
        $orderItems = Order::with(['orderItems', 'orderItems.dish'])->findOrFail($orderId);
        $tableId = Table::with('orders')->findOrFail($id);
        $orderItem = OrderItem::where('order_id', $orderId)
            ->where(function ($query) {
                $query->where('status', 'chờ xử lý')
                    ->orWhere('status', 'đang xử lý');
            })
            ->get();
        $checkoutBtn = false;
        $countItems = $orderItem->count();
        if ($countItems > 0) {
            $checkoutBtn = true;
        }
        $notiBtn = false;
        foreach ($orderItem as $item) {
            if ($item->quantity > $item->informed) {
                $notiBtn = true;
                break;
            } else {
                $notiBtn = false;
            }
        }
        broadcast(new PosTableUpdated($order, $orderItems, $tableId, $notiBtn, $checkoutBtn))->toOthers();
        return response()->json([
            'success' => true,
            'order' => $table,
            'table' => $order,
            'tableId' => $tableId

        ]);
    }
    public function increaseQuantity(Request $request)
    {
        try {
            DB::beginTransaction();
            $reciep = Dishes::findOrFail($request->dish_id)->recipes;
            foreach ($reciep as $recipe) {
                $inventoryStock = InventoryStock::where('ingredient_id', $recipe->ingredient_id)->first();
                $inventoryStock->quantity_reserved += $recipe->quantity_need;
                if ($inventoryStock->quantity_reserved > $inventoryStock->quantity_stock) {
                    return response()->json([
                        'success' => false,
                    ]);
                }
                $inventoryStock->save();
            }
            $orderId = Table::findOrFail($request->table_id)
                ->orders
                ->where('status', 'pending')
                ->firstOrFail()
                ->id;
            $order = Order::findOrFail($orderId);
            $dish = Dishes::findOrFail($request->dish_id);
            $existingOrderItem = OrderItem::where('order_id', $orderId)
                ->where('item_id', $request->dish_id)
                ->where('item_type', '1')
                ->first();

            // Cập nhật hoặc thêm món vào đơn hàng
            if ($existingOrderItem->status == 'hoàn thành') {
                $existingOrderItem->status = 'đang xử lý';
            }
            $existingOrderItem->quantity += 1;
            $existingOrderItem->total_price = $existingOrderItem->quantity * $existingOrderItem->price;
            $existingOrderItem->save();
            $order->total_amount += $existingOrderItem->price;
            $order->save();

            // Cập nhật tổng số tiền của đơn hàng
            $order->total_amount += ($dish->price * $request->quantity); // Cập nhật tổng số tiền
            $order->final_amount = $order->total_amount; // Cập nhật tổng tiền cuối cùng
            $order->save();  // Lưu đơn hàng vào cơ sở dữ liệu
            $tables = Table::all();
            broadcast(new MessageSent($tables))->toOthers();
            $order = Order::findOrFail($orderId);
            $orderItems = Order::with(['orderItems', 'orderItems.dish'])->findOrFail($orderId);
            $tableId = Table::with('orders')->findOrFail($request->table_id);
            $orderItem = OrderItem::where('order_id', $orderId)
                ->where(function ($query) {
                    $query->where('status', 'chờ xử lý')
                        ->orWhere('status', 'đang xử lý');
                })
                ->get();
            $checkoutBtn = false;
            $countItems = $orderItem->count();
            if ($countItems > 0) {
                $checkoutBtn = true;
            }
            $notiBtn = false;

            foreach ($orderItem as $item) {
                if ($item->quantity > $item->informed) {
                    $notiBtn = true;
                    break;
                } else {
                    $notiBtn = false;
                }
            }
            broadcast(new PosTableUpdated($order, $orderItems, $tableId, $notiBtn, $checkoutBtn))->toOthers();
            DB::commit();
            return response()->json([
                'success' => true,
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false
            ]);
        }

    }
    public function decreaseQuantity(Request $request)
    {
        $reciep = Dishes::findOrFail($request->dish_id)->recipes;
        foreach ($reciep as $recipe) {
            $inventoryStock = InventoryStock::where('ingredient_id', $recipe->ingredient_id)->first();
            $inventoryStock->quantity_reserved -= $recipe->quantity_need;
            $inventoryStock->save();
        }
        $orderId = Table::findOrFail($request->table_id)
            ->orders
            ->where('status', 'pending')
            ->firstOrFail()
            ->id;
        $order = Order::findOrFail($orderId);
        $dish = Dishes::findOrFail($request->dish_id);
        // Kiểm tra món đã có trong đơn hàng chưa
        $existingOrderItem = OrderItem::where('order_id', $orderId)
            ->where('item_id', $request->dish_id)
            ->where('item_type', '1')
            ->where('status', '!=', 'hủy')
            ->first();
        $existingOrderItem->quantity -= 1;
        if ($existingOrderItem->quantity == 0) {
            $existingOrderItem->status = 'hủy';
        }
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
        $orderItem = OrderItem::where('order_id', $orderId)
            ->where(function ($query) {
                $query->where('status', 'chờ xử lý')
                    ->orWhere('status', 'đang xử lý');
            })
            ->get();
        $checkoutBtn = false;
        $countItems = $orderItem->count();
        if ($countItems > 0) {
            $checkoutBtn = true;
        }

        $notiBtn = false;

        foreach ($orderItem as $item) {
            if ($item->quantity > $item->informed) {
                $notiBtn = true;
                break;
            } else {
                $notiBtn = false;
            }
        }
        broadcast(new PosTableUpdated($order, $orderItems, $tableId, $notiBtn, $checkoutBtn))->toOthers();
        return response()->json([
            'success' => true,
        ]);

    }
    public function canelItem(Request $request)
    {
        DB::transaction(function () use ($request) {
            $reciep = Dishes::findOrFail($request->dish_id)->recipes;
            foreach ($reciep as $recipe) {
                $inventoryStock = InventoryStock::where('ingredient_id', $recipe->ingredient_id)->first();
                $inventoryStock->quantity_reserved -= $recipe->quantity_need;
                $inventoryStock->save();
            }
            $orderId = $request->dishOrder;
            $order = Order::findOrFail($orderId);
            $dish = Dishes::findOrFail($request->dish_id);
            // Kiểm tra món đã có trong đơn hàng chưa
            $existingOrderItem = OrderItem::where('order_id', $orderId)
                ->where('item_id', $request->dish_id)
                ->where('item_type', '1')
                ->where('status', '!=', 'hủy')
                ->first();
            if ($existingOrderItem->quantity == 1) {
                $existingOrderItem->status = 'hủy';
                $existingOrderItem->cancel_reason = $request->reason;
            } else {
                $newRecord = $existingOrderItem->replicate();
                $newRecord->status = 'hủy';
                $newRecord->quantity = 1;
                $newRecord->cancel_reason = $request->reason;
                $newRecord->save();
            }
            $existingOrderItem->quantity = $existingOrderItem->quantity - 1;
            $existingOrderItem->total_price = $existingOrderItem->quantity * $existingOrderItem->price; // Cập nhật tổng giá
            $existingOrderItem->save();

            $kitchens = Kitchen::where('item_id', $request->dish_id)
                ->where('order_id', $orderId)
                ->get();
            $processed = false;
            foreach ($kitchens as $kitchen) {
                if ($kitchen->status == 'đang chế biến' && $kitchen->quantity > 0) {
                    $kitchen->count_cancel += 1;
                    $kitchen->quantity -= 1;
                    $kitchen->save();
                    $processed = true;
                    break;
                }
            }
            if (!$processed) {
                foreach ($kitchens as $kitchen) {
                    if ($kitchen->status == 'chờ cung ứng' && $kitchen->quantity > 0) {
                        $kitchen->count_cancel += 1;
                        $kitchen->quantity -= 1;
                        $kitchen->save();
                        break;
                    }
                }
            }

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
            $orderItem = OrderItem::where('order_id', $orderId)
                ->where(function ($query) {
                    $query->where('status', 'chờ xử lý')
                        ->orWhere('status', 'đang xử lý');
                })
                ->get();
            $checkoutBtn = false;
            $countItems = $orderItem->count();
            if ($countItems > 0) {
                $checkoutBtn = true;
            }

            $notiBtn = false;

            foreach ($orderItem as $item) {
                if ($item->quantity > $item->informed) {
                    $notiBtn = true;
                    break;
                } else {
                    $notiBtn = false;
                }
            }
            broadcast(new PosTableUpdated($order, $orderItems, $tableId, $notiBtn, $checkoutBtn))->toOthers();
            $items = Kitchen::where('status', 'đang chế biến')
                ->with(['dish', 'order.tables'])
                ->get();
            $items1 = Kitchen::where('status', 'chờ cung ứng')
                ->with(['dish', 'order.tables'])
                ->get();
            broadcast(new ProcessingDishes($items, null))->toOthers();
            broadcast(new ProvideDishes($items1))->toOthers();
        });
        return response()->json([
            'success' => true,
        ]);
    }
    public function deleteItem(Request $request)
    {
        DB::transaction(function () use ($request) {

            $orderId = Table::findOrFail($request->table_id)
                ->orders
                ->where('status', 'pending')
                ->firstOrFail()
                ->id;
            $order = Order::findOrFail($orderId);
            $dish = Dishes::findOrFail($request->dish_id);
            // Kiểm tra món đã có trong đơn hàng chưa
            $existingOrderItem = OrderItem::where('order_id', $orderId)
                ->where('item_id', $request->dish_id)
                ->where('item_type', '1')
                ->where('status', '!=', 'hủy')
                ->first();
            $existingOrderItem->status = 'hủy';
            $existingOrderItem->cancel_reason = $request->reason;
            $existingOrderItem->total_price = $existingOrderItem->quantity * $existingOrderItem->price; // Cập nhật tổng giá
            $existingOrderItem->save();
            $reciep = Dishes::findOrFail($request->dish_id)->recipes;
            foreach ($reciep as $recipe) {
                $inventoryStock = InventoryStock::where('ingredient_id', $recipe->ingredient_id)->first();
                $inventoryStock->quantity_reserved -= $recipe->quantity_need * $existingOrderItem->quantity;
                $inventoryStock->save();
            }

            $kitchens = Kitchen::where('item_id', $request->dish_id)
                ->where('order_id', $orderId)
                ->get();
            foreach ($kitchens as $kitchen) {
                $kitchen->count_cancel = $kitchen->quantity;
                $kitchen->quantity = 0;
                $kitchen->save();
            }

            $order->total_amount -= $existingOrderItem->total_price;
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
            $orderItem = OrderItem::where('order_id', $orderId)
                ->where(function ($query) {
                    $query->where('status', 'chờ xử lý')
                        ->orWhere('status', 'đang xử lý');
                })
                ->get();
            $checkoutBtn = false;
            $countItems = $orderItem->count();
            if ($countItems > 0) {
                $checkoutBtn = true;
            }
            $notiBtn = false;
            foreach ($orderItem as $item) {
                if ($item->quantity > $item->informed) {
                    $notiBtn = true;
                    break;
                } else {
                    $notiBtn = false;
                }
            }
            broadcast(new PosTableUpdated($order, $orderItems, $tableId, $notiBtn, $checkoutBtn))->toOthers();
            $items = Kitchen::where('status', 'đang chế biến')
                ->with(['dish', 'order.tables'])
                ->get();
            $items1 = Kitchen::where('status', 'chờ cung ứng')
                ->with(['dish', 'order.tables'])
                ->get();
            broadcast(new ProcessingDishes($items, null))->toOthers();
            broadcast(new ProvideDishes($items1))->toOthers();
        });
        return response()->json([
            'success' => true,
        ]);
    }
    public function notificatioButton($table_id)
    {
        DB::transaction(function () use ($table_id) {
            $orderId = Table::findOrFail($table_id)
                ->orders
                ->where('status', 'pending')
                ->firstOrFail()
                ->id;
            $order = Order::findOrFail($orderId)->orderItems;
            foreach ($order as $item) {
                if ($item->status == 'chờ xử lý') {
                    $reciep = Dishes::findOrFail($item->item_id)->recipes;
                    foreach ($reciep as $recipe) {
                        $inventoryStock = InventoryStock::where('ingredient_id', $recipe->ingredient_id)->first();
                        $inventoryStock->quantity_reserved -= $recipe->quantity_need * $item->quantity;
                        $inventoryStock->quantity_stock -= $recipe->quantity_need * $item->quantity;
                        $inventoryStock->save();
                        $inventoryTransaction = InventoryTransaction::create([
                            'transaction_type' => 'xuất',
                            'total_amount' => $recipe->quantity_need * $item->quantity * $recipe->ingredient->price,
                            'description' => 'Xuất nguyên liệu chế biến món',
                            'status' => 'hoàn thành'
                        ]);
                        $inventoryItems = InventoryItem::create([
                            'ingredient_id' => $recipe->ingredient_id,
                            'inventory_transaction_id' => $inventoryTransaction->id,
                            'quantity' => $recipe->quantity_need * $item->quantity
                        ]);
                    }
                    $item->status = 'đang xử lý';
                    $item->informed = $item->quantity;
                    $item->save();
                    $items = Kitchen::create(
                        [
                            'order_id' => $orderId,
                            'item_id' => $item->item_id,
                            'item_type' => $item->item_type,
                            'quantity' => $item->quantity,
                            'updated_at' => now()
                        ]
                    );
                }
                if ($item->status == 'đang xử lý' && $item->informed < $item->quantity) {
                    $reciep = Dishes::findOrFail($item->item_id)->recipes;
                    foreach ($reciep as $recipe) {
                        $inventoryStock = InventoryStock::where('ingredient_id', $recipe->ingredient_id)->first();
                        $inventoryStock->quantity_reserved -= $recipe->quantity_need * ($item->quantity - $item->informed);
                        $inventoryStock->quantity_stock -= $recipe->quantity_need * ($item->quantity - $item->informed);
                        $inventoryStock->save();
                        $inventoryTransaction = InventoryTransaction::create([
                            'transaction_type' => 'xuất',
                            'total_amount' => $recipe->quantity_need * ($item->quantity - $item->informed) * $recipe->ingredient->price,
                            'description' => 'Xuất nguyên liệu chế biến món',
                            'status' => 'hoàn thành'
                        ]);
                        $inventoryItems = InventoryItem::create([
                            'ingredient_id' => $recipe->ingredient_id,
                            'inventory_transaction_id' => $inventoryTransaction->id,
                            'quantity' => $recipe->quantity_need * ($item->quantity - $item->informed)
                        ]);
                    }
                    $items = Kitchen::create(
                        [
                            'order_id' => $orderId,
                            'item_id' => $item->item_id,
                            'item_type' => $item->item_type,
                            'quantity' => $item->quantity - $item->informed,
                            'updated_at' => now()
                        ]
                    );
                    $item->status = 'đang xử lý';
                    $item->informed = $item->quantity;
                    $item->save();
                }
            }
            $order = Order::findOrFail($orderId);
            $orderItems = Order::with(['orderItems', 'orderItems.dish'])->findOrFail($orderId);
            $tableId = Table::with('orders')->findOrFail($table_id);
            $orderItem = OrderItem::where('order_id', $orderId)
                ->where(function ($query) {
                    $query->where('status', 'chờ xử lý')
                        ->orWhere('status', 'đang xử lý');
                })
                ->get();
            $checkoutBtn = false;
            $countItems = $orderItem->count();
            if ($countItems > 0) {
                $checkoutBtn = true;
            }
            $notiBtn = false;
            foreach ($orderItem as $item) {
                if ($item->quantity > $item->informed) {
                    $notiBtn = true;
                    break;
                } else {
                    $notiBtn = false;
                }
            }
            broadcast(new PosTableUpdated($order, $orderItems, $tableId, $notiBtn, $checkoutBtn))->toOthers();
            $items = Kitchen::where('status', 'đang chế biến')
                ->with(['dish', 'order.tables'])
                ->get();
            broadcast(new ProcessingDishes($items, "Bàn $tableId->table_number gửi yêu cầu chế biến"))->toOthers();
        });
        return response()->json(['status' => 'success']);
    }
}

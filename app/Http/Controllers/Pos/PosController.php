<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
<<<<<<< HEAD
=======
use App\Models\Category;
use App\Models\Combo;
>>>>>>> fc0a73e868cae2bc1cd6f1a65f303c2818b17a88
use App\Models\Dishes;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Table;
<<<<<<< HEAD
=======
use App\Models\Payment;
use App\Models\Reservation;
use App\Models\ReservationTable;
use App\Models\User;
>>>>>>> fc0a73e868cae2bc1cd6f1a65f303c2818b17a88
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PosController extends Controller
{
    // Trang chính của POS, hiển thị bàn và món ăn
    public function index()
    {
        // Lấy tất cả các bàn
        $tables = Table::all();

        // Lấy các món ăn với phân trang (8 món mỗi trang)
        $dishes = Dishes::paginate(8);

        // Trả về view cùng với dữ liệu bàn và món ăn
        return view('pos.index', compact('tables', 'dishes'));
    }

<<<<<<< HEAD
    // API để tạo đơn hàng mới
    public function createOrder(Request $request)
=======





    public function orders()
    {
        return $this->hasMany(Order::class);
    }




    public function Pmenu($tableNumber)
>>>>>>> fc0a73e868cae2bc1cd6f1a65f303c2818b17a88
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'table_id' => 'required|exists:tables,id',
        ]);

        try {
            // Tìm bàn theo table_id
            $table = Table::findOrFail($request->table_id);

            // Tạo đơn hàng mới
            $order = Order::create([
                'table_id' => $request->table_id,
                'status' => 'pending',
                'total_amount' => 0,
                'discount_amount' => 0,
                'final_amount' => 0,
            ]);

            Log::info('Đơn hàng mới đã được tạo cho bàn: ' . $table->table_number);

            return response()->json([
                'success' => true,
                'order' => $order,
                'table_number' => $table->table_number,
            ]);

        } catch (\Exception $e) {
            Log::error('Lỗi khi tạo đơn hàng: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Đã xảy ra lỗi khi tạo đơn hàng.',
            ], 500);
        }
    }

<<<<<<< HEAD
    // API để thêm món vào order_items
    public function addDishToOrder(Request $request)
    {
        // Ghi lại dữ liệu từ request
        Log::info('Dữ liệu nhận được từ frontend: ', $request->all());

        // Xác thực dữ liệu đầu vào
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'dish_id' => 'required|exists:dishes,id',
            'quantity' => 'required|integer|min:1',
        ]);

        try {
            $order = Order::findOrFail($request->order_id);
            $dish = Dishes::findOrFail($request->dish_id);

            // Kiểm tra món ăn đã tồn tại trong order hay chưa
            $existingOrderItem = OrderItem::where('order_id', $order->id)
                                          ->where('item_id', $dish->id)
                                          ->where('item_type', 'dish')
                                          ->first();

            if ($existingOrderItem) {
                Log::info('Cập nhật số lượng món đã tồn tại trong đơn hàng.');
                // Cập nhật số lượng và tổng tiền nếu món đã có trong đơn hàng
                $existingOrderItem->quantity += $request->quantity;
                $existingOrderItem->total_price = $existingOrderItem->quantity * $existingOrderItem->price;
                $existingOrderItem->save();
            } else {
                Log::info('Thêm món mới vào đơn hàng.');
                // Thêm món mới vào order_items nếu chưa có
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
            $order->total_amount = OrderItem::where('order_id', $order->id)->sum('total_price');
            $order->final_amount = $order->total_amount;
            $order->save();

            Log::info('Cập nhật tổng tiền của đơn hàng: ', ['total_amount' => $order->total_amount]);

            return response()->json([
                'success' => true,
                'orderItem' => $existingOrderItem ?? $orderItem, // Trả về món đã được cập nhật hoặc món mới
                'totalAmount' => $order->total_amount,
            ]);

        } catch (\Exception $e) {
            Log::error('Lỗi khi thêm món vào đơn hàng: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Đã xảy ra lỗi khi thêm món vào đơn hàng.',
            ], 500);
        }
=======
    public function Ppayment($orderId, Request $request)
    {
        $order = Order::find($orderId);
        $reservation = Reservation::find($order->reservation_id);
        $table = Table::find($order->table_id);
        $reservation_table = ReservationTable::where('reservation_id', $order->reservation_id)
            ->where('table_id', $order->table_id)
            ->first();
        $order_items = Dishes::whereIn('id', $request->order_item)->get();
        $staff_id = User::find($order->staff_id);
        $customer_id = User::find($order->customer_id);
        $total_amount = $request->total_amount;
        $order_item = $request->order_item;
        return view(
            'pos.payment',
            compact('orderId', 'order', 'reservation', 'table', 'reservation_table', 'order_items', 'staff_id', 'customer_id', 'total_amount', 'order_item', )
        );
>>>>>>> fc0a73e868cae2bc1cd6f1a65f303c2818b17a88
    }
}

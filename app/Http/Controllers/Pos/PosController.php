<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use App\Models\Dishes;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Reservation;
use App\Models\ReservationTable;
use App\Models\Table;
use App\Models\User;
use Illuminate\Http\Request;
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

    // Trang chính của POS, hiển thị bàn và món ăn

 

    public function index()
    {
        $tables = Table::all();
        $availableTablesCount = Table::where('status', 'available')->count();
        $reservedTablesCount = Table::where('status', 'reserved')->count();
        $occupiedTablesCount = Table::where('status', 'occupied')->count();
        $totalTablesCount = Table::count();
        
        $dishes = Dishes::query()->paginate(8);

        // Trả về view cùng với dữ liệu bàn và món ăn
        return view('pos.index', compact('tables', 'dishes', 'availableTablesCount', 'reservedTablesCount', 'occupiedTablesCount', 'totalTablesCount'));
    }

    // Tạo đơn hàng
    public function createOrder(Request $request)
    {
        $request->validate([
            'table_id' => 'required|exists:tables,id',
        ]);

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
    public function Ppayment($orderId, Request $request)
    {
        $order = Order::find($orderId);
        $reservation = Reservation::find($order->reservation_id);
        $table = Table::find($order->table_id);
        $reservation_table = ReservationTable::where('reservation_id', $order->reservation_id)
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



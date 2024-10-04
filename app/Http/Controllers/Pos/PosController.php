<?php
namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Combo;
use App\Models\Dishes;
use App\Models\Order;
use App\Models\Table;
use App\Models\Payment;
use App\Models\Reservation;
use App\Models\ReservationTable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PosController extends Controller
{
    public function index(Request $request)
    {
        // Fetch all tables along with their associated orders
        $tables = Table::with('orders')->get();

        // Loop through each table and calculate the total price of the order and deposit
        foreach ($tables as $table) {
            // Initialize total_price and deposit for each table
            $totalPrice = 0;
            $deposit = 0;

            // Check if the table has any orders
            if ($table->orders->isNotEmpty()) {
                foreach ($table->orders as $order) {
                    $totalPrice += $order->quantity * $order->price;
                }
            }

            // // Set total price for the table
            // $table->total_price = $totalPrice;

            // Calculate deposit (100,000 VND per guest)
            if (isset($table->guests) && $table->guests > 0) {
                $deposit = $table->guests * 100000;
            }

            // // Set the deposit for the table
            // $table->deposit = $deposit;
        }

        // Return the view with the tables and associated data
        return view('pos.index', compact('tables'));
    }






    public function orders()
    {
        return $this->hasMany(Order::class);
    }




    public function Pmenu($tableNumber)
    {
        try {
            $tableInfo = Table::where('table_number', $tableNumber)->first();
            if (!$tableInfo) {
                return back()->with('error', 'Table not found.');
            }

            $tableType = $tableInfo->type;
            $tableArea = $tableInfo->area;

            // Fetch categories and dishes from cache
            $categories = Cache::remember('categories_with_dishes', 60, function () {
                return Category::with('dishes')->get();
            });

            // Organize categories and their dishes
            $groupedCategories = $categories->mapWithKeys(function ($category) {
                return [
                    $category->name => $category->dishes->map(function ($dish) {
                        return [
                            'name' => $dish->name,
                            'price' => $dish->price,
                            'image' => $dish->image ?? asset('path/to/default-image.jpg'),
                        ];
                    })
                ];
            });

            // Fetch and add combos to categories
            $combos = Cache::remember('combos', 60, function () {
                return Combo::all()->map(function ($combo) {
                    return [
                        'name' => $combo->name,
                        'price' => $combo->price,
                        'image' => $combo->image ?? asset('path/to/default-combo-image.jpg'),
                    ];
                });
            });

            $groupedCategories['Combo'] = $combos;

            return view('pos.menu', [
                'table' => $tableNumber,
                'tableType' => $tableType,
                'tableArea' => $tableArea,
                'categories' => $groupedCategories
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching menu in PosController: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return back()->with('error', 'An error occurred while loading the menu. Please try again.');
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
        $staff_id = User::find($order->staff_id);
        $customer_id = User::find($order->customer_id);
        $total_amount = $request->total_amount;
        $order_item = $request->order_item;
        return view(
            'pos.payment',
            compact('orderId', 'order', 'reservation', 'table', 'reservation_table', 'order_items', 'staff_id', 'customer_id', 'total_amount', 'order_item', )
        );
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

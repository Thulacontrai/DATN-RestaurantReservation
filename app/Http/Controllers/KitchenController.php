<?php

namespace App\Http\Controllers;

use App\Events\PosTableUpdated;
use App\Events\PosTableUpdatedWithNoti;
use App\Events\ProcessingDishes;
use App\Events\ProvideDishes;
use App\Models\Dishes;
use App\Models\Kitchen;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Scalar\MagicConst\Dir;

class KitchenController extends Controller
{
    public function index()
    {
        $items = Kitchen::where('status', 'đang chế biến')
            ->with(['dish', 'order.tables'])
            ->get();
        $items1 = Kitchen::where('status', 'chờ cung ứng')
            ->with(['dish', 'order.tables'])
            ->get();
        return view("kitchen.index", compact("items", "items1"));
    }
    public function cookAll($id)
    {
        DB::transaction(function () use ($id) {
            $item = Kitchen::find($id);
            $item->status = 'chờ cung ứng';
            $item->save();
            $items = Kitchen::where('status', 'đang chế biến')
                ->with(['dish', 'order.tables'])
                ->get();
            $items1 = Kitchen::where('status', 'chờ cung ứng')
                ->with(['dish', 'order.tables'])
                ->get();
            broadcast(new ProcessingDishes($items, null))->toOthers();
            broadcast(new ProvideDishes($items1))->toOthers();
        });
        return response()->json(['status' => 'success']);
    }
    public function doneAll($id, Request $request)
    {
        DB::transaction(function () use ($id, $request) {
            $item = Kitchen::find($id);
            $item->status = 'hoàn thành';
            $orderItem = $item->order->orderItems()
                ->where('item_id', $item->item_id)
                ->where('status', '!=', 'hủy')
                ->first();
            if ($orderItem) {
                $orderItem->completed += $item->quantity;
                if ($orderItem->completed == $orderItem->quantity) {
                    $orderItem->status = 'hoàn thành';
                }
                $orderItem->save();
            }
            $item->save();
            $item = Kitchen::find($id);
            $order = Order::findOrFail($item->order->id);
            $orderItems = Order::with(['orderItems', 'orderItems.dish'])->findOrFail($item->order->id);
            $itemName = $item->dish->name;
            $tableId = Table::with('orders')->findOrFail($request->tableId);
            $orderId = Table::findOrFail($request->tableId)
                ->orders
                ->where('status', 'pending')
                ->firstOrFail()
                ->id;
            $orderItem = OrderItem::where('order_id', $orderId)
                ->where(function ($query) {
                    $query->where('status', 'chờ xử lý')
                        ->orWhere('status', 'đang xử lý');
                })
                ->get();
            $notiBtn = false;
            foreach ($orderItem as $item) {
                if ($item->quantity > $item->informed) {
                    $notiBtn = true;
                    break;
                } else {
                    $notiBtn = false;
                }
            }
            broadcast(new PosTableUpdatedWithNoti($order, $orderItems, $tableId, $notiBtn, "Bàn $tableId->table_number đã được cung ứng món $itemName"))->toOthers();
            $items1 = Kitchen::where('status', 'chờ cung ứng')
                ->with(['dish', 'order.tables'])
                ->get();
            broadcast(new ProvideDishes($items1))->toOthers();
        });
        return response()->json(['status' => 'success']);
    }
    public function delete($id)
    {
        DB::transaction(function () use ($id) {
            $item = Kitchen::find($id);
            $item->delete();
            $items = Kitchen::where('status', 'đang chế biến')
                ->with(['dish', 'order.tables'])
                ->get();
            $items1 = Kitchen::where('status', 'chờ cung ứng')
                ->with(['dish', 'order.tables'])
                ->get();
            broadcast(new ProcessingDishes($items, null))->toOthers();
            broadcast(new ProvideDishes($items1))->toOthers();
        });
        return response()->json(['status' => 'success']);
    }
}

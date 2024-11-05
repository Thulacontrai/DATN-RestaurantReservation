<?php

namespace App\Http\Controllers;

use App\Events\KitchenUpdated;
use App\Models\Dishes;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Scalar\MagicConst\Dir;

class KitchenController extends Controller
{
    public function index()
    {
        $items = OrderItem::where('status', 'đang chế biến')
            ->orWhere('status', 'chờ cung ứng')
            ->with(['dish', 'order.table'])
            ->get();
        return view("kitchen.index", compact("items"));
    }
    public function cookAll($id)
    {
        $item = OrderItem::find($id);
        if ($item) {
            $item->status = 'chờ cung ứng';
            $item->save();
            $items = OrderItem::whereIn('status', ['đang chế biến', 'chờ cung ứng'])
                ->with(['dish', 'order.table'])
                ->get();
            broadcast(new KitchenUpdated($items))->toOthers();
            return response()->json(['status' => 'success']);
        }
        return response()->json(['status' => 'error', 'message' => 'Item không tồn tại'], 404);
    }
    public function doneAll($id)
    {
        $item = OrderItem::find($id);
        if ($item) {
            $item->status = 'hoàn thành';
            $item->save();
            $items = OrderItem::whereIn('status', ['đang chế biến', 'chờ cung ứng'])
                ->with(['dish', 'order.table'])
                ->get();
            broadcast(new KitchenUpdated($items))->toOthers();
            return response()->json(['status' => 'success']);
        }
        return response()->json(['status' => 'error', 'message' => 'Item không tồn tại'], 404);
    }
}
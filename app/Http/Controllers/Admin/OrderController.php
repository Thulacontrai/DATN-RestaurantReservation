<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('admin.order.index', compact('orders'));
    }

    public function create()
    {
        return view('admin.order.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'reservation_id' => 'required|integer|exists:reservations,id',
            'staff_id' => 'required|integer|exists:users,id',
            'table_id' => 'required|integer|exists:tables,id',
            'total_amount' => 'required|numeric',
            'final_amount' => 'required|numeric',
            'status' => 'required|in:Completed,Pending,Cancelled',
        ]);

        Order::create($validated);

        return redirect()->route('admin.order.index')->with('success', 'Đơn hàng đã được thêm thành công.');
    }

    public function show(Order $order)
    {
        return view('admin.order.detail', compact('order'));
    }

    public function edit(Order $order)
    {
        return view('admin.order.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'reservation_id' => 'required|integer',
            'staff_id' => 'required|integer',
            'table_id' => 'nullable|integer',
            'customer_id' => 'nullable|integer',
            'total_amount' => 'required|numeric',
            'order_type' => 'required|in:dine_in,take_away,delivery',
            'status' => 'required|in:pending,completed,cancelled',
            'discount_amount' => 'nullable|numeric',
            'final_amount' => 'required|numeric',
        ]);

        $order->update($validated);
        return redirect()->route('admin.order.index')->with('success', 'Order updated successfully.');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.order.index')->with('success', 'Order deleted successfully.');
    }
}

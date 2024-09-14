<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Traits\TraitCRUD;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    use TraitCRUD;

    protected $model = Order::class;
    protected $viewPath = 'admin.order';
    protected $routePath = 'admin.order';

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

    public function show($id)
    {
        $order = Order::with(['staff', 'reservation', 'table', 'customer'])->findOrFail($id);
        return view('admin.order.show', compact('order'));
    }

    public function edit(Order $order)
    {
        return view('admin.order.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'reservation_id' => 'required|integer|exists:reservations,id',
            'staff_id' => 'required|integer|exists:users,id',
            'table_id' => 'nullable|integer|exists:tables,id',
            'total_amount' => 'required|numeric|min:0',
            'final_amount' => 'required|numeric|min:0',
            'status' => 'required|in:Completed,Pending,Cancelled',
        ]);

        $order->update($validated);

        return redirect()->route('admin.order.index')->with('success', 'Đơn hàng đã được cập nhật thành công.');
    }


    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.order.index')->with('success', 'Order deleted successfully.');
    }
}

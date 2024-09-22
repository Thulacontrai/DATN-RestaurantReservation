<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Traits\TraitCRUD;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        // Gán middleware cho các phương thức
        $this->middleware('permission:Xem order', ['only' => ['index']]);
        $this->middleware('permission:Tạo mới order', ['only' => ['create']]);
        $this->middleware('permission:Sửa order', ['only' => ['edit']]);
        $this->middleware('permission:Xóa order', ['only' => ['destroy']]);
        
    }

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

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        if ($order->status == 'Pending') {
            return redirect()->route('admin.order.index')->with('error', 'Không thể xóa đơn hàng đang trong trạng thái Đang xử lý. Vui lòng thực hiện thao tác khác.');
        }

        $order->delete();

        return redirect()->route('admin.order.index')->with('success', 'Đơn hàng đã được xóa thành công.');
    }


    public function trash()
    {
        $orders = Order::onlyTrashed()->paginate(10);
        return view('admin.order.trash', compact('orders'));
    }

    public function restore($id)
    {
        $order = Order::withTrashed()->findOrFail($id);
        $order->restore();

        return redirect()->route('admin.order.trash')->with('success', 'Đơn hàng đã được khôi phục thành công.');
    }

    public function forceDelete($id)
    {
        $order = Order::withTrashed()->findOrFail($id);
        $order->forceDelete();

        return redirect()->route('admin.order.trash')->with('success', 'Đơn hàng đã được xóa vĩnh viễn.');
    }
}

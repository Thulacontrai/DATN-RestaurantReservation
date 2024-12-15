<?php

namespace App\Http\Controllers\Admin;

use App\Events\MenuOrderUpdateItem;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Combo;
use App\Models\Dishes;
use App\Models\Order;
use App\Models\Table;
use App\Traits\TraitCRUD;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

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

    public function index(Request $request)
    {
        $title = 'Hóa Đơn';
        // Lấy tham số sort, direction, id, và status từ request
        $sort = $request->input('sort', 'id');
        $direction = $request->input('direction', 'desc');
        $id = $request->input('id');
        $status = $request->input('status');

        // Xác nhận cột sắp xếp hợp lệ
        $allowedSorts = ['id', 'reservation_id', 'total_amount', 'final_amount'];
        $sort = in_array($sort, $allowedSorts) ? $sort : 'id';

        // Xác nhận thứ tự sắp xếp hợp lệ
        $direction = in_array($direction, ['asc', 'desc']) ? $direction : 'desc';

        // Lấy danh sách hóa đơn, áp dụng sắp xếp
        $orders = Order::query();

        // Lọc theo mã đơn hàng nếu có
        if ($id) {
            $orders->where('id', 'like', "%{$id}%");
        }

        // Lọc theo trạng thái nếu có
        if ($status) {
            $orders->where('status', $status);
        }

        // Áp dụng sắp xếp
        $orders = $orders->orderBy($sort, $direction)->paginate(10);

        return view('admin.order.index', compact('orders', 'title'));

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
        $title = 'Chi Tiết Hoá Đơn';
        $order = Order::with(['staff', 'reservation', 'customer'])->findOrFail($id);
        return view('admin.order.show', compact('order', 'title'));
    }

    public function edit(Order $order)
    {
        // Trả về view chỉnh sửa với dữ liệu đơn hàng
        $title = 'Chỉnh Sửa Hoá Đơn';
        return view('admin.order.edit', compact('order', 'title'));
    }

    public function update(Request $request, Order $order)
    {
        // Xác thực dữ liệu người dùng nhập vào
        $validated = $request->validate([
            'reservation_id' => 'required|integer|exists:reservations,id', // Kiểm tra mã đặt chỗ hợp lệ
            'staff_id' => 'required|integer|exists:users,id', // Kiểm tra nhân viên hợp lệ
            'total_amount' => 'required|numeric|min:0', // Tổng tiền phải là số hợp lệ và >= 0
            'order_type' => 'required|in:dine_in,take_away,delivery', // Loại đơn hàng phải hợp lệ
            'status' => 'nullable|in:pending,completed,cancelled', // Trạng thái có thể thay đổi hoặc không
            'discount_amount' => 'nullable|numeric|min:0', // Số tiền giảm giá có thể là null nhưng nếu có phải là số hợp lệ
            'final_amount' => 'required|numeric|min:0', // Số tiền cuối cùng phải là số hợp lệ và >= 0
        ]);

        // Lấy trạng thái hiện tại và trạng thái mới
        $currentStatus = $order->status;
        $newStatus = $validated['status'] ?? $currentStatus;

        // Kiểm tra trạng thái ngược
        if ($this->isStatusReversal($currentStatus, $newStatus)) {
            return redirect()->back()->with('error', 'Không thể cập nhật trạng thái ngược.');
        }

        // Kiểm tra tính hợp lệ của số tiền cuối cùng
        $discountAmount = $validated['discount_amount'] ?? 0;

        if ($validated['final_amount'] < $validated['total_amount'] - $discountAmount) {
            return redirect()->back()->with('error', 'Số tiền cuối cùng không hợp lệ. Nó phải lớn hơn hoặc bằng tổng tiền trừ số tiền giảm giá.');
        }

        // Chuẩn bị dữ liệu để cập nhật
        $orderData = [
            'reservation_id' => $validated['reservation_id'],
            'staff_id' => $validated['staff_id'],
            'total_amount' => $validated['total_amount'],
            'order_type' => $validated['order_type'],
            'discount_amount' => $discountAmount,
            'final_amount' => $validated['final_amount'],
            'status' => $newStatus,
        ];

        // Cập nhật thông tin đơn hàng
        $order->update($orderData);

        return redirect()->route('admin.order.index')->with('success', 'Đơn hàng đã được cập nhật thành công.');
    }

    /**
     * Kiểm tra trạng thái ngược.
     *
     * @param string $currentStatus
     * @param string $newStatus
     * @return bool
     */
    private function isStatusReversal($currentStatus, $newStatus)
    {
        $statusOrder = [
            'pending' => 1,    // Trạng thái khởi tạo
            'completed' => 2,  // Trạng thái hoàn thành
            'cancelled' => 3,  // Trạng thái hủy
        ];

        // Kiểm tra thứ tự trạng thái
        return isset($statusOrder[$currentStatus], $statusOrder[$newStatus]) &&
            $statusOrder[$currentStatus] > $statusOrder[$newStatus];
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
        $title = 'Khôi Phục Danh Sách Hoá Đơn';
        $orders = Order::onlyTrashed()->paginate(10);
        return view('admin.order.trash', compact('orders', 'title'));
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
    public function menuOrder(Request $request)
    {
        try {
            $tableId = $request->input('data');
            $table = Table::findOrFail($tableId);
            $order = $table->orders->where('status', 'pending')->first();
            $item = $order->items
                ->where('status', '==', 'chưa yêu cầu')
            ;
            $dishes = Dishes::all();
            $combo = Combo::all();
            $cate = Category::all();
            return view('client.menuOrder', compact('cate', 'table', 'order', 'item', 'dishes', 'combo'));
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function menuSelected($id)
    {
        $table = Table::findOrFail($id);
        $order = $table->orders->where('status', 'pending')->first();
        $item = $order->items
            ->where('status', '==', 'chưa yêu cầu')
        ;
        $encryptedId = Crypt::encryptString($id);
        $url = route('menuOrder', ['data' => $encryptedId]);
        return view('client.menuSelected', compact('item', 'table', 'order', 'url'));
    }
    public function updateItemm(Request $request)
    {
        $item_id = $request->item_id;
        $action = $request->action;
        $item_type = $request->item_type;
        if ($item_type == 'dish') {
            $item = Dishes::find($item_id);
        } else {
            $item = Combo::find($item_id);
        }
        if (!$item) {
            return response()->json(['error' => 'Item not found'], 404);
        }
        if ($action === 'increase') {
            $item->quantity += 1;
        } elseif ($action === 'decrease') {
            $item->quantity = max(0, $item->quantity - 1);
        } elseif ($action === 'remove') {
            $item->delete();
            broadcast(new MenuOrderUpdateItem(['id' => $item_id, 'deleted' => true]));
            return response()->json(['success' => true]);
        } elseif ($action === 'add') {
            // $item = ($item_type === 'dish') ? Dish::create([...]) : Combo::create([...]);
        }
        $item->save();
        broadcast(new MenuOrderUpdateItem([
            'id' => $item->id,
            'type' => $item_type,
            'name' => $item->name,
            'image' => asset('storage/' . $item->dish->image),
            'price' => $item->price,
            'quantity' => $item->quantity
        ]));
        return response()->json(['message' => 'Item updated successfully']);
    }
}

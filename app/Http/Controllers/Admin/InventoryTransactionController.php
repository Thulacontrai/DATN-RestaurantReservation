<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use App\Models\InventoryTransaction;
use App\Models\InventoryItem;
use App\Models\InventoryStock;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class InventoryTransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = InventoryTransaction::query()
            ->select('inventory_transactions.*', 'users.name as staff_name')
            ->leftJoin('users', 'inventory_transactions.staff_id', '=', 'users.id');

        // Lọc theo trạng thái nếu có
        if ($request->has('status') && !empty($request->status)) {
            $query->where('inventory_transactions.status', $request->status);
        }

        // Lọc theo ngày tạo nếu có
        if ($request->has('date') && !empty($request->date)) {
            $query->whereDate('inventory_transactions.created_at', $request->date);
        }

        // Phân trang kết quả
        $transactions = $query->paginate(10);

        return view('admin.inventoryTransaction.index', compact('transactions'));
    }



    public function createTransaction()
    {
        $user = Auth::user(); // Lấy thông tin user đã đăng nhập
        $suppliers = Supplier::all();
        $ingredients = Ingredient::all();

        return view('admin.inventoryTransaction.create', compact('user', 'suppliers', 'ingredients'));
    }


    public function show($id)
    {
        $transaction = InventoryTransaction::with(['supplier', 'inventoryItems.ingredient'])
            ->findOrFail($id);

        // Lấy thông tin nhân viên từ bảng users
        $staff = User::find($transaction->staff_id);

        return view('admin.inventoryTransaction.show', compact('transaction', 'staff'));
    }


    public function storeTransaction(Request $request)
    {
        $validated = $request->validate([
            'total_amount' => 'required|numeric',
            'description' => 'nullable|string',
            'supplier_id' => 'required|exists:suppliers,id',
            'ingredients.*.ingredient_id' => 'required|exists:ingredients,id',
            'ingredients.*.quantity' => 'required|numeric|min:1',
            'ingredients.*.unit_price' => 'required|numeric|min:0',
        ]);

        // Lấy ID của user đang đăng nhập
        $userId = Auth::id();

        $transaction = InventoryTransaction::create([
            'transaction_type' => 'nhập',
            'total_amount' => $validated['total_amount'],
            'description' => $validated['description'],
            'supplier_id' => $validated['supplier_id'],
            'staff_id' => $userId, // Đặt ID của user đang đăng nhập
            'status' => 'chờ xử lý',
        ]);

        foreach ($validated['ingredients'] as $ingredientData) {
            InventoryItem::create([
                'ingredient_id' => $ingredientData['ingredient_id'],
                'inventory_transaction_id' => $transaction->id,
                'quantity' => $ingredientData['quantity'],
            ]);
        }

        return redirect()->route('transactions.create')->with('success', 'Tạo phiếu nhập và thêm nguyên liệu thành công!');
    }

    public function addItemForm($id)
    {
        $transaction = InventoryTransaction::findOrFail($id);
        $ingredients = Ingredient::all(); // Lấy tất cả nguyên liệu
        return view('admin.inventory.add_item', compact('transaction', 'ingredients')); // Đảm bảo đúng đường dẫn
    }

    public function storeItem($id, Request $request)
    {
        $validated = $request->validate([
            'ingredient_id' => 'required|exists:ingredients,id',
            'quantity' => 'required|numeric|min:1',
        ]);

        InventoryItem::create([
            'ingredient_id' => $validated['ingredient_id'],
            'inventory_transaction_id' => $id,
            'quantity' => $validated['quantity'],
        ]);

        return redirect()->route('transactions.add_items', $id)->with('success', 'Thêm nguyên liệu thành công!');
    }

    public function edit($id)
{
    $transaction = InventoryTransaction::findOrFail($id);

    // Kiểm tra nếu trạng thái là "hoàn thành" thì ngăn chỉnh sửa
    if ($transaction->status === 'hoàn thành') {
        return redirect()->route('transactions.show', $transaction->id)
            ->with('error', 'Phiếu đã hoàn thành và không thể chỉnh sửa.');
    }

    $user = auth()->user();
    $suppliers = Supplier::all();
    $ingredients = Ingredient::all();

    return view('admin.inventoryTransaction.edit', compact('transaction', 'suppliers', 'ingredients', 'user'));
}



    public function update(Request $request, $id)
    {
        $transaction = InventoryTransaction::findOrFail($id);

        // Bỏ `staff_id` ra khỏi xác thực
        $validated = $request->validate([
            'total_amount' => 'required|numeric',
            'description' => 'nullable|string',
            'supplier_id' => 'required|exists:suppliers,id',
            'ingredients.*.ingredient_id' => 'required|exists:ingredients,id',
            'ingredients.*.quantity' => 'required|numeric|min:1',
        ]);

        // Cập nhật các trường trong giao dịch
        $transaction->update([
            'total_amount' => $validated['total_amount'],
            'description' => $validated['description'],
            'supplier_id' => $validated['supplier_id'],
            // Không cần cập nhật staff_id
        ]);

        // Xóa các mục nguyên liệu cũ và thêm lại
        $transaction->inventoryItems()->delete();

        foreach ($validated['ingredients'] as $ingredientData) {
            InventoryItem::create([
                'ingredient_id' => $ingredientData['ingredient_id'],
                'inventory_transaction_id' => $transaction->id,
                'quantity' => $ingredientData['quantity'],
            ]);
        }

        return redirect()->route('transactions.show', $transaction->id)->with('success', 'Cập nhật phiếu nhập thành công!');
    }


    public function updateStatus(Request $request, $id)
{
    // Tìm giao dịch theo ID
    $transaction = InventoryTransaction::findOrFail($id);

    // Xác thực dữ liệu đầu vào
    $validated = $request->validate([
        'status' => 'required|string',
    ]);

    // Kiểm tra nếu trạng thái hiện tại là "hoàn thành" thì không cho phép chuyển đổi ngược về trạng thái "chờ xử lý"
    if ($transaction->status === 'hoàn thành' && $validated['status'] === 'chờ xử lý') {
        return redirect()->route('transactions.show', $transaction->id)
            ->with('error', 'Không thể chuyển trạng thái từ hoàn thành về chờ xử lý.');
    }

    // Cập nhật trạng thái mới
    $transaction->status = $validated['status'];
    $transaction->save();

    // Kiểm tra nếu trạng thái được thay đổi thành "Hủy"
    if ($transaction->status === 'Hủy') {
        $transaction->inventoryItems()->delete();
    }

    // Nếu trạng thái được thay đổi thành "hoàn thành", cập nhật tồn kho
    if ($transaction->status === 'hoàn thành') {
        foreach ($transaction->inventoryItems as $item) {
            $stock = InventoryStock::firstOrNew(['ingredient_id' => $item->ingredient_id]);
            $stock->quantity_stock += $item->quantity;
            $stock->last_update = now();
            $stock->save();
        }
    }

    return redirect()->route('transactions.show', $transaction->id)->with('success', 'Cập nhật phiếu nhập thành công!');
}



    public function finalizeTransaction($id)
    {
        $transaction = InventoryTransaction::with('inventoryItems')->findOrFail($id);

        foreach ($transaction->inventoryItems as $item) {
            $stock = InventoryStock::firstOrNew(['ingredient_id' => $item->ingredient_id]);
            $stock->quantity_stock += $item->quantity;
            $stock->last_update = now(); // Sử dụng now() để lấy thời gian hiện tại
            $stock->save(); // Lưu stock, không cần `updated_at`
        }

        $transaction->status = 'hoàn thành';
        $transaction->save();

        return back()->with('success', 'Phiếu nhập hoàn thành và kho được cập nhật!');
    }


    public function destroy($id)
    {
        $transaction = InventoryTransaction::findOrFail($id);

        // Xóa tất cả các mục nguyên liệu liên quan đến giao dịch
        $transaction->inventoryItems()->delete();

        // Sau đó xóa giao dịch
        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'Xóa phiếu nhập thành công!');
    }
}

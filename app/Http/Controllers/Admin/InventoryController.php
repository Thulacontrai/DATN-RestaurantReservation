<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReservationRequest;
use App\Models\Coupon;
use App\Models\Dishes;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Reservation;
use App\Models\Table;
use App\Models\ReservationTable;
use App\Models\User;
use App\Traits\TraitCRUD;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Whoops\Exception\Formatter;
use Illuminate\Support\Str;
use App\Models\InventoryStock;
use App\Models\Ingredient;

class InventoryController extends Controller
{
    public function __construct()
    {
        // Gán middleware cho các phương thức
        $this->middleware('permission:Xem tồn kho', ['only' => ['index']]);
        $this->middleware('permission:Tạo mới tồn kho', ['only' => ['create']]);
        $this->middleware('permission:Sửa tồn kho', ['only' => ['edit']]);
        $this->middleware('permission:Xóa tồn kho', ['only' => ['destroy']]);

    }
    public function index(Request $request)
    {
        $title = 'Hàng Tồn Kho';
        $query = InventoryStock::with('ingredient');

        if ($request->has('search') && $request->input('search') !== '') {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('id', $search)
                  ->orWhereHas('ingredient', function ($q) use ($search) {
                      $q->where('name', 'like', '%' . $search . '%');
                  });
            });
        }

        if ($request->has('status') && $request->input('status') !== '') {
            $status = $request->input('status');
            switch ($status) {
                case 'out_of_stock':
                    $query->where('quantity_stock', 0);
                    break;
                case 'low_stock':
                    $query->whereBetween('quantity_stock', [1, 5]);
                    break;
                case 'high_stock':
                    $query->whereBetween('quantity_stock', [100, 200]);
                    break;
            }
        }

        $inventoryStocks = $query->paginate(10);

        $outOfStock = InventoryStock::where('quantity_stock', 0)->get();
        $lowStock = InventoryStock::whereBetween('quantity_stock', [1, 10])->get();
        $highStock = InventoryStock::whereBetween('quantity_stock', [50, 100])->get();

        return view('admin.inventory.index', compact('inventoryStocks', 'outOfStock', 'lowStock', 'highStock', 'title'));
    }

    public function edit($id)
    {
        $title = 'Chỉnh Sửa Hàng Tồn Kho';
        try {
            $inventory = InventoryStock::findOrFail($id);
            $ingredients = Ingredient::all(); // Thay thế Ingredient bằng model phù hợp với nguyên liệu của bạn
            return view('admin.inventory.edit', compact('inventory','title', 'ingredients'));
        } catch (\Exception $e) {
            return redirect()->route('admin.inventory.index')->with('error', 'Có lỗi xảy ra khi lấy dữ liệu kho.');
        }
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity_stock' => 'required|integer',
        ], [
            'quantity_stock.required' => 'Trường số lượng không được để trống.',
            'quantity_stock.integer' => 'Trường số lượng phải là một số nguyên.',
        ]);

        try {
            $inventory = InventoryStock::findOrFail($id);
            $inventory->update([
                'product_name' => $request->input('product_name'),
                'quantity_stock' => $request->input('quantity_stock'),
                'last_update' => now()
            ]);

            return redirect()->route('admin.inventory.index')->with('success', 'Cập nhật kho thành công.');
        } catch (\Exception $e) {
            Log::error('Error updating inventory: ' . $e->getMessage());
            return redirect()->route('admin.inventory.index')->with('error', 'Có lỗi xảy ra khi cập nhật kho.');
        }
    }



    public function destroy($id)
    {
        try {
            $inventoryStock = InventoryStock::findOrFail($id);
            $inventoryStock->delete();

            return redirect()->route('admin.inventory.index')->with('success', 'Xóa kho thành công.');
        } catch (\Exception $e) {
            return redirect()->route('admin.inventory.index')->with('error', 'Có lỗi xảy ra khi xóa kho.');
        }
    }

}


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

class InventoryController extends Controller
{
    public function index(Request $request)
    {
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
                    $query->whereBetween('quantity_stock', [1, 10]);
                    break;
                case 'high_stock':
                    $query->whereBetween('quantity_stock', [50, 100]);
                    break;
            }
        }

        $inventoryStocks = $query->paginate(10);

        $outOfStock = InventoryStock::where('quantity_stock', 0)->get();
        $lowStock = InventoryStock::whereBetween('quantity_stock', [1, 10])->get();
        $highStock = InventoryStock::whereBetween('quantity_stock', [50, 100])->get();

        return view('admin.inventory.index', compact('inventoryStocks', 'outOfStock', 'lowStock', 'highStock'));
    }
}


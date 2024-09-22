<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Table;
use App\Http\Requests\StoreTableRequest;
use App\Http\Requests\UpdateTableRequest;
use App\Models\Reservation;
use App\Traits\TraitCRUD;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TableController extends Controller
{
    use TraitCRUD;

    protected $model = Table::class;
    protected $viewPath = 'admin.tables';
    protected $routePath = 'table';

    public function index(Request $request)
    {
        $query = Table::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('table_type')) {
            $query->where('table_type', $request->table_type);
        }

        $tables = $query->paginate(10);
        return view('admin.tables.index', compact('tables'));
    }

    public function store(StoreTableRequest $request)
    {
        Table::create($request->validated());

        return redirect()->route('admin.table.index')->with('success', 'Bàn đã được thêm thành công!');
    }

    public function edit($id)
    {
        $table = Table::findOrFail($id);

        return view('admin.tables.edit', compact('table'));
    }

    public function update(UpdateTableRequest $request, $id)
    {
        $table = Table::findOrFail($id);
        $table->update($request->validated());

        return redirect()->route('admin.table.index')->with('success', 'Bàn đã được cập nhật thành công!');
    }

    public function destroy($id)
    {
        // Tìm bàn theo id
        $table = Table::findOrFail($id);

        // Kiểm tra trạng thái của bàn, nếu là 'reserved' (hoặc tương tự) thì không cho phép xóa
        if ($table->status === 'reserved') {
            return redirect()->route('admin.table.index')->with('error', 'Không thể xóa bàn này vì đang ở trạng thái đã đặt trước.');
        }

        // Kiểm tra các liên kết khác (nếu có)
        $reservationTable = DB::table('reservation_tables')->where('table_id', $id)->count();
        $reservationHistory = DB::table('reservation_history')
            ->join('reservations', 'reservation_history.reservation_id', '=', 'reservations.id')
            ->join('reservation_tables', 'reservations.id', '=', 'reservation_tables.reservation_id')
            ->where('reservation_tables.table_id', $id)
            ->count();

        $orders = DB::table('orders')->where('table_id', $id)->count();
        $payments = DB::table('payments')
            ->join('reservations', 'payments.reservation_id', '=', 'reservations.id')
            ->join('reservation_tables', 'reservations.id', '=', 'reservation_tables.reservation_id')
            ->where('reservation_tables.table_id', $id)
            ->count();

        // Nếu có các ràng buộc khác, không cho phép xóa
        if ($reservationTable > 0 || $reservationHistory > 0 || $orders > 0 || $payments > 0) {
            return redirect()->route('admin.table.index')->with('error', 'Không thể xóa bàn này vì vẫn còn đặt trước liên quan.');
        }

        // Thực hiện xóa bàn
        $table->delete();

        return redirect()->route('admin.table.index')->with('success', 'Bàn đã được xóa mềm thành công!');
    }






    public function trash()
    {
        $tables = Table::onlyTrashed()->paginate(10);
        return view('admin.tables.trash', compact('tables'));
    }



    public function restore($id)
    {
        $table = Table::withTrashed()->findOrFail($id);
        $table->restore();
        return redirect()->route('admin.tables.trash')->with('success', 'Bàn đã được khôi phục thành công!');
    }

    public function forceDelete($id)
    {
        $table = Table::withTrashed()->findOrFail($id);
        $table->forceDelete();
        return redirect()->route('admin.tables.trash')->with('success', 'Bàn đã được xóa vĩnh viễn!');
    }

   
}

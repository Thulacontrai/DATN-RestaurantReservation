<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Table;
use App\Http\Requests\StoreTableRequest;
use App\Http\Requests\UpdateTableRequest;
use App\Traits\TraitCRUD;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TableController extends Controller
{

    public function __construct()
    {
        // Gán middleware cho các phương thức
        $this->middleware('permission:Xem đặt bàn', ['only' => ['index']]);
        $this->middleware('permission:Tạo mới đặt bàn', ['only' => ['create']]);
        $this->middleware('permission:Sửa đặt bàn', ['only' => ['edit']]);
        $this->middleware('permission:Xóa đặt bàn', ['only' => ['destroy']]);
    }

    use TraitCRUD;

    protected $model = Table::class;
    protected $viewPath = 'admin.tables';
    protected $routePath = 'table';


    public function index(Request $request)
    {
        $query = Table::query();

        // Tìm kiếm bàn theo số bàn
        if ($request->filled('name')) {
            $query->where('table_number', 'like', '%' . $request->name . '%');
        }

        // Lọc theo loại bàn
        if ($request->filled('table_type')) {
            $query->where('table_type', $request->table_type);
        }

        // Lọc theo trạng thái bàn
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Phân trang kết quả
        $tables = $query->paginate(10);

        // Trả về view cùng với kết quả
        return view('admin.tables.index', compact('tables'));
    }


    public function create()
    {
        return view('admin.tables.create'); // Kiểm tra xem view này có tồn tại không
    }

    public function store(StoreTableRequest $request)
    {
        Table::create($request->validated());
        return redirect()->route('admin.table.index')->with('success', 'Bàn đã được thêm thành công!');
    }

    public function edit(Table $table)
    {
        return view('admin.tables.edit', compact('table'));
    }

    public function update(UpdateTableRequest $request, Table $table)
    {
        $table->update($request->validated());
        return redirect()->route('admin.table.index')->with('success', 'Bàn đã được cập nhật thành công!');
    }

    public function destroy(Table $table)
    {
        // Kiểm tra xem bàn có đang được đặt không
        if ($table->status === 'Reserved') {
            return redirect()->route('admin.table.index')->with('error', 'Không thể xóa bàn này vì đang ở trạng thái đã đặt trước.');
        }

        // Kiểm tra xem có đặt trước hoặc đơn hàng nào liên quan không
        if ($this->hasRelatedRecords($table->id)) {
            return redirect()->route('admin.table.index')->with('error', 'Không thể xóa bàn này vì vẫn còn đặt trước liên quan.');
        }

        $table->delete(); // Xóa mềm
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

    private function hasRelatedRecords($id)
    {
        // Kiểm tra xem có đặt trước hoặc đơn hàng nào liên quan đến bàn
        return DB::table('reservation_tables')->where('table_id', $id)->exists() ||
            DB::table('reservation_history')->whereExists(function ($query) use ($id) {
                $query->select(DB::raw(1))
                    ->from('reservations')
                    ->whereColumn('reservation_history.reservation_id', 'reservations.id')
                    ->whereExists(function ($query) use ($id) {
                        $query->select(DB::raw(1))
                            ->from('reservation_tables')
                            ->whereColumn('reservations.id', 'reservation_tables.reservation_id')
                            ->where('reservation_tables.table_id', $id);
                    });
            })->exists() ||
            DB::table('orders')->where('table_id', $id)->exists() ||
            DB::table('payments')->whereExists(function ($query) use ($id) {
                $query->select(DB::raw(1))
                    ->from('reservations')
                    ->whereColumn('payments.reservation_id', 'reservations.id')
                    ->whereExists(function ($query) use ($id) {
                        $query->select(DB::raw(1))
                            ->from('reservation_tables')
                            ->whereColumn('reservations.id', 'reservation_tables.reservation_id')
                            ->where('reservation_tables.table_id', $id);
                    });
            })->exists();
    }
}

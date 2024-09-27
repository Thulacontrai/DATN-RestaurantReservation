<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReservationTable;
use App\Traits\TraitCRUD;
use Illuminate\Http\Request;

class ReservationTableController extends Controller
{
    

    use TraitCRUD;

    protected $model = ReservationTable::class;
    protected $viewPath = 'admin.reservationTable';
    protected $routePath = 'admin.reservationTable';
    protected $reservationTable;

    public function __construct(ReservationTable $reservationTable)
    {
        $this->reservationTable = $reservationTable;
    }

    public function index()
    {
        $reservationTables = ReservationTable::all();
        return view('admin.reservation.reservationTable.index', compact('reservationTables')); // Truyền dữ liệu vào view
    }

    public function show($id)
    {
        try {
            $data = $this->reservationTable->getById($id);
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'reservation_id' => 'required|integer',
            'status' => 'required|in:available,reserved,occupied,cleaning',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        $data = $this->reservationTable->createRecord($validated);
        return response()->json($data, 201);
    }


    public function update(Request $request, ReservationTable $reservationTable)
    {
        $validated = $request->validate([
            'status' => 'in:available,reserved,occupied,cleaning',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        try {
            $data = $reservationTable->fill($validated)->save();
            return response()->json([
                'data'      => $data,
                'success'   => true,
                'message'   => 'Cập nhật thành công',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success'   => false,
                'message' => 'Cập nhật thất bại',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    public function destroy(ReservationTable $reservationTable)
    {
        try {
            $reservationTable->delete();
            return response()->json([
                'success'   => true,
                'message'   => 'Xóa thành công',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success'   => false,
                'message' => 'Xóa thất bại',
                'error' => $e->getMessage()
            ], 404);
        }
    }
}

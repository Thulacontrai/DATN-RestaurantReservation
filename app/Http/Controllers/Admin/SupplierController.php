<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\TraitCRUD;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Imports\SupplierImport;
use Maatwebsite\Excel\Facades\Excel;

class SupplierController extends Controller
{
    use TraitCRUD;

    protected $model = Supplier::class;
    protected $viewPath = 'suppliers';
    protected $routePath = 'suppliers';


    public function index(Request $request)
    {
        $suppliers = Supplier::when($request->name, function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->name . '%');
        })->paginate(10);

        return view('admin.ingredientType.supplier.index', compact('suppliers'));
    }


    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ingredientType.supplier.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:255',
        ]);

        Supplier::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
        ]);


        return redirect()->route('admin.supplier.index')
            ->with('success', 'Nhà cung cấp đã được thêm thành công.');
    }

    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('admin.ingredientType.supplier.edit', compact('supplier'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:255',
        ]);

        $supplier = Supplier::findOrFail($id);
        $supplier->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
        ]);

        return redirect()->route('admin.supplier.index')->with('success', 'Cập nhật nhà cung cấp thành công.');
    }
    

    public function destroy($id)
    {
        if (!isset($this->model)) {
            abort(500, 'Model is not defined.');
        }

        $item = $this->model::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.supplier.index')->with('success', 'Xóa thành công.');
    }

    public function import(Request $request)
    {
        // Kiểm tra và xử lý file upload
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        try {
            Excel::import(new SupplierImport, $request->file('file'));
            return redirect()->route('admin.supplier.index')->with('success', 'Nhập dữ liệu thành công!');
        } catch (\Exception $e) {
            return redirect()->route('admin.supplier.index')->with('error', 'Có lỗi xảy ra khi nhập dữ liệu: ' . $e->getMessage());
        }
    }
}

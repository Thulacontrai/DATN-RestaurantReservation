<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\TraitCRUD;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Imports\SupplierImport;
// use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Validator;

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

    public function showImportForm()
    {
        return view('admin.ingredientType.supplier.import');
    }
    public function import(Request $request)
    {
        // Xác thực file upload
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        // Đọc file Excel
        $file = $request->file('file');
        $spreadsheet = IOFactory::load($file->getPathname());

        // Lấy dữ liệu từ sheet đầu tiên
        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        // Bỏ qua hàng tiêu đề nếu có
        $headerRow = true;

        foreach ($sheetData as $row) {
            // Bỏ qua dòng đầu tiên nếu là header
            if ($headerRow) {
                $headerRow = false;
                continue;
            }

            // Thực hiện validation cho từng dòng
            $validator = Validator::make([
                'name'    => $row[0], // Tên nhà cung cấp
                'phone'   => $row[1], // Số điện thoại
                'email'   => $row[2], // Email
                'address' => $row[3], // Địa chỉ
            ], [
                'name'    => 'required|string|max:255',
                'phone'   => 'required|numeric|digits_between:10,15',
                'email'   => 'required|email|unique:suppliers,email',
                'address' => 'nullable|string|max:255',
            ]);

            // Kiểm tra nếu dữ liệu không hợp lệ
            if ($validator->fails()) {
                // Bạn có thể ghi lại lỗi vào log hoặc bỏ qua dòng dữ liệu này
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Nếu dữ liệu hợp lệ, tạo nhà cung cấp mới
            Supplier::create([
                'name'    => $row[0],
                'phone'   => $row[1],
                'email'   => $row[2],
                'address' => $row[3],
            ]);
        }

        // Trả về thông báo thành công sau khi import
         // Sau khi import thành công, quay lại trang danh sách nhà cung cấp
         return redirect()->route('admin.supplier.index')->with('success', 'Import thành công!');
    }

}

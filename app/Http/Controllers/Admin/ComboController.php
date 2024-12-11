<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Combo;
use App\Models\Dishes;
use App\Traits\TraitCRUD;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ComboController extends Controller
{

    /**
     * Construct function
     *
     * Gán middleware cho các phương thức
     * - Xem combo
     * - Tạo mới combo
     * - Sửa combo
     * - Xóa combo
     */

    public function __construct()
    {
        // Gán middleware cho các phương thức
        $this->middleware('permission:Xem combo', ['only' => ['index']]);
        $this->middleware('permission:Tạo mới combo', ['only' => ['create']]);
        $this->middleware('permission:Sửa combo', ['only' => ['edit']]);
        $this->middleware('permission:Xóa combo', ['only' => ['destroy']]);
    }
    use TraitCRUD;

    protected $model = Combo::class;
    protected $viewPath = 'admin.dish.combo';
    protected $routePath = 'admin.combo';


    public function index(Request $request)
    {
        try {
            // Khởi tạo truy vấn
            $query = $this->model::query();
            $title = 'Combo';

            // Tìm kiếm theo tên nếu có
            if ($request->filled('name')) {
                $query->where('name', 'like', '%' . $request->name . '%');
            }

            // Kiểm tra và áp dụng trạng thái active/inactive nếu có
            if ($request->filled('is_active')) {
                $isActive = $request->is_active;
                $query->where('is_active', $isActive); // Lọc theo trạng thái
            } else {
                // Nếu không có tham số, lấy cả active và inactive combo
                // Mặc định sẽ lấy cả hai
            }
            // Lấy tham số sort và direction từ request
            $sort = $request->input('sort', 'id'); // Mặc định sắp xếp theo id
            $direction = $request->input('direction', 'asc'); // Mặc định thứ tự tăng dần

            // Xác nhận cột sắp xếp hợp lệ
            $allowedSorts = ['id', 'name', 'price', 'quantity']; // Các cột cho phép sắp xếp
            $sort = in_array($sort, $allowedSorts) ? $sort : 'id';

            // Xác nhận thứ tự sắp xếp hợp lệ
            $direction = in_array($direction, ['asc', 'desc']) ? $direction : 'asc';

            // Truy vấn dữ liệu với sắp xếp và phân trang
            $combos = Combo::orderBy($sort, $direction)->paginate(10);


            // Trả về view
            return view($this->viewPath . '.index', compact('combos', 'title'));
        } catch (\Exception $e) {
            // Ghi log và trả về lỗi
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Đã xảy ra lỗi. Vui lòng thử lại!');
        }
    }




    public function create()
    {
        $title = 'Thêm Mới Combo';
        $categories = Category::all();
        $dishes = Dishes::all();
        return view($this->viewPath . '.create', compact('categories', 'dishes', 'title'));
    }


    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name'             => 'required|string|max:255',
            'price'            => 'required|numeric',
            'description'      => 'nullable|string',
            'image'            => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'quantity_dishes'  => 'required|integer|min:1',
        ]);

        // Kiểm tra tên combo đã tồn tại hay chưa
        $existingCombo = Combo::where('name', $request->name)->first();
        if ($existingCombo) {
            return redirect()->back()->withInput()->with('error', 'Tên combo đã tồn tại. Vui lòng đặt tên khác.');
        }

        DB::transaction(function () use ($request) {
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('combo_images', 'public');
            }

            $combo = Combo::create([
                'name'             => $request->name,
                'price'            => $request->price,
                'description'      => $request->description,
                'image'            => $imagePath,
                'quantity_dishes'  => $request->quantity_dishes,
            ]);

            foreach ($request->dishes as $dishId) {
                // Tạo bản ghi trong bảng combo_dish
                $combo->dishes()->attach($dishId, ['quantity' => 1]);
            }
        });

        return redirect()->route($this->routePath . '.index')->with('success', 'Combo đã được thêm thành công!');
    }


    public function edit($id)
    {
        $title = 'Chỉnh Sửa Combo';
        $combo = $this->model::findOrFail($id);
        $categories = Category::all();
        $dishes = Dishes::all();

        return view($this->viewPath . '.edit', compact('combo', 'categories', 'dishes', 'title'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name'             => 'required|string|max:255', // Tên combo là bắt buộc
            'price'            => 'required|numeric|min:1', // Giá combo là bắt buộc và phải là số
            'description'      => 'nullable|string', // Mô tả món ăn không bắt buộc
            'image'            => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Ảnh combo là không bắt buộc
            'quantity_dishes'  => 'required|integer|min:1', // Số lượng món ăn là bắt buộc và phải là số nguyên
        ]);


        // Kiểm tra tên combo đã tồn tại nhưng loại trừ combo hiện tại
        $existingCombo = Combo::where('name', $request->name)->where('id', '!=', $id)->first();
        if ($existingCombo) {
            return redirect()->back()->withInput()->with('error', 'Tên combo đã tồn tại. Vui lòng đặt tên khác.');
        }

        // Cập nhật thông tin combo trong một transaction
        DB::transaction(function () use ($request, $id) {
            $combo = $this->model::findOrFail($id);

            // Nếu có ảnh mới, xử lý lưu ảnh và xóa ảnh cũ nếu cần
            if ($request->hasFile('image')) {
                if ($combo->image) {
                    // Xóa ảnh cũ khỏi storage
                    Storage::delete('public/' . $combo->image);
                }
                // Lưu ảnh mới vào thư mục combo_images
                $imagePath = $request->file('image')->store('combo_images', 'public');
                $combo->image = $imagePath; // Cập nhật đường dẫn ảnh mới
            }

            // Cập nhật các thông tin còn lại
            $combo->update($request->except('image')); // Cập nhật tất cả trường, ngoại trừ ảnh
            $combo->dishes()->sync($request->dishes); // Cập nhật mối quan hệ món ăn với combo
        });

        // Trả về thông báo thành công
        return redirect()->route($this->routePath . '.index')->with('success', 'Combo đã được cập nhật thành công!');
    }


    public function show($id)
    {
        $title = 'Chi Tiết Combo';
        $combo = $this->model::findOrFail($id);
        $dishes = $combo->dishes;

        return view($this->viewPath . '.detail', compact('combo', 'dishes', 'title'));
    }


    public function trash()
    {
        $title = 'Khôi Phục Danh Sách Combo';
        $combos = Combo::onlyTrashed()->paginate(10);
        return view($this->viewPath . '.trash', compact('combos', 'title'));
    }

    public function restore($id)
    {
        $combo = Combo::withTrashed()->findOrFail($id);
        $combo->restore();

        return redirect()->route($this->routePath . '.trash')->with('success', 'Combo đã được khôi phục thành công!');
    }

    public function forceDelete($id)
    {
        $combo = Combo::withTrashed()->findOrFail($id);

        if ($combo->image) {
            Storage::delete('public/' . $combo->image);
        }

        $combo->forceDelete();

        return redirect()->route($this->routePath . '.trash')->with('success', 'Combo đã được xóa!!');
    }



    public function toggleStatus(Request $request, $id)
    {
        try {
            $combo = Combo::findOrFail($id); // Lấy combo theo ID
            $combo->is_active = $request->input('is_active'); // Cập nhật trạng thái
            $combo->save();

            return response()->json(['success' => true, 'message' => 'Trạng thái đã được cập nhật thành công.']);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['success' => false, 'message' => 'Có lỗi xảy ra trong quá trình cập nhật trạng thái.']);
        }
    }
}

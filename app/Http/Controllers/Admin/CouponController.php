<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Traits\TraitCRUD;
use Illuminate\Http\Request;

class CouponController extends Controller
{

    public function __construct()
    {
        // Gán middleware cho các phương thức
        $this->middleware('permission:Xem mã giảm giá', ['only' => ['index']]);
        $this->middleware('permission:Tạo mới mã giảm giá', ['only' => ['create']]);
        $this->middleware('permission:Sửa mã giảm giá', ['only' => ['edit']]);
        $this->middleware('permission:Xóa mã giảm giá', ['only' => ['destroy']]);
        
    }

    use TraitCRUD;

    protected $model = Coupon::class;
    protected $viewPath = 'admin.coupon';
    protected $routePath = 'admin.coupon';

    public function index()
    {
        $coupons = Coupon::all();
        return view('admin.coupon.index', compact('coupons'));
    }

    public function create()
    {
        return view('admin.coupon.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|max:255',
            'description' => 'nullable|string',
            'max_uses' => 'nullable|integer',
            'start_time' => 'nullable|date',
            'end_time' => 'nullable|date',
            'discount_type' => 'required|in:Percentage,Fixed',
            'discount_amount' => 'nullable|numeric',
            'status' => 'required|in:active,inactive,expired',
        ]);

        Coupon::create($validated);

        return redirect()->route('admin.coupon.index')->with('success', 'Coupon đã được tạo thành công.');
    }

    public function show($id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('admin.coupon.detail', compact('coupon'));
    }

    public function edit(Coupon $coupon)
    {
        return view('admin.coupon.edit', compact('coupon'));
    }

    public function update(Request $request, Coupon $coupon)
    {
        $validated = $request->validate([
            'code' => 'required|max:255',
            'description' => 'nullable|string',
            'max_uses' => 'nullable|integer',
            'start_time' => 'nullable|date',
            'end_time' => 'nullable|date',
            'discount_type' => 'required|in:Percentage,Fixed',
            'discount_amount' => 'nullable|numeric',
            'status' => 'required|in:active,inactive,expired',
        ]);

        $coupon->update($validated);

        return redirect()->route('admin.coupon.index')->with('success', 'Coupon đã được cập nhật thành công.');
    }

    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id);

        // Check if the coupon is in "active" status
        if ($coupon->status === 'active') {
            return redirect()->route('admin.coupon.index')->with('error', 'Không thể xóa phiếu giảm giá đang trong trạng thái hoạt động. Vui lòng thực hiện thao tác khác.');
        }

        // If the status is not active, proceed with soft deletion
        $coupon->delete(); // Xóa mềm

        return redirect()->route('admin.coupon.index')->with('success', 'Coupon đã được xóa thành công.');
    }

    // Hiển thị các mã giảm giá đã bị xóa mềm (thùng rác)
    public function trash()
    {
        $coupons = Coupon::onlyTrashed()->paginate(10);
        return view($this->viewPath . '.trash', compact('coupons'));
    }


    // Khôi phục mã giảm giá từ thùng rác
    public function restore($id)
    {
        $coupon = Coupon::withTrashed()->findOrFail($id);
        $coupon->restore(); // Khôi phục mã giảm giá

        return redirect()->route($this->routePath . '.trash')->with('success', 'Mã giảm giá đã được khôi phục thành công!');
    }

    // Xóa vĩnh viễn mã giảm giá
    public function forceDelete($id)
    {
        $coupon = Coupon::withTrashed()->findOrFail($id);
        $coupon->forceDelete(); // Xóa vĩnh viễn

        return redirect()->route($this->routePath . '.trash')->with('success', 'Mã giảm giá đã được xóa vĩnh viễn!');
    }
}

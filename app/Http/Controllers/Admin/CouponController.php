<?php

namespace App\Http\Controllers\Admin;

use App\Events\CouponExpiryNotification;
use App\Events\OverdueCouponEvent;
use App\Events\UpcomingCouponEvent;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Traits\TraitCRUD;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CouponController extends Controller
{
    use TraitCRUD;

    protected $model = Coupon::class;
    protected $viewPath = 'admin.coupon';
    protected $routePath = 'admin.coupon';

    public function __construct()
    {
        $this->middleware('permission:Xem mã giảm giá', ['only' => ['index', 'show']]);
        $this->middleware('permission:Tạo mới mã giảm giá', ['only' => ['create', 'store']]);
        $this->middleware('permission:Sửa mã giảm giá', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Xóa mã giảm giá', ['only' => ['destroy', 'trash', 'forceDelete']]);
    }

    public function index()
    {
        $title = 'Phiếu Giảm Giá';

        // Lấy danh sách các coupon sắp hết hạn trong 24 giờ
        $UpcomingCouponEvent = Coupon::where('end_time', '>', now())
            ->where('end_time', '<=', now()->addDay())
            ->get();

        // Lấy danh sách các coupon đã hết hạn
        $OverdueCouponEvent = Coupon::where('end_time', '<', now())
            ->get();

        // Phát sự kiện cho các coupon sắp hết hạn
        foreach ($UpcomingCouponEvent as $coupon) {
            event(new UpcomingCouponEvent($coupon));
        }

        // Phát sự kiện cho các coupon đã hết hạn
        foreach ($OverdueCouponEvent as $coupon) {
            event(new OverdueCouponEvent($coupon));
        }

        // Lấy danh sách coupon với phân trang
        $coupons = Coupon::paginate(10);

        // Trả về view với dữ liệu
        return view('admin.coupon.index', compact('UpcomingCouponEvent', 'OverdueCouponEvent', 'coupons', 'title'));
    }




    private function updateOverdueCoupons()
    {
        $now = Carbon::now();

        try {
            Log::info('Bắt đầu cập nhật phiếu giảm giá vào lúc ' . $now->toDateTimeString());

            // Cập nhật trạng thái phiếu giảm giá đã hết hạn
            $expiredCouponsCount = Coupon::where('end_time', '<', $now)
                ->where('status', '!=', 'expired')
                ->update(['status' => 'expired']);

            Log::info("Số phiếu giảm giá đã hết hạn được cập nhật: $expiredCouponsCount");

            // Kiểm tra lại trong cơ sở dữ liệu sau khi cập nhật
            $updatedCoupons = Coupon::where('status', 'expired')
                ->where('end_time', '<', $now)
                ->get();

            Log::info("Số phiếu giảm giá đã cập nhật: " . $updatedCoupons->count());

            // Phát sự kiện cho các phiếu giảm giá đã quá hạn (nếu có)
            $overdueCoupons = Coupon::where('status', 'expired')
                ->where('end_time', '<', $now)
                ->get();

            $overdueCouponsCount = $overdueCoupons->count();
            if ($overdueCouponsCount > 0) {
                foreach ($overdueCoupons as $coupon) {
                    // Phát sự kiện quá hạn cho mỗi phiếu giảm giá
                    event(new OverdueCouponEvent($coupon));
                    Log::info("Sự kiện quá hạn được kích hoạt cho phiếu giảm giá ID: {$coupon->id}");
                }
            }

            return redirect()->route('admin.coupon.index')
                ->with('status', "Phiếu giảm giá đã được kiểm tra và cập nhật thành công. Đã hết hạn: $expiredCouponsCount, Quá hạn: $overdueCouponsCount");
        } catch (\Exception $e) {
            Log::error('Lỗi khi cập nhật phiếu giảm giá: ' . $e->getMessage());

            return redirect()->route('admin.coupon.index')
                ->with('error', 'Đã xảy ra lỗi khi cập nhật phiếu giảm giá.');
        }
    }






    // Tạo phiếu giảm giá mới
    public function create()
    {
        $title = 'Thêm Mới Phiếu Giảm Giá';
        return view('admin.coupon.create', compact('title'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|max:255|unique:coupons',
            'description' => 'nullable|string',
            'max_uses' => 'nullable|integer',
            'start_time' => 'nullable|date',
            'end_time' => 'nullable|date|after_or_equal:start_time',
            'discount_type' => 'required|in:Percentage,Fixed',
            'discount_amount' => 'required_if:discount_type,Fixed|numeric',
            'discount_percentage' => 'required_if:discount_type,Percentage|numeric|between:5,100',
            'status' => 'required|in:active,inactive',
        ]);

        // Kiểm tra nếu phiếu đã hết hạn
        if (isset($validated['end_time']) && now()->greaterThan($validated['end_time'])) {
            $validated['status'] = 'expired';
        }

        Coupon::create($validated);

        return redirect()->route('admin.coupon.index')->with('success', 'Phiếu giảm giá đã được tạo thành công.');
    }

    // Hiển thị chi tiết phiếu giảm giá
    public function show($id)
    {
        $title = 'Chi Tiết Phiếu Giảm Giá';
        $coupon = Coupon::findOrFail($id);
        return view('admin.coupon.detail', compact('coupon', 'title'));
    }

    // Chỉnh sửa phiếu giảm giá
    public function edit(Coupon $coupon)
    {
        $title = 'Chỉnh Sửa Phiếu Giảm Giá';
        return view('admin.coupon.edit', compact('coupon', 'title'));
    }

    public function update(Request $request, Coupon $coupon)
    {
        // Lấy thời gian hiện tại
        $now = now();

        // Xác thực dữ liệu
        $validated = $request->validate([
            'code' => 'required|max:255',
            'description' => 'nullable|string',
            'max_uses' => 'nullable|integer|min:1',
            'start_time' => 'nullable|date|after_or_equal:' . $now->toDateString(), // Kiểm tra thời gian bắt đầu không được nhỏ hơn thời gian hiện tại
            'end_time' => 'nullable|date|after_or_equal:start_time', // Kiểm tra thời gian kết thúc phải lớn hơn hoặc bằng thời gian bắt đầu
            'discount_type' => 'required|in:Percentage,Fixed',
            'discount_amount' => 'nullable|numeric|required_if:discount_type,Fixed|min:0.01',
            'discount_percentage' => 'nullable|integer|required_if:discount_type,Percentage|min:1|max:100',
            'status' => 'required|in:active,inactive,expired',
        ]);

        // Kiểm tra trạng thái "đã hủy"
        if ($coupon->status === 'expired' && $validated['status'] !== 'expired') {
            return redirect()->back()->with('error', 'Không thể thay đổi trạng thái của phiếu giảm giá đã hủy.');
        }

        // Xử lý logic tùy theo loại giảm giá
        if ($validated['discount_type'] === 'Fixed') {
            // Loại giảm giá cố định thì bỏ discount_percentage
            $validated['discount_percentage'] = null;
        } elseif ($validated['discount_type'] === 'Percentage') {
            // Loại giảm giá phần trăm thì bỏ discount_amount
            $validated['discount_amount'] = null;
        }

        // Cập nhật dữ liệu vào model
        $coupon->update($validated);

        // Chuyển hướng về danh sách với thông báo thành công
        return redirect()->route('admin.coupon.index')->with('success', 'Phiếu giảm giá đã được cập nhật thành công.');
    }




    // Xóa phiếu giảm giá
    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id);

        if ($coupon->status === 'active') {
            return redirect()->route('admin.coupon.index')->with('error', 'Không thể xóa phiếu giảm giá đang hoạt động.');
        }

        $coupon->delete();

        return redirect()->route('admin.coupon.index')->with('success', 'Phiếu giảm giá đã được xóa thành công.');
    }

    // Quản lý thùng rác
    public function trash()
    {
        $title = 'Khôi Phục Danh Sách Phiếu Giảm Giá';
        $coupons = Coupon::onlyTrashed()->paginate(10);
        return view($this->viewPath . '.trash', compact('coupons', 'title'));
    }

    public function restore($id)
    {
        $coupon = Coupon::withTrashed()->findOrFail($id);
        $coupon->restore();

        return redirect()->route($this->routePath . '.trash')->with('success', 'Phiếu giảm giá đã được khôi phục thành công.');
    }

    public function forceDelete($id)
    {
        $coupon = Coupon::withTrashed()->findOrFail($id);
        $coupon->forceDelete();

        return redirect()->route($this->routePath . '.trash')->with('success', 'Phiếu giảm giá đã được xóa vĩnh viễn.');
    }
}

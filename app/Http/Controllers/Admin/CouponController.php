<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
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
        $coupon->delete();

        return redirect()->route('admin.coupon.index')->with('success', 'Coupon đã được xóa thành công.');
    }
}

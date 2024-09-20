<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Traits\TraitCRUD;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    use TraitCRUD;

    protected $model = Payment::class;
    protected $viewPath = 'admin.payment';
    protected $routePath = 'admin.payment';

    public function index()
    {
        $payments = Payment::all();
        return view('admin.payment.index', compact('payments'));
    }

    public function create()
    {
        return view('admin.payment.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'reservation_id' => 'nullable|integer',
            'bill_id' => 'nullable|integer',
            'transaction_id' => 'nullable|integer',
            'refund_amount' => 'nullable|numeric',
            'amount' => 'required|numeric',
            'transaction_status' => 'required|in:pending,completed,failed',
            'payment_method' => 'required|in:cash,credit_card,online',
            'status' => 'required|in:Completed,Pending,Failed',
        ]);

        Payment::create($validated);
        return redirect()->route('admin.payment.index')->with('success', 'Payment created successfully');
    }

    public function show(Payment $payment)
    {
        return view('admin.payment.detail', compact('payment'));
    }

    public function edit(Payment $payment)
    {
        return view('admin.payment.edit', compact('payment'));
    }

    public function update(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'payment_method' => 'required|in:Cash,Credit Card,Online',
            'transaction_status' => 'required|in:pending,completed,failed',
            'status' => 'required|in:Completed,Pending,Failed',
        ]);

        $payment->update($validated);
        return redirect()->route('admin.payment.index')->with('success', 'Cập nhật thanh toán thành công.');
    }

    public function destroy($id)
{
    $payment = Payment::findOrFail($id);

    if ($payment->transaction_status === 'pending') {
        return redirect()->route($this->routePath . '.index')->with('error', 'Không thể xóa  thanh toán khi đang trong trạng thái chờ xử lý. Vui lòng thực hiện thao tác khác.');
    }

    // Xóa mềm bản ghi
    $payment->delete();

    return redirect()->route($this->routePath . '.index')->with('success', 'Thanh toán đã được xóa thành công!');
}


    public function trash()
{
    $payments = Payment::onlyTrashed()->paginate(10); // Lấy tất cả các thanh toán đã bị xóa mềm
    return view($this->viewPath . '.trash', compact('payments'));
}


    public function restore($id)
    {
        $payment = Payment::withTrashed()->findOrFail($id);
        $payment->restore();

        return redirect()->route($this->routePath . '.trash')->with('success', 'Thanh toán đã được khôi phục thành công!');
    }

    public function forceDelete($id)
    {
        $payment = Payment::withTrashed()->findOrFail($id);
        $payment->forceDelete(); // Xóa vĩnh viễn bản ghi

        return redirect()->route($this->routePath . '.trash')->with('success', 'Thanh toán đã được xóa vĩnh viễn!');
    }


}

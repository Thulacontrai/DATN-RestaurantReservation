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

    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('admin.payment.index')->with('success', 'Payment deleted successfully');
    }
}

<?php

namespace App\Http\Middleware;

use App\Models\Table;
use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $tableId = $request->route('table_number');
        $table = Table::find($tableId);
        if (!$table || $table->status !== 'Occupied') {
            return redirect()->route('client.index')->with('err', 'Vui lòng đến quầy lễ tân đặt bàn trước!');
        }
        if (!Auth::check()) {
            Session::put('url.intended', url()->current());
            return redirect()->guest(route('login.form'));
        }
        $userId = Auth::id();
        $order = $table->orders->where('status', 'pending')->first();
        if ($order) {
            $customerId = $order->reservation ? $order->reservation->customer->id : $order->customer->id;
            if ($customerId !== $userId) {
                return redirect()->route('client.index')->with('err', 'Người dùng không có quyền truy cập bàn này!');
            }
        }
        return $next($request);
    }
}

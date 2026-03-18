<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class EmployeeOrderController extends Controller
{
    public function index(Request $request)
    {

        $orders = Order::with('orderItems.product', 'client')->where('status', $request->status)->get();

        return response()->json(['orders' => $orders]);
    }
}

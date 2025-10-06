<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
       // Lấy đơn hàng mới nhất, phân trang 10 đơn mỗi trang
        $orders = Order::with('user')->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.orders', compact('orders'));
    }

    // Xem chi tiết 1 đơn hàng
    public function show(Order $order)
    {
        $order->load('details.product', 'user'); // quan hệ với chi tiết đơn và sản phẩm
        // dd($order);

        return view('admin.orderDetail', compact('order'));
    }
}

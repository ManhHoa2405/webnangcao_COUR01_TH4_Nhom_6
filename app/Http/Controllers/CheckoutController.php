<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use Illuminate\Support\Facades\Log;


class CheckoutController extends Controller
{
    //
    public function index(Request $request ){
        $userId = auth()->id(); 
        // Xóa các cart item không còn sản phẩm
        // Cart::where('user_id', $userId)
        //     ->whereDoesntHave('product')
        //     ->delete();

        // Lấy từ session (nếu trước đó bạn có lưu order_note trong giỏ hàng)
        $orderNote = $request->input('order_note', '');


        Log::debug($userId);
        Log::debug('4444');
        $cartItems = Cart::where('user_id',auth()->id())
        ->where('status','new')
        ->with('product')
        ->get()
        ->filter(fn($item) => $item->product !== null);


        Log::debug($cartItems);
        Log::debug('5555');
        // dd($cartItems);  
        return view('checkout.index' ,compact('cartItems','orderNote'));
    }

    public function store(Request $request){
        $request->validate([
            'cart_ids' => 'required|array',
            'method' => 'required|in:cash,momo,card'
        ]);

        $cartItems = Cart::where('user_id',auth()->id())
        ->where('status', 'new')
        ->whereIn('id',$request->cart_ids)
        ->with('product')
        ->get();

        if ($cartItems->isEmpty()) {
        return back()->with('error', 'Giỏ hàng trống, không thể thanh toán.');
        }
        
       $total = $cartItems->sum(fn($item) => $item->quantity * $item->product->price);

        if ($total <= 0) {
        return back()->with('error', 'Đơn hàng không hợp lệ.');
        }
        Log::debug($total);
        Log::debug('11111111');
        // tao don hang
        $order = Order::create([
            'user_id' =>auth()->id(),
            'total_amount' => $total,
            'status' => 'paid',
            'note' =>$request->input('order_note', ''),
        ]);

        Log::debug($order);
        Log::debug('333333');
        //tao chi tiet don hang
        foreach ($cartItems as $item) {
            OrderDetail::create([
                'order_id'      => $order->id,
                'product_id'    => $item->product_id,
                'product_name'  => $item->product->name,
                'product_price' => $item->product->price,
                'quantity'      => $item->quantity,
            ]);
        }
        Log::debug($total);
        Log::debug('2222');
        
        //thanh toan
        Payment::create([
            'order_id' => $order->id,
            'method'   => $request->method,
            'payment_amount' => $total
        ]);

        //xoa san pham trong gio
        Cart::whereIn('id', $request->cart_ids)->delete();

        return redirect()->route('checkout.index')->with('success', 'Đặt hàng thành công!');
    }

}

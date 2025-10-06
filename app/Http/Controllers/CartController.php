<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Hiển thị giỏ hàng
    public function index()
    {
        $user = auth()->user();
        $userId = auth()->id(); 

        // Cart::where('user_id', $userId)
        // ->whereDoesntHave('product')
        // ->delete();

        // Lấy giỏ hàng của user đã đăng nhập
        $carts = Cart::where('user_id', $user->id)->where('status','new')->with('product')->get();

        // Tổng số item
        $cartCount = $carts->sum('quantity');

        return view('cart.index', compact('carts', 'cartCount'));
    }

    // Thêm sản phẩm vào giỏ
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'nullable|integer|min:1',
        ]);

        $user = auth()->user();
        $product = Product::findOrFail($request->product_id);
        $quantity = $request->quantity ?? 1;

        // Giới hạn số lượng không vượt quá chất lượng kho
        $quantity = min($quantity, $product->qualityStock);

        // Kiểm tra sản phẩm đã có trong giỏ chưa
        $cartItem = Cart::where('user_id', $user->id)
                        ->where('product_id', $product->id)
                        ->where('status', 'new')
                        ->first();

        if($cartItem){
            // Tổng số lượng mới không vượt quá qualityStock
            $cartItem->quantity = min($cartItem->quantity + $quantity, $product->qualityStock);
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'quantity' => $quantity,
            ]);
        }

        // Tổng số item của user
        $cartCount = Cart::where('user_id', $user->id)->where('status', 'new')->sum('quantity');

        // Nếu request AJAX, trả về JSON để cập nhật số lượng giỏ hàng
        if($request->ajax()){
            return response()->json([
                'cartCount' => Cart::where('user_id', $user->id)->where('status', 'new')->sum('quantity')
            ]);
        }


        // Nếu submit form bình thường
        return redirect()->route('cart.index');

        return redirect()->route('cart.index')->with('success', 'Đã thêm vào giỏ hàng!');
    }

    public function checkoutIndex(Request $request)
    {
        $user = auth()->user();
        $carts = Cart::where('user_id', $user->id)->where('status', 'new')->with('product')->get();

        // Lấy ghi chú: ưu tiên từ query ?order_note=...
        $orderNote = $request->query('order_note') ?? session('order_note') ?? '';

        $cartCount = $carts->sum('quantity');

        return view('checkout.index', compact('carts', 'cartCount', 'orderNote'));
    }

    public function destroy($id)
    {
        $user = auth()->user();
        $cartItem = Cart::where('id', $id)->where('user_id', $user->id)->where('status', 'new')->firstOrFail();
        $cartItem->delete();

        // Cập nhật lại số lượng giỏ hàng
        $cartCount = Cart::where('user_id', $user->id)->where('status', 'new')->sum('quantity');

        // Nếu request AJAX
        if(request()->ajax()){
            return response()->json(['cartCount' => $cartCount]);
        }

        return redirect()->route('cart.index');
    }

    public function checkout(Request $request)
    {
        $user = auth()->user();
        $carts = Cart::where('user_id', $user->id)->where('status', 'new')->get();

        // Tính tổng tiền
        $totalAmount = $carts->sum(function($item){
            return $item->product->price * $item->quantity;
        });

        // Lưu ghi chú vào session
        if($request->filled('order_note')){
        session(['order_note' => $request->order_note]);
        }

        // Xóa giỏ hàng sau khi thanh toán
        Cart::where('user_id', $user->id)->update(['status'=>'new']);

        return redirect()->route('cart.index')->with('success', 'Thanh toán thành công!');
    }

}

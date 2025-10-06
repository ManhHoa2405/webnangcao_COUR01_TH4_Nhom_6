<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Cart;
use App\Models\Product;

class ShopController extends Controller
{
    //
    public function index(){
        $products = product::where('status','available')//con hang moi lay
        ->orderBy('id' ,'desc')->paginate(8);

        // Lấy danh sách category distinct
        $categories = Product::select('category')
            ->distinct()// loai bo cac gia tri trung lap quan, ao ( khong lay quan ,quan)
            ->pluck('category'); //lay. cac gia mot cot trong bang 

        $menus = Menu::all();   

        return view('shop.menuProducts',compact('products','categories','menus')); //compact bien product thanh mang de truyen sang view
    }

    public function category($category){
        $products = product::where('status','available')
        ->where('category',$category)
        ->orderBy('id','desc')
        ->paginate(8);

        $categories = Product::select('category')
            ->distinct()
            ->pluck('category');

          $menus = Menu::all();

            
        return view('shop.menuProducts', compact('products', 'categories', 'category','menus'));
    }


    public function show($id){
        $product = Product::findOrFail($id);

        $cartCount = 0;
        if(auth()->check()){
            $cartCount = \App\Models\Cart::where('user_id', auth()->id())->where('status','new')->sum('quantity');
        }

        // dd($cartCount);
        return view('shop.detailProduct', compact('product', 'cartCount'));
    }

    public function addToCart(REQUEST $request ){

        $productId = $request->product_id;
        $quantity = $request->quantity ?? 1;

        $cart = Cart::updateOrCreate(
            ['user_id' => auth()->id(), 'product_id' =>$productId],
            ['quantity'=> \DB::raw("quantity + $quantity")]
        );

    }
    public function cartCount(){
        $count =0;
        if(auth()->check()){
            $count= Cart::where('user_id',auth()->id())->where('status', 'new')->sum('quantity');
        }
        return respone()->json(['cartCount' => $count]);
    }
}



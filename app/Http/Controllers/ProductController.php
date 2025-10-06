<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function create(){
        return view('admin.addProduct');
    }

    public function index(){
        $products = Product::orderBy('id', 'desc')->paginate(10); //sắp xếp theo id giảm dần 10 sản phẩm mỗi trang
        return view('admin.editProduct', compact('products')); //return view, truyền biến products để hiển thị.
    }

    public function store(Request $request) {
        // validate dữ liệu
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'qualityStock' => 'required|integer',
            'category' => 'required|string|max:255',
            'image_url' => 'required|image|mimes:jpg,jpeg,webp,png|max:2048',
            'status' => 'required'
        ]);

        // lưu ảnh
        $imagePath = $request->file('image_url')->store('products', 'public');//lưu ảnh vào storage/app/public/products.
        // tạo sản phẩm
        // dd('3333');

        //Tạo bản ghi mới trong DB bảng products.
        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'qualityStock' => $request->qualityStock,
            'category' => $request->category,
            'image_url' => $imagePath,
            'status' => $request->status,
        ]);

        // dd('9999');
        return redirect()->route('products.create')->with('success', 'Thêm sản phẩm thành công!');


    }

    // public function edit() {
    //     $products = Product::all();
    //     return view('admin.editProduct', compact('products'));
    // }

    public function update(Request $request, $id) {
        // validate dữ liệu
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'qualityStock' => 'required|integer',
            'category' => 'required|string|max:255',
            'image_url' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', //Validate dữ liệu như store, nhưng image_url có thể nullable (không bắt buộc).
            'status' => 'required'
        ]);

        $product = Product::findOrFail($id); //Tìm sản phẩm theo $id. Nếu không thấy → báo lỗi 404.

        // nếu có ảnh mới thì lưu ảnh
        if ($request->hasFile('image_url')) {
            $imagePath = $request->file('image_url')->store('products', 'public');// Nếu có ảnh mới thì upload lại và ghi đè đường dẫn.
            $product->image_url = $imagePath;
        }

        // cập nhật sản phẩm
        $product->name = $request->name;
        $product->price = $request->price;
        $product->qualityStock = $request->qualityStock;
        $product->category = $request->category;
        $product->status = $request->status;
        $product->save();

        return redirect()->route('products.index')->with('success', 'Cập nhật sản phẩm thành công!');
    }

    // Xóa sản phẩm
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image_url && file_exists(public_path('storage/' . $product->image_url))) {
            unlink(public_path('storage/' . $product->image_url)); //Nếu sản phẩm có ảnh và ảnh tồn tại trong public/storage/... → xóa ảnh luôn.
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Xóa sản phẩm thành công!');
    }
}
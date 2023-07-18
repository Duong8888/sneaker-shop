<?php

namespace App\Http\Controllers\Admin\product;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    public function index()
    {
        return view('admin.index');
    }

    public function list()
    {
        $data = Product::all();
        $color = Color::all();
        $size = Size::all();
        $brand = Brand::all();
        return view('admin.product.list', compact('data', 'color', 'size', 'brand'));
    }

    public function add(Request $request)
    {
        // Lấy danh sách các tệp đã tải lên từ ô input file
        $files = $request->file('files');

        // Kiểm tra xem có tệp được tải lên hay không
        if ($request->hasFile('files')) {
           $result = uploadFile('uploads',$files,true);
           return response()->json(['files' => $result]);
        } else {
            return response()->json(['message' => 'Không có tệp tải lên.']);
        }
    }

    public function edit(ProductRequest $request, $id)
    {

    }
}

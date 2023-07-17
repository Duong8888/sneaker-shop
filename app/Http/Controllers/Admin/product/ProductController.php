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

    public function index(){
        return view('admin.index');
    }
    public function list(){
        $data = Product::all();
        $color = Color::all();
        $size = Size::all();
        $brand = Brand::all();
        return view('admin.product.list', compact('data','color','size','brand'));
    }
    public function add(Request $request){
        // Lấy danh sách các file ảnh
        if ($request->hasFile('file')) {
            $files = $request->file('file');
            // Duyệt qua từng file ảnh và thực hiện xử lý
            foreach ($files as $file) {
                // Lưu file vào thư mục lưu trữ hoặc thực hiện xử lý khác tùy ý
                $filename = $file->getClientOriginalName();
//                $file->move(public_path('uploads'), $filename);
            }
        }else{
            dd('no');
        }
    }

    public function edit(ProductRequest $request,$id){

    }
}

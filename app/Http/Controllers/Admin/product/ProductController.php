<?php

namespace App\Http\Controllers\Admin\product;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Color;
use App\Models\ImagesProduct;
use App\Models\Product;
use App\Models\Size;
use App\Models\Variations;
use App\Models\VariationsHistories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{

    public function index()
    {
        $color = Color::all();
        $size = Size::all();
        $brand = Brand::all();
        return view('admin.product.list', compact('color', 'size', 'brand'));
    }

    public function list()
    {
        $products = Product::all();
        $data = [];
        foreach ($products as $value) {
            $data = Product::with('brand')->get();
        }
        return response()->json(['products' => $data]);
    }

    public function add(ProductRequest $request)
    {
        $files = $request->file('files');// Lấy danh sách các tệp đã tải lên từ ô input file
        $countVariations = (int)($request->input('lengthFor')); // lấy số lương biến thể đếm được ở bên giao diện
        $slug = Str::slug($request->input('productName'));// tạo slug thông qua name
        $product = Product::create([// lưu thôn tin sản phẩm
            'product_name' => $request->input('productName'),
            'description' => $request->input('description'),
            'slug' => $slug,
            'brand_id' => $request->brand,
        ]);
        $id = (int)($product->id);
        // Kiểm tra xem có tệp được tải lên hay không
        if ($request->hasFile('files')) {
            // thêm ảnh vào folder public/uploads
            $result = uploadFile('images', $files, true);
//            dd($result);
            foreach ($result as $value) {
                ImagesProduct::create([
                    'url' => $value['url'],
                    'product_id' => $id,
                ]);
            }
        }
        // thự hiện lưu các biến thể
        for ($i = 1; $i <= $countVariations; $i++) {
            Variations::create([
                'product_id' => $id,
                'size_id' => (int)($request->input('size-variations-' . $i)),
                'color_id' => (int)($request->input('color-variations-' . $i)),
                'quantity' => $request->input('quantity-variations-' . $i),
                'price' => $request->input('price-variations-' . $i),
            ]);
        }
        return response()->json(['message' => 'them moi thanh cong']);
    }

    public function showEdit(Request $request, $id)
    {
        $product = Product::with(['brand', 'variations','images'])->find($id);
        return response()->json(['data' => $product]);
    }

    public function saveEdit(Request $request, $id)
    {
        $product = Product::find($id);
        $requestAll = $request->all();
        if ($product->product_name !== $request->input('productName')) {
            $slug = Str::slug($request->input('productName'));
            $product->product_name = $request->input('productName');
            $product->slug = $slug;
        }
        if ($product->description !== $request->input('description')) {
            $product->description = $request->input('description');
        }
        if ($product->brand_id !== $request->input('brand')) {
            $product->brand_id = $request->input('brand');
        }

        $files = $request->file('files');// Lấy danh sách các tệp đã tải lên từ ô input file
        // Kiểm tra xem có tệp được tải lên hay không
        if ($request->hasFile('files')) {
            // thêm ảnh vào folder public/uploads
            $result = uploadFile('uploads', $files, true);
            ImagesProduct::where(['product_id' => $id])->delete();
            foreach ($result as $value) {
                ImagesProduct::create([
                    'url' => $value['url'],
                    'product_id' => $id,
                ]);
            }
        }
        // thự hiện update các biến thể
       foreach ($request->all() as $key => $value){
           // Kiểm tra nếu khóa bắt đầu bằng "quantity-Variations-"
           if(strpos($key, 'quantity-variations-') === 0 || strpos($key, 'price-variations-') === 0){
               $variableId = explode('-', $key)[2]; // lấy id bản gi cần update
               $variableIdColum = explode('-', $key)[0];
               Variations::where('id', $variableId)->update([$variableIdColum => $value]);
           }
       }
        $product->save();
        return response()->json(['message' => 'updated thanh cong']);
    }

    public function delete(Request $request, $id)
    {
        if ($request->isMethod('DELETE')) {
            Product::destroy($id);
            return response(['message' => 'Xóa thành công']);
        }
        return response(['message' => 'Không thể xóa']);
    }


}

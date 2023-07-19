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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function add(Request $request)
    {
        $files = $request->file('files');// Lấy danh sách các tệp đã tải lên từ ô input file
        $countVariations = (int)($request->input('lengthFor')); // lấy số lương biến thể đếm được ở bên giao diện
        $product = Product::create([        // lưu thôn tin sản phẩm
            'product_name' => $request->input('product-name'),
            'description' => $request->input('description'),
            'slug' => $request->input('slug'),
            'brand_id' => $request->brand,
        ]);
        $id = (int)($product->id);
        // Kiểm tra xem có tệp được tải lên hay không
        if ($request->hasFile('files')) {
            // thêm ảnh vào folder public/uploads
            $result = uploadFile('uploads', $files, true);
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
                'size_id' => (int)($request->input('size-variable-' . $i)),
                'color_id' => (int)($request->input('color-variable-' . $i)),
                'quantity' => $request->input('quantity-variable-' . $i),
                'price' => $request->input('price-variable-' . $i),
            ]);
        }
        return response()->json(['message' => 'them moi thanh cong']);
    }

    public function edit(ProductRequest $request, $id)
    {

    }

    public function delete(Request $request, $id)
    {
        if($request->isMethod('DELETE')){
            Product::destroy($id);
            return response(['message' => 'Xóa thành công']);
        }
        return response(['message' => 'Không thể xóa']);
    }
}

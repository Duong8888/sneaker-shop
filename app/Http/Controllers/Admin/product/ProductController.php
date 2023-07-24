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
                'size_id' => (int)($request->input('size-variable-' . $i)),
                'color_id' => (int)($request->input('color-variable-' . $i)),
                'quantity' => $request->input('quantity-variable-' . $i),
                'price' => $request->input('price-variable-' . $i),
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
//        return response()->json(['data' => $requestAll]);
        $countVariationsUpdate = (int)($request->input('lengthFor')); // lấy số lương biến thể đếm được ở bên giao diện
        if ($product->product_name !== $request->input('productName')) {
            $slug = Str::slug($request->input('productName'));// tạo slug thông qua name
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
//            dd($result);
            ImagesProduct::where(['product_id' => $id])->delete();
            foreach ($result as $value) {
                ImagesProduct::create([
                    'url' => $value['url'],
                    'product_id' => $id,
                ]);
            }
        }
        // thự hiện lưu các biến thể
        /*
         * lấy ra danh sách sản phẩm biến thể hiện tại
         * vì phần color và size của mỗi biến thể là khác nhău không thể trùng lặp nên có thể dựa vào đó để lấy ra id của biến thể đó
         * Lý do cần làm vậy vì phần update biến thể cần lấy id của nó để update
         * Lý do nữa là do phần giao diện update khá là lằng nhằng vì có thể xóa biến thể tạo lại nên nó sẽ bị xáo trộn
         * */
//        $variationsOld = Variations::where('product_id',$id)->get();
//        // sao lư lại dữ liệu trước khi update
//        foreach ($variationsOld as $value){
//            VariationsHistories::create([
//                'id' => $value->id,
//                'product_id' => $id,
//                'size_id' => $value->size_id,
//                'color_id' => $value->color_id,
//                'quantity' => $value->quantity,
//                'price' => $value->price,
//            ]);
//        }
//        for ($i = 1; $i <= $countVariationsUpdate; $i++) {
//            Variations::create([
//                'product_id' => $id,
//                'size_id' => (int)($request->input('size-variable-' . $i)),
//                'color_id' => (int)($request->input('color-variable-' . $i)),
//                'quantity' => $request->input('quantity-variable-' . $i),
//                'price' => $request->input('price-variable-' . $i),
//            ]);
//        }
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

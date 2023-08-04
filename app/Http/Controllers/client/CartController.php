<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index(){
        return view('client.cart.index');
}
public function valueTable(Request $request){
        if ($request->session()->has('myCart')){
            $mycart = Session::get('myCart');
            $arrColor = Color::all();
            $arrSize = Size::all();
            $arrProduct = Product::query()->with(['images', 'variations'])->get();
//            dd($mycart);
            return response()
                ->json(['mycart'=>$mycart,'color'=>$arrColor,'size'=>$arrSize,'arrProduct'=>$arrProduct]);
        }else{
            $mycart = [];
            return response()->json($mycart);
        }

}
    public function saveCart(Request $request)
    {
//        return response()->json(['message'=> "Đẹp trai số 2"]);
        try {

            if ($request->session()->has('myCart')) {
                Session::forget('myCart');
            }
            $data = $request->all();

            $request->session()->put('myCart',$data);

            if ($request->session()->has('myCart')) {
                return response()->json(['message' => 'Lưu giỏ hàng thành công']);
            } else {
                return response()->json(['error' => 'Không thể lưu giỏ hàng'], 500);
            }

        } catch (\Exception $e) {
            return response()->json(['error' => 'Đã xảy ra lỗi khi lưu giỏ hàng'], 500);
        }


    }
}

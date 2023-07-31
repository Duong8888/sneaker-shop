<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index(){
        return view('client.cart.index');
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

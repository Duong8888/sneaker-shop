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
        $data = $request->json()->all();

        // Lưu giá trị vào session
        Session::put('myCart', $data);

        return response()->json(['message' => 'Dữ liệu đã được lưu vào session']);
    }
}

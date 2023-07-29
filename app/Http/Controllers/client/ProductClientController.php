<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductClientController extends Controller
{
    public function index(){
        $this->cartProduct();
        return view('client.product.index');
    }

    public function cartProduct(){
        Session::remove('my_cart');
        $data = [
            [
                'product_id'=>25,
                'color_id'=>29,
                'size_id' => 14,
                'quantity'=>10,
            ],
            [
                'product_id'=>28,
                'color_id'=>31,
                'size_id' => 15,
                'quantity'=>1,
            ],
            [
                'product_id'=>29,
                'color_id'=>42,
                'size_id' => 15,
                'quantity'=>19,
            ],
        ];
        Session::put('my_cart',$data);
    }
}

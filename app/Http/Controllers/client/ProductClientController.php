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
                'product_id'=>1,
                'color_id'=>1,
                'size_id' => 1,
                'quantity'=>10,
            ],
            [
                'product_id'=>2,
                'color_id'=>5,
                'size_id' => 1,
                'quantity'=>1,
            ],
            [
                'product_id'=>2,
                'color_id'=>6,
                'size_id' => 1,
                'quantity'=>100,
            ],
        ];
        Session::put('my_cart',$data);
    }
}

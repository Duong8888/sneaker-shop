<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductClientController extends Controller
{
    public function index(){


        $data_products = Product::query()->with('images')->with('variations')->get();
        $data_brands = Brand::query()->limit(8)->get();
//        dd($data_products[2]->variations);
        return view('client.product.index',compact('data_products','data_brands'));


    }

}

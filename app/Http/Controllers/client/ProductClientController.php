<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductClientController extends Controller
{
    public function index(){
        $data = Product::query()->with('images')->get();


        return view('client.product.index',compact('data'));
    }
}

<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DetailController extends Controller
{
    public function detail(Request $request, $id){


        if ($request->session()->has('myCart')) {
            $mycart = Session::get('myCart');
        } else {
            $mycart = [];
        }
        $product_detail = Product::query()
            ->with('images')
            ->with('variations')

            ->where('id',$id) ->first();

        return response()->json(['product_detail'=>$product_detail,'mycart'=>$mycart]);
//        return response()->json($product_detail);
    }
}

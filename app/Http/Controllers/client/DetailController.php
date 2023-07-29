<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function detail(Request $request,$id){


        $product_detail = Product::query()
            ->with('images')
            ->with('variations')

            ->where('id',$id) ->first();
//        dd($product_detail);
        return response()->json($product_detail);
    }
}

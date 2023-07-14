<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    const OBJECT = 'admin';
    const DOT = '.';
    const PRODUCT = 'ProductAdmin';
    public function index(){
        return view(self::OBJECT. self::DOT . __FUNCTION__);
    }
    public function list(){
        $data = Product::all();
        return view(self::OBJECT . self::DOT .self::PRODUCT . self::DOT . __FUNCTION__, compact('data'));
    }
    public function add(Request $request){
        if ($request->isMethod('post')){
            dd('hihi');
        }
        return view(self::OBJECT. self::DOT .self::PRODUCT . self::DOT . __FUNCTION__);
    }

    public function edit(ProductRequest $request,$id){
//        dd($request->id);

        $data = DB::table('products')->where('id',$id)->first();
//        dd($data->description);
        if ($request->isMethod('post')){
            dd('hihi');
        }

        return view(self::OBJECT. self::DOT .self::PRODUCT . self::DOT . __FUNCTION__, compact('data'));
    }
}

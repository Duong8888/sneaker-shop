<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use Illuminate\Support\Facades\DB;

class BrandsController extends Controller
{
    const OBJECT = 'admin';
    const DOT = '.';
    const BRANDS = 'brandsAdmin';
  public function list(){
      $data = Brand::all();
    return view(self::OBJECT . self::DOT . self::BRANDS . self::DOT . __FUNCTION__,compact('data'));
  }
    public function add(BrandRequest $request){
//
        if ($request->isMethod('POST')){

        }
        return view(self::OBJECT . self::DOT . self::BRANDS . self::DOT . __FUNCTION__);
    }
    public function edit(BrandRequest $request,$id){
        $data = DB::table('brands')->where('id',$id)->first();
        if ($request->isMethod('POST')){

        }
        return view(self::OBJECT . self::DOT . self::BRANDS . self::DOT . __FUNCTION__,compact('data'));
    }
}

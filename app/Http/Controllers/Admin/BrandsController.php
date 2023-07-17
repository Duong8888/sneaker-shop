<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use http\Env\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class BrandsController extends Controller
{
    const OBJECT = 'admin';
    const DOT = '.';
    const BRANDS = 'brands';
  public function list(){
      $data = Brand::all();
    return view(self::OBJECT . self::DOT . self::BRANDS . self::DOT . __FUNCTION__,compact('data'));
  }
    public function add(BrandRequest $request){
//
        if ($request->isMethod('POST')){
            $uploadedFiles = $request->input('uploaded_files');
            dd($uploadedFiles);
            dd($request->input('name_brand'));
            // tạo slug
            $slug = Str::slug($request->input('name_brand'));
            $data = $request->except('_token');
            $data['slug'] = $slug;
            $brands = Brand::create($data);
            if ($brands->id){
                Session::flash('success','Thêm thương hiệu thành công');
                return redirect()->route('route.brands.list');
            }
        }
        return view(self::OBJECT . self::DOT . self::BRANDS . self::DOT . __FUNCTION__);
    }
    public function edit(BrandRequest $request,$id){
        $data = DB::table('brands')->where('id',$id)->first();

        if ($request->isMethod('POST')){

            $slug = Str::slug($request->input('name_brand'));

            $data = $request->except('_token');
            $data['slug'] = $slug;
            $brands = Brand::where('id',$id)->update($data);
            if ($brands){
                Session::flash('success','sửa thương hiệu thành công');
                return redirect()->route('route.brands.list');
            }
        }
        return view(self::OBJECT . self::DOT . self::BRANDS . self::DOT . __FUNCTION__,compact('data'));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
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


        if ($request->isMethod('POST')){
            // lấy ra mảng các file đã chọn
            $files = $request->file('files');

            $count = count($files) > 1 ? 'true' : 'false';

            // tạo slug
            $slug = Str::slug($request->input('name_brand'));
            $data = $request->except('_token','files');

            // nếu như tồn tại file thì up file
            if ($request->hasFile('files')){
                $filesValue = [];
                foreach ($files as $file){
                    if ($file->isValid()){
                        $filesValue[] = $file;
                    }else{
                        Session::flash('error','ảnh '.$file.' không hợp lệ');
                        return redirect()->route('route.brands.add');
                    }
                }
                $image = uploadFile('images',$filesValue,$count);
            }

            $data['image'] = $image;
            $data['slug'] = $slug;
            $brands = Brand::create($data);
//            dd($brands->id);
            if ($brands->id){
//
                Session::flash('success','Thêm thương hiệu thành công');
                return redirect()->route('route.brands.list');
            }
        }
        return view(self::OBJECT . self::DOT . self::BRANDS . self::DOT . __FUNCTION__);
    }
    public function edit(BrandRequest $request,$id){
        $data = DB::table('brands')->where('id',$id)->first();
//        dd($data);

        if ($request->isMethod('POST')){
            $dataNew = $request->except('_token','files');
            $files = $request->file('files');

            $count = is_array($files) ? 'true' : 'false';

            $slug = Str::slug($request->input('name_brand'));


            if ($request->hasFile('files')){

                // có file mới upload lên sẽ link vào để xóa ảnh cũ đi
                $resultDL = File::delete(public_path('images').'/'.$data->image);
                if ($resultDL){
                    $dataNew['image'] = uploadFile('images',$files,$count);
                }else{
                    $dataNew['image'] = $data->image;
                }
            }


//            $data['image'] = $image;
            $dataNew['slug'] = $slug;
            $brands = Brand::where('id',$id)->update($dataNew);
            if ($brands){
                Session::flash('success','sửa thương hiệu thành công');
                return redirect()->route('route.brands.list');
            }
        }
        return view(self::OBJECT . self::DOT . self::BRANDS . self::DOT . __FUNCTION__,compact('data'));
    }

    public function delete($id){
        Brand::where('id',$id)->delete();
        Session::flash('success','Đã chuyển thương hiệu id là: '.$id.' đến thùng rác. bạn có thể khôi phục tại đó');
        return redirect()->route('route.brands.list');
    }
}

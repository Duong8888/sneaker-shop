<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class TrashBrandController extends Controller
{
    public function list(){
        $data = Brand::onlyTrashed()->get();
        return view('admin.trash.list',compact('data'));
    }

    public function restore($id){
//        dd($id);
//        $brand = Brand::withTrashed()->findOrFail($id);
//        $brand->restore();
//        dd($brand);
        $brand = Brand::withTrashed()->where('id',$id)->restore();
        if ($brand) {
//            $brand->restore();
            // Thực hiện các thao tác khác sau khi khôi phục
            return redirect()->route('route.brands.trash')->with('success', 'Khôi phục thành công');
        } else {
            return redirect()->route('route.brands.trash')->with('error', 'Khôi phục thất bại');
        }
    }
    public function delete($id){

        $brand = Brand::withTrashed()->where('id', $id)->forceDelete();
        if ($brand) {
//            $brand->restore();
            // Thực hiện các thao tác khác sau khi khôi phục
            return redirect()->route('route.brands.trash')->with('success', 'Xóa thành công');
        } else {
            return redirect()->route('route.brands.trash')->with('error', 'Xóa thất bại');
        }
    }
}

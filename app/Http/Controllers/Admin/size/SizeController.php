<?php

namespace App\Http\Controllers\Admin\size;

use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{

    public function index(){
        return view('admin.size.index');
    }
    public function list(){
        $data = Size::OrderBy('id','desc')->get();
        return response()->json(['data' => $data]);
    }
    public function add(Request $request)
    {
        $result = $request->validate([
            'data' => 'required'
        ]);

        if ($result) {
            $size = Size::create([
                'size_value' => $request->input('data'),
            ]);

            return response()->json(['message' => 'Thêm mới thành công','id'=> $size->id,'value'=>$size->size_value,'name' => 'size']);
        }

        return response()->json(['message' => 'Lỗi khi thêm mới'], 500);
    }

    public function update(Request $request, $id){
        if($request->isMethod('POST')){
            $request->validate([
                'data' => 'required'
            ]);
            $data = Size::where('id', $id)->update(['color_value' => $request->data]);
            return response()->json(['message' =>'Cập nhật thành công.']);
        }else{
            $data = Size::where('id', $id)->first();
            return response()->json(['data' =>$data]);
        }
    }

    public function delete(Request $request, $id){
        if ($request->isMethod('DELETE')) {
            Size::destroy($id);
            return response(['message' => 'Xóa thành công']);
        }
        return response(['message' => 'Không thể xóa']);
    }
}

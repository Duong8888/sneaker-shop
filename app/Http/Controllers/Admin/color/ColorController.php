<?php

namespace App\Http\Controllers\Admin\color;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Size;
use Illuminate\Http\Request;

class ColorController extends Controller
{

    public function index(){
        return view('admin.color.index');
    }
    public function list(){
        $data = Color::OrderBy('id','desc')->get();
        return response()->json(['data' => $data]);
    }
    public function add(Request $request)
    {
        $result = $request->validate([
            'data' => 'required'
        ]);

        if ($result) {
            $color = Color::create([
                'color_value' => $request->input('data'),
            ]);

            return response()->json(['message' => 'Thêm mới thành công','id'=> $color->id,'value'=>$color->color_value,'name' => 'color']);
        }

        return response()->json(['message' => 'Lỗi khi thêm mới'], 500);
    }

    public function update(Request $request, $id){
        if($request->isMethod('POST')){
            $request->validate([
                'data' => 'required'
            ]);
            $data = Color::where('id', $id)->update(['color_value' => $request->data]);
            return response()->json(['message' =>'Cập nhật thành công.']);
        }else{
            $data = Color::where('id', $id)->first();
            return response()->json(['data' =>$data]);
        }
    }

    public function delete(Request $request, $id){
        if ($request->isMethod('DELETE')) {
            Color::destroy($id);
            return response(['message' => 'Xóa thành công']);
        }
        return response(['message' => 'Không thể xóa']);
    }

}

<?php

namespace App\Http\Controllers\Admin\color;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Size;
use Illuminate\Http\Request;

class ColorController extends Controller
{

    public function index(){
        $data = Color::all();
        $size = Size::all();
        return view('admin.color.index',compact('data','size'));
    }
    public function add(Request $request)
    {
        $result = $request->validate([
            'value' => 'required'
        ]);

        if ($result) {
            $color = Color::create([
                'color_value' => $request->value,
            ]);

            return response()->json(['message' => 'Thêm mới thành công','id'=> $color->id,'value'=>$color->color_value,'name' => 'color']);
        }

        return response()->json(['message' => 'Lỗi khi thêm mới'], 500);
    }

    public function delete($id){
        Color::destroy($id);
        return back();
    }

}

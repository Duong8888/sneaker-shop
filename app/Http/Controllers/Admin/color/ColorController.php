<?php

namespace App\Http\Controllers\Admin\color;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
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

}

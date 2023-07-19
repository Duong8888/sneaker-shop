<?php

namespace App\Http\Controllers\Admin\size;

use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function add(Request $request)
    {
        $result = $request->validate([
            'value' => 'required'
        ]);

        if ($result) {
            $size = Size::create([
                'size_value' => $request->value,
            ]);

            return response()->json(['message' => 'Thêm mới thành công','id'=> $size->id,'value'=>$size->size_value,'name' => 'size']);
        }else{
            return response()->json(['message' => 'Lỗi khi thêm mới'], 500);
        }

    }
}

<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DetailProductController extends Controller
{
    public function addSession(Request $request, $id){
        $valueDetail = $request->except(['_token','slug']);
//        dd($valueDetail);
        if ($request->session()->has('myCart')){
            $mycart = Session::get('myCart');
//            dd($mycart['data']);
            $isDuplicate = false;
            for ($i = 0; $i < count($mycart['data']); $i++){
//                dd($item['quantity']);
                if ($mycart['data'][$i]['product_id'] == $valueDetail['product_id'] && $mycart['data'][$i]['color_id'] == $valueDetail['color_id'] && $mycart['data'][$i]['size_id'] == $valueDetail['size_id']){
                    $isDuplicate = true;
                    $mycart['data'][$i]['quantity'] += $valueDetail['quantity'];
//                    dd($mycart['data'][$i]['quantity'], $mycart['data']);
//                    $mycart['data'];
                    break;
                }
            }
            if (!$isDuplicate){
//                dd($mycart['data']);
                $mycart['data'][] = $valueDetail;
//                dd($mycart['data']);
            }
//            dd($mycart['data']);
            $request->session()->put('myCart', $mycart);

            return redirect()->route('route.viewDetail',$request->slug);
        }else{
            $mycart['data'] = [$valueDetail];
            // Lưu mảng mới vào session
            $request->session()->put('myCart', $mycart);
            return redirect()->route('route.viewDetail',$request->slug);
        }
    }
    public function viewDetail($slug){
        $product_detail = Product::query()
            ->with(['images', 'variations'])
            ->where('slug', $slug)->first();
        $arrColor = Color::all();
        $arrSize = Size::all();
        return view('client.product_detail.detail',compact('product_detail','arrSize','arrColor'));
    }
    public function detail(Request $request, $id)
    {

        if ($request->session()->has('myCart')) {
            $mycart = Session::get('myCart');
        } else {
            $mycart = [];
        }
        $product_detail = Product::query()
            ->with(['images', 'variations'])
            ->where('id', $id)->first();
        $arrColor = Color::all();
        $arrSize = Size::all();
        return response()->json(['product_detail' => $product_detail, 'mycart' => $mycart,'arrSize' => $arrSize,'arrColor' => $arrColor]);
//        return response()->json($product_detail);
    }
}

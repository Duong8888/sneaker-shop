<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\ImagesProduct;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Collection\Collection;

class OrderController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $orderList = Order::query()
            ->where('user_id', $user->id)
            ->orderBy('id', 'DESC')
            ->get();
        $data = [
            'orderList' => $orderList,
            'user' => $user,
        ];
        return view('client.user.account', compact(['data']));
    }

    public function detailOrder(Request $request)
    {
        $orderDetail = OrderDetail::query()
            ->where('order_id', $request->id)->with(['variations'])->get();
        $data = [];
        foreach ($orderDetail as $value) {
            $product = Product::query()->where('id', $value->variations->product_id)->get();
            $productImage = ImagesProduct::query()->where('product_id', $value->variations->product_id)->first();
            $color = Color::query()->where('id', $value->variations->color_id)->get();
            $size = Size::query()->where('id', $value->variations->size_id)->get();
            $data[] = [
                'product' => $product[0]->product_name . " (mằu: " . $color[0]->color_value . ",size: " . $size[0]->size_value . ")",
                'product_id' => $product[0]->id,
                'image' => $productImage->url,
                'quantity' => $value->quantity,
                'price' => number_format($value->variations->price),
                'total' => number_format($value->quantity * $value->variations->price),
            ];
        }
        return view('client.cart.detail', compact(['data']));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\ImagesProduct;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Size;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $order;
    public $orderDetail;
    public function __construct(Order $order,OrderDetail $orderDetail)
    {
        $this->order =$order;
        $this->orderDetail =$orderDetail;
    }

    public function index()
    {
        $orderList = $this->order
            ->orderBy('id', 'DESC')
            ->paginate(5);
        $data = $orderList;
        return view('admin.order.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request,string $id)
    {
        $order = $this->order->where('id',$id)->get();
        $user = User::where('id',$order[0]->user_id)->get();
        $orderDetail = $this->orderDetail
            ->where('order_id',$id)->with(['variations'])->get();
        $data = [];
        $total = 0;
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
            $total+=$value->quantity * $value->variations->price;
        }
        return view('admin.order.detail',compact('data', 'id','total','order','user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $order = $this->order->query()->findOrFail($id);
        if ($order) {
            $order->update([
                'delivery_status' => $request->input('status'),
            ]);
        }
        return back()->with('message','Cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

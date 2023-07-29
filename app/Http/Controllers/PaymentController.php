<?php

namespace App\Http\Controllers;

use App\Models\Variations;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function showCheckout(Request $request)
    {
        $user = Auth::user();
        $myCart = Session::get('my_cart');
        $arrayVariations = new Collection();
        $totalCart = 0;
        foreach ($myCart as $value) {
            $query = Variations::query();
            $variations = $query->where('product_id', $value['product_id'])
                ->where('color_id', $value['color_id'])
                ->where('size_id', $value['size_id'])
                ->with(['color', 'size', 'product'])->get();
            if ($variations->isNotEmpty()) {
                /* khái niệm tham trị và tham triếu search gg để hiểu thêm
                Tham trị (by value): nếu thêm dấu & thì nó sẽ là tham chiếu bến được truyền vào giá trị được thany đổi sẽ ảnh hưởng trược tiếp đến biế được khai báo ở bên ngoài
                Tham chiếu (reference): còn nếu khai báo bình thường chỉ có dấu $ thì nó sẽ là tham trị. Bất kỳ thay đổi nào đối với biến trong hàm không ảnh hưởng đến giá trị của biến gốc bên ngoài hàm.
                */
                $variations->map(function ($item) use (&$totalCart, $value) {
                    $item->quantity = $value['quantity'];
                    $item->totalItem = $value['quantity'] * $item->price;
                    $totalCart += $item->totalItem;
                });
                $arrayVariations = $arrayVariations->concat($variations);
            }
        }
        $data = [
            'name' => $user->name,
            'email' => $user->email,
            'address' => $user->address,
            'my_cart' => $arrayVariations,
            'total_cart' => $totalCart,
        ];
        return view('client.checkout.main', compact(['data']));
    }
}

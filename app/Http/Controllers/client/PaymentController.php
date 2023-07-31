<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\Variations;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{

    public function createPayment(Request $request)
    {
        $vnp_Url = env('VNP_URL');
        $vnp_Returnurl = route('payment.callback');
        $vnp_TmnCode = env('VNP_TMNCODE');//Mã website tại VNPAY
        $vnp_HashSecret = env('VNP_HASHSECRET'); //Chuỗi bí mật
        $vnp_TxnRef = time(); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'checkout';
        $vnp_OrderType = 'online';
        $vnp_Amount = $request->input('total_amount') * 100;
        $vnp_Locale = 'NV';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $inputData = [
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        ];

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);//
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
        , 'message' => 'success'
        , 'data' => $vnp_Url);
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
    }

    public function handlePaymentCallback(Request $request)
    {
//        dd($request->all());
        if ($request->vnp_ResponseCode == '00' && $request->vnp_TransactionStatus == '00') { // trạng thái giao dịch thành công

            // tạo đơ hàng
            $order = new Order([
                'total' => $request->vnp_Amount,
                'user_id' => Auth::user()->id,
                'payment_method' => 'online',
                'payment_status' => 'success',
                'delivery_status' => '1' // chờ nhận hàng
            ]);
            $order->save();
//             tạo chi tiết đơn hàng
            foreach (\session('arrayVariations') as $value) {
                OrderDetail::create([
                    'variations_id' => $value->id,
                    'order_id' => $order->id,
                ]);
            }
            Payment::create([
                'order_id' => $order->id,
                'payment_method' => 'online',
                'transaction_id'=>$request->vnp_TransactionNo,
                'amount'=>($request->vnp_Amount) / 100,
                'status' => 'success'
            ]);
            Session::forget('arrayVariations');
            Session::put('my_cart',[]);
            return redirect()->route('account');
        }
        return redirect()->route('checkout');
    }




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
                $arrayVariations = $arrayVariations->merge($variations);
            }
        }
        $data = [
            'name' => $user->name,
            'email' => $user->email,
            'address' => $user->address,
            'my_cart' => $arrayVariations,
            'total_cart' => $totalCart,
        ];
        Session::put('arrayVariations',$arrayVariations);
        return view('client.checkout.main', compact(['data']));
    }
}

<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Jobs\MailJobs;
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
        $vnp_Returnurl = route('checkout.payment.callback');
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
        if ($request->vnp_ResponseCode == '00' && $request->vnp_TransactionStatus == '00') { // trạng thái giao dịch thành công
            // tạo đơ hàng
            $order = new Order([
                'total' => ($request->vnp_Amount) / 100,
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
                    'quantity' => $value->quantity,
                ]);
            }
            Payment::create([
                'order_id' => $order->id,
                'payment_method' => 'online',
                'transaction_id' => $request->vnp_TransactionNo,
                'amount' => ($request->vnp_Amount) / 100,
                'status' => 'success'
            ]);
            Session::forget('arrayVariations');
            Session::put('myCart', []);
            // đẩy việc send mail vào queue
            $dataSendMail = [
                'time' => date("Y-m-d H:i:s"),
                'user_name' => Auth::user()->name,
                'total' => $order->total,
                'status' => $order->payment_status,
            ];
            MailJobs::dispatch(Auth::user()->email,$dataSendMail)->delay(now()->addSecond(20));
            return redirect()->route('account');
        }
        return redirect()->route('checkout');
    }

    public function refund(Request $request)
    {
        // Lấy thông tin cần thiết từ request
        $order_id = $request->input('order_id');
        // Xử lý logic để kiểm tra và thực hiện hoàn tiền
        // Kiểm tra xem đơn hàng có tồn tại và chưa được hoàn tiền
        $order = Order::find($order_id);
        if (!$order) {
            return response()->json(['code' => 'error', 'message' => 'Đơn hàng không tồn tại'], 400);
        }
        if ($order->payment_status == 'refund') {
            return response()->json(['code' => 'error', 'message' => 'Đơn hàng đã được hoàn tiền'], 400);
        }
        if ($order->payment_status == 'online') {
            $this->handleRefund($order->id);
        }
    }

    public function handleRefund($order_id)
    {
        // Thực hiện hoàn tiền với VNPAY
        // Sử dụng thư viện HTTP client của Laravel để gửi yêu cầu hoàn tiền đến VNPAY
        $order = Order::find($order_id);
        $amount_to_refund = $order->total;
        $vnp_RefundUrl = env('VNP_REFUND_URL');
        $vnp_HashSecret = env('VNP_HASHSECRET'); // Chuỗi bí mật

        $vnp_TxnRef = time(); // Mã đơn hàng hoàn tiền
        $vnp_Amount = $amount_to_refund * 100;

        // Tạo dữ liệu để gửi yêu cầu hoàn tiền
        $inputData = [
            "vnp_Version" => "2.1.0",
            "vnp_Command" => "refund",
            "vnp_TmnCode" => env('VNP_TMNCODE'), // Mã website tại VNPAY
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_OrderInfo" => "refund_order",
            "vnp_Amount" => $vnp_Amount,
        ];

        ksort($inputData);
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            $hashdata .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        // Tính chuỗi hash
        $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
        $vnp_Url = $vnp_RefundUrl . "?" . $hashdata . 'vnp_SecureHash=' . $vnpSecureHash;

        // Gửi yêu cầu hoàn tiền đến VNPAY
        $client = new \GuzzleHttp\Client();
        $response = $client->get($vnp_Url);
        $response_body = $response->getBody();
        // Xử lý kết quả trả về từ VNPAY
        if ($response_body == 'Refund Success') {
            // Cập nhật trạng thái hoàn tiền cho đơn hàng
            $order->payment_status = 'refund';
            $order->save();
            // Hoàn tiền thành công
            return response()->json(['code' => 'success', 'message' => 'Yêu cầu hoàn tiền thành công']);
        } else {
            // Hoàn tiền thất bại
            return response()->json(['code' => 'error', 'message' => 'Yêu cầu hoàn tiền thất bại']);
        }
    }


    public function showCheckout(Request $request)
    {
        if (Session::get('myCart') == null) {
            return back();
        }
        $user = Auth::user();
        $myCart = Session::get('myCart');
        $arrayVariations = new Collection();
        $totalCart = 0;
        foreach ($myCart['data'] as $value) {
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
            'myCart' => $arrayVariations,
            'total_cart' => $totalCart,
        ];
        Session::put('arrayVariations', $arrayVariations);
        return view('client.checkout.main', compact(['data']));
    }
}

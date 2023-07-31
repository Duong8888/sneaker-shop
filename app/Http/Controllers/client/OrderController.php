<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orderList = Order::query()->orderBy('id', 'DESC')->get();
        $user = Auth::user();
        $data = [
            'orderList' => $orderList,
            'user' => $user,
        ];
        return view('client.user.account', compact(['data']));
    }
}

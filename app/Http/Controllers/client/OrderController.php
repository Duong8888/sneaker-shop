<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $orderList = Order::query()
            ->where('user_id',$user->id)
            ->orderBy('id', 'DESC')
            ->get();
        $data = [
            'orderList' => $orderList,
            'user' => $user,
        ];
        return view('client.user.account', compact(['data']));
    }
}

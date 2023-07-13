<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    const OBJECT = 'admin';
    const DOT = '.';
    public function index(){
        return view(self::OBJECT . self::DOT . __FUNCTION__);
    }
    public function listProduct(){
//        $data = Product::all();
        return view(self::OBJECT . self::DOT . __FUNCTION__);
    }
}

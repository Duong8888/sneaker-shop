<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthenController extends Controller
{
    const OBJECT = 'admin';
    const DOT = '.';
    const AUTH = 'authen';
    public function login(){
        return view(self::OBJECT.self::DOT.self::AUTH.self::DOT.__FUNCTION__);
    }
    public function register(){
        return view(self::OBJECT.self::DOT.self::AUTH.self::DOT.__FUNCTION__);
    }
}

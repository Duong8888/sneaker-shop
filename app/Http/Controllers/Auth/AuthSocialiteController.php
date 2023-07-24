<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthSocialiteController extends Controller
{
    public function redirectProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleCallback($provider)
    {

        try {
            $user = Socialite::driver($provider)->user();
        } catch (Exception $e) {
            // Nếu xảy ra lỗi khi xác thực, chuyển hướng về trang đăng nhập
            return redirect()->route('login');
        }
        if ($provider === "google" || $provider === "github") {
            // kiểm tra xem người dùng đang sử dụng cách thức đăng nhập nào
            if ($provider === "google") {
                $checkUser = User::where('google_id', $user->getId())->first();
                $data = [
                    'name' => $user->name,
                    'email' => $user->getEmail(),
                    'google_email' => $user->getEmail(),
                    'google_id' => $user->getId(),
                    'google_token' => $user->token,
                ];
            } else {
                $checkUser = User::where('github_id', $user->getId())->first();
                $data = [
                    'name' => $user->name,
                    'email' => $user->getEmail(),
                    'github_username' => $user->name,
                    'github_id' => $user->getId(),
                    'github_token' => $user->token,
                ];
            }
            // kiểm tra user có tồn tại chưa để tọa mới nếu chưa và cho đăng nhập nếu đã tồn tại
            if ($checkUser) {
                Auth::login($checkUser);
                $userAvatar = $user->getAvatar();
                session(['user_avatar' => $userAvatar]);
                return redirect()->intended(RouteServiceProvider::HOME);
            } else {
                $checkEmail = User::where('email', $user->email)->first();
                if ($checkEmail) {
                    $alert = 'Email đã được kết nối với tài khoản khác.';
                    return redirect()->route('login')->with('error', $alert);
                }
                $newUser = User::create($data);
                Auth::login($newUser);
                $userAvatar = $user->getAvatar();
                session(['user_avatar' => $userAvatar]);
                return redirect()->intended(RouteServiceProvider::HOME);
            }
        }
    }
}

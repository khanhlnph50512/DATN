<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Nơi chuyển hướng sau khi đăng nhập thành công.
     *
     * @var string
     */
    protected function redirectTo()
    {
        return 'client/home';
    }



    /**
     * Tạo instance mới cho controller.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Hiển thị form đăng nhập.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('client.auth.login'); // View nằm ở: resources/views/client/auth/login.blade.php
    }
}

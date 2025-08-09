<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin\Role;
use App\Models\Admin\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function showLogin()
{
    return view('client.auth.login');
}

public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Lấy thông tin user
    $user = User::where('email', $credentials['email'])->first();

    if (!$user) {
        return back()->withErrors(['email' => 'Email hoặc mật khẩu không đúng.']);
    }

    // Chặn nếu bị vô hiệu hóa
    if ($user->status === 'disabled') {
        return back()->withErrors(['email' => 'Tài khoản của bạn đã bị vô hiệu hóa, vui lòng liên hệ hỗ trợ.']);
    }

    // Thực hiện login
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        // Điều hướng theo role
        if ($user->role === 'admin') {
            return redirect('/client/home'); // hoặc /admin tùy ý
        }

        return redirect('/client/home');
    }

    return back()->withErrors([
        'email' => 'Email hoặc mật khẩu không đúng.',
    ]);
}

    public function showRegister()
    {
        return view('client.auth.register');
    }

    public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'seri_user' => Str::uuid(),
    ]);

    // Gán role mặc định là "user"
    $role = Role::where('name', 'customer')->first(); // hoặc 'customer' nếu bạn đặt tên vậy
    if ($role) {
        $user->roles()->attach($role->id);
    }

    Auth::login($user);

    return redirect('/client/home');
}
    public function showForgotForm()
{
    return view('client.auth.forgot-password');
}

public function sendResetLink(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:users,email',
    ]);

    $user = User::where('email', $request->email)->first();
    $token = Str::random(60);

    $user->reset_token = $token;
    $user->save();

    // Gửi link reset qua email (ở đây demo in ra màn hình thay vì gửi mail)
    $resetLink = route('password.reset', ['token' => $token]);
    return back()->with('success', 'Link đặt lại mật khẩu: ' . $resetLink);
}

public function showResetForm($token)
{
    return view('client.auth.reset-password', compact('token'));
}

public function resetPassword(Request $request)
{
    $request->validate([
        'token' => 'required',
        'password' => 'required|confirmed|min:6',
    ]);

    $user = User::where('reset_token', $request->token)->first();

    if (!$user) {
        return back()->withErrors(['token' => 'Token không hợp lệ!']);
    }

    $user->password = Hash::make($request->password);
    $user->reset_token = null;
    $user->save();

    return redirect()->route('login.form')->with('success', 'Đổi mật khẩu thành công! Hãy đăng nhập lại.');
}
public function logout(Request $request)
{
    Auth::logout(); // Đăng xuất người dùng

    $request->session()->invalidate(); // Hủy session hiện tại
    $request->session()->regenerateToken(); // Tạo CSRF token mới

    return redirect()->route('login.form')->with('success', 'Đăng xuất thành công!');
}
}

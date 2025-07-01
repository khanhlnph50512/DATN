<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Tạo instance controller.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Hiển thị form đăng ký
     */
    public function showRegistrationForm()
    {
        return view('client.auth.register');
    }

    /**
     * Xử lý đăng ký
     */
    public function register(Request $request)
    {
        // validate
        $this->validator($request->all())->validate();

        // tạo user
        $this->create($request->all());

        // redirect kèm thông báo
        return redirect()->route('login')->with('success', 'Đăng ký thành công, vui lòng đăng nhập!');
    }

    /**
     * Validate dữ liệu đăng ký
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Tạo user mới
     */
    protected function create(array $data)
    {
        return User::create([
            'seri_user' => 'VN' . rand(1000, 9999),
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'] ?? null,
            'address' => $data['address'] ?? null,
            'gender' => $data['gender'] ?? null,
            'birthday' => $data['birthday'] ?? null,
        ]);
    }
}

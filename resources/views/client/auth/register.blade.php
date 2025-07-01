@extends('client.layouts.auth')

@section('content')
    @if (session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <style>
        body {
            background: #f1f3f5;
        }

        .auth-card {
            max-width: 800px;
            width: 100%;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            padding: 40px;
        }

        .auth-title {
            font-size: 28px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
        }

        .auth-btn {
            background: #007bff;
            border: none;
            border-radius: 8px;
            color: #fff;
            font-weight: bold;
            padding: 12px;
            width: 100%;
        }

        .auth-btn:hover {
            background: #0056b3;
        }
    </style>

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="auth-card">
            <div class="text-center mb-4">
                <img src="https://cdn-icons-png.flaticon.com/512/295/295128.png" width="60">
            </div>
            <div class="auth-title">Đăng ký tài khoản</div>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label>Họ và tên</label>
                        <input name="name" class="form-control" required value="{{ old('name') }}">
                    </div>
                    <div class="col-md-6">
                        <label>Email</label>
                        <input name="email" class="form-control" required type="email" value="{{ old('email') }}">
                    </div>
                    <div class="col-md-6">
                        <label>Số điện thoại</label>
                        <input name="phone" class="form-control" value="{{ old('phone') }}">
                    </div>
                    <div class="col-md-6">
                        <label>Địa chỉ</label>
                        <input name="address" class="form-control" value="{{ old('address') }}">
                    </div>
                    <div class="col-md-6">
                        <label>Giới tính</label>
                        <select name="gender" class="form-select">
                            <option value="">-- Chọn --</option>
                            <option value="male">Nam</option>
                            <option value="female">Nữ</option>
                            <option value="other">Khác</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Ngày sinh</label>
                        <input name="birthday" type="date" class="form-control" value="{{ old('birthday') }}">
                    </div>
                    <div class="col-md-6">
                        <label>Mật khẩu</label>
                        <input name="password" type="password" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label>Xác nhận mật khẩu</label>
                        <input name="password_confirmation" type="password" class="form-control" required>
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit" class="auth-btn">Đăng ký</button>
                </div>
                <div class="text-center mt-3">
                    Đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập</a>
                </div>
            </form>
        </div>
    </div>
@endsection

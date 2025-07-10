@extends('client.layouts.auth')

@section('title', 'Đăng ký')

@section('content')
<div class="card shadow">
    <div class="card-body">
        <h3 class="mb-4 text-center">Đăng ký</h3>

        {{-- Hiển thị lỗi --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- FORM ĐĂNG KÝ --}}
        <form action="{{ route('register') }}" method="POST">
            @csrf {{-- BẮT BUỘC để tránh lỗi 419 --}}

            <div class="mb-3">
                <input type="text" name="name" class="form-control" placeholder="Họ tên" value="{{ old('name') }}" required>
            </div>

            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
            </div>

            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Mật khẩu" required>
            </div>

            <div class="mb-3">
                <input type="password" name="password_confirmation" class="form-control" placeholder="Xác nhận mật khẩu" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Đăng ký</button>
        </form>

        <div class="text-center mt-3">
            <a href="{{ route('login.form') }}">Đã có tài khoản? Đăng nhập</a>
        </div>
    </div>
</div>
@endsection

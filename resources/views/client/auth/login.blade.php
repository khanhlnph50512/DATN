@extends('client.layouts.auth')

@section('content')
<div class="d-flex justify-content-center align-items-center vh-100" style="background: #f8f9fa;">
    <div class="card shadow rounded border-0" style="width: 400px;">
        <div class="card-header text-center fs-4 bg-white">
            Đăng nhập
        </div>
        <div class="card-body p-4">

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="email"
                        class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <input id="password" type="password"
                        class="form-control @error('password') is-invalid @enderror"
                        name="password" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                        {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        Ghi nhớ đăng nhập
                    </label>
                </div>

                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary">
                        Đăng nhập
                    </button>
                </div>

                <div class="text-center mb-2">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">
                            Quên mật khẩu?
                        </a>
                    @endif
                </div>
                <div class="text-center">
                    Chưa có tài khoản? <a href="{{ route('register') }}">Đăng ký</a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection

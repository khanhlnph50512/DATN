@extends('admin.layouts.adminAnatats')

@section('title', 'Chi tiết người dùng')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Chi tiết người dùng</h2>
        <div class="card shadow rounded">
            <div class="card-body">
                <div class="row">
                    <!-- Bên trái -->
                    <div class="col-md-8">
                        <div class="row mb-3">
                            <div class="col-md-4 font-weight-bold">ID</div>
                            <div class="col-md-8">{{ $user->id }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 font-weight-bold">Mã khách hàng</div>
                            <div class="col-md-8">{{ $user->seri_user }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 font-weight-bold">Tên</div>
                            <div class="col-md-8">{{ $user->name }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 font-weight-bold">Email</div>
                            <div class="col-md-8">{{ $user->email }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 font-weight-bold">Phone</div>
                            <div class="col-md-8">{{ $user->phone }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 font-weight-bold">Địa chỉ</div>
                            <div class="col-md-8">{{ $user->address }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 font-weight-bold">Vai trò</div>
                            <div class="col-md-8">{{ ucfirst($user->role) }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 font-weight-bold">Ngày tạo</div>
                            <div class="col-md-8">{{ $user->created_at->format('d/m/Y H:i') }}</div>
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Quay lại</a>
                        </div>
                    </div>
                    <!-- Bên phải: Avatar -->
                    <div class="col-md-4 text-center">
                        @if ($user->avater)
                            <img src="{{ asset('storage/' . $user->avater) }}" alt="Avatar" class="img-thumbnail rounded-circle"
                                style="width:150px;">
                        @else
                            <div class="text-muted">Không có ảnh</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

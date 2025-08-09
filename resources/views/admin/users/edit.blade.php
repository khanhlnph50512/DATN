@extends('admin.layouts.adminAnatats')

@section('title', 'Cập nhật người dùng')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Cập nhật người dùng</h1>



        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="mt-4">
            @csrf
            @method('PUT')



            <div class="mb-3">
                <label for="status" class="form-label">Trạng thái tài khoản</label>
                <select name="status" id="status" class="form-select">
                    <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>Hoạt động</option>
                    <option value="disabled" {{ $user->status == 'disabled' ? 'selected' : '' }}>Vô hiệu hóa</option>
                </select>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Cập nhật</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Quay lại</a>
            </div>
        </form>
    </div>
@endsection

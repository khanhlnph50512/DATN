@extends('admin.layouts.adminAnatats')

@section('title', 'Thùng rác người dùng')

@section('content')
    <div class="container mt-4">
        <div class="card shadow rounded">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fa fa-trash"></i> Thùng rác người dùng</h5>
                <a href="{{ route('admin.users.index') }}" class="btn btn-light btn-sm">
                    <i class="fa fa-arrow-left"></i> Quay lại
                </a>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Mã KH</th>
                                <th>Tên</th>
                                <th>Email</th>
                                <th>Avatar</th>
                                <th>Điện thoại</th>
                                <th>Địa chỉ</th>
                                <th>Vai trò</th>
                                <th>Ngày xoá</th>
                                <th class="text-center">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->seri_user }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if ($user->avater)
                                            <img src="{{ asset('storage/' . $user->avater) }}" width="40" height="40"
                                                class="rounded-circle" />
                                        @else
                                            <span>--</span>
                                        @endif
                                    </td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->address }}</td>
                                    <td>{{ ucfirst($user->role) }}</td>
                                    <td>{{ $user->deleted_at->format('d/m/Y H:i') }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('users.restore', $user->id) }}" method="POST"
                                            style="display:inline-block;">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm" data-bs-toggle="tooltip"
                                                title="Khôi phục">
                                                <i class="fa fa-rotate-left"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('users.forceDelete', $user->id) }}" method="POST"
                                            style="display:inline-block;" onsubmit="return confirm('Xoá vĩnh viễn?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" data-bs-toggle="tooltip"
                                                title="Xoá vĩnh viễn">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center">Không có bản ghi nào trong thùng rác.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div>
                    {{ $users->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection

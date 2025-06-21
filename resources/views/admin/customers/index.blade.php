@extends('layouts.adminAnatats')

@section('title', 'Danh sách khách hàng')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Danh sách khách hàng</h1>

    @if (session('success'))
        <div class="alert alert-success mt-2">
            {{ session('success') }}
        </div>
    @endif

    <div class="my-3">
        <a href="{{ route('admin.customers.trash') }}" class="btn btn-secondary">🗑️ Thùng rác</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Mã KH</th>
                <th>Tên</th>
                <th>Email</th>
                <th>SĐT</th>
                <th>Địa chỉ</th>
                <th>Ngày tạo</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($customers as $customer)
                <tr>
                    <td>{{ $customer->id }}</td>
                    <td>{{ $customer->seri_customer }}</td>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->phone ?? '-' }}</td>
                    <td>{{ $customer->address }}</td>
                    <td>{{ $customer->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <form action="{{ route('admin.customers.destroy', $customer->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Bạn có chắc muốn xoá khách hàng này?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Xoá</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Không có khách hàng nào.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div>
        {{ $customers->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection

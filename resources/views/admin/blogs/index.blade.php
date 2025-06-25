@extends('admin.layouts.adminAnatats')

@section('content')
    @if (session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Thành công!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2500,
                timerProgressBar: true,
                didClose: () => {
                    window.location.href = "{{ route('admin.blogs.index') }}";
                }
            });
        </script>
    @endif

    <div class="container py-4">
        {{-- Tiêu đề --}}
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
            <h2 class="fw-bold mb-2">📝 Danh sách bài viết</h2>
            <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary rounded-pill shadow-sm">
                <i class="fas fa-plus me-1"></i> Thêm bài viết
            </a>
        </div>

        {{-- Nút thùng rác ngay dưới tiêu đề --}}
        <div class="mb-4">
            <a href="{{ route('admin.blogs.trash') }}" class="btn btn-outline-warning rounded-pill">
                <i class="fas fa-trash-restore-alt me-1"></i> Thùng rác
            </a>
        </div>

        {{-- Nút thêm và tìm kiếm --}}

        <form action="{{ route('admin.blogs.index') }}" method="GET" class="row g-2 mb-4">
            <div class="col-md-4">
                <input type="text" name="keyword" class="form-control" placeholder="🔍 Tìm theo tiêu đề..."
                    value="{{ request('keyword') }}">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-outline-primary rounded-pill">Tìm</button>
                <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline-secondary rounded-pill">Xoá lọc</a>
            </div>
        </form>

        {{-- Bảng danh sách --}}
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle text-center shadow-sm rounded">
                <thead class="table-light">
                    <tr class="text-uppercase text-muted small">
                        <th scope="col">Tiêu đề</th>
                        <th scope="col">Ảnh</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($blogs as $blog)
                        <tr>
                            <td class="fw-semibold">{{ $blog->title }}</td>
                            <td>
                                @if ($blog->image)
                                    <img src="{{ asset('img/blogs/' . $blog->image) }}" alt="Ảnh bài viết"
                                        class="img-fluid rounded" style="width: 90px; height: auto;">
                                @else
                                    <span class="text-muted fst-italic">Không có ảnh</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge px-3 py-2 {{ $blog->status ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $blog->status ? 'Hiển thị' : 'Ẩn' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.blogs.show', $blog->id) }}"
                                    class="btn btn-sm btn-outline-info rounded-pill me-1" title="Xem">
                                    <i class="bx bx-show"></i> <!-- icon xem của Boxicons -->
                                </a>
                                <a href="{{ route('admin.blogs.edit', $blog->id) }}"
                                    class="btn btn-sm btn-outline-warning rounded-pill me-1">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger rounded-pill"
                                        onclick="return confirm('Bạn có chắc muốn xoá bài viết này?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-muted fst-italic">Chưa có bài viết nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if (method_exists($blogs, 'links'))
            <div class="d-flex justify-content-end mt-4">
                {{ $blogs->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
@endsection

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
        <h2 class="fw-bold mb-4"><i class="fas fa-trash-alt text-danger me-2"></i>Thùng rác - Bài viết</h2>

        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle text-center shadow-sm rounded">
                <thead class="table-light">
                    <tr class="text-uppercase text-muted small">
                        <th scope="col">Tiêu đề</th>
                        <th scope="col">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($blogs as $blog)
                        <tr>
                            <td class="fw-semibold">{{ $blog->title }}</td>
                            <td>
                                <form action="{{ route('admin.blogs.restore', $blog->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success rounded-pill me-1">
                                        <i class="fas fa-undo"></i> Khôi phục
                                    </button>
                                </form>

                                <form action="{{ route('admin.blogs.forceDelete', $blog->id) }}" method="POST"
                                    class="d-inline" onsubmit="return confirm('Xoá vĩnh viễn bài viết này?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger rounded-pill">
                                        <i class="fas fa-trash"></i> Xoá vĩnh viễn
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="text-muted fst-italic">Không có bài viết nào trong thùng rác.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline-secondary mt-3">
            <i class="fas fa-arrow-left me-1"></i> Quay về danh sách
        </a>
    </div>
@endsection

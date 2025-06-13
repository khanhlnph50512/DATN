<h1>Tạo bài viết mới</h1>

<form method="POST" action="{{ route('blog.store') }}" enctype="multipart/form-data">
    @csrf
    <input type="text" name="title" placeholder="Tiêu đề"><br><br>
    <textarea name="content" rows="5" placeholder="Nội dung"></textarea><br><br>
    <input type="file" name="image"><br><br>
    <button type="submit">Đăng bài</button>
</form>

<a href="{{ route('blog.index') }}">← Về danh sách bài viết</a>

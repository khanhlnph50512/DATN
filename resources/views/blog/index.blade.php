<h1>Quản lý bài viết</h1>

<a href="{{ route('blog.create') }}">+ Tạo bài viết mới</a>

@foreach ($posts as $post)
    <div>
        <h3>{{ $post->title }}</h3>
        <a href="{{ route('post.show', $post->slug) }}" target="_blank">Xem bài viết</a>
    </div>
@endforeach

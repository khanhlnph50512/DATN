<h1>{{ $post->title }}</h1>

@if($post->image)
    <img src="{{ asset('storage/' . $post->image) }}" width="300">
@endif

<p>{!! nl2br(e($post->content)) !!}</p>
<a href="{{ route('home') }}">← Về trang chủ</a>

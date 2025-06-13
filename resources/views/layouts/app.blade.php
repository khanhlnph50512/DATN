{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trang Tin Tức</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    @include('layouts.header')
    @include('layouts.menu')

    <main>
        @yield('content')
    </main>

    @include('layouts.footer')

</body>
</html>

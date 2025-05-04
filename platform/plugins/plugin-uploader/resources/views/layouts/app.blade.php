<!DOCTYPE html>
<html lang="en">
<head>
    @include('plugins/plugin-uploader::partials._head')
    @include('plugins/plugin-uploader::partials._styles')
</head>
<body> 
    <main class="container">
        @yield('content')
    </main>
    @include('plugins/plugin-uploader::partials._scripts')
</body>
</html>

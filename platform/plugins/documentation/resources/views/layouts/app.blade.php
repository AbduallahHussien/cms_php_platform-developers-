<!DOCTYPE html>
<html lang="en">
<head>
    @include('plugins/documentation::partials._head')
</head>
<body>
    @include('plugins/documentation::partials._navbar')
    
    @include('plugins/documentation::partials._sidebar')
    
    <!-- Main Content -->
    <div id="main-content">
        <div class="doc-content">
            @yield('content')
        </div>
    </div>
    
    @include('plugins/documentation::partials._scripts')
    @stack('scripts')
</body>
</html>
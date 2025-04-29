<!doctype html>
<html lang="ar" dir="rtl">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>لوحة تحكم الأدمن</title>
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('common/css/bootstrap.rtl.min.css') }}" rel="stylesheet">
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="{{ asset('dashboard/css/dashboard.rtl.css') }}" rel="stylesheet">
  </head>
  <body>
    
        @include('partials.admin._header')

        <div class="container-fluid">
        <div class="row">
            @include('partials.admin._nav')
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                @yield('content')
            </main>
        </div>
        </div>


    <script src="{{ asset('common/js/bootstrap.bundle.min.js') }}"></script>

    
  </body>
</html>

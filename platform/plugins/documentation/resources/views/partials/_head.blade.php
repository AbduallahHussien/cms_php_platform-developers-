<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $documentation->name ?? 'DevDocs' }}</title>

<!-- Bootstrap 5 CSS -->

@if($documentation->direction == LTR)
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
@else    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.rtl.min.css" integrity="sha384-q8+l9TmX3RaSz3HKGBmqP2u5MkgeN7HrfOJBLcTgZsQsbrx8WqqxdA5PuwUV9WIx" crossorigin="anonymous">
@endif
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<!-- Custom CSS -->
@if($documentation->direction == LTR)
    <link rel="stylesheet" href="{{ URL::asset('vendor/core/plugins/documentation/css/docs_style.css') }}">
@else
    <link rel="stylesheet" href="{{ URL::asset('vendor/core/plugins/documentation/css/docs_style_rtl.css') }}">
@endif
<link rel="stylesheet" href="{{ URL::asset('vendor/core/plugins/documentation/css/global.css') }}">

 
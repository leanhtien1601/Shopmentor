<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @include('layouts._share.front-end.style')
</head>
<body>
<section class="home">
    @include('layouts._share.front-end.header')
    @include('layouts._share.front-end.header_bot')
    @yield('content')
    @include('layouts._share.front-end.footer')
</section>
@include('layouts._share.front-end.script')
@yield('script_view')
</body>
</html>

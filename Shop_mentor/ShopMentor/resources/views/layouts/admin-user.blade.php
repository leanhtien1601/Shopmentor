<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @include('layouts._share.back-end-main.style')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

        @yield('content')

</div>
@include('layouts._share.back-end-main.script')
</body>
</html>

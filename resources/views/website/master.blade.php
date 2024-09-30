<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @yield('meta_info')
    <title>@yield('title')</title>

    @include('website.includes.css')

</head>
<body class="ltr app sidebar-mini">


<!-- app-Header -->
@include('website.includes.header')
<!-- /app-Header -->

<!-- PAGE -->
<div class="page">

    {{--    @include('website.include.left-side-menu')--}}

    <div class="page-main">

        @yield('content')

    </div>

    {{--    @include('website.include.cart')--}}

</div>
<!-- page -->

<!-- FOOTER -->
@include('website.includes.footer')
<!-- FOOTER CLOSED -->

@include('website.includes.js')

{{--Chatbox--}}
@include('website.includes.chatbox')

</body>
</html>

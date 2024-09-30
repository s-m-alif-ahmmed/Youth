<!doctype html>
<html lang="en" dir="ltr">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="title" content="Youth | Dashboard">
    <meta name="description" content="Youth Admin Dashboard.">
    <meta name="author" content="Youth">
    <meta name="keywords" content="Youth">

    <!-- TITLE -->
    <title>@yield('title')</title>

    <!-- Switcher-->
    @include('admin.includes.css')

</head>

<body class="ltr app sidebar-mini">

<!-- Switcher-->
@include('admin.includes.switcher')
<!-- Switcher-->

<!-- GLOBAL-LOADER -->
<div id="global-loader">
    <img src="{{asset('/')}}admin/assets/images/loader.svg" class="loader-img" alt="Loader">
</div>
<!-- /GLOBAL-LOADER -->

<!-- PAGE -->
<div class="page">
    <div class="page-main">

        <!-- app-Header -->
        @include('admin.includes.header')
        <!-- /app-Header -->

        <!--APP-SIDEBAR-->
        @include('admin.includes.left-side-menu')
        <!--/APP-SIDEBAR-->

        <!--app-content open-->
        <div class="app-content main-content mt-0">
            <div class="side-app">

                <!-- CONTAINER -->
                @yield('content')
            </div>
        </div>
        <!-- CONTAINER CLOSED -->
    </div>


    <!-- FOOTER -->
    @include('admin.includes.footer')
    <!-- FOOTER CLOSED -->

</div>
<!-- page -->

<!-- BACK-TO-TOP -->
<a href="#top" id="back-to-top"><i class="fa fa-long-arrow-up"></i></a>

{{--JS Links--}}
@include('admin.includes.js')

</body>


</html>


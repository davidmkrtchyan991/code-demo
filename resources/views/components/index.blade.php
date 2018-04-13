<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">

    <!-- Optional theme -->
    <link rel="stylesheet" href="{{asset('css/bootstrap-theme.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-datetimepicker.min.css')}}" />

    <!-- Gentelella -->
    <link rel="stylesheet" href="{{asset('assets/admin/css/admin.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/css/dashboard.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/css/users/edit.css')}}">

    <link rel="stylesheet" href="{{asset('assets/app/css/app.css')}}">

    <link rel="stylesheet" href="{{asset('assets/auth/css/auth.css')}}">
    <link rel="stylesheet" href="{{asset('assets/auth/css/login.css')}}">
    <link rel="stylesheet" href="{{asset('assets/auth/css/passwords.css')}}">
    <link rel="stylesheet" href="{{asset('assets/auth/css/register.css')}}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.3/chosen.min.css">

</head>
<body class="nav-md">

<?php /**/
$user = auth()->user() /**/ ?>


<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="/" class="site_title">
                        <span>
                            <img src="{{asset('images/logo.png')}}" alt="logo.png">
                        </span>
                    </a>
                </div>

                <div class="clearfix"></div>

                <!-- menu profile quick info -->
            @include('components.user-info')
            <!-- /menu profile quick info -->

                <br />

                <!-- sidebar menu -->
            @include('components.left-sidebar-menu')
            <!-- /sidebar menu -->
            </div>
        </div>

        <!-- top navigation -->
        @include('components.top-navbar')
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">

            <!-- Additional services -->
            @if($user && $user->isClient())
                @include('components.additional-services')
            @endif
            <!-- / Additional services -->

            <!-- Order topvisor statistics -->
            @if($user && $user->isClient())
                @include('components.order-topvisor-statistics')
            @endif
            <!-- / Order topvisor statistics -->


            @yield('content')
        </div>
        <!-- /page content -->

    </div>
</div>


<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- Gentelella -->
<script src="{{ asset('assets/app/js/app.js') }}"></script>

<script src="{{ asset('assets/admin/js/dashboard.js') }}"></script>
<script src="{{ asset('assets/admin/js/users/edit.js') }}"></script>

<script src="{{ asset('assets/admin/js/admin.js') }}"></script>


<script src="{{asset('js/moment-with-locales.min.js')}}"></script>
<script src="{{asset('js/bootstrap-datetimepicker.min.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>

</body>
</html>

<!-- JS -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.3/chosen.jquery.min.js"></script>
<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title') - zMenu</title>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">
        <link href="{{ asset('css/main.css') }}" rel="stylesheet">
        <link href="{{ asset('css/metro.css') }}" rel="stylesheet">
        <link href="{{ asset('css/metro-icons.css') }}" rel="stylesheet">
        <link href="{{ asset('css/metro-responsive.css') }}" rel="stylesheet">
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/metro.js') }}"></script>
        <script src="{{ asset('js/functions.js') }}"></script>
        <script src="{{ asset('js/select2/select2.js') }}"></script>
        <style>
            body {
                background-image: url("{{asset('img/background.jpg')}}");
                background-size: 200px 200px;
                background-repeat: repeat;
            }
            .login-form {
                width: 25rem;
                height: 18.75rem;
                position: fixed;
                top: 50%;
                margin-top: -9.375rem;
                left: 50%;
                margin-left: -12.5rem;
                background-color: #ffffff;
                opacity: 0;
                -webkit-transform: scale(.8);
                transform: scale(.8);
                z-index: 2;
            }
            .background-image{
                position: fixed;
                width: 20%;
                bottom: 10px;
                right: 10px;
                z-index: 1;
                opacity: 0.9;
                filter: alpha(opacity=90);
            }
            .background-text{
                position: fixed;
                bottom: 0;
                left: 10px;
                color: #EFEFEF;
                z-index: 1;
            }
        </style>
    </head>
    <body style="background-color: #d5d1d9">
        <div class="login-form padding20 block-shadow">
            @yield('content')
        </div>
        <img src="{{ asset('img/logo.png')}}" class="background-image">
        <div class="background-text"><h2>zMenu</h2></div>
        <div id="charm" data-role="charm" data-position="right" style="width: 300px;"></div>
    </body>
</html>
<script>
$(document).ready(function () {
    /*@if (session('success'))*/
    flashS("{{ session('success') }}");
    /*@endif*/
    /*@if (session('error'))*/
    flashE("{{ session('error') }}");
    /*@endif*/
});
</script>
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
        <link href="{{ asset('css/monthly.css') }}" rel="stylesheet">
        <link href="{{ asset('css/select2.css') }}" rel="stylesheet">
        <link href="{{ asset('css/pace.css') }}" rel="stylesheet">
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/metro.js') }}"></script>
        <script src="{{ asset('js/functions.js') }}"></script>
        <script src="{{ asset('js/jquery/monthly.js') }}"></script>
        <script src="{{ asset('js/jquery/jquery.dataTables.js') }}"></script>
        <script src="{{ asset('js/jquery/highcharts.js') }}"></script>
        <script src="{{ asset('js/select2/select2.js') }}"></script>
        <script src="{{ asset('js/charts.js') }}"></script>
        <script src="{{ asset('js/pace.min.js') }}"></script>
        <style>
            html, body {
                height: 100%;
            }
            .page-content {
                padding-top: 3.125rem;
                min-height: 100%;
                height: 100%;
            }
            .app-search:hover{
                background-color: transparent !important;
            }
            .hidden{
                display: none !important;
            }
        </style>
    </head>
    <body cz-shortcut-listen="true">
        <div class="app-bar fixed-top" data-role="appbar">
            <a href="/home" class="app-bar-element branding">zMenu</a>
            <span class="app-bar-divider"></span>
            <ul class="app-bar-menu">
                <li><a href="#"><span class="mif-home"></span> Evaluaciones</a></li>
            </ul>
            <ul class="app-bar-menu place-right" data-flexdirection="reverse">
                <li><a href="/user" class="fg-white"><span class="mif-user"></span> {{ ucfirst(Auth::user()->nombre) }}</a></li>
                <li><a href="/logout" class="fg-white"><span class="mif-exit"></span></a></li>
            </ul>
            <div class="app-bar-pullbutton automatic" style="display: none;"></div><div class="clearfix" style="width: 0;"></div><nav class="app-bar-pullmenu hidden flexstyle-app-bar-menu" style="display: none;"><ul class="app-bar-pullmenubar hidden app-bar-menu"></ul></nav>
        </div>
        <div class="container page-content">
            <div class="grid responsive-future" style="height: 95%;">
                <div class="row" id="contenido">
                    @yield('content')
                </div>
            </div>
        </div>
        <div id="charm" data-role="charm" data-position="right" style="width: 300px;"></div>
    </body>
</html>
<script>
$(function () {
    /*@if (session('success'))*/
    flashS("{{ session('success') }}");
    /*@endif*/
    /*@if (session('error'))*/
    flashE("{{ session('error') }}");
    /*@endif*/
});
</script>
<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title') - zMenu</title>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">
        <link href="{{ asset($public.'css/main.css') }}" rel="stylesheet">
        <link href="{{ asset($public.'css/metro.css') }}" rel="stylesheet">
        <link href="{{ asset($public.'css/metro-icons.css') }}" rel="stylesheet">
        <link href="{{ asset($public.'css/metro-responsive.css') }}" rel="stylesheet">
        <link href="{{ asset($public.'css/pace.css') }}" rel="stylesheet">
        <link href="{{ asset($public.'css/select2.css') }}" rel="stylesheet">
        <script src="{{ asset($public.'js/jquery.min.js') }}"></script>
        <script src="{{ asset($public.'js/metro.js') }}"></script>
        <script src="{{ asset($public.'js/functions.js') }}"></script>
        <script src="{{ asset($public.'js/jscolor.min.js') }}"></script>
        <script src="{{ asset($public.'js/jquery/jquery.dataTables.js') }}"></script>
        <script src="{{ asset($public.'js/select2/select2.js') }}"></script>
        <script src="{{ asset($public.'js/pace.min.js') }}"></script>
        <script src="{{ asset($public.'js/jquery/highcharts.js') }}"></script>
        <script src="{{ asset($public.'js/jquery/highcharts-theme.js') }}"></script>
        <script src="{{ asset($public.'js/jquery/highcharts-lang.js') }}"></script>
        <script src="{{ asset($public.'js/charts.js') }}"></script>
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
            <a href="/inicio" class="app-bar-element branding">zMenu</a>
            <span class="app-bar-divider"></span>
            <ul class="app-bar-menu">
                <li><a href="/Venta/inventario"><span class="mif-shop"></span> Inventario</a></li>
                <li><a href="/Reporte"><span class="mif-coins"></span> Reportes</a></li>
                <li><a href="/Admin/panel"><span class="mif-cogs"></span> Administrador</a></li>
            </ul>
            <ul class="app-bar-menu place-right" data-flexdirection="reverse">
                <li><a href="#" class="fg-white"><span class="mif-user"></span> {{ ucfirst(Auth::user()->nombre) }}</a></li>
                <li><a href="/logout" class="fg-white"><span class="mif-exit"></span></a></li>
            </ul>
            <div class="app-bar-pullbutton automatic" style="display: none;"></div><div class="clearfix" style="width: 0;"></div><nav class="app-bar-pullmenu hidden flexstyle-app-bar-menu" style="display: none;"><ul class="app-bar-pullmenubar hidden app-bar-menu"></ul></nav>
        </div>
        <div class="page-content">
            <div class="grid responsive-future" style="height: 96%; margin-left: 2rem; margin-right: 2rem;">
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
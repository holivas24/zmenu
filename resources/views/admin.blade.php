<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title') - Administración</title>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/png" href="{{ asset($public.'img/favicon.png') }}">
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
        <style>
            html, body {
                height: 100%;
            }
            body {
            }
            .page-content {
                padding-top: 3.125rem;
                min-height: 100%;
                height: 100%;
            }
            .table .input-control.checkbox {
                line-height: 1;
                min-height: 0;
                height: auto;
            }
            .app-search:hover{
                background-color: transparent !important;
            }
            .hidden{
                display: none !important;
            }
            @media screen and (max-width: 800px){
                #cell-sidebar {
                    flex-basis: 52px;
                }
                #cell-content {
                    flex-basis: calc(100% - 52px);
                }
            }
            .frame{
                background-color: transparent !important;
                padding: 0 !important;
            }
        </style>
    </head>
    <body cz-shortcut-listen="true">
        <div class="app-bar fixed-top" data-role="appbar" style="height: 3.125rem;">
            <a href="/inicio" class="app-bar-element branding"><span class="mif-cogs"></span> zMenu</a>
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
            <div class="flex-grid no-responsive-future" style="height: 100%;">
                <div class="row" style="height: 100%">
                    <div class="cell size-x200 bg-grayDark" id="cell-sidebar" style="height: 100%; overflow-y: auto; overflow-x: hidden">
                        <ul class="sidebar bg-grayDark">
                            <li class="{{Session::get('selected') == '0' ? 'active' : ''}}">
                                <a href="/Admin" class="bg-hover-dark fg-hover-white">
                                    <span class="mif-apps icon"></span>
                                    <span class="title">Ver Todo</span>
                                </a>
                            </li>
                            <li class="{{ Session::get('selected') == 'usu' ? 'active' : ''}}">
                                <a href="/Admin/usuarios" class="bg-hover-dark fg-hover-white">
                                    <span class="mif-users icon"></span>
                                    <span class="title">Usuarios</span>
                                    <span class="counter">{{Session::get('count_usu')}}</span>
                                </a>
                            </li>
                            <li class="{{ Session::get('selected') == 'ven' ? 'active' : ''}}">
                                <a href="/Admin/ventas" class="bg-hover-dark fg-hover-white">
                                    <span class="mif-dollars icon"></span>
                                    <span class="title">Ventas</span>
                                    <span class="counter">{{Session::get('count_ven')}}</span>
                                </a>
                            </li>
                            <li class="{{ Session::get('selected') == 'cat' ? 'active' : ''}}">
                                <a href="/Admin/categorias" class="bg-hover-dark fg-hover-white">
                                    <span class="mif-tag icon"></span>
                                    <span class="title">Categorías</span>
                                    <span class="counter">{{Session::get('count_cat')}}</span>
                                </a>
                            </li>
                            <li class="{{ Session::get('selected') == 'pro' ? 'active' : ''}}">
                                <a href="/Admin/productos" class="bg-hover-dark fg-hover-white">
                                    <span class="mif-shop icon"></span>
                                    <span class="title">Productos</span>
                                    <span class="counter">{{Session::get('count_pro')}}</span>
                                </a>
                            </li>
                            <li class="{{ Session::get('selected') == 'reg' ? 'active' : ''}}">
                                <a href="/Admin/registros" class="bg-hover-dark fg-hover-white">
                                    <span class="mif-history icon"></span>
                                    <span class="title">Registros</span>
                                    <span class="counter">{{Session::get('count_reg')}}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="cell auto-size padding20 no-padding-top bg-white" id="contenido" style="overflow-y: auto">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
        <div data-role="dialog" id="dialog" data-overlay="true" data-overlay-color="op-dark" data-overlay-click-close="true" class="dialog">
            <div class="window">
                <div class="window-caption wbg-cyan fg-white">
                    <span class="window-caption-icon"><span id="dialog-icon"></span></span>
                    <span class="window-caption-title" id="dialog-title"></span>
                    <span class="btn-close wbg-darkCyan fg-white" onclick="hideMetroDialog('#dialog')"></span>
                </div>
                <div class="window-content padding10" id="dialog-content">
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

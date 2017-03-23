@extends('admin')
@section('title', 'Panel')
@section('content')
<script>
    Titulo("Panel", "de Administración", false, undefined, "cogs");
    $(function () {
        Contador(".tile-badge");
        $("#resize").click(function () {
            var grow = ($(".tile-wide").size() === 0);
            $.get("/Admin/resize?val=" + !grow, function () {
                if (grow) {
                    $(".tile").addClass("tile-wide").removeClass("tile");
                } else {
                    $(".tile-wide").addClass("tile").removeClass("tile-wide");
                }
                flashS("Configuración guardada");
            });
        });
    });
</script>
<a href="/Admin/usuarios">
    <div class="tile bg-crimson fg-white" data-role="tile">
        <div class="tile-content iconic">
            <span class="icon mif-users"></span>
            <span class="tile-label">Usuarios</span>
            <span class="tile-badge bg-darkCrimson">{{Session::get('count_usu')}}</span>
        </div>
    </div>
</a>
<a href="/Admin/ventas">
    <div class="tile bg-green fg-white" data-role="tile">
        <div class="tile-content iconic">
            <span class="icon mif-dollars"></span>
            <span class="tile-label">Ventas</span>
            <span class="tile-badge bg-darkGreen">{{Session::get('count_ven')}}</span>
        </div>
    </div>
</a>
<a href="/Admin/categorias">
    <div class="tile bg-blue fg-white" data-role="tile">
        <div class="tile-content iconic">
            <span class="icon mif-tag"></span>
            <span class="tile-label">Categorías</span>
            <span class="tile-badge bg-darkBlue">{{Session::get('count_cat')}}</span>
        </div>
    </div>
</a>
<a href="/Admin/productos">
    <div class="tile bg-brown fg-white" data-role="tile">
        <div class="tile-content iconic">
            <span class="icon mif-shop"></span>
            <span class="tile-label">Productos</span>
            <span class="tile-badge bg-darkBrown">{{Session::get('count_pro')}}</span>
        </div>
    </div>
</a>
<a href="/Admin/registros">
    <div class="tile bg-orange fg-white" data-role="tile">
        <div class="tile-content iconic">
            <span class="icon mif-history"></span>
            <span class="tile-label">Registros</span>
            <span class="tile-badge bg-darkOrange">{{Session::get('count_reg')}}</span>
        </div>
    </div>
</a>
@stop
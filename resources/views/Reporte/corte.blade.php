@extends('master')
@section('title', 'Reportes: Corte del Día')
@section('content')
<script>
    Titulo("Reportes", "Corte del Día", true, undefined, "calendar");
    function CargarCorte() {
        var x = $("#fecha_corte").val();
        $.post("/Reporte/corte?d=" + x, function (data) {
            $("#reporte_corte").html(data);
        });
    }
    $(function () {
        CargarCorte();
    });
</script>
<div class="input-control text full-size" data-role="datepicker" data-locale="es" data-format="dd/mm/yyyy" data-on-select="CargarCorte()">
    <input type="text" value="{{$d->formatLocalized('%d/%m/%Y')}}" id="fecha_corte">
    <button class="button"><span class="mif-calendar"></span></button>
</div>
<div id="reporte_corte"></div>
@stop
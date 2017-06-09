@extends('master')
@section('title', 'Reportes')
@section('content')
<script>
    Titulo("Reportes", "", false, undefined, "coins");
    $(function () {
        $("#est_m").val("{{date('m')}}" * 1);
        $("#stats select").change(function () {
            LoadCharts();
        });
        LoadCharts();
    });
    function LoadCharts() {
        var m = $("#est_m option:selected").val();
        var y = $("#est_y option:selected").val();
        var sub = $("#est_m option:selected").text() + " " + $("#est_y option:selected").text();
        Highcharts.setOptions({colors: ['#7CB5EC', '#434348', '#A9FF96', '#F7A35C', '#8085E9', '#F15C80']});
        chart_ts("#cbd", "Reporte de ventas", sub, "/Reporte/estVentas?m=" + m + "&y=" + y, "Ventas");
        $.get("/Reporte/estCategoria?m=" + m + "&y=" + y, function (data) {
            ChartPie("#obd", "Categorías más vendidas", data);
        });
    }
</script>
<div class="panel" data-role="panel">
    <div class="heading bg-red">
        <span class="icon mif-chart-line bg-darkRed"></span>
        <span class="title">Estadística General</span>
    </div>
    <div class="content bg-white" style="border: 2px solid rgba(0,0,0,0.2); border-top: 0; border-bottom: 0;">
        <table class="table" style="margin: 0;" id='stats'>
            <tr>
                <td style="width: 50%;">
                    <strong>Mes</strong>
                    <div class='input-control select full-size'>
                        <select id='est_m'>
                            <option value='1'>Enero</option>
                            <option value='2'>Febrero</option>
                            <option value='3'>Marzo</option>
                            <option value='4'>Abril</option>
                            <option value='5'>Mayo</option>
                            <option value='6'>Junio</option>
                            <option value='7'>Julio</option>
                            <option value='8'>Agosto</option>
                            <option value='9'>Septiembre</option>
                            <option value='10'>Octubre</option>
                            <option value='11'>Noviembre</option>
                            <option value='12'>Diciembre</option>
                        </select>
                    </div>
                </td>
                <td>
                    <strong>Año</strong>
                    <div class='input-control select full-size'>
                        <select id='est_y'>
                            <?php for ($x = date('Y'); $x >= 2017; $x--): ?><option>{{$x}}</option><?php endfor; ?>
                        </select>
                    </div>
                </td>
            </tr>
            <tr class="big-rep">
                <td style="height: 425px" id="cbd"></td>
                <td id="obd"></td>
            </tr>
        </table>
    </div>
</div>
<div class="panel" data-role="panel">
    <div class="heading">
        <span class="icon mif-file-text"></span>
        <span class="title">Reportes Específicos</span>
    </div>
    <div class="content">
        <table class='table striped' style="margin-top: 0;">
            <thead>
                <tr>
                    <th>Reporte</th>
                    <th>Descripción</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="width: 200px;"><a href="/Reporte/corte" class="button success">Corte del Día</a></td>
                    <td>Reporte de las ventas por día</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@stop
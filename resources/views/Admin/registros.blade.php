@extends('admin')
@section('title', 'Registros')
@section('content')
<script>
    Titulo("Registros", "", false, undefined, "history");
    function CargarRegistros() {
        var tipo = $("#tipo option:selected").val();
        var cant = $("#cant option:selected").val();
        $("#registros").load("/Admin/registro?tipo=" + tipo + "&cant=" + cant);
    }
</script>
<table class="table">
    <thead>
        <tr>
            <th>Tipo</th>
            <th>Cantidad</th>
            <th></th>
        </tr>
    </thead>
    <tr>
        <td>
            <div class="input-control select full-size">
                <select id="tipo">
                    <option value="0">Todos</option>
                    @foreach($tipos as $t)
                    <option value="{{$t}}">{{$t}}</option>
                    @endforeach
                </select>
            </div>
        </td>
        <td>
            <div class="input-control select full-size">
                <select id="cant">
                    @foreach($cant as $c)
                    <option value="{{$c}}">Últimos {{$c}} Registros</option>
                    @endforeach
                    <option value="0">Todos</option>
                </select>
            </div>
        </td>
        <td style="width: 300px;" class="align-center">
            <a href="javascript:CargarRegistros()" class="button">Ver Registros</a>
        </td>
    </tr>
</table>
<hr>
<div id="registros"></div>
@stop
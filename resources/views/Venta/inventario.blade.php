@extends('master')
@section('title', 'Inventario')
@section('content')
<script>
    Titulo("Inventario", "");
    $(function () {
        TablaDinamica("#inventario");
    });
</script>
<table class="table striped" id="inventario">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Categoría</th>
            <th>Precio</th>
            <th style='width: 200px;'>Cantidad</th>
        </tr>
    </thead>
    <tbody>
        @foreach($prod as $p)
        <tr>
            <td>{{$p->nombre}}</td>
            <td>{{$p->categoria->nombre}}</td>
            <td>$ {{$p->precio}}.00</td>
            <td>
                <div class="input-control text">
                    <input type="number" value="{{$p->cantidad}}" min="0">
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@stop
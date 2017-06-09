@extends('admin')
@section('title', 'Ventas')
@section('content')
<script>
    Titulo("Ventas", "", false, undefined, "dollar");
</script>
<table class='table striped'>
    <thead>
        <tr>
            <th>Folio</th>
            <th>Productos</th>
            <th>Total</th>
            <th>Usuario</th>
            <th>Fecha</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $v)
        <tr>
            <td><a href='/Admin/venta/{{$v->id}}'>{{$v->folio}}</a></td>
            <td>{{sizeof($v->productos)}}</td>
            <td>$ {{$v->total}}.00</td>
            <td>{{$v->usuario->nombre}}</td>
            <td>{{$v->creado}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@stop
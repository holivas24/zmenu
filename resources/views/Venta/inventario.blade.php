@extends('master')
@section('title', 'Inventario')
@section('content')
<script>
    Titulo("Inventario", "");
</script>
<table class="table striped">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Categoría</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th></th>
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
            <td></td>
        </tr>
        @endforeach
    </tbody>
</table>
@stop
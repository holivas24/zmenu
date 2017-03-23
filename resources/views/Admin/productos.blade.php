@extends('admin')
@section('title', 'Productos')
@section('content')
<script>
    Titulo("Productos", "", false, undefined, "shop");
</script>
<table class="table striped">
    <thead>
        <tr>
            <th>Folio</th>
            <th>Nombre</th>
            <th>Categoría</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Fecha de Creación</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $p)
        <tr>
            <td><a href="/Admin/producto/{{$p->id}}">{{$p->folio}}</a></td>
            <td>{{$p->nombre}}</td>
            <td>{{$p->categoria->nombre}}</td>
            <td>{{$p->precioMoneda}}</td>
            <td>{{$p->cantidad}}</td>
            <td>{{$p->creado}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@stop
@extends('admin')
@section('title', 'Categorías')
@section('content')
<script>
    Titulo("Categorías", "", false, undefined, "tag");
</script>
<table class="table striped">
    <thead>
        <tr>
            <th>Folio</th>
            <th>Nombre</th>
            <th>Productos</th>
            <th>Tipo</th>
            <th>Fecha de Creación</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $c)
        <tr>
            <td><a href="/Admin/categoria/{{$c->id}}">{{$c->folio}}</a></td>
            <td>{{$c->nombre}}</td>
            <td>{{$c->productos->count()}}</td>
            <td>{{'$ 0.00'}}</td>
            <td>{{$c->creado}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@stop
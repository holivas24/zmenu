@extends('admin')
@section('title', 'Usuarios')
@section('content')
<script>
    Titulo("Usuarios", "", false, undefined, "users");
</script>
<table class="table striped">
    <thead>
        <tr>
            <th>Folio</th>
            <th>Nombre</th>
            <th>Usuario</th>
            <th>Tipo</th>
            <th>Fecha de Creación</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $u)
        <tr>
            <td><a href="/Admin/usuario/{{$u->id}}">{{$u->folio}}</a></td>
            <td>{{$u->nombre}}</td>
            <td>{{$u->usuario}}</td>
            <td>{{$u->tipo}}</td>
            <td>{{$u->creado}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@stop
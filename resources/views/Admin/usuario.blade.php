@extends('admin')
@section('title', 'Usuario '. $u->nombre)
@section('content')
<script>
    Titulo("Usuario", "{{$u->nombre}}", true, undefined, "user");
</script>
@stop
@extends('admin')
@section('title', 'Categoría '. $c->nombre)
@section('content')
<script>
    Titulo("Categoría", "{{$c->nombre}}", true, undefined, "tag");
</script>
@stop
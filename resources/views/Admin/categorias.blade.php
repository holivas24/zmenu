@extends('admin')
@section('title', 'Categorías')
@section('content')
<script>
    Titulo("Categorías", "", false, undefined, "tag");
</script>
<a href="javascript:$('#new_category_button').hide();$('#new_category').slideDown();" class='button primary' id="new_category_button" style='float: right;'>Agregar Categoría</a>
<form action="/admin/categoria/0" method="post" enctype="multipart/form-data" id="new_category" style="display: none;">
    {{csrf_field()}}
    <table class="table striped">
        <thead>
            <tr>
                <th colspan="4">Modificar Información</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <strong>Nombre</strong>
                    <div class="input-control text full-size">
                        <input type="text" name="nombre" required>
                    </div>
                </td>
                <td>
                    <strong>Imagen</strong>
                    <div class="input-control file full-size" data-role="input">
                        <input type="file" name="photo" accept='image/*'>
                        <button class="button"><span class="mif-folder"></span></button>
                    </div>
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" style="text-align: center;"><input type="submit" value="Guardar" class="button success"></td>
            </tr>
        </tfoot>
    </table>
</form>
<table class="table striped">
    <thead>
        <tr>
            <th>Folio</th>
            <th>Nombre</th>
            <th>Productos</th>
            <th>Fecha de Creación</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $c)
        <tr>
            <td><a href="/Admin/categoria/{{$c->id}}">{{$c->folio}}</a></td>
            <td>{{$c->nombre}}</td>
            <td>{{$c->productos->count()}}</td>
            <td>{{$c->creado}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@stop
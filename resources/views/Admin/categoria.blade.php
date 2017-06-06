@extends('admin')
@section('title', 'Categoría '. $c->nombre)
@section('content')
<script>
    Titulo("Categoría", "{{$c->nombre}}", true, undefined, "tag");
</script>
<form action="/admin/categoria/{{$c->id}}" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
    <table class="table striped">
        <thead>
            <tr>
                <th colspan="4">Modificar Información</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td rowspan="2" style="width: 100px;">
                    <div class="image-container image-format-cycle" style="height: 100px;">
                        <div class="frame">
                            <div style="height: 100%; width: 100px; background-image: url({{$c->imagen}}); background-size: cover; background-repeat: no-repeat; border-radius: 50%;"></div>
                        </div>
                    </div>
                </td>
                <td>
                    <strong>Nombre</strong>
                    <div class="input-control text full-size">
                        <input type="text" name="nombre" value="{{$c->nombre}}" required>
                    </div>
                </td>
            </tr>
            <tr>
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
@stop
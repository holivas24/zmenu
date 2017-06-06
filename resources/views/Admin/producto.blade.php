@extends('admin')
@section('title', $p->nombre)
@section('content')
<script>
    Titulo("Producto", "{{$p->nombre}}", true, undefined, "shop");
    $(function () {
        $("#categoria_id").val("{{$p->categoria_id}}");
    });
</script>
<form action="/admin/producto/{{$p->id}}" method="post" enctype="multipart/form-data">
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
                            <div style="height: 100%; width: 100px; background-image: url({{$p->imagen}}); background-size: cover; background-repeat: no-repeat; border-radius: 50%;"></div>
                        </div>
                    </div>
                </td>
                <td>
                    <strong>Nombre</strong>
                    <div class="input-control text full-size">
                        <input type="text" name="nombre" value="{{$p->nombre}}" required>
                    </div>
                </td>
                <td>
                    <strong>Precio</strong>
                    <div class="input-control text full-size">
                        <input type="number" name="precio" value="{{$p->precio}}" required>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Categoría</strong>
                    <div class="input-control select full-size">
                        <select name="categoria_id" id="categoria_id">
                            @foreach($cat as $c)
                            <option value="{{$c->id}}">{{$c->nombre}}</option>
                            @endforeach
                        </select>
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
@stop
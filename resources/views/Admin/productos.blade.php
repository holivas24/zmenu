@extends('admin')
@section('title', 'Productos')
@section('content')
<script>
    Titulo("Productos", "", false, undefined, "shop");
</script>
<a href="javascript:$('#new_product_button').hide();$('#new_product').slideDown();" class='button primary' id="new_product_button" style='float: right;'>Agregar Producto</a>
<form action="/admin/producto/0" method="post" enctype="multipart/form-data" id="new_product" style="display: none;">
    {{csrf_field()}}
    <table class="table striped">
        <thead>
            <tr>
                <th colspan="4">Agregar Producto</th>
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
                    <strong>Precio</strong>
                    <div class="input-control text full-size">
                        <input type="number" name="precio" required>
                    </div>
                </td>
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
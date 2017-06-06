@extends('master')
@section('title', 'Inventario')
@section('content')
<script>
    Titulo("Inventario", "");
    $(function () {
        TablaDinamica("#inventario");
    });
    function EditItem(id) {
        $("#inv_mod_" + id).show();
        $("#inv_mod_" + id + "_btn").hide();
    }
    function SaveItem(id) {
        var c = $("#inv_amount_input_" + id).val();
        $.get('/Venta/mInventario', {"id": id, "cantidad": c}, function () {
            $("#inv_mod_" + id + "_btn").show();
            $("#inv_mod_" + id).hide();
            $("#inv_amount_" + id).html(c);
        });
    }
</script>
<table class="table striped" id="inventario">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Categoría</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th style='width: 200px;'></th>
        </tr>
    </thead>
    <tbody>
        @foreach($prod as $p)
        <tr>
            <td>{{$p->nombre}}</td>
            <td>{{$p->categoria->nombre}}</td>
            <td>$ {{$p->precio}}.00</td>
            <td id="inv_amount_{{$p->id}}">{{$p->cantidad}}</td>
            <td>
                <a href="javascript:EditItem({{$p->id}})" id="inv_mod_{{$p->id}}_btn">Modificar</a>
                <div id="inv_mod_{{$p->id}}" style="display: none;">
                    <div class="input-control text">
                        <input type="number" value="{{$p->cantidad}}" id="inv_amount_input_{{$p->id}}" min="0">
                        <a href='javascript:SaveItem({{$p->id}})' class='button success'>Guardar</a>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@stop
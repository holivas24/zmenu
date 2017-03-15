@extends('master')
@section('title', 'Inicio')
@section('content')
<div class="venta">
    <div class="categorias">
        <ul>
            @foreach ($cat as $c)
            <li value="{{$c->id}}">{{$c->nombre}}</li>
            @endforeach
        </ul>
    </div>
    @foreach ($cat as $c)
    <div class="productos" id="prods_{{$c->id}}"></div>
    @endforeach
    <div class="detalle">
        <div class="prods">
            <table class="table" style="margin-top: 0">
                <thead>
                    <tr>
                        <th style="width: 50%;">Detalle</th>
                        <th style="width: 25%;">Cantidad</th>
                        <th style="width: 25%;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="3" style="padding: 0;">
                            <table class="lista"></table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="info">
            <table class="table striped" style="margin-top: 0">
                <thead>
                    <tr><th colspan="2">Detalle de la Venta</th></tr>
                </thead>
                <tr><td class="align-right"><strong>Productos</strong></td><td class="cant">0</td></tr>
                <tr><td class="align-right"><strong>Total</strong></td><td class="total">$ 0.00</td></tr>
            </table>
        </div>
        <div class="functions"></div>
    </div>
</div>
<script>
    $(function () {
        $(".grid").css("height", "100%");
        $(".grid").css("margin", "0");
        $(".categorias li").click(function () {
            $(".categorias li").removeClass("selected");
            $(this).addClass("selected");
            var id = $(this).attr('value');
            if (!$("#prods_" + id).hasClass("loaded")) {
                $.get("/Venta/productos?id=" + id, function (data) {
                    $("#prods_" + id).html(data);
                    $(".productos .producto").click(function () {
                        $.get("/Venta/add?id=" + $(this).attr("value"), function (detail) {
                            $(".detalle .lista").html(detail);
                            CalcularTotal();
                        });
                    });
                });
                $("#prods_" + id).addClass("loaded");
            }
            $(".productos").hide();
            $("#prods_" + id).show();
        });
        $.get("/Venta/detalle", function (detail) {
            $(".detalle .lista").html(detail);
            CalcularTotal();
        });
        $(".categorias li:first-child").trigger('click');
    });
    function CalcularTotal() {
        var total = 0;
        var cant = 0;
        $(".lista tr td:nth-child(2)").each(function () {
            cant += $(this).text() * 1;
        });
        $(".lista tr td:nth-child(3)").each(function () {
            total += $(this).text().replace("$", "") * 1;
        });
        $(".info .cant").html(cant);
        $(".info .total").html("$ " + total.toFixed(2));
    }
</script>
<style>
    .venta{
        position: absolute;
        height: 100%;
        width: 100%;
    }
    .venta .categorias{
        float: left;
        height: 100%;
        width: 15%;
        border-right: 2px solid rgba(0, 0, 0, 0.3);
    }
    .venta .categorias ul{
        list-style: none;
        padding: 0;
    }
    .venta .categorias li{
        width: 100%;
        padding: 6px;
        font-size: 1.2rem;
        text-align: center;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    }
    .venta .categorias li:hover{
        cursor: pointer;
        background-color: rgba(0, 0, 0, 0.1);
    }
    .venta .categorias li.selected{
        color: #2196F3;
        font-weight: bold;
    }
    .venta .productos{
        float: left;
        width: 60%;
        height: 100%;
        padding: 5px;
        overflow-y: auto;
        padding-left: 10px;
        border-right: 2px solid rgba(0, 0, 0, 0.3);
    }
    .venta .productos .producto{
        float: left;
        margin: 2px;
        width: 150px;
        height: 150px;
        padding: 5px;
        text-align: center;
        vertical-align:middle;
        background: rgba(0, 0, 0, 0.1);
    }
    .venta .productos .producto:hover{
        cursor: pointer;
        background: rgba(0, 0, 0, 0.3);
    }
    .venta .productos .producto:hover .nombre{
        color: white;
        font-weight: 500;
    }
    .venta .productos .producto .nombre{
        float: left;
        width: 100%;
        color: #2196F3;
        text-align: center;
    }
    .venta .productos .producto .precio{
        position: relative;
        float: right;
        top: 110px;
        padding-right: 10px;
        color: rgba(0, 0, 0, 0.5);
    }
    .venta .detalle{
        float: left;
        height: 100%;
        width: 25%;
    }
    .venta .detalle .prods{
        height: 60%;
    }
    .venta .detalle .prods .lista{
        position: relative;
        width: 100%;
        height: 52%;
        overflow: auto;
    }
    .venta .detalle .info{
        height: 20%;
        border-top: 2px solid rgba(0, 0, 0, 0.1);
    }
</style>
@stop
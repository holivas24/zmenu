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
    <div class="productos"></div>
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
                        <td colspan="3">
                            <div class="lista"></div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="info"></div>
        <div class="functions"></div>
    </div>
</div>
<script>
    $(".categorias li").click(function () {
        $(".categorias li").removeClass("selected");
        $(this).addClass("selected");
        $.get("/Venta/productos?id=" + $(this).attr('value'), function (data) {
            $(".venta .productos").html(data);
        });
    });
    $(".categorias li:first-child").trigger('click');
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
        vertical-align:middle;

        text-align: center;
        background: rgba(0, 0, 0, 0.1);
    }
    .venta .productos .producto:hover{
        cursor: pointer;
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
        width: 100%;
        height: 100%;
        background: red;
    }
    .venta .detalle .info{
        height: 20%;
        border-top: 2px solid rgba(0, 0, 0, 0.1);
    }
</style>
@stop
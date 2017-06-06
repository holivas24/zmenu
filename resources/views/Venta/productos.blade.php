@foreach($prod as $p)
<div class="producto" value="{{$p->id}}">
    <div class="image-container image-format-cycle" style="height: 75px; position: absolute; z-index: -1; margin-left: -40px; margin-top: 35px;">
        <div class="frame">
            <div style="height: 100%; width: 75px; background-image: url({{$p->imagen}}); background-size: cover; background-repeat: no-repeat; border-radius: 50%;"></div>
        </div>
    </div>
    <div class="precio">{{$p->PrecioMoneda}}</div><div class="nombre">{{$p->nombre}}</div>

</div>
@endforeach
@foreach($prod as $p)
<div class="producto" value="{{$p->id}}"><div class="precio">{{$p->PrecioMoneda}}</div><div class="nombre">{{$p->nombre}}</div></div>
@endforeach
@foreach($prod as $p)
<div class="producto" value="{{$p->id}}"><div class="precio">$ {{number_format($p->precio, 2, '.', ',')}}</div><div class="nombre">{{$p->nombre}}</div></div>
@endforeach
<table class="table striped">
    <thead>
        <tr>
            <th>Folio</th>
            <th>Fecha</th>
            <th>Usuario</th>
            <th>Tipo</th>
            <th>Descripción</th>
        </tr>
    </thead>
    @foreach ($registros as $r)
    <tr>
        <td>{{$r->folio}}</td>
        <td>{{$r->creado}}</td>
        <td>{{$r->usuario->usuario}}</td>
        <td>{{$r->tipo}}</td>
        <td>{{$r->descripcion}}</td>
        <td>
            <div style="display: none;" id="dump_{{$r->id}}">{{$r->dumpTxt}}</div>
            <a href='javascript:alert($("#dump_{{$r->id}}").html())' class="button warning">Detalle</a>
        </td>
    </tr>
    @endforeach
</table>
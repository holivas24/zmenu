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
    </tr>
    @endforeach
</table>
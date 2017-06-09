<h4 class="fg-darkGreen">Reporte del día {{$d->formatLocalized('%A, %d de %B de %Y')}}</h4>
<div class="grid">
    <div class="row cells12">
        <div class="cell colspan8">
            <div class="panel">
                <div class="heading bg-darkBlue">
                    <span class="title">Detalle de Ventas</span>
                </div>
                <div class="content">
                    <table class="table striped" style="margin-top: 0;">
                        <thead>
                            <tr>
                                <th>Folio</th>
                                <th>Hora</th>
                                <th>Productos</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ven as $v)
                            <tr>
                                <td>{{$v->folio}}</td>
                                <td>{{$v->created_at->formatLocalized('%I:%M %p')}}</td>
                                <td>{{sizeof($v->productos)}}</td>
                                <td>{{$v->totalMoneda}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="cell colspan4">
            <div class="panel">
                <div class="heading">
                    <span class="title">Resumen</span>
                </div>
                <div class="content">
                    <table class="table striped" style="margin-top: 0;">
                        <tbody>
                            <tr>
                                <td><h4 class="fg-gray">Productos</h4></td>
                                <td><h4>{{$tot['productos']}}</h4></td>
                            </tr>
                            <tr>
                                <td><h4 class="fg-gray">Total</h4></td>
                                <td><h4>{{"$ " . number_format($tot['total'], 2, '.', ',')}}</h4></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php

namespace App\Http\Controllers;

use DB,
    View,
    Carbon\Carbon;
use App\Ventas,
    App\Categorias,
    App\VentasProductos;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;

class Reporte extends Controller {

    public function __construct() {
        View::share('public', Application::getPublic());
    }

    public function index() {
        return view('Reporte/index');
    }

    public function corte() {
        $d = Carbon::today();
        return view('Reporte/corte', ['d' => $d]);
    }

    public function postCorte() {
        $d = Carbon::createFromFormat('d/m/Y H', Input::get('d') . ' 0');
        $ven = Ventas::whereDate('created_at', $d->formatLocalized('%Y-%m-%d'))->get();
        $tot = ['productos' => 0, 'total' => 0];
        foreach ($ven as $v) {
            $tot['productos'] += sizeof($v->productos);
            $tot['total'] += $v->total;
        }
        return view('Reporte/postCorte', ['d' => $d, 'ven' => $ven, 'tot' => $tot]);
    }

    public function estVentas() {
        $cbd = DB::table('ventas')
                ->select(DB::raw("COUNT(*) 'total', DATE(created_at) 'fecha'"))
                ->whereRaw('YEAR(created_at) = ? AND MONTH(created_at) = ? AND deleted_at IS NULL', [Input::get('y'), Input::get('m')])
                ->groupBy(DB::raw('DATE(created_at)'))
                ->get();
        $val = [];
        foreach ($cbd as $i => $c) {
            $act = Carbon::createFromFormat('Y-m-d', $c->fecha);
            $val[] = [$c->fecha, $c->total * 1];
            if ($i + 1 < sizeof($cbd)) {
                $next = Carbon::createFromFormat('Y-m-d', $cbd[$i + 1]->fecha);
                $val = $this->cbd($act, $next, $val);
            }
        }
        return response()->json($val);
    }

    static function cbd($act, $next, $val) {
        while ($next->gt($act)) {
            $act = $act->addDay(1);
            if (!$next->eq($act)) {
                $val[] = [$act->toDateString(), 0];
            }
        }
        return $val;
    }

    public function estCategoria() {
        $val = [];
        $cat = Categorias::all();
        foreach ($cat as $c) {
            $val[$c->id - 1] = [$c->nombre, 0];
        }
        $ven = VentasProductos::whereRaw('YEAR(created_at) = ? AND MONTH(created_at) = ? AND deleted_at IS NULL', [Input::get('y'), Input::get('m')])->get();
        foreach ($ven as $p) {
            $val[$p->producto->categoria->id - 1][1] ++;
        }
        return response()->json($val);
    }

}

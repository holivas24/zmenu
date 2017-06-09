<?php

namespace App\Http\Controllers;

use Session,
    View,
    Auth;
use App\Productos,
    App\Ventas,
    App\VentasProductos;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;

class Venta extends Controller {

    public function __construct() {
        View::share('public', Application::getPublic());
    }

    public function productos() {
        $prod = Productos::porCategoria(Input::get('id'))->get();
        return view('Venta/productos', ['prod' => $prod]);
    }

    public function detalle() {
        $prods = Session::get('productos') ? Session::get('productos') : [];
        foreach ($prods as $p) {
            echo "<tr><td style='width: 50%'>" . $p['nombre'] . "</td><td style='width: 25%;text-align:center;'>" . $p['cantidad'] . "</td><td style='width: 25%;'>$ " . number_format(($p['precio'] * $p['cantidad']), 2, '.', ',') . "</td></tr>";
        }
    }

    public function add() {
        $p = Productos::findOrFail(Input::get('id'));
        $prods = Session::get('productos') ? Session::get('productos') : [];
        $added = false;
        foreach ($prods as $i => $d) {
            if ($d['id'] == $p->id) {
                $d['cantidad'] ++;
                $prods[$i] = $d;
                $added = false;
                break;
            } else {
                $added = true;
            }
        }
        if (sizeof($prods) == 0 || $added) {
            $np = ["id" => $p->id, "nombre" => $p->nombre, "cantidad" => 1, "precio" => $p->precio];
            array_push($prods, $np);
        }
        Session::put('productos', $prods);
        return redirect('Venta/detalle');
    }

    public function clear() {
        Session::put('productos', []);
    }

    public function inventario() {
        $prod = Productos::all();
        return view('Venta/inventario', ['prod' => $prod]);
    }

    public function mInventario() {
        $p = Productos::findOrFail(Input::get('id'));
        $p->cantidad = Input::get('cantidad');
        $p->save();
    }

    public function guardar() {
        $v = new Ventas(['usuario_id' => Auth::id(), 'total' => 0]);
        $v->save();
        foreach (Session::get('productos') as $p) {
            $p = Productos::findOrFail($p['id']);
            $vp = new VentasProductos(['producto_id' => $p['id'], 'venta_id' => $v->id, 'cantidad' => $p['cantidad'], 'precio' => $p['precio'], 'total' => ($p['cantidad'] * $p['precio'])]);
            $vp->save();
            $v->total += $vp->total;
        }
        $v->save();
        Session::put('productos', []);
        return redirect('/inicio?id=' . $v->id);
    }

}

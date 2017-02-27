<?php

namespace App\Http\Controllers;

use Session;
use App\Productos;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;

class Venta extends Controller {

    public function productos() {
        $prod = Productos::categoria(Input::get('id'))->get();
        return view('Venta/productos', ['prod' => $prod]);
    }

    public function detalle() {
        $prods = Session::get('productos') ? Session::get('productos') : [];
        foreach ($prods as $p) {
            echo "<tr><td style='width: 50%'>" . $p['nombre'] . "</td><td style='width: 15%;'>" . $p['cantidad'] . "</td><td style='width: 30%;'>$ " . number_format(($p['precio'] * $p['cantidad']), 2, '.', ','). "</td></tr>";
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

}

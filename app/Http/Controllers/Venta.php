<?php

namespace App\Http\Controllers;

use App\Productos;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;

class Venta extends Controller {

    public function productos() {
        $prod = Productos::categoria(Input::get('id'))->get();
        return view('Venta/productos', ['prod' => $prod]);
    }

}

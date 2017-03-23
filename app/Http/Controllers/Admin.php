<?php

namespace App\Http\Controllers;

use View,
    Session;
use App\Usuarios,
    App\Categorias,
    App\Productos,
    App\Registros;
use Illuminate\Support\Facades\Input;
use Illuminate\Routing\Controller;

class Admin extends Controller {

    public function __construct() {
        View::share('public', app()->env != 'local' ? 'public/' : '');
        Session::put('count_usu', Usuarios::count());
        Session::put('count_cat', Categorias::count());
        Session::put('count_pro', Productos::count());
        Session::put('count_reg', Registros::count());
        $this->middleware('session');
    }

    public function panel() {
        Session::put('selected', '0');
        return view('Admin/panel');
    }

    //Categorías
    public function usuarios() {
        Session::put('selected', 'usu');
        $data = Usuarios::all();
        return view('Admin/usuarios', ['data' => $data]);
    }

    public function ventas() {
        Session::put('selected', 'ven');
        $data = Usuarios::all();
        return view('Admin/ventas', ['data' => $data]);
    }

    public function categorias() {
        Session::put('selected', 'cat');
        $data = Categorias::all();
        return view('Admin/categorias', ['data' => $data]);
    }

    public function productos() {
        Session::put('selected', 'pro');
        $data = Productos::all();
        return view('Admin/productos', ['data' => $data]);
    }

    public function registros() {
        Session::put('selected', 'reg');
        $tipos = ['Alta', 'Baja', 'Cambio'];
        $cant = ["50", "100", "200", "500", "1000", "5000", "10000"];
        return view('Admin/registros', ['tipos' => $tipos, 'cant' => $cant]);
    }

    //Detallados
    public function usuario($id) {
        Session::put('selected', 'usu');
        $data = Usuarios::findOrFail($id);
        return view('Admin/usuario', ['u' => $data]);
    }

    public function venta($id) {
        Session::put('selected', 'ven');
        $data = Usuarios::findOrFail($id);
        return view('Admin/venta', ['v' => $data]);
    }

    public function categoria($id) {
        Session::put('selected', 'cat');
        $data = Categorias::findOrFail($id);
        return view('Admin/categoria', ['c' => $data]);
    }

    public function producto($id) {
        Session::put('selected', 'pro');
        $data = Productos::findOrFail($id);
        return view('Admin/producto', ['p' => $data]);
    }

    public function registro() {
        $tipo = Input::get("tipo");
        $cant = Input::get("cant") == 0 ? 99999999999999 : Input::get("cant");
        $registros = [];
        if ($tipo == 0) {
            $registros = Registros::orderBy('created_at', 'desc')->take($cant)->get();
        } else {
            $registros = Registros::where('tipo', '=', $tipo)->orderBy('created_at', 'desc')->take($cant)->get();
        }
        return view('Admin/registro')->with('registros', $registros);
    }

}

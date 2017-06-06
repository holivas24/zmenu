<?php

namespace App\Http\Controllers;

use View,
    Auth,
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
        $cat = Categorias::all();
        return view('Admin/productos', ['data' => $data, 'cat' => $cat]);
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
        $cat = Categorias::all();
        $data = Productos::findOrFail($id);
        return view('Admin/producto', ['p' => $data, 'cat' => $cat]);
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

    //Modificaciones
    public function modUsuario() {

    }

    public function modCategoria($id) {
        $c = Categorias::find($id);
        if ($c == null) {
            $c = new Categorias();
        }
        $c->fill(Input::all());
        if (Input::file('photo')) {
            $c->imagen = Input::file('photo')->getClientOriginalExtension();
            Input::file('photo')->move(base_path() . '/public/upload/categorias/', $c->imagen);
        }
        $c->save();
        Auth::user()->Registro($id == 0 ? 'Alta' : 'Cambio', 'CAT-' . $c->id, $c);
        return redirect('/Admin/categoria/' . $c->id);
    }

    public function modProducto($id) {
        $p = Productos::find($id);
        if ($p == null) {
            $p = new Productos(['cantidad' => 0]);
        }
        $p->fill(Input::all());
        if (Input::file('photo')) {
            $p->imagen = Input::file('photo')->getClientOriginalExtension();
            Input::file('photo')->move(base_path() . '/public/upload/productos/', $p->imagen);
        }
        $p->save();
        Auth::user()->Registro($id == 0 ? 'Alta' : 'Cambio', 'PRO-' . $p->id, $p);
        return redirect('/Admin/producto/' . $p->id);
    }

}

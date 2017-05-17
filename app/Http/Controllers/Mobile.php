<?php

namespace App\Http\Controllers;

use App\Categorias;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;

class Mobile extends Controller {

    public function categorias() {
        $cat = Categorias::all();
        return response()->json($cat);
    }

    public function productos() {
        $cat = Categorias::find(Input::get('id'));
        if ($cat == null) {
            return response()->json(['error' => false]);
        }
        return response()->json($cat->productos);
    }

}

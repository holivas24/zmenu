<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registros extends Model {

    protected $fillable = ['descripcion', 'tipo', 'usuario'];
    protected $dates = ['created_at', 'updated_at'];

}

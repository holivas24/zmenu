<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categorias extends Model {

    use SoftDeletes;

    protected $fillable = ['nombre'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Productos extends Model {

    use SoftDeletes;

    protected $fillable = ['nombre', 'precio', 'cantidad', 'categoria_id'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function categoria() {
        return $this->belongsTo('App\Categorias');
    }

    public function scopePorcategoria($query, $val) {
        return $query->where('categoria_id', $val);
    }

}

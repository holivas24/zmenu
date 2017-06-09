<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ventas extends Model {

    use SoftDeletes;

    protected $fillable = ['total', 'usuario_id'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function Productos() {
        return $this->hasMany('App\VentasProductos', 'venta_id');
    }

    public function usuario() {
        return $this->belongsTo('App\Usuarios');
    }

    public function getFolioAttribute() {
        return 'VEN-' . $this->id;
    }

    public function getCreadoAttribute() {
        return $this->created_at->formatLocalized('%d %B %Y %I:%M %p');
    }

    public function getTotalMonedaAttribute() {
        return "$ " . number_format($this->total, 2, '.', ',');
    }

}

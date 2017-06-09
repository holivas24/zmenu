<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VentasProductos extends Model {

    protected $fillable = ['precio', 'cantidad', 'total', 'producto_id', 'venta_id'];
    protected $dates = ['created_at', 'updated_at'];

    public function Venta() {
        return $this->hasOne('App\Ventas');
    }

    public function Producto() {
        return $this->belongsTo('App\Productos');
    }

}

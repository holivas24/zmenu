<?php

namespace App;

use App\Http\Controllers\Application;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Productos extends Model {

    use SoftDeletes;

    protected $fillable = ['nombre', 'precio', 'cantidad', 'imagen', 'categoria_id'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function getFolioAttribute() {
        return 'PRO-' . $this->id;
    }

    public function getCreadoAttribute() {
        return $this->created_at->formatLocalized('%d %B %Y %I:%M %p');
    }

    public function getModificadoAttribute() {
        return $this->updated_at->formatLocalized('%d %B %Y %I:%M %p');
    }

    public function getEliminadoAttribute() {
        return $this->deleted_at->formatLocalized('%d %B %Y %I:%M %p');
    }

    public function categoria() {
        return $this->belongsTo('App\Categorias');
    }

    public function scopePorcategoria($query, $val) {
        return $query->where('categoria_id', $val);
    }

    public function getPrecioMonedaAttribute() {
        return "$ " . number_format($this->precio, 2, '.', ',');
    }

    public function getImagenAttribute() {
        return $this->attributes['imagen'] != "" ? "/" . (Application::getPublic() . 'upload/productos/' . $this->id . '.' . $this->attributes['imagen']) : "";
    }

}

<?php

namespace App;

use App\Http\Controllers\Application;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categorias extends Model {

    use SoftDeletes;

    protected $fillable = ['nombre'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function getFolioAttribute() {
        return 'CAT-' . $this->id;
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

    public function productos() {
        return $this->hasMany('App\Productos', 'categoria_id');
    }

    public function getImagenAttribute() {
        return $this->attributes['imagen'] != "" ? "/" . (Application::getPublic() . 'upload/categorias/' . $this->id . '.' . $this->attributes['imagen']) : "";
    }

}

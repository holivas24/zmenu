<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registros extends Model {

    protected $fillable = ['descripcion', 'tipo', 'dump', 'usuario_id'];
    protected $dates = ['created_at', 'updated_at'];

    public function getFolioAttribute() {
        return 'REG-' . $this->id;
    }

    public function getCreadoAttribute() {
        return $this->created_at->formatLocalized('%d %B %Y %I:%M %p');
    }

    public function usuario() {
        return $this->belongsTo('App\Usuarios');
    }

    public function getDumpTxtAttribute() {
        $str = "";
        $data = json_decode($this->attributes['dump']);
        foreach ($data as $k => $v) {
            $str.="$k: $v\n";
        }
        return $str;
    }

}

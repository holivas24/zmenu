<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuarios extends Authenticatable {

    use Notifiable,
        SoftDeletes;

    protected $fillable = ['nombre', 'password', 'usuario', 'tipo'];
    protected $hidden = ['password', 'remember_token'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function getFolioAttribute() {
        return 'USU-' . $this->id;
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

}

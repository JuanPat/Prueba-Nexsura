<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table = 'empleados';

    protected $fillable = ['nombre', 'email', 'sexo', 'area_id', 'boletin', 'descripcion'];

    public $timestamps = false;

    public function area() {
        return $this->belongsTo('App\Area', 'area_id');
    }

    public function roles() {
        return $this->belongsToMany('App\Rol', 'empleado_rols');
    }
}

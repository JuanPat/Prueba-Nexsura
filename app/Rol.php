<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'rols';

    protected $fillable = ['nombre'];

    public $timestamps = false;

    public function empleados() {
        return $this->belongsToMany('App\Empleado', 'empleado_rols');
    }
}

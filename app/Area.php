<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'areas';

    protected $fillable = ['nombre'];

    public $timestamps = false;

    public function empleados() {
        return $this->hasMany('App\Empleado');
    }
}

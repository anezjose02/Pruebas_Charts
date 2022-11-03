<?php

namespace App\Models\Super;

use Illuminate\Database\Eloquent\Model;

class Planes extends Model
{
    //
    protected $fillable = [
        'nombre',
        'modulos',
        'licencia',
        'precio',
        'limite_facturas',
        'max_empresas',
        'max_sucursales',
        'max_usuarios',
        'max_puntos',
        'max_cajas',
    ];

    public function sistemas()
    {
        return $this->hasMany("App\Models\Super\Sistema",'plan','nombre');
    }
}

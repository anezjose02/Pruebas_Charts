<?php

namespace App\Models\Super;

use Illuminate\Database\Eloquent\Model;

class Sistema extends Model
{
    //
    protected $fillable = [
        'user_id',
        'plan',
        'name', 'email', 'password',//datos del usuario
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

    public function user()
    {
        return $this->belongsTo("App\User");
    }
}

<?php

namespace App\Contabilidad;

use Illuminate\Database\Eloquent\Model;

class Asiento extends Model
{
    //
    protected $fillable = [
        'user_id',
        'sucursales_id',
        'total_debito',
        

        'total_credito',
        'monto',
        'fecha',

        'tipo',
        'numero',
        'referencia',

        'centro_costo',
        'cuentas',
        'descripcion',
    ];

    public function user()
    {
        return $this->belongsTo("App\User");
    }

    public function sucursal()
    {
        return $this->belongsTo("App\Models\General\Sucursales");
    }
}

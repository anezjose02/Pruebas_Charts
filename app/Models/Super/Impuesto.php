<?php

namespace App\Models\Super;

use Illuminate\Database\Eloquent\Model;

class Impuesto extends Model
{
    //
    protected $fillable=[
        'nombre',
        'codigo',
        'codigoPorcentaje',
        'tarifa',
    ];
}

<?php

namespace App\Models\Super;

use Illuminate\Database\Eloquent\Model;

class Concepto extends Model
{
    //
    protected $fillable = [
        'codigo',
        'nombre',
        'porcentaje'
    ];
}

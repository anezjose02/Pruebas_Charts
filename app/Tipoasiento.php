<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipoasiento extends Model
{
    //
    protected $fillable = [
        'nombre',
        'abreviatura',
        'prefijo',
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Globales extends Model
{
    //
    protected $fillable=[
        'slug',
        'valor',
        'nombre',
    ];

    public static function global($slug)
    {
        return Globales::where('slug',$slug)->first();
    }
}

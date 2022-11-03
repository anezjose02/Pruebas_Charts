<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Historia extends Model
{
    //
    protected $fillable= [
        'user_id',
        'accion',
        'email',

        'name',
        'rol',
        'sistema',
    ];

    public function user()
    {
        return $this->belongsTo("App\User");
    }
}

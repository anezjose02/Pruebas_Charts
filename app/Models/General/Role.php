<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $fillable = [
        'user_id',
        'nombre',
        'permisos',
        'modulos',
    ];

    public function user()
    {
        return $this->belongsTo("App\User");
    }
}

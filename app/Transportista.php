<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transportista extends Model
{
    //
    protected $fillable = [
        'user_id',
        'empresa_id',
        'identificacion',

        'identificacion_tipo',
        'razonsocial',
        'direccion',

        'telefono',
        'email',
        'NOMBRE_COMERCIAL',
    ];

    public function user()
    {
        return $this->belongsTo("App\User");
    }

    public function empresa()
    {
        return $this->belongsTo("App\Models\General\Empresa");
    }
    
    public function guiasRemision()
    {
        return $this->hasMany("App\Models\Comercio\Guiaremision");
    }
}

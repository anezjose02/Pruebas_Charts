<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Model;

class Punto extends Model
{
    //
    protected $fillable = [
        'user_id',
        'empresa_id',
        'sucursales_id',
        'ptoEmi',
        'secuencialfactura',
        'secuencialretencion',
        'secuencialnotacredito',
        'secuencialnotadebito',
        'secuencialguiaremision',
        'secuencialliquidacioncompra',
    ];

    public function user()
    {
        return $this->belongsTo("App\User");
    }

    public function empresa()
    {
        return $this->belongsTo("App\Models\General\Empresa");
    }

    public function sucursales()
    {
        return $this->belongsTo("App\Models\General\Sucursales");
    }
    
    public function cajas()
    {
        return $this->hasMany("App\Models\General\Caja");
    }
    
    public function guiasRemision()
    {
        return $this->hasMany("App\Models\Comercio\Guiaremision");
    }
}

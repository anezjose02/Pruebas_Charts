<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    //
    protected $fillable = [
        'user_id',
        'empresa_id',
        'sucursales_id',
        'punto_id',
        'nombre',
        'ambiente',
        'facturafisica',
        'envioautomatico',
        'efectivo',
    ];

    public function user()
    {
        return $this->belongsTo("App\User");
    }

    public function empresa()
    {
        return $this->belongsTo("App\Models\General\Empresa");
    }

    public function sucursal()
    {
        return $this->belongsTo("App\Models\General\Sucursales",'sucursales_id','id');
    }

    public function punto()
    {
        return $this->belongsTo("App\Models\General\Punto");
    }

    public function ventas()
    {
        return $this->hasMany("App\Models\Comercio\Venta");
    }

    public function proformas()
    {
        return $this->hasMany("App\Models\Comercio\Proforma");
    }

    public function notasCredito()
    {
        return $this->hasMany("App\Models\Comercio\Notacredito");
    }
    
    public function notasDebito()
    {
        return $this->hasMany("App\Comercio\Notadebito");
    }

    public function retenciones()
    {
        return $this->hasMany("App\Models\Comercio\Retenciones");
    }
}

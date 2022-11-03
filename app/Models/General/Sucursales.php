<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Model;

class Sucursales extends Model
{
    //
    protected $fillable = [
        'user_id',
        'empresa_id',
        'estab',//
        'direccion',//
        'email',
        'celular',
        'telefono',
        'web',
        'aplicaservicios',
        'facturas1',
        'facturas2',
        'proformas1',
        'proformas2',
        'logofactura',//
        'logoproforma',//
        'logomarcaagua',//
        'logocontrato',//
        'secuencialproforma',//
    ];

    public function user()
    {
        return $this->belongsTo("App\User");
    }

    public function empresa()
    {
        return $this->belongsTo("App\Models\General\Empresa");
    }
    
    public function puntos()
    {
        return $this->hasMany("App\Models\General\Punto");
    }
    
    public function cajas()
    {
        return $this->hasMany("App\Models\General\Caja");
    }

    public function notasCredito()
    {
        return $this->hasMany("App\Models\Comercio\Notacredito",'sucursales_id','id');
    }
    
    public function notasDebito()
    {
        return $this->hasMany("App\Comercio\Notadebito",'sucursales_id','id');
    }
    
    public function asientos()
    {
        return $this->hasMany("App\Contabilidad\Asiento");
    }
}

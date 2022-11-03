<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    //
    protected $fillable = [
        'user_id',
        'ruc',//
        'dirMatriz',//
        'razonSocial',//
        'nombreComercial',//
        'agenteRetencion',//

        'representante',//
        'representanteruc',//
        'celular',//
        'telefono',//
        'web',//
        'email',//

        'contribuyenteEspecial',//
        'obligadoContabilidad',//
        'codigoempresa',//
        'codigoartesano',//
        'logo',//
        'firma',//

        'firmaclave',//
        'clavesri',//
        'firmavence',//
        'tipocontribuyente',//
    ];

    public function user()
    {
        return $this->belongsTo("App\User");
    }
    
    public function sucursales()
    {
        return $this->hasMany("App\Models\General\Sucursales");
    }
    
    public function puntos()
    {
        return $this->hasMany("App\Models\General\Punto");
    }
    
    public function cajas()
    {
        return $this->hasMany("App\Models\General\Caja");
    }
    
    public function planesCuentas()
    {
        return $this->hasMany("App\Models\Inventario\Plancuenta");
    }
    
    public function categorias()
    {
        return $this->hasMany("App\Models\Contabilidad\Categoria");
    }
    
    public function clientes()
    {
        return $this->hasMany("App\Models\Cliente");
    }
    
    public function proveedores()
    {
        return $this->hasMany("App\Models\Proveedores");
    }
    
    public function vendedores()
    {
        return $this->hasMany("App\Models\Vendores");
    }

    public function compras()
    {
        return $this->hasMany("App\Models\Comercio\Compra");
    }
    
    public function liquidacionesCompras()
    {
        return $this->hasMany("App\Models\Comercio\Liquidacioncompra");
    }

    public function gastos()
    {
        return $this->hasMany("App\Models\Comercio\Gasto");
    }

    public function retenciones()
    {
        return $this->hasMany("App\Models\Comercio\Retenciones");
    }

    

    public function centrosCostos()
    {
        # code...
        return $this->belongsToMany('App\Models\Contabilidad\Centrocosto');
    }
    
    public function transportistas()
    {
        return $this->hasMany("App\Transportista");
    }
    
    public function guiasRemision()
    {
        return $this->hasMany("App\Models\Comercio\Guiaremision");
    }
}

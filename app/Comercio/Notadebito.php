<?php

namespace App\Comercio;

use Illuminate\Database\Eloquent\Model;

class Notadebito extends Model
{
    //
    
    protected $fillable = [
        'user_id',
        'notadebito_id',
        'cliente_id',
        'proveedor_id',
        'sucursales_id',

        'caja_id',
        'almacen_id',
        'venta_id',
        'compra_id',

        'observaciones',
        'ambiente',

        'razonSocial',
        'numeroDocumento',
        'nombreComercial',
        'ruc',

        'claveAcceso',
        'codDoc',
        'estab',
        'ptoEmi',

        'secuencial',
        'dirMatriz',
        'fecha_emision',
        'fecha_emision_doc_sustento',
        'subtotal_cero',

        'subtotal_sin_impuestos',
        'subtotal_iva',
        'descuento',
        'propina',

        'total',
        'rise',///* */
        'codDocModificado',
        'numDocModificado',

        'fechaEmisionDocSustento',
        'valorModificacion',
        'motivo',

        'centrocosto_id',
    ];

    public function user()
    {
        return $this->belongsTo("App\User");
    }

    public function documento()
    {
        return $this->hasOne("App\Models\Documento",'id','notadebito_id');
    }

    public function cliente()
    {
        return $this->belongsTo("App\Models\Cliente");
    }

    public function caja()
    {
        return $this->belongsTo("App\Models\General\Caja");
    }

    public function almacen()
    {
        return $this->belongsTo("App\Models\Inventario\Almacenes",'id','almacen_id');
    }

    public function venta()
    {
        return $this->belongsTo("App\Models\Comercio\Venta");
    }

    public function compra()
    {
        return $this->belongsTo("App\Models\Comercio\Compra");
    }

    public function sucursal()
    {
        return $this->belongsTo("App\Models\General\Sucursales",'sucursales_id','id');
    }

    public function proveedor()
    {
        return $this->belongsTo("App\Models\Proveedores",'proveedor_id','id');
    }

    public function centroCostos()
    {
        return $this->belongsTo("App\Models\Contabilidad\Centrocosto");
    }
}

<?php



namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','admin_id',
        'superuser','activo','sistema','en_empresas',
        'en_sucursales','en_puntos','en_cajas','en_almacenes',
        'modulos','permisos','rol','licencia',
        'proximo_corte','limite_facturas','max_empresas','max_sucursales',
        'max_usuarios','max_puntos','tema_sistema','precio_sistema',
        'configuracion_sistema',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
 
    public function evaluarModulos($modulos)
    {
        # code...
        if ($this->modulos) {
            # code...
            $m = json_decode($this->modulos);
            if (count($m) > 0) {
                # code...
                foreach ($m as $md) {
                    # code...
                    foreach ($modulos as $mdd) {
                        # code...
                        if ($md == $mdd) {
                            # code...
                            return true;
                        }
                    }
                }
            }
        }
        return false;
    }
 
    public function evaluarPermisos($permisos)
    {
        # code...
        if ($this->id == $this->admin_id || $this->superuser) {
            # code...
            return true;
        }

        if ($this->permisos) {
            # code...
            $m = json_decode($this->permisos);
            if (count($m) > 0) {
                # code...
                foreach ($m as $md) {
                    # code...
                    foreach ($permisos as $mdd) {
                        # code...
                        if ($md == $mdd) {
                            # code...
                            return true;
                        }
                    }
                }
            }
        }
        return false;
    }


    

    public function usuarios()
    {
        return $this->hasMany("App\User",'admin_id','id');
    }
    
    public function getSistema()
    {
        return $this->hasOne("App\Models\Super\Sistema");
    }
    
    public function roles()
    {
        return $this->hasMany("App\Models\General\Role");
    }
    
    public function empresas()
    {
        return $this->hasMany("App\Models\General\Empresa");
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
    
    public function almacenes()
    {
        return $this->hasMany("App\Models\Inventario\Almacenes");
    }
    
    public function unidades()
    {
        return $this->hasMany("App\Models\Inventario\Unidades");
    }
    
    public function precios()
    {
        return $this->hasMany("App\Models\Inventario\Precio");
    }
    
    public function filtros()
    {
        return $this->hasMany("App\Models\Inventario\Filtro");
    }
    
    public function planesCuentas()
    {
        return $this->hasMany("App\Models\Contabilidad\Plancuenta");
    }
    
    public function categorias()
    {
        return $this->hasMany("App\Models\Contabilidad\Categoria");
    }
    
    public function centrosCostos()
    {
        return $this->hasMany("App\Models\Contabilidad\Centrocosto");
    }
    
    public function productos()
    {
        return $this->hasMany("App\Models\Inventario\Producto");
    }
    
    public function kardex()
    {
        return $this->hasMany("App\Models\Inventario\Kardex");
    }
    
    public function documentos()
    {
        return $this->hasMany("App\Models\Documento");
    }
    public function accionistas(){
        return $this->hasMany("App\Models\Accionista");
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
    
    public function ventas()
    {
        return $this->hasMany("App\Models\Comercio\Venta");
    }
    
    public function gastos()
    {
        return $this->hasMany("App\Models\Comercio\Gasto");
    }
    
    public function proformas()
    {
        return $this->hasMany("App\Models\Comercio\Proforma");
    }
    
    public function historias()
    {
        return $this->hasMany("App\Models\Historia");
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
    
    public function asientos()
    {
        return $this->hasMany("App\Contabilidad\Asiento");
    }
    
    public function agentesTipos()
    {
        return $this->hasMany("App\Models\Contabilidad\Agentetipo");
    }
    
    public function transportistas()
    {
        return $this->hasMany("App\Transportista");
    }
    
    public function guiasRemision()
    {
        return $this->hasMany("App\Models\Comercio\Guiaremision");
    }
    
    public function creditos()
    {
        return $this->hasMany("App\Models\Comercio\Credito");
    }
}

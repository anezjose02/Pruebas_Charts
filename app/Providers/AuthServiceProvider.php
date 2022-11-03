<?php

namespace App\Providers;

use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
        //
        Gate::define('superuser', function (User $user) {
            return $user->superuser;
        });

        Gate::define('historias', function (User $user) {
            return $user->evaluarModulos(['historias']);
        });

        Gate::define('productos', function (User $user) {
            return $user->evaluarModulos(['productos']);
        });

        Gate::define('configuracion-sistema', function (User $user) {
            return $user->evaluarModulos(['configuracion-sistema']);
        });
        
        Gate::define('almacenes', function (User $user) {
            return $user->evaluarModulos(['almacenes']);
        });
        
        Gate::define('planes-cuentas', function (User $user) {
            return $user->evaluarModulos(['planes-cuentas']);
        });
        
        Gate::define('unidades', function (User $user) {
            return $user->evaluarModulos(['unidades']);
        });
        
        Gate::define('filtros', function (User $user) {
            return $user->evaluarModulos(['filtros']);
        });
        
        Gate::define('precios', function (User $user) {
            return $user->evaluarModulos(['precios']);
        });
        
        Gate::define('clasificaciones', function (User $user) {
            return $user->evaluarModulos(['clasificaciones']);
        });
        
        Gate::define('tipos', function (User $user) {
            return $user->evaluarModulos(['tipos']);
        });
        
        Gate::define('categorias', function (User $user) {
            return $user->evaluarModulos(['categorias']);
        });
        
        Gate::define('carga-masiva', function (User $user) {
            return $user->evaluarModulos(['carga-masiva']);
        });
        
        Gate::define('documentos', function (User $user) {
            return $user->evaluarModulos(['documentos']);
        });
        
        Gate::define('empresas', function (User $user) {
            return $user->evaluarModulos(['empresas']);
        });
        
        Gate::define('sucursales', function (User $user) {
            return $user->evaluarModulos(['sucursales']);
        });
        
        Gate::define('puntos', function (User $user) {
            return $user->evaluarModulos(['puntos']);
        });
        
        Gate::define('cajas', function (User $user) {
            return $user->evaluarModulos(['cajas']);
        });
        
        Gate::define('centros-costos', function (User $user) {
            return $user->evaluarModulos(['centros-costos']);
        });
        
        Gate::define('facturar', function (User $user) {
            return $user->evaluarModulos(['facturar']);
        });
        
        Gate::define('ventas', function (User $user) {
            return $user->evaluarModulos(['ventas']);
        });
        
        Gate::define('usuarios', function (User $user) {
            return $user->evaluarModulos(['usuarios']);
        });
        
        Gate::define('roles', function (User $user) {
            return $user->evaluarModulos(['roles']);
        });
        Gate::define('compras', function (User $user) {
            return $user->evaluarModulos(['compras']);
        });
        Gate::define('gastos', function (User $user) {
            return $user->evaluarModulos(['gastos']);
        });
        Gate::define('proformas', function (User $user) {
            return $user->evaluarModulos(['proformas']);
        });
        Gate::define('kardex', function (User $user) {
            return $user->evaluarModulos(['kardex']);
        });
        Gate::define('empleados', function (User $user) {
            return $user->evaluarModulos(['empleados']);
        });
        Gate::define('essistema', function (User $user) {
            return $user->sistema;
        });
        Gate::define('transportistas', function (User $user) {
            return $user->evaluarModulos(['transportistas']);
        });
        Gate::define('vendedores', function (User $user) {
            return $user->evaluarModulos(['vendedores']);
        });
        Gate::define('notas-credito', function (User $user) {
            return $user->evaluarModulos(['notas-credito']);
        });
        Gate::define('notas-credito-compra', function (User $user) {
            return $user->evaluarModulos(['notas-credito-compra']);
        });
        Gate::define('notas-debito', function (User $user) {
            return $user->evaluarModulos(['notas-debito']);
        });
        Gate::define('notas-debito-compra', function (User $user) {
            return $user->evaluarModulos(['notas-debito-compra']);
        });
        Gate::define('accionistas', function (User $user) {
            return $user->evaluarModulos(['accionistas']);
        });
        Gate::define('clientes', function (User $user) {
            return $user->evaluarModulos(['clientes']);
        });
        Gate::define('proveedores', function (User $user) {
            return $user->evaluarModulos(['proveedores']);
        });
        Gate::define('retenciones', function (User $user) {
            return $user->evaluarModulos(['retenciones']);
        });
        Gate::define('retenciones-compra', function (User $user) {
            return $user->evaluarModulos(['retenciones-compra']);
        });
        Gate::define('asientos', function (User $user) {
            return $user->evaluarModulos(['asientos']);
        });
        Gate::define('tipos-asientos', function (User $user) {
            return $user->evaluarModulos(['tipos-asientos']);
        });
        Gate::define('creditos', function (User $user) {
            return $user->evaluarModulos(['creditos']);
        });
        
        Gate::define('guias-remision', function (User $user) {
            return $user->evaluarModulos(['guias-remision']);
        });
        
        Gate::define('guias-remision-compra', function (User $user) {
            return $user->evaluarModulos(['guias-remision-compra']);
        });        
        
        Gate::define('liquidaciones-compras', function (User $user) {
            return $user->evaluarModulos(['liquidaciones-compras']);
        });
    }
}

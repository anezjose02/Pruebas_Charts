<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Contantes extends Controller
{
    //
    public static function modulos()
    {
        return [
            [
                'value' => 'roles',
                'text'  => 'Roles'
            ],
            [
                'value' => 'empresas',
                'text'  => 'Empresas'
            ],
            [
                'value' => 'sucursales',
                'text'  => 'Sucursales'
            ],
            [
                'value' => 'puntos',
                'text'  => 'Puntos'
            ],
            [
                'value' => 'cajas',
                'text'  => 'Cajas'
            ],
            [
                'value' => 'almacenes',
                'text'  => 'Almacenes'
            ],
            [
                'value' => 'usuarios',
                'text'  => 'Usuarios'
            ],
            [
                'value' => 'configuracion-sistema',
                'text' => 'Configuracion del Sistema'
            ],
            [
                'value' => 'unidades',
                'text'  => 'Unidades de medida'
            ],
            [
                'value' => 'precios',
                'text'  => 'Tipos de precios'
            ],
            [
                'value' => 'filtros',
                'text'  => 'Filtros'
            ],
            [
                'value' => 'planes-cuentas',
                'text'  => 'Planes de cuentas'
            ],
            [
                'value' => 'categorias',
                'text'  => 'Categorias'
            ],
            [
                'value' => 'centros-costos',
                'text'  => 'Centros de costos'
            ],
            [
                'value' => 'productos',
                'text'  => 'Productos'
            ],
            [
                'value' => 'kardex',
                'text'  => 'Kardex'
            ],
            [
                'value' => 'carga-masiva',
                'text'  => 'Carga masiva'
            ],
            [
                'value' => 'documentos',
                'text'  => 'Documentos'
            ],
            [
                'value' => 'vendedores',
                'text'  => 'Vendedores'
            ],
            [
                'value' => 'clientes',
                'text'  => 'Clientes'
            ],
            [
                'value' => 'proveedores',
                'text'  => 'Proveedores'
            ],
            [
                'value' => 'facturar',
                'text'  => 'Facturar venta'
            ],
            [
                'value' => 'ventas',
                'text'  => 'Ventas'
            ],
            [
                'value' => 'proformas',
                'text'  => 'Proformas'
            ],
            [
                'value' => 'compras',
                'text'  => 'Compras'
            ],
            [
                'value' => 'guias-remision',
                'text'  => 'Guías de remisión'
            ],
            
            [
                'value' => 'guias-remision-compra',
                'text'  => 'Guías de remisión en compras'
            ],
            [
                'value' => 'gastos',
                'text'  => 'Gastos'
            ],
            [
                'value' => 'historias',
                'text'  => 'HistoriaL de acciones'
            ],
            [
                'value' => 'notas-credito',
                'text'  => 'Notas de crédito'
            ],
            [
                'value' => 'notas-credito-compra',
                'text'  => 'Notas de crédito de compras'
            ],
            [
                'value' => 'notas-debito',
                'text'  => 'Notas de débito'
            ],
            [
                'value' => 'notas-debito-compra',
                'text'  => 'Notas de débito de compras'
            ],
            [
                'value' => 'retenciones',
                'text'  => 'Retenciones'
            ],
            [
                'value' => 'retenciones-compra',
                'text'  => 'Retenciones de compras'
            ],
            [
                'value' => 'asientos',
                'text'  => 'Asientos contables'
            ],
            [
                'value' => 'tipos-asientos',
                'text'  => 'Tipos de asientos contables'
            ],
            [
                'value' => 'transportistas',
                'text'  => 'Transportistas'
            ],
            [
                'value' => 'creditos',
                'text'  => 'Créditos'
            ],
            [
                'value' => 'liquidaciones-compras',
                'text'  => 'Liquidaciones de compra'
            ],
        ];
    }

    
    public static function permisos()
    {
        return [
            [
                'value' => 'configuracion-sistema',
                'text'  => 'Configuracion del Sistema'
            ],
            [
                'value' => 'roles.listar',
                'text'  => 'Listar roles'
            ],
            [
                'value' => 'roles.crear',
                'text'  => 'Crear roles'
            ],
            [
                'value' => 'roles.editar',
                'text'  => 'Editar roles'
            ],
            [
                'value' => 'roles.borrar',
                'text'  => 'Borrar roles'
            ],
            [
                'value' => 'empresas.listar',
                'text'  => 'Listar empresas'
            ],
            [
                'value' => 'empresas.crear',
                'text'  => 'Crear empresas'
            ],
            [
                'value' => 'empresas.editar',
                'text'  => 'Editar empresas'
            ],
            [
                'value' => 'empresas.borrar',
                'text'  => 'Borrar empresas'
            ],
            [
                'value' => 'sucursales.listar',
                'text'  => 'Listar sucursales'
            ],
            [
                'value' => 'sucursales.crear',
                'text'  => 'Crear sucursales'
            ],
            [
                'value' => 'sucursales.editar',
                'text'  => 'Editar sucursales'
            ],
            [
                'value' => 'sucursales.borrar',
                'text'  => 'Borrar sucursales'
            ],
            [
                'value' => 'puntos.listar',
                'text'  => 'Listar puntos'
            ],
            [
                'value' => 'puntos.crear',
                'text'  => 'Crear puntos'
            ],
            [
                'value' => 'puntos.editar',
                'text'  => 'Editar puntos'
            ],
            [
                'value' => 'puntos.borrar',
                'text'  => 'Borrar puntos'
            ],
            [
                'value' => 'cajas.listar',
                'text'  => 'Listar cajas'
            ],
            [
                'value' => 'cajas.crear',
                'text'  => 'Crear cajas'
            ],
            [
                'value' => 'cajas.editar',
                'text'  => 'Editar cajas'
            ],
            [
                'value' => 'cajas.borrar',
                'text'  => 'Borrar cajas'
            ],
            [
                'value' => 'almacenes.listar',
                'text'  => 'Listar almacenes'
            ],
            [
                'value' => 'almacenes.crear',
                'text'  => 'Crear almacenes'
            ],
            [
                'value' => 'almacenes.editar',
                'text'  => 'Editar almacenes'
            ],
            [
                'value' => 'almacenes.borrar',
                'text'  => 'Borrar almacenes'
            ],
            [
                'value' => 'usuarios.listar',
                'text'  => 'Listar usuarios'
            ],
            [
                'value' => 'usuarios.crear',
                'text'  => 'Crear usuarios'
            ],
            [
                'value' => 'usuarios.editar',
                'text'  => 'Editar usuarios'
            ],
            [
                'value' => 'unidades.listar',
                'text'  => 'Listar unidades'
            ],
            [
                'value' => 'unidades.crear',
                'text'  => 'Crear unidades'
            ],
            [
                'value' => 'unidades.editar',
                'text'  => 'Editar unidades'
            ],
            [
                'value' => 'unidades.subunidades',
                'text'  => 'Editar subunidades'
            ],
            [
                'value' => 'unidades.borrar',
                'text'  => 'Borrar unidades'
            ],
            [
                'value' => 'precios.listar',
                'text'  => 'Listar tipos precios'
            ],
            [
                'value' => 'precios.crear',
                'text'  => 'Crear tipos precios'
            ],
            [
                'value' => 'precios.editar',
                'text'  => 'Editar tipos precios'
            ],
            [
                'value' => 'precios.borrar',
                'text'  => 'Borrar tipos precios'
            ],
            [
                'value' => 'filtros.listar',
                'text'  => 'Listar filtros'
            ],
            [
                'value' => 'filtros.crear',
                'text'  => 'Crear filtros'
            ],
            [
                'value' => 'filtros.editar',
                'text'  => 'Editar filtros'
            ],
            [
                'value' => 'filtros.borrar',
                'text'  => 'Borrar filtros'
            ],
            [
                'value' => 'planes-cuentas.listar',
                'text'  => 'Listar planes de cuentas'
            ],
            [
                'value' => 'planes-cuentas.crear',
                'text'  => 'Crear planes de cuentas'
            ],
            [
                'value' => 'planes-cuentas.editar',
                'text'  => 'Editar planes de cuentas'
            ],
            [
                'value' => 'planes-cuentas.borrar',
                'text'  => 'Borrar planes de cuentas'
            ],
            [
                'value' => 'categorias.listar',
                'text'  => 'Listar categorias contables'
            ],
            [
                'value' => 'categorias.crear',
                'text'  => 'Crear categorias contables'
            ],
            [
                'value' => 'categorias.editar',
                'text'  => 'Editar categorias contables'
            ],
            [
                'value' => 'categorias.borrar',
                'text'  => 'Borrar categorias contables'
            ],
            [
                'value' => 'centros-costos.listar',
                'text'  => 'Listar centros de costos'
            ],
            [
                'value' => 'centros-costos.crear',
                'text'  => 'Crear centros de costos'
            ],
            [
                'value' => 'centros-costos.editar',
                'text'  => 'Editar centros de costos'
            ],
            [
                'value' => 'centros-costos.borrar',
                'text'  => 'Borrar centros de costos'
            ],
            [
                'value' => 'productos.listar',
                'text'  => 'Listar productos'
            ],
            [
                'value' => 'productos.crear',
                'text'  => 'Crear productos'
            ],
            [
                'value' => 'productos.editar',
                'text'  => 'Editar productos'
            ],
            [
                'value' => 'productos.borrar',
                'text'  => 'Borrar productos'
            ],
            [
                'value' => 'kardex.listar',
                'text'  => 'Listar kardex'
            ],
            [
                'value' => 'carga-masiva.listar',
                'text'  => 'Carga masiva'
            ],
            [
                'value' => 'documentos.listar',
                'text'  => 'Listar documentos'
            ],
            [
                'value' => 'documentos.borrar',
                'text'  => 'Borrar documentos'
            ],
            [
                'value' => 'documentos.compra',
                'text'  => 'Convertir documentos recibidos en compras.'
            ],
            [
                'value' => 'documentos.venta',
                'text'  => 'Convertir documentos recibidos en ventas.'
            ],
            [
                'value' => 'documentos.gasto',
                'text'  => 'Convertir documentos recibidos en gastos.'
            ],
            [
                'value' => 'vendedores.listar',
                'text'  => 'Listar vendedores'
            ],
            [
                'value' => 'vendedores.crear',
                'text'  => 'Crear vendedores'
            ],
            [
                'value' => 'vendedores.editar',
                'text'  => 'Editar vendedores'
            ],
            [
                'value' => 'vendedores.borrar',
                'text'  => 'Borrar vendedores'
            ],
            [
                'value' => 'clientes.listar',
                'text'  => 'Listar clientes'
            ],
            [
                'value' => 'clientes.crear',
                'text'  => 'Crear clientes'
            ],
            [
                'value' => 'clientes.editar',
                'text'  => 'Editar clientes'
            ],
            [
                'value' => 'clientes.borrar',
                'text'  => 'Borrar clientes'
            ],
            [
                'value' => 'proveedores.listar',
                'text'  => 'Listar proveedores'
            ],
            [
                'value' => 'proveedores.crear',
                'text'  => 'Crear proveedores'
            ],
            [
                'value' => 'proveedores.editar',
                'text'  => 'Editar proveedores'
            ],
            [
                'value' => 'proveedores.borrar',
                'text'  => 'Borrar proveedores'
            ],
            [
                'value' => 'facturar.facturar',
                'text'  => 'Facturar venta'
            ],
            [
                'value' => 'ventas.listar',
                'text'  => 'Listar ventas'
            ],
            [
                'value' => 'ventas.editar',
                'text'  => 'Editar ventas'
            ],
            [
                'value' => 'ventas.borrar',
                'text'  => 'Borrar ventas'
            ],
            [
                'value' => 'proformas.listar',
                'text'  => 'Listar proformas'
            ],
            [
                'value' => 'proformas.crear',
                'text'  => 'Crear proformas'
            ],
            [
                'value' => 'proformas.editar',
                'text'  => 'Editar proformas'
            ],
            [
                'value' => 'proformas.borrar',
                'text'  => 'Borrar proformas'
            ],
            [
                'value' => 'compras.listar',
                'text'  => 'Listar compras'
            ],
            [
                'value' => 'compras.crear',
                'text'  => 'Crear compras'
            ],
            [
                'value' => 'compras.editar',
                'text'  => 'Editar compras'
            ],
            [
                'value' => 'compras.borrar',
                'text'  => 'Borrar compras'
            ],
            [
                'value' => 'guias-remision.listar',
                'text'  => 'Listar guias de remision'
            ],
            [
                'value' => 'guias-remision.crear',
                'text'  => 'Crear guias de remision'
            ],
            [
                'value' => 'guias-remision.editar',
                'text'  => 'Editar guias de remision'
            ],
            [
                'value' => 'guias-remision.borrar',
                'text'  => 'Borrar guias de remision'
            ],
            [
                'value' => 'guias-remision-compra.listar',
                'text'  => 'Listar guias de remision en compras'
            ],
            [
                'value' => 'guias-remision-compra.crear',
                'text'  => 'Crear guias de remision en compras'
            ],
            [
                'value' => 'guias-remision-compra.editar',
                'text'  => 'Editar guias de remision en compras'
            ],
            [
                'value' => 'guias-remision-compra.borrar',
                'text'  => 'Borrar guias de remision en compras'
            ],
            
            [
                'value' => 'gastos.listar',
                'text'  => 'Listar gastos'
            ],
            [
                'value' => 'gastos.crear',
                'text'  => 'Crear gastos'
            ],
            [
                'value' => 'gastos.editar',
                'text'  => 'Editar gastos'
            ],
            [
                'value' => 'gastos.borrar',
                'text'  => 'Borrar gastos'
            ],
            [
                'value' => 'historias.listar',
                'text'  => 'Listar historial de acciones'
            ],
            
            [
                'value' => 'notas-credito-compra.listar',
                'text'  => 'Listar notas de credito de compras'
            ],
            [
                'value' => 'notas-credito-compra.crear',
                'text'  => 'Crear notas de credito de compras'
            ],
            [
                'value' => 'notas-credito-compra.editar',
                'text'  => 'Editar notas de credito de compras'
            ],
            [
                'value' => 'notas-credito-compra.borrar',
                'text'  => 'Borrar notas de credito de compras'
            ],
            [
                'value' => 'notas-credito.listar',
                'text'  => 'Listar notas de credito'
            ],
            [
                'value' => 'notas-credito.crear',
                'text'  => 'Crear notas de credito'
            ],
            [
                'value' => 'notas-credito.editar',
                'text'  => 'Editar notas de credito'
            ],
            [
                'value' => 'notas-credito.borrar',
                'text'  => 'Borrar notas de credito'
            ],

            
            
            [
                'value' => 'notas-debito-compra.listar',
                'text'  => 'Listar notas de debito de compras'
            ],
            [
                'value' => 'notas-debito-compra.crear',
                'text'  => 'Crear notas de debito de compras'
            ],
            [
                'value' => 'notas-debito-compra.editar',
                'text'  => 'Editar notas de debito de compras'
            ],
            [
                'value' => 'notas-debito-compra.borrar',
                'text'  => 'Borrar notas de debito de compras'
            ],
            [
                'value' => 'notas-debito.listar',
                'text'  => 'Listar notas de debito'
            ],
            [
                'value' => 'notas-debito.crear',
                'text'  => 'Crear notas de debito'
            ],
            [
                'value' => 'notas-debito.editar',
                'text'  => 'Editar notas de debito'
            ],
            [
                'value' => 'notas-debito.borrar',
                'text'  => 'Borrar notas de debito'
            ],
            
            [
                'value' => 'retenciones-compra.listar',
                'text'  => 'Listar retenciones de compras'
            ],
            [
                'value' => 'retenciones-compra.crear',
                'text'  => 'Crear retenciones de compras'
            ],
            [
                'value' => 'retenciones-compra.editar',
                'text'  => 'Editar retenciones de compras'
            ],
            [
                'value' => 'retenciones-compra.borrar',
                'text'  => 'Borrar retenciones de compras'
            ],
            [
                'value' => 'retenciones.listar',
                'text'  => 'Listar retenciones'
            ],
            [
                'value' => 'retenciones.crear',
                'text'  => 'Crear retenciones'
            ],
            [
                'value' => 'retenciones.editar',
                'text'  => 'Editar retenciones'
            ],
            [
                'value' => 'retenciones.borrar',
                'text'  => 'Borrar retenciones'
            ],
            [
                'value' => 'asientos.listar',
                'text'  => 'Listar asientos contables'
            ],
            [
                'value' => 'asientos.crear',
                'text'  => 'Crear asientos contables'
            ],
            [
                'value' => 'asientos.editar',
                'text'  => 'Editar asientos contables'
            ],
            [
                'value' => 'asientos.borrar',
                'text'  => 'Borrar asientos contables'
            ],
            
            [
                'value' => 'tipos-asientos.listar',
                'text'  => 'Listar tipos de asientos contables'
            ],
            [
                'value' => 'tipos-asientos.crear',
                'text'  => 'Crear tipos de asientos contables'
            ],
            [
                'value' => 'tipos-asientos.editar',
                'text'  => 'Editar tipos de asientos contables'
            ],
            [
                'value' => 'tipos-asientos.borrar',
                'text'  => 'Borrar tipos de asientos contables'
            ],
            
            [
                'value' => 'transportistas.listar',
                'text'  => 'Listar transpostistas'
            ],
            [
                'value' => 'transportistas.crear',
                'text'  => 'Crear transpostistas'
            ],
            [
                'value' => 'transportistas.editar',
                'text'  => 'Editar transpostistas'
            ],
            [
                'value' => 'transportistas.borrar',
                'text'  => 'Borrar transpostistas'
            ],
            
            [
                'value' => 'creditos.listar',
                'text'  => 'Listar créditos'
            ],
            [
                'value' => 'creditos.crear',
                'text'  => 'Crear créditos'
            ],
            [
                'value' => 'creditos.editar',
                'text'  => 'Editar créditos'
            ],
            [
                'value' => 'creditos.borrar',
                'text'  => 'Borrar créditos'
            ],
            
            
            
            [
                'value' => 'liquidaciones-compras.listar',
                'text'  => 'Listar liquidaciones de compra'
            ],
            [
                'value' => 'liquidaciones-compras.crear',
                'text'  => 'Crear liquidaciones de compra'
            ],
            [
                'value' => 'liquidaciones-compras.editar',
                'text'  => 'Editar liquidaciones de compra'
            ],
            [
                'value' => 'liquidaciones-compras.borrar',
                'text'  => 'Borrar liquidaciones de compra'
            ],

        ];
    }

    public static function unidades()
    {
        # code...
        return [
            [
                
                'nombre'    => 'Metro',
                'siglas'    => 'm',
                'subunidades'=> '[
                    {"factor":100,"siglas":"cm"},
                    {"factor":1000,"siglas":"mm"},
                    {"factor":0.001,"siglas":"km"}
                ]'
            ],
            [
                
                'nombre'    => 'Centimetro',
                'siglas'    => 'cm',
                'subunidades'=> '[
                    {"factor":0.01,"siglas":"m"},
                    {"factor":10,"siglas":"mm"},
                    {"factor":0.00001,"siglas":"km"}
                ]'
            ],
            [
                
                'nombre'    => 'Milimetro',
                'siglas'    => 'mm',
                'subunidades'=> '[
                    {"factor":0.1,"siglas":"cm"},
                    {"factor":0.001,"siglas":"m"},
                    {"factor":0.000001,"siglas":"km"}
                ]'
            ],
            [
                
                'nombre'    => 'Kilometro',
                'siglas'    => 'km',
                'subunidades'=> '[
                    {"factor":100000,"siglas":"cm"},
                    {"factor":1000000,"siglas":"mm"},
                    {"factor":1000,"siglas":"m"}
                ]'
            ],
            
            [
                
                'nombre'    => 'Kilogramo',
                'siglas'    => 'kg',
                'subunidades'=> '[
                    {"factor":1000,"siglas":"g"},
                    {"factor":0.001,"siglas":"T"}
                ]'
            ],
            [
                
                'nombre'    => 'Gramo',
                'siglas'    => 'g',
                'subunidades'=> '[
                    {"factor":0.001,"siglas":"kg"},
                    {"factor":0.000001,"siglas":"T"}
                ]'
            ],
            [
                
                'nombre'    => 'Tonelada',
                'siglas'    => 'T',
                'subunidades'=> '[
                    {"factor":1000000,"siglas":"g"},
                    {"factor":1000,"siglas":"kg"}
                ]'
            ],
        ];
    }

    public static function precios()
    {
        return [
            [
                "nombre"    => 'GENERAL',
                "margen"    => 10,
                "activo"    => 1
            ]
        ];
    }

    public static function gruposContables()
    {
        # code...
        return [
            "ACTIVO",
            "PASIVO",
            "PATRIMONIO NETO",
            "INGRESO",
            "COSTO Y GASTO",
            "GANANCIA",
            "RESULTADO"
        ];
    }

    public static function configuracionSistema()
    {
        $yyy = [
            'general' =>  [
                'porcentajeIVA'=> 12,
                'limiteProductosVenta'=> 0,
                'facturacionSinExistencia'=> false,
                'facturacionDescuentoProducto'=> [
                    'check'=> false,
                    'tipo'=> "PORCENTAJE"
                ],
                'asociacionClienteVendedor'=> [
                    'check'=> false,
                    'minimo'=> 0,
                ],
                'ubicacionProductoVenta'=> false,
                'editarSubtotalIVAVenta'=> false,
                'impresionSubsidioVenta'=> false,
                'notaVentaIVA'=> false,
                'enviarCorreoVenta'=> false,
                'efectivoPredeterminado'=> true,

                'decimalesPrecio'=> 2,
                'decimalesCantidad'=> 2,
                'formatoImpresion'=> "PDF",
            ],
        ];
        
        $xxx = json_encode($yyy);

        return $xxx;
    }


    public static function sustentoTributario(){
        return [
            [
                'sustento'  =>  'Crédito Tributario para declaración de IVA',
                'codigo'    =>  '01'
            ],
            [
                'sustento'  =>  'Costo o Gasto para declaración de imp. a la Renta',
                'codigo'    =>  '02'
            ],
            [
                'sustento'  =>  'Activo Fijo - Crédito tributario para declaración de IVA',
                'codigo'    =>  '03'
            ],
            [
                'sustento'  =>  'Activo Fijo - Costo o Gasto para declaración de imp. a la renta',
                'codigo'    =>  '04'
            ],
            [
                'sustento'  =>  'Liquidación de gastos de viaje, hospedaje y alimentación',
                'codigo'    =>  '05'
            ],
            [
                'sustento'  =>  'Inventario - Crédito Tributario para declaración de IVA',
                'codigo'    =>  '06'
            ],
            [
                'sustento'  =>  'Inventario - Costo o Gasto para declaración de imp. a la Renta',
                'codigo'    =>  '07'
            ],
            [
                'sustento'  =>  'Valor pagado para solicitar Reembolso de Gastos',
                'codigo'    =>  '08'
            ],
            [
                'sustento'  =>  'Reembolso por siniestros',
                'codigo'    =>  '09'
            ],
            [
                'sustento'  =>  'Distribución de Dividendos, Beneficios o Utilidades',
                'codigo'    =>  '10'
            ],
            [
                'sustento'  =>  'Convenios de débito o recaudación para IFI',
                'codigo'    =>  '11'
            ],
            [
                'sustento'  =>  'Impuestos y retenciones presuntivos',
                'codigo'    =>  '12'
            ],
            [
                'sustento'  =>  'Valores reconocidos por entidades del sector público a favor de sujetos pasivos',
                'codigo'    =>  '13'
            ],
        ];
    }
}

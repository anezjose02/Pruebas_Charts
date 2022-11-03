<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/home');
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth', 'activeuser'])->group(function () {

    //Rutas para CONSTANTES
    Route::get("/get-constante-modulos", "Contantes@modulos");
    Route::get("/get-constante-permisos", "Contantes@permisos");
    Route::get("/get-constante-grupos-contables", "Contantes@gruposContables");
    Route::get("/get-constante-sustentos-tributarios", "Contantes@sustentoTributario");

    //Rutas para PERSONAS
    Route::get("/get-pasaporte/{identificacion}", "PersonaController@get_pasaporte");


    Route::get("/get-persona/{identificacion}", "PersonaController@conexionAPI");
    Route::post("/set-persona/{identificacion}", "PersonaController@store");
    Route::get("/get-cliente/{identificacion}/empresa/{empresa_id?}", "PersonaController@getCliente");
    Route::get("/get-cliente-id/{id}", "PersonaController@getClienteId");

    Route::post("/set-cliente/{identificacion}/empresa/{empresa_id?}", "PersonaController@storeCliente");
    Route::get("/get-proveedor/{identificacion}/empresa/{empresa_id?}", "PersonaController@getProveedor");
    Route::get("/get-proveedor-id/{id}", "PersonaController@getProveedorId");

    Route::post("/set-proveedor/{identificacion}/empresa/{empresa_id?}", "PersonaController@storeProveedor");

    //Rutas de ROLES
    Route::get("/roles", "General\RoleController@index");
    Route::get("/get-roles", "General\RoleController@get");
    Route::get("/get-all-roles", "General\RoleController@getAll");
    Route::get("/delete-role/{id}", "General\RoleController@delete");
    Route::post("/role", "General\RoleController@store");
    Route::post("/role/{id}", "General\RoleController@update");

    //Rutas de EMPRESAS
    Route::get("/empresas", "General\EmpresaController@index");
    Route::get("/get-empresas", "General\EmpresaController@get");
    Route::get("/get-all-empresas", "General\EmpresaController@getAll");
    Route::get("/delete-empresa/{id}", "General\EmpresaController@delete");
    Route::post("/empresa/{id?}", "General\EmpresaController@store");

    Route::get("/get-centros-costo-empresa/{id}", "General\EmpresaController@centrosCostos");

    //Rutas de Agentes de retencion
    Route::get("/agentes", "AgenteController@index");
    Route::get("/get-agentes", "AgenteController@get");
    Route::get("/get-all-agentes", "AgenteController@getAll");
    Route::get("/delete-agente/{id}", "AgenteController@delete");
    Route::post("/agente/{id?}", "AgenteController@store");

    //Rutas de Conceptos de retencion
    Route::get("/conceptos", "Admin\ConceptoController@index");
    Route::get("/get-conceptos", "Admin\ConceptoController@get");
    Route::get("/get-all-conceptos", "Admin\ConceptoController@getAll");
    Route::get("/delete-concepto/{id}", "Admin\ConceptoController@delete");
    Route::post("/concepto/{id?}", "Admin\ConceptoController@store");

    //Rutas de SUCURSALES
    Route::get("/sucursales", "General\SucursalController@index");
    Route::get("/get-sucursales", "General\SucursalController@get");
    Route::get("/get-all-sucursales", "General\SucursalController@getAll");
    Route::get("/delete-sucursal/{id}", "General\SucursalController@delete");
    Route::post("/sucursal/{id?}", "General\SucursalController@store");

    //Rutas de PUNTOS
    Route::get("/puntos", "General\PuntoController@index");
    Route::get("/get-puntos", "General\PuntoController@get");
    Route::get("/get-all-puntos", "General\PuntoController@getAll");
    Route::get("/delete-punto/{id}", "General\PuntoController@delete");
    Route::post("/punto/{id?}", "General\PuntoController@store");

    //Rutas de CAJAS efectivo
    Route::get("/cajas-efectivo", "General\CajaController@cajas_efectivo");
    Route::post("/abrir-cerrar-caja", "General\CajaController@abrir_cerrar_caja");


    
    //Rutas de CAJAS
    Route::get("/cajas", "General\CajaController@index");
    Route::get("/get-cajas", "General\CajaController@get");
    Route::get("/get-cajas-efectivo", "General\CajaController@getCajasEfectivo");
    Route::get("/get-all-cajas", "General\CajaController@getAll");

    Route::get("/delete-caja/{id}", "General\CajaController@delete");
    Route::post("/caja/{id?}", "General\CajaController@store");
    
    //Rutas de ALMACENES
    Route::get("/almacenes", "Inventario\AlmacenController@index");
    Route::get("/get-almacenes", "Inventario\AlmacenController@get");
    Route::get("/get-all-almacenes", "Inventario\AlmacenController@getAll");
    Route::get("/delete-almacen/{id}", "Inventario\AlmacenController@delete");
    Route::post("/almacen/{id?}", "Inventario\AlmacenController@store");

    //Rutas de USUARIOS
    Route::get("/usuarios", "General\UserController@index");
    Route::get("/get-usuarios", "General\UserController@get");
    Route::post("/usuario/{id?}", "General\UserController@store");
    Route::get('/configuracion-sistema', 'General\UserController@configSistema');
    Route::post('/configuracion-sistema', 'General\UserController@saveConfigSistema');
    Route::get('/temas', 'General\UserController@temas');
    Route::get('/cambiar-tema/{tema}', 'General\UserController@cambiar_tema');
    Route::get('/cambiar-barra-lateral/{variable}', 'General\UserController@cambiar_barra_lateral');
    Route::post("/cambiar-contraseña-usuario", "General\UserController@cambiar_contraseña");


    //Rutas de UNIDADES DE MEDIDA
    Route::get("/unidades", "Inventario\UnidadController@index");
    Route::get("/get-unidades", "Inventario\UnidadController@get");
    Route::get("/get-all-unidades", "Inventario\UnidadController@getAll");
    Route::get("/delete-unidad/{id}", "Inventario\UnidadController@delete");
    Route::post("/unidad/{id?}", "Inventario\UnidadController@store");

    //Rutas de TIPOS DE PRECIO
    Route::get("/precios", "Inventario\PrecioController@index");
    Route::get("/get-precios", "Inventario\PrecioController@get");
    Route::get("/get-all-precios", "Inventario\PrecioController@getAll");
    Route::get("/delete-precio/{id}", "Inventario\PrecioController@delete");
    Route::post("/precio/{id?}", "Inventario\PrecioController@store");

    //Rutas de FILTROS
    Route::get("/filtros", "Inventario\FiltroController@index");
    Route::get("/get-filtros", "Inventario\FiltroController@get");
    Route::get("/get-all-filtros", "Inventario\FiltroController@getAll");
    Route::get("/delete-filtro/{id}", "Inventario\FiltroController@delete");
    Route::post("/filtro/{id?}", "Inventario\FiltroController@store");

    //Rutas de PLANES DE CUENTAS
    Route::get("/planes-cuentas", "Contabilidad\PlancuentaController@index");
    Route::get("/get-planes-cuentas", "Contabilidad\PlancuentaController@get");
    Route::get("/get-special-planes-cuentas", "Contabilidad\PlancuentaController@getSpecialTree");
    Route::get("/get-all-planes-cuentas", "Contabilidad\PlancuentaController@getAll");
    Route::get("/delete-plan-cuenta/{id}", "Contabilidad\PlancuentaController@delete");
    Route::post("/plan-cuenta/{id?}", "Contabilidad\PlancuentaController@store");

    //Rutas de Categorias
    Route::get("/categorias", "Contabilidad\CategoriaController@index");
    Route::get("/get-categorias", "Contabilidad\CategoriaController@get");
    Route::get("/get-all-categorias", "Contabilidad\CategoriaController@getAll");
    Route::get("/delete-categoria/{id}", "Contabilidad\CategoriaController@delete");
    Route::post("/categoria/{id?}", "Contabilidad\CategoriaController@store");

    //Rutas de CENTROS DE COSTOS
    Route::get("/centros-costos", "Contabilidad\CentrocostoController@index");
    Route::get("/get-centros-costos", "Contabilidad\CentrocostoController@get");
    Route::get("/get-all-centros-costos", "Contabilidad\CentrocostoController@getAll");
    Route::get("/delete-centro-costo/{id}", "Contabilidad\CentrocostoController@delete");
    Route::post("/centro-costo/{id?}", "Contabilidad\CentrocostoController@store");

    Route::get("/get-empresas-centro-costo/{id}", "Contabilidad\CentrocostoController@empresas");


    //Rutas de PRODUCTOS
    Route::get("/productos", "Inventario\ProductoController@index");
    Route::get("/producto/{id?}", "Inventario\ProductoController@show");
    Route::get("/get-productos", "Inventario\ProductoController@get");
    Route::get("/get-producto-almacen/{id}", "Inventario\ProductoController@getSolo");
    Route::get("/get-productos-almacen/{id}", "Inventario\ProductoController@getFromAlmacen");
    Route::get("/delete-producto/{id}", "Inventario\ProductoController@delete");
    Route::post("/producto/{id?}", "Inventario\ProductoController@store");

    //Rutas de Kardex
    Route::get("/kardex", "Inventario\KardexController@index");
    Route::get("/get-kardex", "Inventario\KardexController@get");

    //Rutas de DOCUMENTOS
    Route::get("/documentos", "DocumentoController@index");
    Route::get("/get-documentos", "DocumentoController@get");
    Route::get("/carga-masiva", "DocumentoController@cargaMasiva");
    Route::post("/carga-txt", "DocumentoController@cargarTXT");
    Route::post("/carga-xml", "DocumentoController@cargarXML");
    Route::get("/delete-documento/{id}", "DocumentoController@delete");
    Route::get("/documento-compra/{id}", "DocumentoController@convertirCompra");
    Route::get("/documento-gasto/{id}", "DocumentoController@convertirGasto");

    //Rutas de VENDEDORES
    Route::get("/vendedores", "VendedorController@index");
    Route::get("/get-vendedores", "VendedorController@get");
    Route::get("/get-all-vendedores", "VendedorController@getAll");
    Route::get("/delete-vendedor/{id}", "VendedorController@delete");
    Route::post("/vendedor/{id?}", "VendedorController@store");

    //Rutas de ACCIONISTAS
    Route::get("/accionistas", "AccionistaController@accionistas");
    Route::get("/get-accionista-api", "PersonaController@getAccionistaApi");
    Route::get("/get-compensacion-config", "AccionistaController@getCompensacionConfig");
    Route::post("/save-compensacion-config", "AccionistaController@saveCompensacionConfig");
    Route::post("/ delete-accionista/{id}", "AccionistaController@delete");
    
    Route::get("/get-accionistas", "AccionistaController@get");
    Route::post("/accionista", "AccionistaController@store");
    // Route::post("/delete/{id}", "AccionistaController@store");
    
    //Rutas de CLIENTES
    Route::get("/clientes", "ClienteController@index");
    Route::get("/get-clientes", "ClienteController@get");
    Route::get("/get-all-clientes", "ClienteController@getAll");
    Route::get("/delete-cliente/{id}", "ClienteController@delete");
    Route::post("/cliente/{id?}", "ClienteController@store");
    Route::get("/cliente-creditos/{id}", "ClienteController@creditos");

    //Rutas de Proveedores
    Route::get("/proveedores", "ProveedorController@index");
    Route::get("/get-proveedores", "ProveedorController@get");
    Route::get("/get-all-proveedores", "ProveedorController@getAll");
    Route::get("/delete-proveedor/{id}", "ProveedorController@delete");
    Route::post("/proveedor/{id?}", "ProveedorController@store");
    Route::get("/proveedor-creditos/{id}", "ProveedorController@creditos");

    //Rutas facturacion
    Route::get("/facturar/{id?}", "Comercio\VentaController@facturar");
    Route::post("/facturar/{id?}", "Comercio\VentaController@saveFactura");
    Route::get("/refacturar/{id}", "Comercio\VentaController@refacturar");
    
    //Rutas VENTAS
    Route::get("/ventas", "Comercio\VentaController@index");
    Route::get("/get-ventas", "Comercio\VentaController@get");
    Route::get("/delete-venta/{id}", "Comercio\VentaController@delete");
    Route::get("/anular-venta/{id}", "Comercio\VentaController@anular");

    Route::get("/excel-ventas", "Comercio\VentaController@excelVentas");
    Route::get("/ventas-pdf", "Comercio\VentaController@ventasPdf");
    Route::get("/descargar-venta/{id}", "Comercio\VentaController@downloadVenta");
    // Route::get("/descargar-xml-venta/{id}","Comercio\VentaController@descargarXMLVenta");
    Route::post("/enviar-documentos", "Comercio\VentaController@enviarDocs");
    Route::post("/enviar-seleccionados-correo", "Comercio\VentaController@enviarDocsSelecCorreo");

    Route::post("/enviar-doc-sri", "Comercio\VentaController@enviar_doc_sri");
    Route::post("/enviar-seleccion-doc-sri", "Comercio\VentaController@enviar_seleccion_doc_sri");

    //Rutas de PROFORMAS
    Route::get("/proformas", "Comercio\ProformaController@index");
    Route::get("/get-proformas", "Comercio\ProformaController@get");
    Route::get("/delete-proforma/{id}", "Comercio\ProformaController@delete");
    Route::post("/proforma/{id?}", "Comercio\ProformaController@store");
    Route::get("/proforma/{id?}", "Comercio\ProformaController@show");
    Route::get("/proforma-facturar/{id}", "Comercio\ProformaController@facturar");

    //Rutas de Compras
    Route::get("/compras", "Comercio\CompraController@index");
    Route::get("/get-compras", "Comercio\CompraController@get");
    Route::get("/delete-compra/{id}", "Comercio\CompraController@delete");
    Route::post("/compra/{id?}", "Comercio\CompraController@store");
    Route::get("/compra/{id?}", "Comercio\CompraController@show");

    //Rutas de GASTOS
    Route::get("/gastos", "Comercio\GastoController@index");
    Route::get("/get-gastos", "Comercio\GastoController@get");
    Route::get("/delete-gasto/{id}", "Comercio\GastoController@delete");
    Route::post("/gasto/{id?}", "Comercio\GastoController@store");
    Route::get("/gasto/{id?}", "Comercio\GastoController@show");

    //Rutas de Historial de acciones
    Route::get("/historias", "HistoriaController@index");
    Route::get("/get-historias", "HistoriaController@get");

    //Rutas de Notas de credito
    Route::get("/notas-credito", "Comercio\NotacreditoController@index");
    Route::get("/get-notas-credito", "Comercio\NotacreditoController@get");
    Route::get("/delete-nota-credito/{id}", "Comercio\NotacreditoController@delete");
    Route::post("/nota-credito/{id?}", "Comercio\NotacreditoController@store");
    Route::get("/nota-credito/{id?}", "Comercio\NotacreditoController@show");
    Route::get("/descargar-notacredito/{id?}", "Comercio\NotacreditoController@downloadNotaCredito");
    Route::post("/enviar-notacredito-sri", "Comercio\NotacreditoController@enviar_notacredito_sri");
    Route::post("/enviar-notacredito-selec-sri", "Comercio\NotacreditoController@enviar_notacredito_selec_sri");
    Route::post("/enviar-notacredito-selec-correo", "Comercio\NotacreditoController@enviar_notacredito_selec_correo");

    Route::get("/notas-credito-compra", "Comercio\NotacreditoController@indexCompra");
    Route::get("/get-notas-credito-compra", "Comercio\NotacreditoController@getCompra");
    Route::get("/nota-credito-compra/{id?}", "Comercio\NotacreditoController@showCompra");

    Route::get("/nota-credito-from-venta/{id}", "Comercio\NotacreditoController@showFromVenta");
    Route::get("/nota-credito-from-compra/{id}", "Comercio\NotacreditoController@showFromCompra");

    //Rutas de Notas de debito
    Route::get("/notas-debito", "Comercio\NotadebitoController@index");
    Route::get("/get-notas-debito", "Comercio\NotadebitoController@get");
    Route::get("/delete-nota-debito/{id}", "Comercio\NotadebitoController@delete");
    Route::post("/nota-debito/{id?}", "Comercio\NotadebitoController@store");
    Route::get("/nota-debito/{id?}", "Comercio\NotadebitoController@show");

    Route::get("/notas-debito-compra", "Comercio\NotadebitoController@indexCompra");
    Route::get("/get-notas-debito-compra", "Comercio\NotadebitoController@getCompra");
    Route::get("/nota-debito-compra/{id?}", "Comercio\NotadebitoController@showCompra");

    Route::get("/nota-debito-from-venta/{id}", "Comercio\NotadebitoController@showFromVenta");
    Route::get("/nota-debito-from-compra/{id}", "Comercio\NotadebitoController@showFromCompra");

    //Rutas RETENCIONES
    Route::get("/retenciones", "Comercio\RetencionController@index");
    Route::get("/retenciones-compra", "Comercio\RetencionController@indexCompra");
    Route::get("/delete-retencion/{id}", "Comercio\RetencionController@delete");
    Route::get("/get-retenciones", "Comercio\RetencionController@get");
    Route::get("/get-retenciones-compra", "Comercio\RetencionController@getCompra");
    Route::get("/retencion/{id?}", "Comercio\RetencionController@show");
    Route::get("/retencion-compra/{id?}", "Comercio\RetencionController@showCompra");
    Route::post("/retencion/{id?}", "Comercio\RetencionController@store");
    Route::get("/descargar-retencion/{id?}", "Comercio\RetencionController@downloadRetencion");
    Route::get("/imprimir-retencion/{id?}", "Comercio\RetencionController@printRetencion");
    Route::post("/enviar-retencion-sri", "Comercio\RetencionController@enviar_retencion_sri");
    Route::post("/enviar-retenciones-selec-sri", "Comercio\RetencionController@enviar_seleccion_doc_sri");

    
    // Route::get("/enviar-retencion-email","Comercio\VentaController@enviaDocRetencionMail");



    //Rutas de ASIENTOS
    Route::get("/asientos", "Contabilidad\AsientoController@index");
    Route::get("/get-asientos", "Contabilidad\AsientoController@get");
    Route::get("/asiento/{id?}", "Contabilidad\AsientoController@show");
    Route::get("/delete-asiento/{id}", "Contabilidad\AsientoController@delete");
    Route::post("/asiento/{id?}", "Contabilidad\AsientoController@store");

    //Rutas de ASIENTOS Tipos
    Route::get("/tipos-asientos", "Contabilidad\Agentetipo@index");
    Route::get("/get-tipos-asientos", "Contabilidad\Agentetipo@get");
    Route::get("/get-all-tipos-asientos", "Contabilidad\Agentetipo@getAll");
    Route::get("/delete-tipos-asiento/{id}", "Contabilidad\Agentetipo@delete");
    Route::post("/tipos-asiento/{id?}", "Contabilidad\Agentetipo@store");

    //Rutas de ASIENTOS Tipos globales
    Route::get("/tipos-asientos-globales", "TipoasientoController@index");
    Route::get("/get-tipos-asientos-globales", "TipoasientoController@get");
    Route::get("/delete-tipos-asiento-global/{id}", "TipoasientoController@delete");
    Route::post("/tipos-asiento-global/{id?}", "TipoasientoController@store");


    //Rutas de Transportistas
    Route::get("/transportistas", "TransportistaController@index");
    Route::get("/get-transportistas", "TransportistaController@get");
    Route::get("/get-all-transportistas", "TransportistaController@getAll");
    Route::get("/delete-transportista/{id}", "TransportistaController@delete");
    Route::post("/transportista/{id?}", "TransportistaController@store");



    //Rutas de Guías de remisión
    Route::get("/guias-remision", "Comercio\Guiaremision@index");
    Route::get("/get-guias-remision", "Comercio\Guiaremision@get");
    Route::get("/delete-guia-remision/{id}", "Comercio\Guiaremision@delete");
    Route::post("/guia-remision/{id?}", "Comercio\Guiaremision@store");
    Route::get("/guia-remision/{id?}", "Comercio\Guiaremision@show");

    Route::get("/guias-remision-compra", "Comercio\Guiaremision@indexCompra");
    Route::get("/get-guias-remision-compra", "Comercio\Guiaremision@getCompra");
    Route::get("/guia-remision-compra/{id?}", "Comercio\Guiaremision@showCompra");
    Route::get("/guia-remision-from-venta/{id}", "Comercio\Guiaremision@showFromVenta");
    Route::get("/guia-remision-from-compra/{id}", "Comercio\Guiaremision@showFromCompra");


    ///Rutas CREDITOS
    Route::get("/creditos", "Comercio\CreditoController@index");
    Route::get("/get-creditos", "Comercio\CreditoController@get");
    Route::get("/delete-credito/{id}", "Comercio\CreditoController@delete");
    Route::post("/credito/{id?}", "Comercio\CreditoController@store");
    Route::get("/credito/{id?}", "Comercio\CreditoController@show");

    //Rutas de Liquidacion de compras Compras
    Route::get("/liquidaciones-compras", "Comercio\LiquidacioncompraController@index");
    Route::get("/get-liquidaciones-compras", "Comercio\LiquidacioncompraController@get");
    Route::get("/delete-liquidacion-compra/{id}", "Comercio\LiquidacioncompraController@delete");
    Route::post("/liquidacion-compra/{id?}", "Comercio\LiquidacioncompraController@store");
    Route::get("/liquidacion-compra/{id?}", "Comercio\LiquidacioncompraController@show");


    
});

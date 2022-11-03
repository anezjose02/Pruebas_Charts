/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

// Import Bootstrap and BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
    // Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)

import Vue from 'vue'
import vSelect from 'vue-select'


Vue.component('v-select', vSelect)


import Print from 'vue-print-nb'
Vue.component('Print', Print);


Vue.component('ClockIcon', ClockIcon);
import Multiselect from 'vue-multiselect'
Vue.component('multiselect', Multiselect)






import 'vue-select/dist/vue-select.css';
import { ClockIcon, EditIcon, SlashIcon, ShoppingCartIcon, DownloadIcon, PrinterIcon, CopyIcon, RefreshCwIcon, MailIcon, SendIcon, LayersIcon, RepeatIcon, Trash2Icon } from 'vue-feather-icons';
Vue.component('ClockIcon', ClockIcon);
Vue.component('EditIcon', EditIcon);
Vue.component('SlashIcon', SlashIcon);
Vue.component('ShoppingCartIcon', ShoppingCartIcon);
Vue.component('DownloadIcon', DownloadIcon);
Vue.component('PrinterIcon', PrinterIcon);
Vue.component('CopyIcon', CopyIcon);
Vue.component('RefreshCwIcon', RefreshCwIcon);
Vue.component('MailIcon', MailIcon);
Vue.component('SendIcon', SendIcon);
Vue.component('LayersIcon', LayersIcon);
Vue.component('RepeatIcon', RepeatIcon);
Vue.component('Trash2Icon', Trash2Icon);











/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('featherIcon', require('./components/general/featherIcon.vue').default);

///Componentes filtros
Vue.component('f-ventas', require('./components/filtros/f-ventas.vue').default);
Vue.component('f-productos', require('./components/filtros/f-productos.vue').default);

///Componentes GENERALES
Vue.component('title-menu', require('./components/general/title-menu.vue').default);

Vue.component('print2', require('./components/general/print2.vue').default);
Vue.component('t-general', require('./components/general/t-general.vue').default);
Vue.component('my-modal', require('./components/general/my-modal.vue').default);
Vue.component('my-modal-v2', require('./components/general/my-modal-v2.vue').default);
Vue.component('modal-retencion', require('./components/general/modal-retencion.vue').default);
Vue.component('modal-notacredito', require('./components/general/modal-notacredito.vue').default);
Vue.component('cajas-efectivo', require('./components/general/cajas-efectivo.vue').default);

Vue.component('modal-envia-docs', require('./components/general/modal-envia-docs.vue').default);
Vue.component('modal-envia-multi-docs', require('./components/general/modal-envia-multi-docs.vue').default);
Vue.component('modal-message', require('./components/general/modal-message.vue').default);


Vue.component('enviar-sri', require('./components/general/enviar-sri.vue').default);
Vue.component('alert', require('./components/general/alert.vue').default);



Vue.component('cliente-proveedor', require('./components/general/cliente-proveedor.vue').default);
// Vue.component('proveedor', require('./components/general/proveedor.vue').default);


Vue.component('grafica-lineal', require('./components/general/grafica-lineal.vue').default);
Vue.component('grafica-donut', require('./components/general/grafica-donut.vue').default);
Vue.component('grafica-barras', require('./components/general/grafica-barras.vue').default);

///Componentes Superusuario
Vue.component('t-planes', require('./components/admin/t-planes.vue').default);
Vue.component('t-sistemas', require('./components/admin/t-sistemas.vue').default);
Vue.component('t-agentes', require('./components/admin/t-agentes.vue').default);
Vue.component('t-impuestos', require('./components/admin/t-impuestos.vue').default);
Vue.component('t-conceptos', require('./components/admin/t-conceptos.vue').default);

///Componentes Reportes
Vue.component('t-historias', require('./components/reportes/t-historias.vue').default);

///Componentes Comercio
Vue.component('t-ventas', require('./components/comercio/t-ventas/t-ventas.vue').default);
Vue.component('modal-factura', require('./components/comercio/t-ventas/extras/modal-factura.vue').default);

Vue.component('t-proformas', require('./components/comercio/t-proformas.vue').default);
Vue.component('t-compras', require('./components/comercio/t-compras.vue').default);
Vue.component('t-gastos', require('./components/comercio/t-gastos.vue').default);




Vue.component('t-notas-credito', require('./components/comercio/t-notas-credito.vue').default);
Vue.component('t-notas-debito', require('./components/comercio/t-notas-debito.vue').default);
Vue.component('t-guias-remision', require('./components/comercio/t-guias-remision.vue').default);
Vue.component('t-retenciones', require('./components/comercio/t-retenciones.vue').default);
Vue.component('t-creditos', require('./components/comercio/t-creditos.vue').default);
Vue.component('t-liquidaciones-compras', require('./components/comercio/t-liquidaciones-compras.vue').default);

///Componentes Documentos
Vue.component('interprete-detalles', require('./components/documentos/interprete-detalles.vue').default);
Vue.component('selector-productos', require('./components/documentos/selector-productos.vue').default);
Vue.component('macro-factura', require('./components/documentos/macro-factura.vue').default);
Vue.component('factura-venta', require('./components/documentos/factura-venta.vue').default);



Vue.component('total-pagos', require('./components/documentos/total-pagos/total-pagos.vue').default);
Vue.component('table-creditos', require('./components/documentos/total-pagos/table-creditos.vue').default);
Vue.component('info-adicional', require('./components/documentos/info-adicional.vue').default);
Vue.component('proforma-proforma', require('./components/documentos/proforma-proforma.vue').default);
Vue.component('factura-compra', require('./components/documentos/factura-compra.vue').default);
Vue.component('liquidacion-compra', require('./components/documentos/liquidacion-compra.vue').default);
Vue.component('nota-credito', require('./components/documentos/nota-credito.vue').default);
Vue.component('macro-factura-compra', require('./components/documentos/macro-factura-compra.vue').default);
Vue.component('retencion-retencion', require('./components/documentos/retencion-retencion.vue').default);
Vue.component('ret-retenciones', require('./components/documentos/ret-retenciones.vue').default);
Vue.component('guia-remision', require('./components/documentos/guia-remision.vue').default);
Vue.component('guia-destinatarios', require('./components/documentos/guia-destinatarios.vue').default);
Vue.component('credito-credito', require('./components/documentos/credito-credito.vue').default);
Vue.component('nota-debito', require('./components/documentos/nota-debito.vue').default);
Vue.component('debito-debito', require('./components/documentos/debito-debito.vue').default);

///Componentes PERSONAS
Vue.component('t-vendedores', require('./components/personas/t-vendedores.vue').default);
Vue.component('t-clientes', require('./components/personas/t-clientes.vue').default);
Vue.component('t-proveedores', require('./components/personas/t-proveedores.vue').default);
Vue.component('t-transportistas', require('./components/personas/t-transportistas.vue').default);
Vue.component('t-accionistas', require('./components/personas/t-accionistas.vue').default);
///Componentes SISTEMA
Vue.component('t-roles', require('./components/sistema/t-roles.vue').default);
Vue.component('t-empresas', require('./components/sistema/t-empresas.vue').default);
Vue.component('t-sucursales', require('./components/sistema/t-sucursales.vue').default);
Vue.component('t-puntos', require('./components/sistema/t-puntos.vue').default);
Vue.component('t-cajas', require('./components/sistema/t-cajas.vue').default);
Vue.component('t-usuarios', require('./components/sistema/t-usuarios.vue').default);
Vue.component('configuracion-sistema', require('./components/sistema/configuracion-sistema.vue').default);
Vue.component('t-documentos', require('./components/sistema/t-documentos.vue').default);

///Componentes INVENTARIO
Vue.component('t-almacenes', require('./components/inventario/t-almacenes.vue').default);
Vue.component('t-unidades', require('./components/inventario/t-unidades.vue').default);
Vue.component('t-precios', require('./components/inventario/t-precios.vue').default);
Vue.component('t-filtros', require('./components/inventario/t-filtros.vue').default);
Vue.component('t-productos', require('./components/inventario/t-productos.vue').default);
Vue.component('form-producto', require('./components/inventario/form-producto.vue').default);
Vue.component('t-kardex', require('./components/inventario/t-kardex.vue').default);
Vue.component('carga-masiva', require('./components/inventario/carga-masiva.vue').default);

///Componentes CONTABILIDAD
Vue.component('t-planes-cuentas', require('./components/contabilidad/t-planes-cuentas.vue').default);
Vue.component('t-categorias', require('./components/contabilidad/t-categorias.vue').default);
Vue.component('t-asientos', require('./components/contabilidad/t-asientos.vue').default);
Vue.component('t-centros-costos', require('./components/contabilidad/t-centros-costos.vue').default);
Vue.component('t-tipos-asientos', require('./components/contabilidad/t-tipos-asientos.vue').default);
Vue.component('asiento-contable', require('./components/contabilidad/asiento-contable.vue').default);
Vue.component('t-tipos-asientos-globales', require('./components/contabilidad/t-tipos-asientos-globales.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
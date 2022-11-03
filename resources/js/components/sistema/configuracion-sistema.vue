<template>
    <div class="card">
        <div class="card-body p-2">
            
            <center v-if="cargando">
                <h1>
                    <b-spinner></b-spinner>
                    <br />
                    PROCESANDO...
                </h1>
            </center>
            <div v-else class="accordion" role="tablist">
                <b-card no-body class="mb-1 card-round">
                    <b-card-header
                        v-b-toggle.accordion-1
                        header-tag="header"
                        class="p-1 hover"
                        role="tab"
                    >
                        <b-button variant="success" class="float-right btn-sm">
                            <i class="fas fa-chevron-down"></i>
                        </b-button>
                        <h5>General</h5>
                    </b-card-header>
                    <b-collapse
                        id="accordion-1"
                        accordion="my-accordion"
                        role="tabpanel"
                    >
                        <b-card-body>
                            <div class="row">
                                <b-form-group
                                    class="col-12 col-xl-2 col-lg-3"
                                    label-size="sm"
                                    label="% IVA:"
                                >
                                    <b-form-input
                                        size="sm"
                                        v-model="
                                            configuracion.general.porcentajeIVA
                                        "
                                        type="number"
                                    ></b-form-input>
                                </b-form-group>
                                <b-form-group
                                    class="col-12 col-xl-2 col-lg-3"
                                    label-size="sm"
                                    label="Límite productos en VENTA:"
                                >
                                    <b-form-input
                                        size="sm"
                                        v-model="
                                            configuracion.general
                                                .limiteProductosVenta
                                        "
                                        type="number"
                                    ></b-form-input>
                                </b-form-group>
                                 <b-form-group
                                    label="Decimales en el Precio:"
                                    label-size="sm"
                                    class="col-xl-2 col-lg-3"
                                >
                                    <b-form-input
                                        size="sm"
                                        v-model="
                                            configuracion.general
                                                .decimalesPrecio
                                        "
                                        type="number"
                                    ></b-form-input>
                                </b-form-group>
                                <b-form-group
                                    label="Decimales en la cantidad:"
                                    label-size="sm"
                                    class="col-xl-2 col-lg-3"
                                >
                                    <b-form-input
                                        size="sm"
                                        v-model="
                                            configuracion.general
                                                .decimalesCantidad
                                        "
                                        type="number"
                                    ></b-form-input>
                                </b-form-group>
                                <b-form-group
                                    label="Formato de impresión:"
                                    label-size="sm"
                                    class="col-xl-2 col-lg-3"
                                >
                                    <b-form-select
                                        size="sm"
                                        v-model="
                                            configuracion.general
                                                .formatoImpresion
                                        "
                                        :options="['PDF', 'TICKET']"
                                    ></b-form-select>
                                </b-form-group>
                            </div>

                            <hr />

                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-4">
                                    <b-form-checkbox
                                        size="sm"
                                        :value="true"
                                        :unchecked-value="false"
                                        v-model="
                                            configuracion.general
                                                .facturacionSinExistencia
                                        "
                                    >
                                        Facturación sin existencia del producto.
                                    </b-form-checkbox>
                                </div>
                                <div class="col-12 col-sm-6 col-md-4">
                                    <b-form-checkbox
                                        size="sm"
                                        :value="true"
                                        :unchecked-value="false"
                                        v-model="
                                            configuracion.general
                                                .facturacionDescuentoProducto
                                                .check
                                        "
                                    >
                                        Facturación con descuento por producto.
                                    </b-form-checkbox>
                                    <b-form-group
                                        v-if="
                                            configuracion.general
                                                .facturacionDescuentoProducto
                                                .check
                                        "
                                        label="Tipo:"
                                        label-class="text-info"
                                        label-size="sm"
                                    >
                                        <b-form-radio-group
                                            v-model="
                                                configuracion.general
                                                    .facturacionDescuentoProducto
                                                    .tipo
                                            "
                                            :options="['PORCENTAJE', 'VALOR']"
                                        ></b-form-radio-group>
                                    </b-form-group>
                                </div>
                                <div class="col-12 col-sm-6 col-md-4">
                                    <b-form-checkbox
                                        size="sm"
                                        :value="true"
                                        :unchecked-value="false"
                                        v-model="
                                            configuracion.general
                                                .asociacionClienteVendedor.check
                                        "
                                    >
                                        Asociación automática entre Cliente y
                                        Vendedor.
                                    </b-form-checkbox>
                                    <b-form-group
                                        v-if="
                                            configuracion.general
                                                .asociacionClienteVendedor.check
                                        "
                                        label="Cuota Mínima de Venta para asociar:"
                                        label-size="sm"
                                        label-class="text-info"
                                    >
                                        <b-form-input
                                            v-model="
                                                configuracion.general
                                                    .asociacionClienteVendedor
                                                    .minimo
                                            "
                                            type="number"
                                            size="sm"
                                        ></b-form-input>
                                    </b-form-group>
                                </div>
                                <div class="col-12 col-sm-6 col-md-4">
                                    <b-form-checkbox
                                        size="sm"
                                        :value="true"
                                        :unchecked-value="false"
                                        v-model="
                                            configuracion.general
                                                .ubicacionProductoVenta
                                        "
                                    >
                                        Ubicación del producto en venta.
                                    </b-form-checkbox>
                                </div>
                                <div class="col-12 col-sm-6 col-md-4">
                                    <b-form-checkbox
                                        size="sm"
                                        :value="true"
                                        :unchecked-value="false"
                                        v-model="
                                            configuracion.general
                                                .editarSubtotalIVAVenta
                                        "
                                    >
                                        Subtotal con IVA en Detalle de Venta.
                                    </b-form-checkbox>
                                </div>
                                <div class="col-12 col-sm-6 col-md-4">
                                    <b-form-checkbox
                                        size="sm"
                                        :value="true"
                                        :unchecked-value="false"
                                        v-model="
                                            configuracion.general
                                                .impresionSubsidioVenta
                                        "
                                    >
                                        Impresión de Subsidio en Venta.
                                    </b-form-checkbox>
                                </div>
                                <div class="col-12 col-sm-6 col-md-4">
                                    <b-form-checkbox
                                        size="sm"
                                        :value="true"
                                        :unchecked-value="false"
                                        v-model="
                                            configuracion.general.notaVentaIVA
                                        "
                                    >
                                        IVA en Nota de Venta.
                                    </b-form-checkbox>
                                </div>
                                <div class="col-12 col-sm-6 col-md-4">
                                    <b-form-checkbox
                                        size="sm"
                                        :value="true"
                                        :unchecked-value="false"
                                        v-model="
                                            configuracion.general
                                                .enviarCorreoVenta
                                        "
                                    >
                                        Envío de Correo al Autorizar Comprobante
                                        SRI.
                                    </b-form-checkbox>
                                </div>
                                <div class="col-12 col-sm-6 col-md-4">
                                    <b-form-checkbox
                                        size="sm"
                                        :value="true"
                                        :unchecked-value="false"
                                        v-model="
                                            configuracion.general
                                                .efectivoPredeterminado
                                        "
                                    >
                                        Pago en Efectivo en la Venta
                                    </b-form-checkbox>
                                </div>
                            </div>

                          

                           
                        </b-card-body>
                    </b-collapse>
                </b-card>

                <b-card no-body class="mb-1 card-round">
                    <b-card-header
                        v-b-toggle.accordion-2
                        header-tag="header"
                        class="p-1 hover"
                        role="tab"
                    >
                        <b-button variant="success" class="float-right btn-sm">
                            <i class="fas fa-chevron-down"></i>
                        </b-button>
                        <h5>Pedido</h5>
                    </b-card-header>

                    <b-collapse
                        id="accordion-2"
                        accordion="my-accordion"
                        role="tabpanel"
                    >
                        <b-card-body> General </b-card-body>
                    </b-collapse>
                </b-card>
                <b-card no-body class="mb-1 card-round">
                    <b-card-header
                        v-b-toggle.accordion-3
                        header-tag="header"
                        class="p-1 hover"
                        role="tab"
                    >
                        <b-button variant="success" class="float-right btn-sm">
                            <i class="fas fa-chevron-down"></i>
                        </b-button>
                        <h5>Servicio Técnico</h5>
                    </b-card-header>

                    <b-collapse
                        id="accordion-3"
                        accordion="my-accordion"
                        role="tabpanel"
                    >
                        <b-card-body> General </b-card-body>
                    </b-collapse>
                </b-card>

                <b-card no-body class="mb-1 card-round">
                    <b-card-header
                    v-b-toggle.accordion-4
                        header-tag="header"
                        class="p-1 hover"
                        role="tab"
                    >
                        <b-button
                            
                            variant="success"
                            class="float-right btn-sm"
                        >
                            <i class="fas fa-chevron-down"></i>
                        </b-button>
                        <h5>Pet-Shop</h5>
                    </b-card-header>

                    <b-collapse
                        id="accordion-4"
                        accordion="my-accordion"
                        role="tabpanel"
                    >
                        <b-card-body> General </b-card-body>
                    </b-collapse>
                </b-card>
                <b-card no-body class="card-round">
                    <b-card-header
                        v-b-toggle.accordion-5
                        header-tag="header"
                        class="p-1 hover"
                        role="tab"
                    >
                        <b-button variant="success" class="float-right btn-sm">
                            <i class="fas fa-chevron-down"></i>
                        </b-button>
                        <h5>Sistema</h5>
                    </b-card-header>
                    <b-collapse
                        id="accordion-5"
                        accordion="my-accordion"
                        role="tabpanel"
                    >
                        <b-card-body> General </b-card-body>
                    </b-collapse>
                </b-card>
            </div>
        </div>
        <div class="card-footer p-2">
            <b-button variant="primary float-right" @click="saveData"
                > <i class="fas fa-save"></i> GUARDAR</b-button
            >
        </div>
    </div>
</template>

<script>
export default {
    props: ["preconfiguracion"],
    data() {
        return {
            cargando: false,

            configuracion: {
                general: {
                    porcentajeIVA: 12,
                    limiteProductosVenta: 0,
                    facturacionSinExistencia: false,
                    facturacionDescuentoProducto: {
                        check: false,
                        tipo: "PORCENTAJE",
                    },
                    asociacionClienteVendedor: {
                        check: false,
                        minimo: 0,
                    },
                    ubicacionProductoVenta: false,
                    editarSubtotalIVAVenta: false,
                    impresionSubsidioVenta: false,
                    notaVentaIVA: false,
                    enviarCorreoVenta: false,
                    efectivoPredeterminado: true,

                    decimalesPrecio: 2,
                    decimalesCantidad: 2,
                    formatoImpresion: "PDF",
                },
            },
        };
    },
    methods: {
        async saveData() {
            let params = {
                configuracion: this.configuracion,
            };
            this.cargando = true;
            await axios
                .post("/configuracion-sistema", params)
                .then((r) => {
                    this.cargando = false;
                    this.makeToast(
                        "Exito:",
                        "Se ha actualizado correctamente la configuración del sistema.",
                        "success"
                    );
                })
                .catch((e) => {
                    this.makeToast(
                        "Error:",
                        "A ocurrido un error al intentar guardar.",
                        "danger"
                    );
                    console.log(e);
                    this.cargando = false;
                });
        },
        makeToast(title, msg, variant = "secondary") {
            this.$bvToast.toast(msg, {
                title,
                autoHideDelay: 5000,
                variant,
            });
        },
    },
    mounted() {
        if (this.preconfiguracion) {
            this.configuracion = JSON.parse(this.preconfiguracion);
        }
    },
};
</script>

<style></style>

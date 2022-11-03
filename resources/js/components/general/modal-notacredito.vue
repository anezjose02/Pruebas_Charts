<template>
  <div>
    <div class="loader-sm" v-if="loading">
      <div></div>
    </div>

    <b-modal
      no-close-on-backdrop
      body-class="p-0"
      ref="my-modal-v3"
      :size="'xl'"
      lazy
      scrollable
      :hide-header="true"
      :hide-footer="true"
    >
      <div v-if="notacredito">
        <div class="modal-header">
          <h5>Nota de crédito: {{ notacredito.numeroDocumento }}</h5>

          <span @click="hideModal" type="button" class="float-right">
            <i class="fas fa-times"></i>
          </span>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <button
                @click="enviaSri"
                :disabled="documento.estado == 'AUTORIZADO'"
                class="btn btn-sm btn-primary float-right"
              >
                <featherIcon class="feather-ico" :icon="'send'"></featherIcon>
                Autorizar SRI
              </button>
            </div>
          </div>
          <div class="row" style="text-transform: uppercase">
            <div class="col-6">
              <p class="m-0">{{ empresa.nombreComercial }}</p>
              <p class="m-0">
                Razon Social:
                <span class="text-"> {{ empresa.razonSocial }} </span>
              </p>
              <p class="m-0">
                RUC: <span class="text-">{{ empresa.ruc }} </span>
              </p>

              <p class="m-0">
                Dir. Matriz: <span class="text-">{{ empresa.dirMatriz }} </span>
              </p>
              <p class="m-0">
                Dir Sucursal:
                <span class="text-">{{ sucursal.direccion }}</span>
              </p>

              <p
                class="m-0"
                v-if="
                  empresa.contribuyenteEspecial &
                  (empresa.contribuyenteEspecial != 'null')
                "
              >
                Contribuyente Especial Resolución Nro. NAC-{{
                  empresa.contribuyenteEspecial
                }}
              </p>

              <p class="m-0">
                OBLIGADO A LLEVAR CONTABILIDAD:
                {{ empresa.obligadoContabilidad }}
              </p>
              <p class="m-0" v-if="empresa.agentenotacredito">
                Agente Retención Resolución No. {{ empresa.agentenotacredito }}
              </p>

              <p
                class="m-0"
                v-if="
                  empresa.tipocontribuyente &&
                  empresa.tipocontribuyente != 'RÉGIMEN GENERAL'
                "
              >
                {{ empresa.tipocontribuyente }}
              </p>

              <p
                v-if="
                  empresa.codigoartesano & (empresa.codigoartesano != 'null')
                "
                class="m-0"
              >
                Codigo de Artesano: {{ empresa.codigoartesano }}
              </p>

              <!-- <p
              v-if="empresa.telefono & (empresa.telefono != 'null')"
              class="m-0"
            >
              Teléfono: {{ sucursal.telefono }}
            </p> -->
            </div>

            <div class="col-6">
              <!-- <p class="m-0" v-if="notacredito.codDoc == '01'">
                FACTURA:
                <span class="text-danger">{{
                  notacredito.numeroDocumento
                }}</span>
              </p> -->

              <p class="m-0">
                NOTA DE CRÉDITO:
                <span class="text-danger">{{
                  notacredito.numeroDocumento
                }}</span>
              </p>

              <p class="m-0" style="word-wrap: break-word">
                Número de autorización:
              </p>
              <p class="m-0">{{ notacredito.claveAcceso }}</p>

              <p class="m-0">
                FECHA Y HORA DE AUTORIZACIÓN:
                <span v-if="documento.estado == 'AUTORIZADO'"
                  >{{ documento.updated_at }}
                </span>
              </p>
              <p class="m-0">
                AMBIENTE:

                <span v-if="notacredito.ambiente == 2">PRODUCCIÓN</span>
                <span v-else>PRUEBAS</span>
              </p>
              <!-- <p class="m-0">
                    EMISÍON:
                     <span v-if="notacredito.notacredito.tipoEmision == 2">NORMAL</span>
                     <span v-else>NOINDISPONIBILIDAD DEL SISTEMARMAL</span>

                </p> -->

              <p class="m-0">CLAVE DE ACCESO:</p>
              <p class="m-0">{{ notacredito.claveAcceso }}</p>
            </div>
          </div>

          <hr class="my-2" />
          <div class="row" style="text-transform: uppercase" v-if="cliente">
            <div class="col-6">
              <p class="m-0">
                Razon Social:
                <span class="text-"> {{ cliente.razonsocial }} </span>
              </p>
              <p class="m-0">Identificación: {{ cliente.identificacion }}</p>

              <p class="m-0">
                Ciudad: <span class="text-"> {{ cliente.ciudad }} </span>
              </p>

              <p class="m-0">
                Dirección:
                <span class="text-"> {{ cliente.direccion }} </span>
              </p>
               <p class="m-0">
                Teléfono: <span class="text-"> {{ cliente.telefono }} </span>
              </p>
            </div>
            <div class="col-6">
             
              <p class="m-0">
                correo: <span class="text-"> {{ cliente.email }} </span>
              </p>

              <p class="m-0">
                Fecha de emisión:
                <span class="text-"> {{ notacredito.fecha_emision }} </span>
              </p>
                <p class="m-0">
                Tipo doc. modificado:
                <span class="text-">  FACTURA </span>
              </p>
                 <p class="m-0">
                Nro. doc. modificado:
                <span class="text-"> {{ notacredito.numDocModificado }}  </span>
              </p>
                  <p class="m-0">
                Fecha emisión doc. modificado:
                <span class="text-"> {{ notacredito.fechaEmisionDocSustento }}  </span>
              </p>
               

            </div>
          </div>

          <!-- table -->
          <div class="row">
            <div class="col-12">
              <div class="card my-3">
                <div class="card-header">
                  <h5>Detalles</h5>
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive">
                    <b-table
                      class="m-0"
                      hover
                      :fields="fields"
                      :items="detalles"
                      responsive
                    >
                      <template #cell(action)="row">
                        <b-btn
                          variant="danger mb-1"
                          @click="delItem(row.index)"
                          size="sm"
                        >
                          <b-icon icon="trash"></b-icon>
                        </b-btn>
                        <b-btn
                          v-if="esretencion"
                          variant="success mb-1"
                          @click="showModal(row.index)"
                          size="sm"
                        >
                          <b-icon icon="plus"></b-icon>
                          Retenciones
                        </b-btn>
                      </template>

                      <template #cell(grabaiva)="row">
                        <b-form-checkbox
                          @input="setIVA(row.index)"
                          :value="1"
                          :unchecked-value="0"
                          v-model="row.item.grabaiva"
                        ></b-form-checkbox>

                        <b-form-select
                          v-if="
                            !row.item.grabaiva || row.item.grabaiva * 1 == 0
                          "
                          :options="[
                            { value: 0, text: 'IVA 0' },
                            { value: 1, text: 'No graba iva' },
                            { value: 2, text: 'Exento de IVA' },
                          ]"
                          v-model="row.item.tipoIVA"
                          @change="setIVA(row.index)"
                          @input="setIVA(row.index)"
                        ></b-form-select>
                      </template>

                      <template #cell(asociarInnotacreditorio)="row">
                        <b-form-checkbox
                          @input="setIVA(row.index)"
                          :value="1"
                          :unchecked-value="0"
                          v-model="row.item.asociarInnotacreditorio"
                        ></b-form-checkbox>
                      </template>

                      <template #cell(unidad)="row">
                        <b-form-select
                          @change="cambioUnidadesItem(row.index)"
                          v-if="row.item.unidadMedida"
                          size="sm"
                          :options="row.item.unidadMedida.submedidas"
                          v-model="row.item.unidad"
                        ></b-form-select>
                      </template>

                      <template #cell(id)="row">
                        <selector-productos
                          v-if="!row.item.id && row.item.asociarInnotacreditorio"
                          :almacenid.sync="almacen_id"
                          @producto="(n) => addDetallesProducto(n, row.index)"
                        ></selector-productos>
                        <span
                          v-if="!row.item.id && row.item.asociarInnotacreditorio"
                          class="text-danger"
                        >
                          No existe
                        </span>
                        <span
                          v-if="!row.item.id && !row.item.asociarInnotacreditorio"
                          class="text-info"
                        >
                          No asociado
                        </span>
                        <span v-if="row.item.id" class="text-success">
                          Existe
                        </span>
                      </template>
                    </b-table>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div>
            <div style="width: 70%; float: left">
              <div class="card mr-2" v-if="accionista">
                <div class="card-body">
                  <p class="m-0">Información adicional:</p>
                  <p class="m-0">
                    PUNTO DE EMISIÓN: {{ accionista["ptoEmi"] }} -
                    {{ accionista["razonsocial"] }}
                  </p>
                  <p class="m-0">
                    {{ accionista["identificacion_tipo"] }}:
                    {{ accionista["identificacion"] }}
                  </p>
                </div>
              </div>

              <div class="card mr-2">
                <div class="card-body">
                  <p class="m-0" style="word-wrap: break-word">
                    Observaciones: {{ notacredito.observaciones }}
                  </p>
                  <hr
                    style="
                      background: grey;
                      border-radius: 5px;
                      margin-bottom: 5px;
                      margin-top: 5px;
                    "
                  />
                  <p class="m-0" style="word-wrap: break-word">
                    Motivo de modificación:: {{ notacredito.motivo }}
                  </p>
                  
                  <!-- <hr
                    v-if="vendedor"
                    style="
                      background: grey;
                      border-radius: 5px;
                      margin-bottom: 5px;
                      margin-top: 5px;
                    "
                  />
                  <p class="m-0" v-if="vendedor">
                    Vendedor:
                    <span class="text-"> {{ vendedor.razonsocial }} </span>
                  </p>
                  <p class="m-0" v-if="vendedor">
                    Correo: <span class="text-"> {{ vendedor.email }} </span>
                  </p> -->

                  
                  <!-- <p class="m-0">Facturado por: {{ user.name }}</p> -->
                </div>
              </div>

              <div class="card">
                <div class="card-body">
                  <table style="text-align: left; width: 100%; margin: 0">
                    <thead class="thead-border">
                      <tr style="border-bottom: 1px solid grey !important">
                        <th style="border-right: 1px grey solid">
                          <p
                            class="m-0"
                            style="text-align: left; margin: 5px 0 5px 0"
                          >
                            Forma de Pago
                          </p>
                        </th>
                        <th>
                          <p
                            class="m-0"
                            style="text-align: center; margin: 5px 0 5px 0"
                          >
                            Valor
                          </p>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td style="border-right: 1px grey solid !important">
                          <p class="m-0" style="margin: 8px 0 8px 0">
                            Otras formas de pago - con utilización del sistema
                            financiero
                          </p>
                        </td>
                        <td>
                          <p
                            class="m-0"
                            style="text-align: center; margin: 8px 0 8px 0"
                          >
                            {{ format(notacredito.total) }}
                          </p>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div style="width: 30%; float: left; text-align: right">
              <div class="card ml-2">
                <div class="card-body">
                  <table class="" style="text-align: right; width: 100%">
                    <tr>
                      <td>
                        <p class="m-0">Subtotal 0 %:</p>
                      </td>
                      <td>
                        <p class="m-0">
                          {{ format(notacredito.subtotal_cero) }}
                        </p>
                      </td>
                    </tr>

                    <tr>
                      <td>
                        <p class="m-0">Subtotal IVA:</p>
                      </td>
                      <td>
                        <p class="m-0">
                          {{ format(notacredito.subtotal_iva) }}
                        </p>
                      </td>
                    </tr>

                    <tr>
                      <td>
                        <p class="m-0">IVA:</p>
                      </td>
                      <td>
                        <p class="m-0">{{ format(iva, 2) }}</p>
                      </td>
                    </tr>

                    <tr>
                      <td>
                        <p class="m-0">Subtotal no objeto de IVA:</p>
                      </td>
                      <td>
                        <p class="m-0">0.00</p>
                      </td>
                    </tr>

                    <tr>
                      <td>
                        <p class="m-0">Subtotal exento de IVA:</p>
                      </td>
                      <td>
                        <p class="m-0">0.00</p>
                      </td>
                    </tr>

                    <tr>
                      <td>
                        <p class="m-0">Total sin impuestos:</p>
                      </td>
                      <td>
                        <p class="m-0">
                          {{ format(notacredito.subtotal_sin_impuestos) }}
                          <!-- {{ number_format(notacredito.subtotal_sin_impuestos,2) }} -->
                        </p>
                      </td>
                    </tr>

                    <tr>
                      <td>
                        <p class="m-0">Descuento:</p>
                      </td>
                      <td>
                        {{ format(notacredito.descuento) }}
                        <!-- <p class="m-0">{{ number_format($descuento, 2) }}</p> -->
                      </td>
                    </tr>

                    <tr>
                      <td>
                        <p class="m-0">Total:</p>
                      </td>
                      <td>
                        <p class="m-0">{{ format(notacredito.total) }}</p>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <a
            :href="'/descargar-notacredito/' + notacredito.id + '?xml=true'"
            class="btn btn-sm btn-square btn-info float-right ml-2"
          >
            <i class="fas fa-file-code"></i> XML
          </a>

          <a
            :href="'/descargar-notacredito/' + notacredito.id + '?pdf=true'"
            class="btn btn-sm btn-square btn-danger float-right"
          >
            <i class="fas fa-file-code"></i> PDF
          </a>

          <button
            @click="hideModal"
            class="btn btn-sm btn-square btn-secondary float-right"
          >
            <i class="fas fa-times"></i> Cerrar
          </button>
        </div>
      </div>
    </b-modal>


    <enviar-sri
      v-if="enviasri"
      :empresa_id="notacredito.empresa_id"
      :documento_id="documento.id"
      :url="'/enviar-notacredito-sri'"
      @estadosri="(e) => (documento.estado = e)"
      @reload="reloadT"
    ></enviar-sri>

  

    
  </div>
</template>

<script>
export default {
  props: ["notacredito_id"],

  data() {
    return {
      recargarTabla: false,
      enviasri: false,
      loading: true,
      notacredito: null,
      cliente: null,
      empresa: null,
      documento: false,
      sucursal: null,
      detalles: null,
      accionista:null,
      iva: null,
      fields: [
        { key: "codigoPrincipal", label: "Cod. principal", sortable: true },
        { key: "codigoAuxiliar", label: "Cod. auxiliar", sortable: true },
        { key: "descripcion", label: "Descripción", sortable: true },

        {
          key: "precioUnitario",
          label: "Precio",
          sortable: true,
          formatter: (value, key, item) => {
            return this.format(item.precioUnitario);
          },
        },
        {
          key: "cantidad",
          label: "Cantidad",
          sortable: true,
        },

        {
          key: "descuento",
          label: "Descuento",
          sortable: true,
          formatter: (value, key, item) => {
            return this.format(item.descuento);
          },
        },

        {
          key: "subtotal_0",
          label: "Total 0%",
          sortable: true,
          formatter: (value, key, item) => {
            if (!item.grabaiva) {
              return this.format(item.precioUnitario * item.cantidad);
            }

            return 0;
          },
        },
        {
          key: "subtotal_IVA",
          label: "Total IVA",
          sortable: true,
          formatter: (value, key, item) => {
            if (item.grabaiva) {
              return this.format(item.precioUnitario * item.cantidad * 0.12);
            }
            return 0;
          },
        },
      ],
    };
  },
  methods: {
    reloadT() {
      this.recargarTabla = true;
      console.log("recargatabla true");
    },
    enviaSri() {
      this.enviasri = false;
      self = this;
      setTimeout(function () {
        self.enviasri = true;
      }, 500);
    },
    async showModal(ctx) {
      await axios
        .get("/descargar-notacredito/" + this.notacredito_id + "?modal=true")
        .then((r) => {
          console.log(r.data);
          this.loading = false;
          this.notacredito = r.data.notacredito;
          this.cliente = r.data.cliente;
          this.empresa = r.data.empresa;

          this.documento = r.data.documento;
          this.sucursal = r.data.sucursal;
          this.iva = r.data.iva;
          this.detalles = r.data.detalles;

          this.$refs["my-modal-v3"].show();
        })
        .catch((e) => {
          console.log(e);
          alert("Verifique su conexión a internet.");
          this.loading = false;

          this.hideModal();
        });

      return this.items;
    },

    hideModal() {
      this.$refs["my-modal-v3"].hide();
      self = this;

      setTimeout(function () {
        if (self.recargarTabla == true) {
          console.log("emit reload");
          self.$emit("reload");
          self.recargarTabla = false;
        }

        self.$emit("hide");
      }, 500);
    },
    format(number) {
      return parseFloat(number).toFixed(2);
    },
  },

  mounted() {
    if (this.correo) {
      this.correocliente = this.correo;
    }
    this.showModal();
  },
};
</script>

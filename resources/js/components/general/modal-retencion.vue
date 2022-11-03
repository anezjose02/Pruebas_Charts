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
      <div v-if="retencion">
        <div class="modal-header">
          <h5>Retención: {{ retencion.numeroDocumento }}</h5>

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

         
              <p class="m-0" v-if="empresa.agenteRetencion & empresa.agenteRetencion != 'null'">
                Agente Retención Resolución No. {{ empresa.agenteRetencion }}
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
              <p class="m-0" v-if="retencion.codDoc == '01'">
                FACTURA:
                <span class="text-danger">{{ retencion.numeroDocumento }}</span>
              </p>

              <p class="m-0" v-else>
                NOTA DE documento:
                <span class="text-danger">{{ retencion.numeroDocumento }}</span>
              </p>

              <p class="m-0" style="word-wrap: break-word">
                Número de autorización:
              </p>
              <p class="m-0">{{ retencion.claveAcceso }}</p>
              
          

              <p class="m-0">
                FECHA Y HORA DE AUTORIZACIÓN: <span v-if="documento.estado == 'AUTORIZADO'">{{ documento.updated_at }} </span> 
              </p>
              <p class="m-0">
                AMBIENTE:

                <span v-if="retencion.ambiente == 2">PRODUCCIÓN</span>
                <span v-else>PRUEBAS</span>
              </p>
              <!-- <p class="m-0">
                    EMISÍON:
                     <span v-if="retencion.retencion.tipoEmision == 2">NORMAL</span>
                     <span v-else>NOINDISPONIBILIDAD DEL SISTEMARMAL</span>

                </p> -->

              <p class="m-0">CLAVE DE ACCESO:</p>
              <p class="m-0">{{ retencion.claveAcceso }}</p>
            </div>
          </div>

          <hr class="my-2" />
          <div class="row" style="text-transform: uppercase" v-if="proveedor">
            <div class="col-6">
              <p class="m-0">
                Razon Social:
                <span class="text-"> {{ proveedor.razonsocial }} </span>
              </p>
              <p class="m-0">Identificación: {{ proveedor.identificacion }}</p>

              <p class="m-0">
                Ciudad: <span class="text-"> {{ proveedor.ciudad }} </span>
              </p>

              <p class="m-0">
                Dirección:
                <span class="text-"> {{ proveedor.direccion }} </span>
              </p>
            </div>
            <div class="col-6">
              <p class="m-0">
                Teléfono: <span class="text-"> {{ proveedor.telefono }} </span>
              </p>
              <p class="m-0">
                correo: <span class="text-"> {{ proveedor.email }} </span>
              </p>

              <p class="m-0">
                Fecha de emisión:
                <span class="text-"> {{ retencion.fecha_emision }} </span>
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
                    <b-table hover :fields="fields" :items="detalles">
                      <template #cell(nombre)="row">
                        {{ row.item.codigoRetencion }} - {{ row.item.nombre }}
                      </template>

                      <template #cell(numeroDocumentoSustento)="row">
                        {{ retencion.numeroDocumentoSustento }}
                      </template>
                      <template #cell(fecha_emision_doc_sustento)="row">
                        {{ retencion.fecha_emision_doc_sustento }}
                      </template>
                      <template #cell(id)="row">
                        {{ row.item.codigo }}
                      </template>
                    </b-table>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- DETALLES -->
        </div>
        <div class="modal-footer">
          <a
            :href="'/descargar-retencion/' + retencion.id + '?xml=true'"
            class="btn btn-sm btn-square btn-info float-right ml-2"
          >
            <i class="fas fa-file-code"></i> XML
          </a>

          <a
            :href="'/descargar-retencion/' + retencion.id + '?pdf=true'"
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
      :empresa_id="retencion.empresa_id"
      :documento_id="documento.id"
      :url="'/enviar-retencion-sri'"
      @estadosri="(e) => (documento.estado = e)"
      @reload="reloadT"
    ></enviar-sri>
  </div>
</template>

<script>
export default {
  // <table class="table-detalles" style="width: 100%">
  //         <thead>
  //             <tr>
  //
  //                 <th> Número </th>
  //                 <th> F. emisión </th>
  //                 <th> Código </th>
  //                 <th> Concepto </th>
  //                 <th> Base imp.</th>
  //                 <th> Impuesto</th>

  //                 <th> % </th>
  //                 <th> Valor </th>
  //             </tr>
  //         </thead>
  //         <tbody>
  //             @foreach (json_decode($documento->json)->impuestos[0]->impuesto as $r)
  //                 <tr>
  //                     <td> Factura </td>
  //                     <td> {{ $retencion->numeroDocumentoSustento }} </td>
  //                     <td> {{ \carbon\carbon::parse($retencion->fecha_emision_doc_sustento)->format('d/m/Y') }}
  //                     </td>
  //                     <td> {{ $r->codigo }} </td>

  //                     <td> {{ $r->nombre }} </td>
  //                     <td> {{ number_format($r->baseImponible, 2) }} </td>
  //                     <td>
  //                         @if ($r->codigo == 1)
  //                             RENTA
  //                         @else
  //                             IVA
  //                         @endif
  //                     </td>

  //                     <td> {{ $r->porcentajeRetener }} </td>
  //                     <td> {{ $r->valorRetenido }} </td>
  //                 </tr>
  //             @endforeach

  //         </tbody>

  //     </table>

  props: ["retencion_id"],

  data() {
    return {
      recargarTabla: false,
      enviasri: false,
      loading: true,
      retencion: null,
      proveedor: null,
      empresa: null,
      documento: null,
      sucursal: null,
      detalles: null,
      iva: null,
      fields: [
        {
          key: "Comprobante",
          label: "Comprobante",
          sortable: true,
          formatter: (value) => {
            return "Factura";
          },
        },
        { key: "numeroDocumentoSustento", label: "Número", sortable: true },
        {
          key: "fecha_emision_doc_sustento",
          label: "F. emisión",
          sortable: true,
        },

        { key: "nombre", label: "Concepto", sortable: true },

        {
          key: "baseImponible",
          label: "Base imponible",
          sortable: true,
          formatter: (value) => {
            return parseFloat(value).toFixed(2);
          },
        },
        {
          key: "codigo",
          label: "Impuesto",
          sortable: true,
          formatter: (value) => {
            if (value == 2) {
              return "IVA";
            } else {
              return "RENTA";
            }
          },
        },
        {
          key: "porcentajeRetener",
          label: "%",
          sortable: true,
        },
        {
          key: "valorRetenido",
          label: "Valor",
          sortable: true,
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
        .get("retencion/" + this.retencion_id)
        .then((r) => {
          console.log(r.data);
          this.loading = false;
          this.retencion = r.data.retencion;
          this.proveedor = r.data.proveedor;
          this.empresa = r.data.empresa;

          this.documento = r.data.documento;
          this.sucursal = r.data.sucursal;
          this.iva = r.data.iva;
          if (r.data.documento.json) {
            var detalles = JSON.parse(r.data.documento.json);
            this.detalles = detalles.impuestos[0].impuesto;
          }

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
      this.correoproveedor = this.correo;
    }
    this.showModal();
  },
};
</script>

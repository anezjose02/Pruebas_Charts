<template>
  <div class="w-100">
    <div class="title-ventas" v-if="title != 'Productos venta'">
      <div class="content-title-ventas">
        <div class="row m-auto" style="width: 100%">
          <div class="col-sm-6 p-0">
            <h1 class="m-0">
              {{ title }}
            </h1>
          </div>
          <div class="col-sm-6 p-0">
            <b-breadcrumb class="float-right m-0 ml-2">
              <b-breadcrumb-item href="#home"> Inicio </b-breadcrumb-item>
              <b-breadcrumb-item active>{{ title }}</b-breadcrumb-item>
            </b-breadcrumb>
            <div class="dropdown float-right ml-2">
              <button
                class="btn btn-sm btn-success dropdown-toggle"
                type="button"
                id="dropdownMenuButton"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                <i class="fas fa-plus"></i> Nueva
              </button>
              <div
                class="dropdown-menu dropdown-menu-right"
                aria-labelledby="dropdownMenuButton"
              >
                <a class="dropdown-item" href="/facturar">
                  <i class="fas fa-file-invoice"></i> Factura de venta</a
                >
                <a class="dropdown-item" href="/proforma">
                  <i class="text-info fas fa-file"></i>
                  Proforma</a
                >
                <a class="dropdown-item" href="/nota-credito">
                  <i class="text-success fas fa-file-invoice-dollar"></i>
                  Nota de crédito</a
                >
                <a class="dropdown-item" href="/retencion">
                  <i class="text-secondary far fa-file-alt"></i>

                  Retención</a
                >
              </div>
            </div>

            <div
              class="dropdown float-right ml-2"
              v-if="urlNow('ventas') || urlNow('retenciones')"
            >
              <button
                class="btn btn-sm btn-info dropdown-toggle"
                type="button"
                id="dropdownMenuButton"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                <i class="fas fa-plus"></i> Acción Lotes
              </button>
              <div class="dropdown-menu dropdown-menu-right">
                <button
                  @click="
                    showModalMessage(
                      '¿Esta seguro de enviar los documentos seleccionados al SRI?',
                      'warning',
                      'enviaSriSelec'
                    )
                  "
                  :disabled="seleccionadas.length == 0"
                  class="dropdown-item"
                  type="button"
                >
                  <featherIcon
                    style="margin-left: -5px"
                    class="feather-ico"
                    :icon="'send'"
                  ></featherIcon>
                  Autorizar seleccion
                </button>
                <button
                  @click="
                    showModalMessage(
                      '¿Esta seguro de enviar los documentos seleccionados a sus respectivos clientes?',
                      'warning',
                      'enviaCorreosMulti'
                    )
                  "
                  :disabled="seleccionadas.length == 0"
                  class="dropdown-item"
                  type="button"
                >
                  <i class="fas fa-mail-bulk"></i> Enviar seleccion a clientes
                </button>
                <button disabled class="dropdown-item" type="button">
                  <featherIcon
                    style="margin-left: -5px"
                    class="feather-ico"
                    :icon="'send'"
                  ></featherIcon>
                  Autorizar todo
                </button>
                <button disabled class="dropdown-item" type="button">
                  <i class="fas fa-mail-bulk text-info"></i>
                  Enviar todos a correo
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div v-if="title == 'Productos venta'">
      <form @submit.prevent="getFormValues">
        <f-productos :filters.sync="filtros"></f-productos>
      </form>
    </div>

    <b-card no-body v-if="title != 'Productos venta'">
      <b-card-header v-if="title">
        <slot></slot>
        <!-- IF TITLE VENTAS -->
        <div
          style="margin-top: -3px"
          class="dropdown float-right"
          v-if="title == 'Ventas'"
        >
          <button
            class="btn btn-sm btn-primary not-arrow dropdown-toggle"
            type="button"
            id="dropdownMenuButton"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
          >
            <i class="fas fa-plus"></i>
          </button>
          <div
            class="dropdown-menu mt-1 dropdown-menu-right"
            aria-labelledby="dropdownMenuButton"
          >
            <a class="dropdown-item" :href="'/excel-ventas?' + filtros">
              <i class="text-success fas fa-file-excel"></i>
              Exportar a excell</a
            >
            <a class="dropdown-item" :href="'/ventas-pdf?' + filtros">
              <i class="text-danger fas fa-file-pdf"></i> Exportar a pdf</a
            >
          </div>
        </div>
        <!-- END IF TITLE VENTAS -->
        <h5>
          {{ title }}
        </h5>
      </b-card-header>
      <b-card-body>
        <form @submit.prevent="getFormValues">
          <f-ventas
            v-if="title == 'Ventas'"
            :datosfiltros="datosfiltros"
            :errores="errores"
            :campos="campos"
          ></f-ventas>
        </form>
      </b-card-body>
    </b-card>

    <div class="card">
      <div class="card-body py-0 px-1">
        <div
          class="table-responsive"
          :class="{
            'min-height-responsive': items.length <= 2 && items.length != 0,
          }"
        >
          <b-table
            ref="my-table"
            :items="getItems"
            :fields="fields"
            hover
            class="text-nowrap"
            select-mode="multi"
            selectable
            @row-selected="seleccionarFilas"
            :busy.sync="isBusy"
            :sort-by.sync="mySortBy"
            :sort-desc.sync="mySortDesc"
          >
            <template #table-busy>
              <div class="text-center text-danger my-2">
                <b-spinner class="align-middle"></b-spinner>
                <strong>Cargando...</strong>
              </div>
            </template>

            <template #cell(razonSocial)="row">
              <div style="margin-bottom: -7px" v-if="urlNow('ventas')">
                <span v-if="!row.item.nombre_cliente"> CONSUMIDOR FINAL </span>
                <span v-else>
                  {{ row.item.nombre_cliente }}
                </span>
              </div>

              <span v-if="!urlNow('ventas')">
                {{ row.item.razonSocial }}
              </span>

              <span
                v-if="row.item.nombre_cliente && urlNow('ventas')"
                style="font-weight: 500; font-size: 10px !important"
              >
                {{ row.item.identificacion_cliente }}
              </span>
            </template>

            <template #cell(numeroDocumento)="row">
              <modal-factura
                v-if="urlNow('ventas')"
                @reload="recargarTabla"
                :id="row.item.id"
                :txtbutton="row.item.numeroDocumento"
                :tipodoc="row.item.codDoc"
                :estado_venta="row.item.estado_documento"
                :estado="row.item.estado_sri"
                :documento_id="row.item.documento_id"
                :empresa_id="row.item.documento_id"
                :correo_enviado="row.item.correo_enviado"
              ></modal-factura>
              <a
                v-if="urlNow('retenciones')"
                href=""
                @click.prevent="showModalRet(row.item.id)"
              >
                <div style="margin-bottom: -5px">
                  RET-{{ row.item.numeroDocumento }}
                </div>
              </a>
              <div v-if="urlNow('retenciones')">
                <span
                  class="text-danger"
                  v-if="row.item.estado_documento == 'ANULADA'"
                >
                  ANULADA
                </span>
                <span v-else class="text-success"> EMITIDA </span>
                <featherIcon
                  :class="{
                    'text-warning2': row.item.correo_enviado == 'ENVIADO',
                    'text-secondary': row.item.correo_enviado != 'ENVIADO',
                  }"
                  :icon="'mail'"
                ></featherIcon>

                <span
                  class="text-success"
                  v-if="row.item.estado_sri == 'AUTORIZADO'"
                >
                  {{ row.item.estado_sri }}
                </span>
                <span
                  class="text-primary"
                  v-else-if="row.item.estado_sri == 'RECIBIDO'"
                >
                  {{ row.item.estado_sri }}
                </span>
                <span
                  class="text-primary"
                  v-else-if="row.item.estado_sri == 'PENDIENTE'"
                >
                  {{ row.item.estado_sri }}
                </span>
                <span
                  class="text-danger"
                  v-else-if="row.item.estado_sri == 'RECHAZADO'"
                >
                  {{ row.item.estado_sri }}
                </span>
                <span class="text-primary" v-else-if="!row.item.estado">
                  PENDIENTE
                </span>
              </div>
              <!-- <modal-retencion>
              
              <modal-retencion> -->
            </template>

            <template #cell(action)="row">
              <span v-for="(ac, ia) in actions" :key="ia">
                <span v-if="ac.modalMessage">
                  <button class="btn btn"></button>
                </span>

                <span
                  style="margin-right: 6.5px"
                  class=""
                  v-else-if="ac.download"
                >
                  <b-dropdown
                    :disabled="
                      row.item.estado == 'ANULADO' ||
                      row.item.estado_documento == 'ANULADA'
                    "
                    v-b-tooltip.hover.top="ac.tooltip"
                    class="not-arrow btn-ico"
                    size="sm"
                  >
                    <template #button-content class="btn-sm">
                      <em>
                        <featherIcon
                          class="feather-ico"
                          :icon="'download'"
                        ></featherIcon>
                      </em>
                    </template>

                    <b-dropdown-item
                      :href="urldownloaddoc + row.item.id + '?xml=true'"
                    >
                      <i class="fas fa-file-code"></i>
                      Descargar xml</b-dropdown-item
                    >

                    <b-dropdown-item :href="urldownloaddoc + row.item.id">
                      <i class="fas fa-file-pdf text-danger"></i>
                      Descargar pdf
                    </b-dropdown-item>
                    <b-dropdown-item
                      @click="modalEnviaDocs(row.item)"
                      v-if="correo"
                    >
                      <featherIcon
                        style="margin-left: -2px; margin-right: 2px"
                        class="feather-ico text-warning"
                        :icon="'mail'"
                      ></featherIcon>
                      Enviar correo
                    </b-dropdown-item>
                  </b-dropdown>
                </span>

                <span class="mr-1" v-else-if="ac.imprimir">
                  <b-dropdown
                    :disabled="
                      row.item.estado == 'ANULADO' ||
                      row.item.estado_documento == 'ANULADA'
                    "
                    v-b-tooltip.hover="ac.tooltip"
                    class="not-arrow btn-ico"
                    size="sm"
                    variant="primary"
                  >
                    <template #button-content class="btn-sm">
                      <em>
                        <featherIcon
                          class="feather-ico"
                          :icon="'print'"
                        ></featherIcon>
                      </em>
                    </template>

                    <b-dropdown-item
                      href="#"
                      @click="printTicket(row.item.id)"
                      v-if="ticket"
                    >
                      <i
                        class="fas fa-ticket-alt"
                        data-fa-transform="rotate-45"
                        style="transform: rotate(90deg); margin-left: -3px"
                      ></i>
                      Ticket
                    </b-dropdown-item>
                    <b-dropdown-item
                      href="#"
                      @click="printFactura(row.item.id)"
                    >
                      <i class="mr-2 fas fa-file-pdf text-danger"></i>
                      PDF
                    </b-dropdown-item>
                  </b-dropdown>
                </span>

                <my-modal
                  :estado_documento="row.item.estado_documento"
                  :estado_sri="row.item.estado_sri"
                  class="mr-1"
                  v-else-if="ac.rapida"
                  :tooltip="ac.tooltip"
                  @ok="ac.callback(row.item)"
                  :btnvariant="ac.variant"
                  :btnicon="ac.icon"
                  :featherIcon="ac.featherIcon"
                  footer="true"
                  :size="'md'"
                  :alert="ac.alert"
                  :title="ac.txt"
                  :htmltxt="ac.html"
                >
                </my-modal>

                <b-btn
                  v-b-tooltip.hover
                  :title="ac.tooltip"
                  class="mr-1"
                  v-else
                  v-bind:class="{ 'btn-ico': !ac.txt }"
                  :variant="ac.icon == 'pen' ? 'info' : ac.variant"
                  @click="ac.callback(row.item)"
                  size="sm"
                >
                  <i v-if="ac.icon == 'trash'" class="fas fa-trash"> </i>
                  <i v-if="ac.icon == 'plus'" class="fas fa-plus"> </i>

                  <featherIcon
                    class="feather-ico"
                    v-if="ac.icon == 'pen'"
                    :icon="'edit'"
                  ></featherIcon>

                  <i
                    v-if="ac.icon == 'cart'"
                    class="fas fa-shopping-cart"
                    style="padding-left: 1px"
                  >
                  </i>

                  <b-icon
                    :icon="ac.icon"
                    v-if="
                      ac.icon != 'plus' &&
                      ac.icon != 'trash' &&
                      ac.icon != 'cart' &&
                      ac.icon != 'pen'
                    "
                  ></b-icon>

                  <span v-if="ac.txt">
                    {{ ac.txt }}
                  </span>
                </b-btn>
              </span>
            </template>
          </b-table>
        </div>
        <div class="row child-buttons-square">
          <div class="col-12 col-md-3">
            <b-pagination
              class="justify-content-center pagination-sm"
              style="margin-top: 1px"
              v-model="currentPage"
              :total-rows.sync="rows"
              :per-page.sync="perPage"
              @input="recargarTabla"
            ></b-pagination>
          </div>
          <b-form-group
            class="col-12 col-md-3"
            label="Por página:"
            label-size="sm"
            label-cols="6"
            content-cols="6"
          >
            <b-form-select
              v-model="perPage"
              :options="page_options"
              size="sm"
              @change="recargarTabla"
            ></b-form-select>
          </b-form-group>
          <div class="col-12 col-md-3" v-if="items.length > 0">
            <b-btn variant="secondary" size="sm" @click="selectAllRows">
              <i class="fas fa-list"></i> Todo
            </b-btn>
            <b-btn variant="secondary" size="sm" @click="clearSelected">
              <i class="fas fa-times"></i> Nada
            </b-btn>
          </div>

          <div
            class="col-12 col-md-3"
            v-if="(items.length > 0) & (title != 'Ventas')"
          >
            <div
              v-if="
                multiactions.length > 0 &&
                seleccionadas &&
                seleccionadas.length > 0
              "
              class=""
            >
              <span style="font-size: 14px; font-weight: 500"
                >Acción seleccionados:</span
              >
              <my-modal
                v-for="(ac, ia) in multiactions"
                :key="ia"
                :btnvariant="ac.variant"
                :btnicon="ac.icon"
                @ok="ac.callback(seleccionadas)"
                footer="true"
              >
                {{ ac.txt }}
              </my-modal>
            </div>
          </div>
        </div>

        <input type="hidden" v-model="r_recargar" />
      </div>
    </div>

    <print2 v-if="urlprint" :url="urlprint" :tipo="typePrint"></print2>

    <modal-envia-docs
      @reload="recargarTabla"
      @hide="componenteEnviaDocs = false"
      v-if="componenteEnviaDocs"
      :tipodoc="docselec.codDoc"
      :id="docselec.id"
      :numerodoc="docselec.numeroDocumento"
      :correo="docselec.correoCliente"
    >
    </modal-envia-docs>

    <enviar-sri
      v-if="enviasri"
      :tipo="'seleccionados'"
      :url="preurlsri"
      :tipodoc="tipodoc"
      :seleccionados="seleccionadas"
      @reload="recargarTabla"
    ></enviar-sri>

    <enviar-sri
      v-if="compenviaCorreosMulti"
      :tipo="'seleccionadosOnlyCorreo'"
      :tipodoc="tipodoc"
      :seleccionados="seleccionadas"
      @reload="recargarTabla"
    ></enviar-sri>

    <modal-message
      v-if="showModalMsg"
      :alertModal="alertModal"
      :messageModal="messageModal"
      @result="exeFunction"
      @hideModalMessage="showModalMsg = false"
    >
    </modal-message>

    <modal-retencion
      v-if="retencion_selec"
      @reload="recargarTabla"
      @hide="retencion_selec = false"
      :retencion_id="retencion_selec"
    >
    </modal-retencion>
  </div>
</template>

<script>
export default {
  props: [
    "title",
    "url",
    "prefields",
    "preactions",
    "premultiactions",
    "prebuscadores",
    "reloadtabla",
    "campos",
    "predatosfiltros",
    "urldownloadxml",
    "urlprintdoc",
    "ticket",
    "correo",
    "urldownloaddoc",
    "tipodoc",
    "preurlsri",
  ],
  data() {
    return {
      reload: false,
      seleccionadas: [],
      items: [],
      fields: [],
      actions: [],
      multiactions: [],
      buscadores: [],
      page_options: [5, 10, 20, 25, 50],
      isBusy: false,
      mySortBy: "",
      mySortDesc: true,
      currentPage: 1,
      rows: 0,
      perPage: 5,
      recargas: 0,
      errores: {},
      filtros: "",
      datosfiltros: [],
      componenteEnviaDocs: false,
      compenviaCorreosMulti: false,
      docselec: [],
      urlprint: null,
      typePrint: null,
      enviasri: false,
      empresa_id_selec: null,
      documento_id_selec: null,
      showModalMsg: false,
      functionModalMsg: null,
      showModalMsg: null,
      alertModal: null,
      messageModal: null,
      retencion_selec: null,
      urlsri: null,
    };
  },
  methods: {
    showModalRet(retencion_id) {
      this.retencion_selec = retencion_id;
    },

    showModalMessage(message, alert, functionName) {
      this.alertModal = alert;
      this.messageModal = message;
      this.functionModalMsg = functionName;
      this.showModalMsg = false;
      self = this;
      setTimeout(function () {
        self.showModalMsg = true;
      }, 500);
    },
    exeFunction() {
      if (this.functionModalMsg == "enviaCorreosMulti") {
        this.enviaCorreosMulti();
      } else if (this.functionModalMsg == "enviaSriSelec") {
        this.enviaSriSelec();
      }
      this.showModalMsg = false;
    },
    enviaSriSelec() {
      this.enviasri = false;
      self = this;
      setTimeout(function () {
        self.enviasri = true;
      }, 500);
    },

    enviaCorreosMulti() {
      this.compenviaCorreosMulti = false;
      self = this;
      setTimeout(function () {
        self.compenviaCorreosMulti = true;
      }, 500);
    },

    printFactura(id) {
      this.urlprint = false;
      var self = this;
      this.typePrint = "factura";
      setTimeout(function () {
        // self.urlprint = "descargar-venta-pdf/" + id;
        self.urlprint = self.urlprintdoc + id;
      }, 500);
    },
    printTicket(id) {
      this.urlprint = false;
      var self = this;
      this.typePrint = "ticket";
      setTimeout(function () {
        self.urlprint = self.urlprintdoc + id;
        // self.urlprint = "descargar-venta-pdf/" + id;
      }, 500);
    },
    modalEnviaDocs(data) {
      this.docselec = data;
      this.componenteEnviaDocs = true;
    },
    seleccionarFilas(items) {
      this.seleccionadas = items;
    },
    selectAllRows() {
      this.seleccionadas = this.$refs["my-table"].selectAllRows();
    },
    clearSelected() {
      this.$refs["my-table"].clearSelected();
      this.seleccionadas = [];
    },

    async getItems(ctx) {
      try {
        this.isBusy = true;
        let buscar = this.filtros;
        await axios
          .get(
            this.url +
              "?page=" +
              this.currentPage +
              "&orderBy=" +
              this.mySortBy +
              "&perPage=" +
              this.perPage +
              "&orderDesc=" +
              (this.mySortDesc ? "desc" : "asc") +
              buscar
          )
          .then((r) => {
            this.isBusy = false;
            console.log(r.data);

            this.items = [];
            this.seleccionadas = [];
            this.items = r.data.data;

            this.currentPage = r.data.current_page;
            this.rows = r.data.total;
          })
          .catch((e) => {
            console.log(e.response.data);
            this.errores = JSON.parse(e.response.data.errors);
            this.isBusy = false;

            return this.items;
          });
      } catch (error) {
        console.log(error);
      }

      return this.items;
    },
    urlNow(url) {
      if (window.location.href.includes(url)) {
        return true;
      } else {
        return false;
      }
    },
    getFormValues(submitEvent) {
      this.filtros = "";

      for (let item of submitEvent.target.elements) {
        if (item.value && item.name) {
          this.filtros += "&" + item.name + "=" + item.value;
        }
      }
      this.recargarTabla();
    },
    recargarTabla() {
      console.log("recarga tabla");
      this.$refs["my-table"].refresh();
    },
  },
  mounted() {
    if (this.prefields) {
      this.fields =
        typeof this.prefields != "object"
          ? JSON.parse(this.prefields)
          : this.prefields;
    }
    if (this.preactions) {
      this.actions =
        typeof this.preactions != "object"
          ? JSON.parse(this.preactions)
          : this.preactions;
    }
    if (this.premultiactions) {
      this.multiactions =
        typeof this.premultiactions != "object"
          ? JSON.parse(this.premultiactions)
          : this.premultiactions;
    }
    if (this.prebuscadores) {
      this.buscadores =
        typeof this.prebuscadores != "object"
          ? JSON.parse(this.prebuscadores)
          : this.prebuscadores;
    }
    if (this.predatosfiltros) {
      this.datosfiltros = JSON.parse(this.predatosfiltros);
    }
    if (this.preurlsri) {
      this.urlsri = this.preurlsri;
    }
  },
  computed: {
    r_recargar: function () {
      if (this.reloadtabla > this.recargas) {
        this.$refs["my-table"].refresh();
        this.recargas = this.reloadtabla;
      }

      return this.reloadtabla ?? 0;
    },
  },
};
</script>

<style></style>

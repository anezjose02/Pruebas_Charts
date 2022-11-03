<template>
  <div>
    <title-menu :title="'Cajas efectivo'">
      <slot name="buttons"> </slot>
    </title-menu>

    <div v-if="loading" class="loader-sm">
      <div></div>
    </div>

    <div class="card">
      <div class="card-header">
        <h5>Cajas efectivo</h5>
      </div>
      <div class="card-body"></div>
    </div>
    <div class="card p-0">
      <div class="card-body p-0">
        <div
          class="table-responsive2"
          :class="{
            'min-height-responsive': items.length <= 2 && items.length != 0,
          }"
        >
          <b-table
            class="m-0"
            ref="my-table"
            :items="getItems"
            :fields="fields"
            hover
            select-mode="multi"
            selectable
            :sort-by.sync="mySortBy"
            :sort-desc.sync="mySortDesc"
            @row-selected="seleccionarFila"
          >
            <template #cell(action)="row">
              <div style="min-width: 125px">
                <div style="width: 40px; float: left" class="pt-1">
                  <label class="switch">
                    <input
                      name="activo"
                      :checked="row.item.estado == 'ABIERTA'"
                      type="checkbox"
                      @click.prevent="showModal(row.item)"
                    />
                    <span class="slider round"></span>
                  </label>
                </div>
              </div>
            </template>
            <template #cell(sucursales_estab)="row">
              {{ row.item.sucursales_estab }} -
              {{ row.item.sucursales_direccion }}
            </template>
          </b-table>
        </div>
        <div class="row child-buttons-square mt-2">
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
        </div>
      </div>
    </div>

    <b-modal
      no-close-on-backdrop
      body-class="p-0"
      ref="modal"
      :hide-header="true"
      :hide-footer="true"
      :size="'md'"
      lazy
      scrollable
    >
      <div class="modal-header">
        <h5>
          <span v-if="editCaja.estado == 'ABIERTA'">Cerrar</span>
          <span v-else>Abrir</span>
          Caja: {{ editCaja.nombre }}
        </h5>
        <span @click="hideModal" type="button" class="float-right">
          <i class="fas fa-times"></i>
        </span>
      </div>
      <div class="modal-body">
        <form @submit.prevent="save" id="form-cajas">
          <input type="hidden" name="caja_id" v-model="editCaja.id" />
          <input type="hidden" name="registro_id" v-model="editCaja.registro_id" />

          <div class="row">
            <div class="col-6">
              <label for="">Efectivo apertura</label>

              <input
                
                v-model="editCaja.valor_apertura"
                name="valor_apertura"
                type="number"
                class="
                  form-control form-control-sm
                  required
                  number
                  
                  maxnumber(999999999999)
                "
                step="0.01"
              />
              <div class="text-error">
                {{ errorsV.valor_apertura }}
              </div>
            </div>
            <div class="col-6" v-if="editCaja.estado == 'ABIERTA'">
              <label for="">Efectivo Cierre</label>

              <input
              
                
                v-model="editCaja.valor_cierre"
                name="valor_cierre"
                type="number"
                class="
                  form-control form-control-sm
                  required
                  number
                  maxnumber(999999999999)
                "
                step="0.01"
              />
              <div class="text-error">
                {{ errorsV.valor_cierre }}
              </div>
            </div>
          </div>
          <div class="row mt-4">
            <div class="col-12">
              <button
                type="submit"
                v-if="editCaja.estado == 'ABIERTA'"
                class="btn btn-danger float-right ml-1"
              >
                Cerrar caja
              </button>
              <button
                type="submit"
                v-else
                class="btn btn-primary float-right ml-1"
              >
                Abrir caja
              </button>
              <button
                @click="hideModal"
                type="button"
                class="btn btn-secondary float-right"
              >
                Cancelar
              </button>
            </div>
          </div>
        </form>
      </div>
    </b-modal>
  </div>
</template>

<script>
import moment from "moment";
import { validation } from "../../helpers";

export default {
  props: ["clienteid"],
  data() {
    return {
      fields: [
        // {
        //   key: "tipoCredito",
        //   label: "Tipo de crédito",
        //   sortable: true,
        //   formatter: (value, key, item) => {
        //     if (item.cliente_id > 0) {
        //       return "A CLIENTE";
        //     } else {
        //       return "DE PROVEEDOR";
        //     }
        //   },
        // },
        { key: "action", label: "Abrir/Cerrar", sortable: false },
        { key: "nombre", label: "Nombre", sortable: true },
        { key: "sucursales_estab", label: "Sucursal", sortable: true },
        // { key: "valor_apertura", label: "Efectivo Apertura", sortable: true },
      ],

      // sucursales_direccion
      items: [],
      currentPage: 1,
      rows: 0,
      mySortBy: "",
      mySortDesc: true,
      perPage: 5,
      page_options: [1, 5, 10, 20, 25, 50],
      filtros: "",
      cliente: "",
      loading: false,
      editCaja: [],
      errorsV: [],
    };
  },
  methods: {
    validate(value, valid) {
      return validation(value, valid);
    },
    save(submitEvent) {
      this.errorsV = [];
      let inputs =
        document.forms["form-cajas"].getElementsByClassName("form-control");
      let inputs2 =
        document.forms["form-cajas"].getElementsByClassName("custom-select");

      this.errorsV = this.validate(inputs, inputs2);

      if (Object.keys(this.errorsV).length != 0) {
        this.makeToast(
          "Error",
          "Algún campo fue completado de forma incorrecta.",
          "warning"
        );
        return;
      }
      this.loading = true;
      var data = {};
      for (let item of submitEvent.target.elements) {
        if (item.value && item.name && !item.disabled) {
          data[item.name] = item.value;
        }
      }
      this.send(data);
    },
    async send(data) {
      var url = window.location.origin + "/abrir-cerrar-caja";

      await axios
        .post(url, data)
        .then((r) => {
          // console.log(r.data);

          this.recargarTabla();
          this.hideModal();
        })
        .catch((e) => {
          console.log(e);
        });
      this.loading = false;
    },
    showModal(item) {
      this.editCaja = item;
      console.log(this.editCaja);
       
      
      // moment().now().format('MM/DD/YYYY hh:mm:ss a');
      this.$refs["modal"].show();
    },
    hideModal() {
      this.$refs["modal"].hide();
    },
    recargarTabla() {
      this.$refs["my-table"].refresh();
    },
    async getItems() {
      this.loading = true;
      let buscar = this.filtros;
      await axios
        .get(
          "/get-cajas-efectivo" +
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
          this.items = [];
          this.cliente = r.data.cliente;
          this.items = r.data.data;
          this.currentPage = r.data.current_page;
          this.rows = r.data.total;
        })
        .catch((e) => {
          console.log(e.response.data);
          this.errores = JSON.parse(e.response.data.errors);
        });
      this.loading = false;
      return this.items;
    },
    seleccionarFila(item) {
      this.$emit("creditoExist", item[0]);
    },
    close() {
      this.$emit("close");
    },
    makeToast(title, msg, variant = "secondary") {
      this.$bvToast.toast(msg, {
        title,
        autoHideDelay: 5000,
        variant,
      });
    },
  },

  mounted() {},
};
</script>


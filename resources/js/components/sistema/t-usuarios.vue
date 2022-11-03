<template>
  <div>
    <div class="loader-sm" v-if="loading"><div></div></div>
    <t-general
      title="Usuarios"
      url="/get-usuarios"
      :prefields="fields"
      :preactions="actions"
      :premultiactions="multiactions"
      :prebuscadores="buscadores"
      :reloadtabla.sync="reloadtabla"
    >
      <b-btn
        class="btn-sm float-right"
        v-if="essuperuser || puedecrear"
        variant="success"
        @click="showModal()"
      >
        <i class="fas fa-plus"></i>
      </b-btn>
    </t-general>

    <b-modal
      ref="my-modal"
      :title="
        newUsuario && newUsuario.id
          ? 'Usuario - ' + newUsuario.name
          : 'Nuevo Usuario'
      "
      hide-footer
      size="xl"
    >
      <center v-if="cargando">
        <h1>
          <b-spinner></b-spinner>
          Cargando...
        </h1>
      </center>
      <div v-else-if="newUsuario" class="row">
        <b-form-group
          class="col-12 col-sm-3"
          label=""
          label-class="text-danger"
          label-size="sm"
        >
          <label for="">Nombre: <span class="text-danger">*</span> </label>
          <b-form-input
            v-model="newUsuario.name"
            size="sm"
            placeholder="Juan Perez"
          ></b-form-input>
        </b-form-group>
        <b-form-group
          class="col-12 col-sm-3"
          label=""
          label-class="text-danger"
          label-size="sm"
        >
          <label for="">Email: <span class="text-danger">*</span> </label>
          <b-form-input
            v-model="newUsuario.email"
            size="sm"
            placeholder="test@empresa.com"
          ></b-form-input>
        </b-form-group>
        <b-form-group class="col-12 col-sm-3" label="Rol:" label-size="sm">
          <b-form-select
            @change="setPermisosRol"
            v-model="newUsuario.rol"
            size="sm"
            :options="roles"
          ></b-form-select>
        </b-form-group>
        <b-form-group
          v-if="!newUsuario.id"
          class="col-3"
          label-class="text-danger"
          label-size="sm"
        >
          <label for="">Contraseña: <span class="text-danger">*</span> </label>
          <b-form-input
            v-model="newUsuario.password"
            size="sm"
            placeholder="*******"
            type="password"
          ></b-form-input>
        </b-form-group>

        <div class="col-12">
          <div class="accordion row" role="tablist">
            <div
              class="col-12 col-lg-4 col-sm-6 col-xl-3"
              v-for="(m, i) in modulos"
              :key="i"
            >
              <b-card no-body class="mb-1 card-round">
                <b-card-header
                  v-b-toggle="'accordion-' + m"
                  header-tag="header"
                  class="p-1 hover"
                  role="tab"
                >
                  <b-button
                    class="float-right"
                    v-b-toggle="'accordion-' + m"
                    variant="success"
                    size="sm"
                  >
                    <i class="fas fa-chevron-down"></i>
                  </b-button>
                  <h5>{{ m }}</h5>
                </b-card-header>
                <b-collapse
                  :id="'accordion-' + m"
                  accordion="my-accordion"
                  role="tabpanel"
                >
                  <b-card-body>
                    <span v-for="(p, ip) in permisos" :key="ip">
                      <b-form-checkbox
                        v-model="p.check"
                        @input="seleccionarPermisos(ip)"
                        v-if="p.value.indexOf(m) > -1"
                        value="1"
                        size="sm"
                        unchecked-value="0"
                      >
                        {{ p.text }}
                      </b-form-checkbox>
                    </span>
                  </b-card-body>
                </b-collapse>
              </b-card>
            </div>
          </div>
        </div>

        <!-- <div class="row">
          <div class="col-4">
            <div class="form-check">
              <input
                type="checkbox"
                class="form-check-input"
                id="exampleCheck1"
              />
              <label class="form-check-label" for="exampleCheck1"
                > Editar contraseña </label
              >
            </div>
          </div>
        </div> -->

        <b-form-group class="col-12" label="Empresas:" label-size="sm">
          <b-form-checkbox-group
            :options="empresas"
            v-model="newUsuario.en_empresas"
          ></b-form-checkbox-group>
        </b-form-group>
        <b-form-group class="col-12" label="Sucursales:" label-size="sm">
          <b-form-checkbox-group
            :options="sucursales"
            v-model="newUsuario.en_sucursales"
          ></b-form-checkbox-group>
        </b-form-group>
        <b-form-group class="col-12" label="Puntos de emisión:" label-size="sm">
          <b-form-checkbox-group
            :options="puntos"
            v-model="newUsuario.en_puntos"
          ></b-form-checkbox-group>
        </b-form-group>
        <b-form-group class="col-12" label="Cajas:" label-size="sm">
          <b-form-checkbox-group
            :options="cajas"
            v-model="newUsuario.en_cajas"
          ></b-form-checkbox-group>
        </b-form-group>
        <b-form-group class="col-12" label="Almacenes:" label-size="sm">
          <b-form-checkbox-group
            :options="almacenes"
            v-model="newUsuario.en_almacenes"
          ></b-form-checkbox-group>
        </b-form-group>

        <div class="col-12 mt-2">
          <b-btn class="float-right" variant="primary" @click="saveUsuario">
            <i class="fas fa-save"></i> Guardar
          </b-btn>
        </div>
      </div>
    </b-modal>

    <b-modal
      ref="modal-pass"
      :title="'Cambiar contraseña'"
      hide-footer
      size="lg"
    >
      <form id="frm" @submit.prevent="savePass">
        <div class="row" v-if="newUsuario">
          <input
            class="form-control form-control-ms required"
            type="hidden"
            name="id"
            v-model="newUsuario.id"
          />
          <b-form-group class="col-4" label-class="text-danger" label-size="sm">
            <label for="">Usuario: <span class="text-danger">*</span> </label>
            <b-form-input
              name="email"
              class="email required"
              v-model="newUsuario.email"
              size="sm"
              placeholder=""
              type="text"
            ></b-form-input>
            <span class="text-error"> {{ errorsV.email }} </span>
          </b-form-group>
          <b-form-group class="col-4" label-class="text-danger" label-size="sm">
            <label for=""
              >Contraseña: <span class="text-danger">*</span>
            </label>
            <b-form-input
              name="password"
              class="required min(4)"
              v-model="newUsuario.password"
              size="sm"
              placeholder="*******"
              type="password"
            ></b-form-input>
            <span class="text-error"> {{ errorsV.password }} </span>
          </b-form-group>
          <div class="col-12 mt-2">
            <b-btn type="submit" class="float-right" variant="primary">
              <i class="fas fa-save"></i> Guardar
            </b-btn>
          </div>
        </div>
      </form>
    </b-modal>
  </div>
</template>

<script>
import moment from "moment";
import { validation } from "../../helpers.js";

export default {
  props: ["essuperuser", "puedecrear", "puedeeditar", "premodulos"],
  data() {
    return {
      loading: false,
      errorsV: [],
      fields: [
        { key: "action", label: "Acción", sortable: false },
        { key: "email", label: "Email", sortable: true },
        { key: "name", label: "Nombre", sortable: true },
        {
          key: "activo",
          label: "Activo",
          sortable: true,
          formatter: (value) => {
            if (value) {
              return "SI";
            } else {
              return "NO";
            }
          },
        },
        { key: "rol", label: "Rol", sortable: true },
        { key: "licencia", label: "Licencia", sortable: true },
      ],
      actions: [],
      multiactions: [],
      buscadores: [],

      reloadtabla: 0,

      cargando: false,

      newUsuario: null,

      permisos: [],
      modulos: [],
      roles: [],
      empresas: [],
      sucursales: [],
      puntos: [],
      cajas: [],
      almacenes: [],
    };
  },
  methods: {
    async setPermisosRol() {
      this.cargando = true;
      await setTimeout(() => {
        for (let i = 0; i < this.roles.length; i++) {
          if (this.roles[i].value == this.newUsuario.rol) {
            this.newUsuario.permisos = JSON.parse(this.roles[i].permisos);
          }
        }
        for (let i = 0; i < this.permisos.length; i++) {
          this.permisos[i].check = 0;

          if (this.newUsuario.permisos.indexOf(this.permisos[i].value) > -1) {
            this.permisos[i].check = 1;
          }
        }

        console.log(this.newUsuario.permisos);

        this.filtrarModulos();

        this.cargando = false;
      }, 500);
    },
    seleccionarPermisos(ip) {
      if (this.permisos[ip].check == 1) {
        this.newUsuario.permisos.push(this.permisos[ip].value);
      } else {
        for (let i = 0; i < this.newUsuario.permisos.length; i++) {
          if (this.newUsuario.permisos[i] == this.permisos[ip].value) {
            this.newUsuario.permisos.splice(i, 1);
            i--;
          }
        }
      }

      this.filtrarModulos();
    },

    filtrarModulos() {
      for (let i = 0; i < this.newUsuario.permisos.length; i++) {
        let x = this.newUsuario.permisos[i].split(".");

        this.newUsuario.modulos.push(x[0]);
      }

      for (let i = 0; i < this.newUsuario.modulos.length; i++) {
        for (let j = i + 1; j < this.newUsuario.modulos.length; j++) {
          if (this.newUsuario.modulos[i] == this.newUsuario.modulos[j]) {
            this.newUsuario.modulos.splice(j, 1);
            j--;
          }
        }
      }
    },
    showModal(item = null) {
      if (item) {
        this.newUsuario = Object.assign({}, item, {
          permisos: JSON.parse(item.permisos),
          modulos: JSON.parse(item.modulos),
          en_empresas: JSON.parse(item.en_empresas),
          en_sucursales: JSON.parse(item.en_sucursales),
          en_puntos: JSON.parse(item.en_puntos),
          en_cajas: JSON.parse(item.en_cajas),
          en_almacenes: JSON.parse(item.en_almacenes),
        });
        this.newUsuario.password = "";
        console.log(this.newUsuario);
      } else {
        this.newUsuario = {
          name: "",
          email: "",
          password: "",
          rol: "",
          permisos: [],
          modulos: [],
          en_empresas: [],
          en_sucursales: [],
          en_puntos: [],
          en_cajas: [],
          en_almacenes: [],
        };
      }

      for (let i = 0; i < this.permisos.length; i++) {
        this.permisos[i].check = 0;

        if (this.newUsuario.permisos) {
          if (this.newUsuario.permisos.indexOf(this.permisos[i].value) > -1) {
            this.permisos[i].check = 1;
          }
        }
      }

      this.$refs["my-modal"].show();
    },
    hideModal() {
      this.$refs["my-modal"].hide();
      this.$refs["modal-pass"].hide();

      this.newUsuario = null;
    },
    async getPermisos() {
      await axios
        .get("/get-constante-permisos")
        .then((r) => {
          this.permisos = r.data;
        })
        .catch((e) => {
          console.log(e);
        });
    },
    async getRoles() {
      await axios
        .get("/get-all-roles")
        .then((r) => {
          for (let i = 0; i < r.data.length; i++) {
            let x = {
              value: r.data[i].nombre,
              text: r.data[i].nombre,
              permisos: r.data[i].permisos,
            };

            this.roles.push(x);
          }
        })
        .catch((e) => {
          console.log(e);
        });
    },
    async getEmpresas() {
      await axios
        .get("/get-all-empresas")
        .then((r) => {
          for (let i = 0; i < r.data.length; i++) {
            let x = {
              value: r.data[i].id,
              text: r.data[i].nombreComercial
                ? r.data[i].nombreComercial
                : r.data[i].razonSocial,
            };

            this.empresas.push(x);
          }
        })
        .catch((e) => {
          console.log(e);
        });
    },
    async getSucursales() {
      await axios
        .get("/get-all-sucursales")
        .then((r) => {
          for (let i = 0; i < r.data.length; i++) {
            let x = {
              value: r.data[i].id,
              text: r.data[i].estab,
            };

            this.sucursales.push(x);
          }
        })
        .catch((e) => {
          console.log(e);
        });
    },
    async getPuntos() {
      await axios
        .get("/get-all-puntos")
        .then((r) => {
          for (let i = 0; i < r.data.length; i++) {
            let x = {
              value: r.data[i].id,
              text: r.data[i].ptoEmi,
            };

            this.puntos.push(x);
          }
        })
        .catch((e) => {
          console.log(e);
        });
    },
    async getCajas() {
      await axios
        .get("/get-all-cajas")
        .then((r) => {
          for (let i = 0; i < r.data.length; i++) {
            let x = {
              value: r.data[i].id,
              text: r.data[i].nombre,
            };

            this.cajas.push(x);
          }
        })
        .catch((e) => {
          console.log(e);
        });
    },
    async getAlmacenes() {
      await axios
        .get("/get-all-almacenes")
        .then((r) => {
          for (let i = 0; i < r.data.length; i++) {
            let x = {
              value: r.data[i].id,
              text: r.data[i].nombre,
            };

            this.almacenes.push(x);
          }
        })
        .catch((e) => {
          console.log(e);
        });
    },
    async saveUsuario() {
      let faltantes =
        "" +
        (!this.newUsuario.name ? " Nombre." : "") +
        (!this.newUsuario.email ? " Email." : "");
      if (faltantes) {
        this.makeToast("Campos obligatorios:", faltantes, "danger");
        return;
      }

      this.cargando = true;
      if (this.newUsuario.id) {
        delete this.newUsuario["password"];
      }
      await axios
        .post(
          "/usuario" + (this.newUsuario.id ? "/" + this.newUsuario.id : ""),
          this.newUsuario
        )
        .then((r) => {
          this.reloadtabla++;
          this.cargando = false;
          this.hideModal();
          if (r.data) {
            this.makeToast("Exito", "Datos guardados exitosamente.", "success");
          } else {
            this.makeToast(
              "Limite de plan",
              "Límite de creacion alcanzado, para crear mas elementos solicite un plan avanzado.",
              "warning"
            );
          }
        })
        .catch((e) => {
          console.log(e);
          this.makeToast(
            "Error",
            "Existió un error al intentar guardar los datos.",
            "danger"
          );
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
    showModalPass(item) {
      this.newUsuario = { id: item.id, email: item.email, password: "" };
      this.$refs["modal-pass"].show();
    },
    async savePass(submitEvent) {
      this.errorsV = [];
      let inputs = document.forms["frm"].getElementsByClassName("form-control");
      let inputs2 =
        document.forms["frm"].getElementsByClassName("custom-select");
      this.errorsV = this.validate(inputs, inputs2);

      if (Object.keys(this.errorsV).length != 0) {
        this.makeToast(
          "Atención",
          "Algunos campos estan escritos de forma incorrecta. verifique e intente nuevamente",
          "warning"
        );
        return;
      }
      this.loading = true;
      var data = {};
      for (let item of submitEvent.target.elements) {
        if (item.value && item.name) {
          data[item.name] = item.value;
        }
      }
      await axios
        .post("/cambiar-contraseña-usuario", data)
        .then((r) => {
          this.loading = false;

          this.makeToast("Éxito", "Petición realizada con éxito.", "success");
          this.hideModal();
          this.reloadtabla++;
        })
        .catch((e) => {
          this.loading = false;
        });
    },
    validate(value, valid) {
      return validation(value, valid);
    },
  },
  mounted() {
    if (this.essuperuser || this.puedeeditar) {
      this.actions.push({
        tooltip: "Editar",
        variant: "primary",
        icon: "pen",
        callback: this.showModal,
      });

      this.actions.push({
        tooltip: "Cambiar contraseña",
        variant: "primary",
        icon: "key",
        callback: this.showModalPass,
      });
    }

    if (this.premodulos) {
      this.modulos = JSON.parse(this.premodulos);
    }
    this.getPermisos();
    this.getRoles();
    this.getEmpresas();
    this.getSucursales();
    this.getPuntos();
    this.getCajas();
    this.getAlmacenes();
  },
};
</script>

<style>
</style>
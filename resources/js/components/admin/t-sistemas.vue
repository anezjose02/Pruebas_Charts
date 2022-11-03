<template>
  <div>
    <t-general
      title="Sistemas"
      url="/admin/get-sistemas"
      :prefields="fields"
      :preactions="actions"
      :premultiactions="multiactions"
      :prebuscadores="buscadores"
      :reloadtabla.sync="reloadtabla"
    >
      <b-btn
        size="sm"
        class="float-right"
        variant="success"
        @click="showModal()"
      >
        <i class="fas fa-plus"></i>
      </b-btn>
    </t-general>

    <b-modal
      ref="my-modal"
      :title="
        newSistema && newSistema.id
          ? 'Sitema - ' + newSistema.nombre
          : 'Nuevo sistema'
      "
      hide-footer
    >
      <center v-if="cargando">
        <h1>
          <b-spinner></b-spinner>
          Cargando...
        </h1>
      </center>

      <div v-else-if="newSistema" class="row">
        <b-form-group
          class="col-12 col-sm-6"
          label=""
          label-class="text-danger"
          label-size="sm"
        >
          <label for=""> Nombre: <span class="text-danger">*</span> </label>
          <b-form-input
            v-model="newSistema.nombre"
            size="sm"
            placeholder="Sistema 1"
          ></b-form-input>
        </b-form-group>
        <b-form-group
          class="col-12 col-sm-6"
          label=""
          label-class="text-danger"
          label-size="sm"
        >
          <label for=""> Plan: <span class="text-danger">*</span> </label>
          <b-form-select
            :options="planes"
            size="sm"
            v-model="newSistema.plan"
          ></b-form-select>
        </b-form-group>
        <b-form-group
          v-if="!newSistema.id"
          class="col-12 col-sm-6"
          label=""
          label-class="text-danger"
          label-size="sm"
        >
          <label for="">
            Nombre usuario: <span class="text-danger">*</span>
          </label>
          <b-form-input
            v-model="newSistema.name"
            size="sm"
            placeholder="Juan Perez"
          ></b-form-input>
        </b-form-group>
        <b-form-group
          v-if="!newSistema.id"
          class="col-12 col-sm-6"
          label=""
          label-class="text-danger"
          label-size="sm"
        >
          <label for=""> Email: <span class="text-danger">*</span> </label>
          <b-form-input
            v-model="newSistema.email"
            size="sm"
            placeholder="email@ejemplo.com"
          ></b-form-input>
        </b-form-group>
        <b-form-group
          v-if="!newSistema.id"
          class="col-12 col-sm-6"
          label=""
          label-class="text-danger"
          label-size="sm"
        >
          <label for=""> Contraseña: <span class="text-danger">*</span> </label>
          <b-form-input
            
            v-model="newSistema.password"
            size="sm"
            placeholder="********"
            type="password"
          ></b-form-input>
        </b-form-group>

        <div class="col-12 mt-2">
          <b-btn variant="primary float-right" @click="saveSistema">
            Guardar
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
            <div class="text-error">{{ errorsV.email }}</div>
          </b-form-group>
          <b-form-group class="col-4" label-class="text-danger" label-size="sm">
            <label for=""
              >Contraseña: <span class="text-danger">*</span>
            </label>
            <b-form-input
              name="password"
              v-model="newUsuario.password"
              class="required min(4)"
              size="sm"
              placeholder="*******"
              type="password"
            ></b-form-input>
            <div class="text-error">{{ errorsV.password }}</div>
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
import { validation } from "../../helpers.js";
export default {
  props: ["essuperuser", "editarsuclave"],
  data() {
    return {
      fields: [
        { key: "action", label: "Acción", sortable: false },
        { key: "nombre", label: "Nombre", sortable: true },
        { key: "plan", label: "Plan", sortable: true },
        { key: "email", label: "Administrador", sortable: true },
        { key: "licencia", label: "Licencia", sortable: true },
        { key: "precio", label: "Precio", sortable: true },
        { key: "limite_facturas", label: "Max. Facturas", sortable: true },
        { key: "max_empresas", label: "Max. Empresas", sortable: true },
        { key: "max_sucursales", label: "Max. Sucursales", sortable: true },
        { key: "max_usuarios", label: "Max. Usuarios", sortable: true },
        { key: "max_puntos", label: "Max. Puntos de emisión", sortable: true },
        { key: "max_cajas", label: "Max. Cajas", sortable: true },
      ],
      actions: [
        {
          variant: "info",
          icon: "pen",
          callback: this.showModal,
        },

        {
          rapida: true,
          txt: "¿Desea borrar este sistema?",
          variant: "danger",
          icon: "trash",
          callback: this.delSistema,
        },
        {
          rapida: true,
          txt: "¿Desea tomar poseción temporal de este sistema?",
          variant: "dark",
          icon: "globe",
          callback: this.posSistema,
        },
      ],
      multiactions: [],
      buscadores: [],
      reloadtabla: 0,
      cargando: false,
      newSistema: null,
      planes: [],
      newUsuario: [],
      errorsV: [],
    };
  },
  methods: {
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
        .post("/admin/cambiar-contraseña-sistema", data)
        .then((r) => {
          console.log(r.data);
          this.loading = false;

          this.makeToast("Éxito", "Petición realizada con éxito.", "success");
          this.hideModal();
          this.reloadtabla++;
        })
        .catch((e) => {
          console.log(e);
          this.loading = false;
        });
    },
    validate(value, valid) {
      return validation(value, valid);
    },
    showModal(item = null) {
      if (item) {
        this.newSistema = Object.assign({}, item, {
          modulos: JSON.parse(item.modulos),
        });
      } else {
        this.newSistema = {
          nombre: "",
          plan: "",
          password: "",
          name: "",
          email: "",
        };
      }

      this.$refs["my-modal"].show();
    },
    hideModal() {
      this.$refs["my-modal"].hide();
      this.$refs["modal-pass"].hide();

      this.newSistema = null;
    },
    async getPlanes() {
      await axios
        .get("/admin/get-all-planes")
        .then((r) => {
          for (let i = 0; i < r.data.length; i++) {
            this.planes.push(r.data[i].nombre);
          }
        })
        .catch((e) => {
          console.log(e);
        });
    },
    async saveSistema() {
      let faltantes =
        "" +
        (!this.newSistema.nombre ? " Nombre." : "") +
        (!this.newSistema.plan ? " Plan." : "") +
        (!this.newSistema.name && !this.newSistema.id
          ? " Nombre del usuario."
          : "") +
        (!this.newSistema.email && !this.newSistema.id ? " Email." : "") +
        (!this.newSistema.password && !this.newSistema.id
          ? " Contraseña."
          : "");
      if (faltantes) {
        this.makeToast("Campos obligatorios:", faltantes, "danger");
        return;
      }

      this.cargando = true;
      await axios
        .post(
          "/admin/sistema" +
            (this.newSistema.id ? "/" + this.newSistema.id : ""),
          this.newSistema
        )
        .then((r) => {
          console.log("saveEmpresaXXXX");
          console.log(r.data);

          this.reloadtabla++;
          this.cargando = false;
          this.hideModal();
          this.makeToast("Exito", "Datos guardados exitosamente.", "success");
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
    async delSistema(item) {
      await axios
        .get("/admin/delete-sistema/" + item.id)
        .then((r) => {
          this.reloadtabla++;
          this.makeToast("Exito", "Datos eliminados exitosamente.", "success");
        })
        .catch((e) => {
          console.log(e);
          this.makeToast(
            "Error",
            "Existió un error al intentar borrar los datos.",
            "danger"
          );
        });
    },
    posSistema(item) {
      location.replace("/admin/controlar-sistema/" + item.id);
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
    if (this.essuperuser || this.editarsuclave) {
    this.actions.push({
      variant: "primary",
      icon: "key",
      callback: this.showModalPass,
    });
    }
    this.getPlanes();
  },
};
</script>

<style></style>

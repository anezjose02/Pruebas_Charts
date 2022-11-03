<template>
  <div>
    <t-general
      title="Empresas"
      url="/get-empresas"
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
        newEmpresa && newEmpresa.id
          ? 'Empresa - ' + newEmpresa.nombreComercial
          : 'Nueva Empresa'
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
      <div v-else-if="newEmpresa" class="row">

          <div class="col-12 col-lg-3">
          <b-form-group>
            <label for=""> Logo:(PNG,JPG,JPEG) </label>
            <b-form-file
              v-model="newEmpresa.file_1"
              accept="image/png, image/jpeg, image/jpg"
              :state="true"
              placeholder="Seleccione una imagen..."
              drop-placeholder="Arrastre su imagen aqui..."
              size="sm"
            ></b-form-file>
          </b-form-group>

          <center v-if="newEmpresa.logo">
            <img
              :src="'/files/img/' + newEmpresa.logo"
              class="img-fluid"
              alt="Logo de empresa"
            />
          </center>
        </div>

           <b-form-group
          class="col-12 col-md-12 col-lg-3"
          label-class="text-danger"
          label-size="sm"
        >
          <label for=""> RUC: <span class="text-danger">*</span> </label>
          <b-form-input
            @change="getPersona"
            @keyup="getPersona"
            v-model="newEmpresa.ruc"
            size="sm"
            placeholder="1721721723001"
          ></b-form-input>
        </b-form-group>

      

        <b-form-group
          class="col-12 col-lg-3"
          label-class="text-danger"
          label-size="sm"
        >
          <label for="">
            Nombre Comercial: <span class="text-danger">*</span>
          </label>
          <b-form-input
            v-model="newEmpresa.nombreComercial"
            size="sm"
            placeholder="Mi empresa"
          ></b-form-input>
        </b-form-group>
        <b-form-group
          class="col-12 col-lg-3"
          label-class="text-danger"
          label-size="sm"
        >
          <label for="">
            Razón social: <span class="text-danger">*</span>
          </label>
          <b-form-input
            v-model="newEmpresa.razonSocial"
            size="sm"
            placeholder="Mi empresa"
          ></b-form-input>
        </b-form-group>

     

        <b-form-group
          class="col-12 col-md-12 col-lg-6"
          label-class="text-danger"
          label-size="sm"
        >
          <label for="">
            Dirección matriz: <span class="text-danger">*</span>
          </label>
          <b-form-input
            v-model="newEmpresa.dirMatriz"
            size="sm"
            placeholder="Av. Colon y 10 de Agosto"
          ></b-form-input>
        </b-form-group>

        <b-form-group
          class="col-12 col-lg-3"
          label="Representante:"
          label-size="sm"
        >
          <b-form-input
            v-model="newEmpresa.representante"
            size="sm"
            placeholder="Juan Perez"
          ></b-form-input>
        </b-form-group>
        <b-form-group
          class="col-12 col-lg-3"
          label="RUC representante:"
          label-size="sm"
        >
          <b-form-input
            v-model="newEmpresa.representanteruc"
            size="sm"
            placeholder="1721721723001"
          ></b-form-input>
        </b-form-group>
        <b-form-group
          class="col-12 col-lg-3"
          label="Obligado contabilidad:"
          label-size="sm"
        >
          <b-form-select
            v-model="newEmpresa.obligadoContabilidad"
            :options="['SI', 'NO']"
            size="sm"
          ></b-form-select>
        </b-form-group>

        <b-form-group class="col-12 col-lg-3" label="Web:" label-size="sm">
          <b-form-input
            v-model="newEmpresa.web"
            size="sm"
            placeholder="mi-web.com"
          ></b-form-input>
        </b-form-group>
        <b-form-group class="col-12 col-lg-3" label="Celular:" label-size="sm">
          <b-form-input
            v-model="newEmpresa.celular"
            size="sm"
            placeholder="0959959099"
          ></b-form-input>
        </b-form-group>
        <b-form-group class="col-12 col-lg-3" label="Teléfono:" label-size="sm">
          <b-form-input
            v-model="newEmpresa.telefono"
            size="sm"
            placeholder="02 333 3333"
          ></b-form-input>
        </b-form-group>
        <b-form-group class="col-12 col-lg-3" label="Email:" label-size="sm">
          <b-form-input
            v-model="newEmpresa.email"
            size="sm"
            placeholder="mi@web.com"
          ></b-form-input>
        </b-form-group>

        <b-form-group
          class="col-12 col-lg-3"
          label="Agente de retención:"
          label-size="sm"
        >
          <b-form-select
            v-model="newEmpresa.agenteRetencion"
            size="sm"
            :options="agentes"
          ></b-form-select>
        </b-form-group>
        <b-form-group
          class="col-12 col-lg-3"
          label="Contribuyente especial:"
          label-size="sm"
        >
          <b-form-input
            v-model="newEmpresa.contribuyenteEspecial"
            size="sm"
            placeholder="596"
          ></b-form-input>
        </b-form-group>
        <b-form-group
          class="col-12 col-lg-3"
          label="Código de empresa:"
          label-size="sm"
        >
          <b-form-input
            v-model="newEmpresa.codigoempresa"
            size="sm"
            placeholder="1234"
          ></b-form-input>
        </b-form-group>
        <b-form-group
          class="col-12 col-lg-3"
          label="Código del artesano:"
          label-size="sm"
        >
          <b-form-input
            v-model="newEmpresa.codigoartesano"
            size="sm"
            placeholder="1234"
          ></b-form-input>
        </b-form-group>

        <b-form-group label="Firma electrónica: (P12)" class="col-12 col-lg-3">
          <b-form-file
            v-model="newEmpresa.file_2"
            accept=".p12"
            :state="true"
            placeholder="Seleccione firma electrónica..."
            drop-placeholder="Arrastre su firma electrónica aqui..."
            size="sm"
          ></b-form-file>
        </b-form-group>
        <b-form-group
          class="col-12 col-lg-3"
          label="Clave de la firma:"
          label-size="sm"
        >
          <b-form-input
            v-model="newEmpresa.firmaclave"
            size="sm"
            placeholder="1234"
          ></b-form-input>
        </b-form-group>
        <b-form-group
          class="col-12 col-lg-3"
          label="Clave del SRI:"
          label-size="sm"
        >
          <b-form-input
            v-model="newEmpresa.clavesri"
            size="sm"
            placeholder="1234"
          ></b-form-input>
        </b-form-group>
        <b-form-group
          class="col-12 col-lg-3"
          label="F. vencimiento firma:"
          label-size="sm"
        >
          <b-form-input
            v-model="newEmpresa.firmavence"
            size="sm"
            placeholder="1234"
            type="date"
          ></b-form-input>
        </b-form-group>

        <b-form-group
          class="col-12"
          label="Tipo de contribuyente:"
          label-size="sm"
        >
          <b-form-radio-group
            v-model="newEmpresa.tipocontribuyente"
            :options="[
              'RÉGIMEN GENERAL',
              'CONTRIBUYENTE RÉGIMEN RIMPE',
              'CONTRIBUYENTE NEGOCIO POPULAR - RÉGIMEN RIMPE',
            ]"
          ></b-form-radio-group>
        </b-form-group>

        


        <div class="col-12 mt-2">
          <b-btn variant="primary float-right" @click="saveEmpresa">
            Guardar
          </b-btn>
        </div>
      </div>
    </b-modal>
  </div>
</template>

<script>
export default {
  props: ["essuperuser", "puedecrear", "puedeeditar", "puedeborrar"],
  data() {
    return {
      fields: [
        { key: "action", label: "Acción", sortable: false },
        {
          key: "nombreComercial",
          label: "Nombre Comercial",
          sortable: true,
        },
        { key: "razonSocial", label: "Razón Social", sortable: true },
        { key: "ruc", label: "RUC", sortable: true },
        { key: "dirMatriz", label: "Dir. Matriz", sortable: true },
        {
          key: "agenteRetencion",
          label: "Agente de retención",
          sortable: true,
        },
        {
          key: "representante",
          label: "Representante",
          sortable: true,
        },
        {
          key: "representanteruc",
          label: "RUC Representante",
          sortable: true,
        },
        { key: "celular", label: "Celular", sortable: true },
        { key: "telefono", label: "Teléfono", sortable: true },
        { key: "web", label: "Sitio web", sortable: true },
        { key: "email", label: "Email", sortable: true },
        {
          key: "contribuyenteEspecial",
          label: "Contribuyente especial",
          sortable: true,
        },
        {
          key: "obligadoContabilidad",
          label: "Obligado a llevar contabilidad",
          sortable: true,
        },
      ],
      actions: [],
      multiactions: [],
      buscadores: [],

      reloadtabla: 0,

      cargando: false,

      newEmpresa: null,

      agentes: [{ value: "", text: "-Ninguno-" }],
    };
  },
  methods: {
    showModal(item = null) {
      if (item) {
        console.log(item);
        this.newEmpresa = Object.assign({}, item);
        this.newEmpresa.file_1 = null;
        this.newEmpresa.file_2 = null;

        Object.keys(this.newEmpresa).forEach((key) => {
          if (this.newEmpresa[key] == "null") {
            this.newEmpresa[key] = null;
          }
        });
      } else {
        this.newEmpresa = {
          ruc: "",
          dirMatriz: "",
          razonSocial: "",
          nombreComercial: "",
          agenteRetencion: "",
          representante: "",
          representanteruc: "",
          celular: "",
          telefono: "",
          web: "",
          email: "",
          contribuyenteEspecial: "",
          obligadoContabilidad: "NO",
          codigoempresa: "",
          codigoartesano: "",
          firmaclave: "",
          clavesri: "",
          firmavence: "",
          tipocontribuyente: "RÉGIMEN GENERAL",

          file_1: null,
          file_2: null,
        };
      }

      this.$refs["my-modal"].show();
    },
    hideModal() {
      this.$refs["my-modal"].hide();
      this.newEmpresa = null;
    },
    async getAgentes() {
      await axios
        .get("/get-all-agentes")
        .then((r) => {
          for (let i = 0; i < r.data.length; i++) {
            let x = {
              value: r.data[i].codigo,
              text: r.data[i].nombre + " (" + r.data[i].codigo + ")",
            };
            this.agentes.push(x);
          }
        })
        .catch((e) => {
          console.log(e);
        });
    },
    async getPersona() {
      if (this.newEmpresa.ruc.length != 13) {
        return;
      }

      await axios
        .get("/get-persona/" + this.newEmpresa.ruc)
        .then((r) => {
          if (r.data) {
            this.newEmpresa.razonSocial = r.data.RAZON_SOCIAL;
            this.newEmpresa.nombreComercial = r.data.NOMBRE_COMERCIAL;
            this.newEmpresa.dirMatriz = r.data.direccion;
            this.newEmpresa.telefono = r.data.telefono;
            this.newEmpresa.celular = r.data.celular;
            this.newEmpresa.email = r.data.email;
            this.newEmpresa.representanteruc = r.data.identificacion;
            this.newEmpresa.representante = r.data.razonsocial;
          }
        })
        .catch((e) => {
          console.log(e);
        });
    },
    async saveEmpresa() {
      let faltantes =
        "" +
        (!this.newEmpresa.ruc ? " RUC." : "") +
        (!this.newEmpresa.dirMatriz ? " Dirección matriz." : "") +
        (!this.newEmpresa.razonSocial ? " Razón social." : "") +
        (!this.newEmpresa.nombreComercial ? " Nombre Comercial." : "");
      if (faltantes) {
        this.makeToast("Campos obligatorios:", faltantes, "danger");
        return;
      }
      if (this.newEmpresa.ruc.length != 13) {
        this.makeToast(
          "Error:",
          "El ruc tiene que tener 13 digitos.",
          "danger"
        );
        return;
      }
      if (this.newEmpresa.file_1) {
        let extimgA = this.newEmpresa.file_1.name.split(".");
        let extimg = extimgA[extimgA.length - 1];

        if (
          extimg != "PNG" &&
          extimg != "png" &&
          extimg != "jpg" &&
          extimg != "JPG" &&
          extimg != "JPEG" &&
          extimg != "jpeg"
        ) {
          this.makeToast(
            "Error de archivos:",
            "El logo solo puede ser una inagen PNG, JPG o JPEG, porfavor elija otra.",
            "danger"
          );
          return;
        }
      }
      if (this.newEmpresa.file_2) {
        let extimgA = this.newEmpresa.file_2.name.split(".");
        let extimg = extimgA[extimgA.length - 1];

        if (extimg != "P12" && extimg != "p12") {
          this.makeToast(
            "Error de archivos:",
            "La firma electrónica tiene que ser un archivo P12.",
            "danger"
          );
          return;
        }
      }
      if (
        this.newEmpresa.firmavence == null ||
        this.newEmpresa.firmavence == "null"
      ) {
        this.newEmpresa.firmavence = "";
      }

      let formData = new FormData();
      Object.keys(this.newEmpresa).forEach((key) =>
        formData.append(key, this.newEmpresa[key])
      );

      formData.append("file_1", this.newEmpresa.file_1);
      formData.append("file_2", this.newEmpresa.file_2);

      this.cargando = true;
      await axios
        .post(
          "/empresa" + (this.newEmpresa.id ? "/" + this.newEmpresa.id : ""),
          formData,
          {
            headers: {
              "Content-Type": "multipart/form-data",
            },
          }
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
    async delEmpresa(item) {
      await axios
        .get("/delete-empresa/" + item.id)
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
    async delEmpresaMulti(items) {
      for (let i = 0; i < items.length; i++) {
        await axios
          .get("/delete-empresa/" + items[i].id)
          .then((r) => {
            this.reloadtabla++;
            this.makeToast(
              "Exito",
              "Datos eliminados exitosamente.",
              "success"
            );
          })
          .catch((e) => {
            console.log(e);
            this.makeToast(
              "Error",
              "Existió un error al intentar borrar los datos.",
              "danger"
            );
          });
      }
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
    if (this.essuperuser || this.puedeeditar) {
      this.actions.push({
        variant: "primary",
        icon: "pen",
        callback: this.showModal,
      });
    }
    if (this.essuperuser || this.puedeborrar) {
      this.actions.push({
        rapida: true,
        txt: "¿Desea borrar esta empresa?",
        variant: "danger",
        icon: "trash",
        callback: this.delEmpresa,
      });
      this.multiactions.push({
        txt: "¿Desea borrar las empresas selecionadas?",
        variant: "danger",
        icon: "trash",
        callback: this.delEmpresaMulti,
      });
    }

    this.getAgentes();
  },
};
</script>

<style></style>

<template>
  <div>
    <div class="loader-sm" v-if="sending">
      <div></div>
    </div>

    <b-modal
      body-class="p-0"
      ref="modal-errors"
      :size="'lg'"
      lazy
      scrollable
      :hide-header="true"
      :hide-footer="true"
    >
      <div class="modal-body">
        <br />
        <div v-if="messageSuccess" class="my-2">
          <div class="text-center">
            <i class="icon-lg text-success far fa-check-circle"></i>
          </div>
          <h5 class="text-center text-success">{{ messageSuccess }}</h5>
        </div>

        <div v-if="erroresAuth.length != 0">
          <div class="text-center mb-2">
            <i class="icon-lg text-danger fas fa-exclamation-triangle"></i>
          </div>
          <h5 class="text-danger text-center">
            Algunos docuemntos no fueron autorizados por el sri
            <span v-if="erroresMail.length != 0">
              y otros no pudieron enviarse por correo</span
            >
          </h5>
        </div>

        <div v-if="erroresAuth.length == 0 && erroresMail.length != 0">
          <div class="text-center mb-2">
            <i class="icon-lg text-danger fas fa-exclamation-triangle"></i>
          </div>
          <h5 class="text-danger text-center">
            Algunos documentos no pudieron enviarse por correo
          </h5>
        </div>

        <div v-if="erroresAuth.length != 0">
          <br />
          <h6>Documentos no autorizados:</h6>

          <ul>
            <li v-for="e in erroresAuth">
              <p class="m-0">
                <strong> {{ e.numerodoc }} : </strong> {{ e.message }}
              </p>
            </li>
          </ul>
        </div>
        <div v-if="erroresMail.length != 0">
          <br />

          <h6>Documentos no enviador por correo:</h6>

          <ul>
            <li v-for="e in erroresMail">
              <p class="m-0">
                <strong> {{ e.numerodoc }} : </strong> {{ e.message }}
              </p>
            </li>
          </ul>
        </div>
      </div>
      <div class="modal-footer">
        <button @click="hideModal()" type="button" class="btn btn-primary">
          <i class="fas fa-times"></i> Cerrar
        </button>
      </div>
    </b-modal>
  </div>
</template>

<script>
export default {
  props: ["empresa_id", "documento_id", "tipo", "seleccionados"],

  data() {
    return {
      empresa_id2: null,
      documento_id2: null,
      tipo2: null,
      seleccionados2: null,
      sending: true,
      erroresAuth: [],
      erroresMail: [],
      messageSuccess:""
    };
  },

  methods: {
    async enviarSri() {
      if (this.tipo2 == "seleccionados") {
        await axios
          .get("/enviar-seleccion-doc-sri", {
            params: { seleccionados: this.seleccionados2 },
          })
          .then((r) => {
            console.log(r.data);
            console.log("llego");
            console.log(r);
            this.messageSuccess = "";
            if (r.data.errores.length != 0 || r.data.erroresMail.length != 0) {
              this.erroresAuth = r.data.errores;
              this.erroresMail = r.data.erroresMail;
              
             
            } else {
              this.messageSuccess =
                "Documentos autorizados por sri y enviados a clientes.";
            }
            this.showModal();
            this.$emit("reload");
            this.sending = false;
          })
          .catch((e) => {
            console.log(e);
            this.sending = false;

            this.makeToast(
              "Información",
              "Hubo un problema al intentar enviar los documentos seleccionados",
              "danger"
            );
          });

      }else if(this.tipo2 == "seleccionadosOnlyCorreo"){
         await axios
          .get("/enviar-seleccion-doc-sri", {
            params: { seleccionados: this.seleccionados2 },
          })
          .then((r) => {
            console.log(r.data);
            console.log("llego");
            console.log(r);
            this.messageSuccess = "";
            if (r.data.errores.length != 0 || r.data.erroresMail.length != 0) {
              this.erroresAuth = r.data.errores;
              this.erroresMail = r.data.erroresMail;
            } else {
              this.messageSuccess =
                "Documentos autorizados por sri y enviados a clientes.";
            }
            this.showModal();
            this.$emit("reload");
            this.sending = false;
          })
          .catch((e) => {
            console.log(e);
            this.sending = false;

            this.makeToast(
              "Información",
              "Hubo un problema al intentar enviar los documentos seleccionados",
              "danger"
            );
          });    
      } else {
        await axios
          .get("/enviar-doc-sri", {
            params: {
              empresa_id: this.empresa_id2,
              documento_id: this.documento_id2,
            },
          })
          .then((r) => {
            console.log(r.data);
            this.makeToast("Información", r.data.message, r.data.alert);
            this.$emit("estadosri", r.data.estado);
            console.log("ESTADO ENVIO SRI");
            console.log(r.data);
            this.sending = false;
          })
          .catch((e) => {
            console.log(e);
            this.makeToast(
              "Información",
              "Hubo un problema al intentar enviar el documento",
              "danger"
            );
            this.sending = false;
          });
      }
      this.$emit("reload");
    },
    showModal() {
      this.$refs["modal-errors"].show();
    },
    hideModal() {
      this.$refs["modal-errors"].hide();
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
    this.empresa_id2 = this.empresa_id;
    this.documento_id2 = this.documento_id;
    this.tipo2 = this.tipo;
    this.seleccionados2 = this.seleccionados;

    this.enviarSri();
  },
};
</script>

<template>
  <div>
    <div class="loader-sm" v-if="sending">
      <div></div>
    </div>
    <b-modal
      body-class="p-0"
      ref="modal-error"
      :size="'md'"
      lazy
      scrollable
      :hide-header="true"
      :hide-footer="true"
    >
      <div class="modal-body">
        <div>
          <div class="text-center mb-2">
            <i class="icon-lg text-danger fas fa-exclamation-triangle"></i>
          </div>
          <h5 class="text-danger text-center">
            Error al intentar enviar documento a SRI
          </h5>
          <div v-if="errorSendSri">
            <p class="m-0">
              <span class="font-600">Clave Acceso:</span>
              {{ errorSendSri.claveAcceso }}
            </p>
            <p class="m-0">
              <span class="font-600">Identificador:</span>
              {{ errorSendSri.identificador }}
            </p>
            <p class="m-0">
              <span class="font-600">Mensaje:</span>
              {{ errorSendSri.mensaje }}
            </p>
            <p class="m-0">
              <span class="font-600">Información Adicional:</span>
              {{ errorSendSri.informacionAdicional }}
            </p>
            <p class="m-0">
              <span class="font-600">Tipo:</span>
              {{ errorSendSri.tipo }}
            </p>
          </div>
          <div v-if="errorAuthSri">
            <p class="m-0">
              <span class="font-600">Tipo:</span>
              {{ errorAuthSri.claveAccesoConsultada }}
            </p>

            <p class="m-0">
              <span class="font-600">Estado:</span>
              {{ errorAuthSri.estado }}
            </p>
            <p class="m-0">
              <span class="font-600">Fecha Autorizacion:</span>
              {{ errorAuthSri.fechaAutorizacion }}
            </p>
            <p class="m-0">
              <span class="font-600">Identificador:</span>
              {{ errorAuthSri.identificador }}
            </p>
            <p class="m-0">
              <span class="font-600">Mensaje:</span>
              {{ errorAuthSri.mensaje }}
            </p>
            <p class="m-0">
              <span class="font-600">InformacionAdicional:</span>
              {{ errorAuthSri.informacionAdicional }}
            </p>
            <p class="m-0">
              <span class="font-600">Tipo:</span>
              {{ errorAuthSri.tipo }}
            </p>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button @click="hideModal()" type="button" class="btn btn-secondary">
          <i class="fas fa-times"></i> Cerrar
        </button>
      </div>
    </b-modal>

    <b-modal
      body-class="p-0"
      ref="modal-errors"
      :size="'lg'"
      lazy
      scrollable
      :hide-header="true"
      :hide-footer="true"
    >
      <div class="modal-body" v-if="erroresSelec.length == 0">
        <div class="text-center mb-2">
          <i class="icon-lg text-success far fa-check-circle"></i>
        </div>
        <h5 class="text-center text-success">
          Documentos autorizados con éxito
        </h5>
      </div>
      <div class="modal-body" v-else>
        <div>
          <div class="text-center mb-2">
            <i class="icon-lg text-danger fas fa-exclamation-triangle"></i>
          </div>
          <h5 class="text-danger text-center">
            Error al intentar enviar algunos documentos al SRI
          </h5>
          <br />
          <div class="mb-2" v-for="e in erroresSelec">
            <div v-if="e.errorSendSri">
              <h6>Nro. Documento: {{ e.numerodoc }}</h6>
              <p class="m-0">
                <span class="font-600">Clave Acceso:</span>
                {{ e.claveAcceso }}
              </p>
              <p class="m-0">
                <span class="font-600">Identificador:</span>
                {{ e.identificador }}
              </p>
              <p class="m-0">
                <span class="font-600">Mensaje:</span>
                {{ e.mensaje }}
              </p>
              <p class="m-0">
                <span class="font-600">Información Adicional:</span>
                {{ e.informacionAdicional }}
              </p>
              <p class="m-0">
                <span class="font-600">Tipo:</span>
                {{ e.tipo }}
              </p>
            </div>
            <div v-if="e.errorAuthSri">
              <h6>Nro. Documento: {{ e.numerodoc }}</h6>

              <p class="m-0">
                <span class="font-600">Clave Acceso Consultada:</span>

                {{ e.claveAccesoConsultada }}
              </p>

              <p class="m-0">
                <span class="font-600">Estado:</span>
                {{ e.estado }}
              </p>
              <p class="m-0">
                <span class="font-600">Fecha Autorizacion:</span>
                {{ e.fechaAutorizacion }}
              </p>
              <p class="m-0">
                <span class="font-600">Identificador:</span>
                {{ e.identificador }}
              </p>
              <p class="m-0">
                <span class="font-600">Mensaje:</span>
                {{ e.mensaje }}
              </p>
              <p class="m-0">
                <span class="font-600">InformacionAdicional:</span>
                {{ e.informacionAdicional }}
              </p>
              <p class="m-0">
                <span class="font-600">Tipo:</span>
                {{ e.tipo }}
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button @click="hideModal()" type="button" class="btn btn-secondary">
          <i class="fas fa-times"></i> Cerrar
        </button>
      </div>
    </b-modal>

    <b-modal
      body-class="p-0"
      ref="modal-mails"
      :size="'lg'"
      lazy
      scrollable
      :hide-header="true"
      :hide-footer="true"
    >
      <div class="modal-body" v-if="erroresMail.length == 0">
        <div class="text-center mb-2">
          <i class="icon-lg text-success far fa-check-circle"></i>
        </div>
        <h5 class="text-center text-success">Documentos enviados con éxito</h5>
      </div>
      <div class="modal-body" v-else>
        <div class="text-center mb-2">
          <i class="icon-lg text-danger fas fa-exclamation-triangle"></i>
        </div>

        <h5 class="text-center text-danger">
          Algunos documentos no pudieron enviarse por correo.
        </h5>
        <br />
        <div v-for="e in erroresMail">
          <h6>Nro. Documento: {{ e.numerodoc }}</h6>
          <p class="m-0">
            <span class="font-600">Error: </span>{{ e.message }}
          </p>
        </div>
      </div>
      <div class="modal-footer">
        <button @click="hideModal()" type="button" class="btn btn-secondary">
          <i class="fas fa-times"></i> Cerrar
        </button>
      </div>
    </b-modal>
  </div>
</template>

<script>
export default {
  props: [
    "empresa_id",
    "documento_id",
    "tipo",
    "tipodoc",
    "seleccionados",
    "url",
  ],

  data() {
    return {
      seleccionados2: null,
      sending: true,
      erroresAuth: [],
      erroresMail: [],
      messageSuccess: "",
      errorSendSri: "",
      errorAuthSri: "",
      erroresSelec: [],
    };
  },

  methods: {
    async enviarSri() {
      console.log(this.seleccionados2);
      if (this.tipo == "seleccionados") {
        console.log("SELECCIONADOS");
        let url = "/enviar-seleccion-doc-sri";
        if (this.url) {
          url = this.url;
        }
        await axios
          .post(url, { seleccionados: this.seleccionados2 })
          .then((r) => {
            console.log("llego 1");
            console.log(r.data);
            if (r.data.errores && r.data.errores.length != 0) {
              this.erroresSelec = r.data.errores;
              console.log(this.erroresSelec);
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
              "Hubo un problema al intentar enviar los documentos seleccionados,verifique su conexion a internet",
              "danger"
            );
          });
      } else if (this.tipo == "seleccionadosOnlyCorreo") {
        let url = "/enviar-seleccionados-correo?tipodoc";
        if (this.url) {
          url = this.url;
        }

        await axios

          .post(url, { seleccionados: this.seleccionados2 })
          .then((r) => {
            console.log(r.data);
            console.log("llego mails");

            this.messageSuccess = "";
            if (r.data.erroresMail.length != 0) {
              this.erroresMail = r.data.erroresMail;
            }
            this.sending = false;
            this.showModalMails();
            this.$emit("reload");
          })
          .catch((e) => {
            console.log(e);
            this.sending = false;
            this.makeToast(
              "Información",
              "Hubo un problema al intentar enviar los documentos seleccionados,verifique su conexion a internet",
              "danger"
            );
          });
      } else {
        let url = "/enviar-doc-sri";
        if (this.url) {
          url = this.url;
        }
        await axios
          .post(url, {
            empresa_id: this.empresa_id,
            documento_id: this.documento_id,
          })
          .then((r) => {
            if (r.data.errorSendSri) {
              this.errorSendSri = r.data;
              this.$refs["modal-error"].show();
              this.sending = false;
              return;
            } else if (r.data.errorAuthSri) {
              this.errorAuthSri = r.data;
              this.$refs["modal-error"].show();
              this.sending = false;
              return;
            } else if (r.data.errorSistema) {
              this.makeToast("Error", r.data.message, "warning");
            } else if (r.data.estado == "AUTORIZADO") {
              var correo_enviado = "";
              if (r.data.correo_enviado) {
                correo_enviado =
                  "Adicionalmente se envio docuemnto al correo del cliente.";
              }
              this.makeToast(
                "Éxito",
                "Documento autorizado con éxito. " + correo_enviado,
                "success"
              );
              this.$emit("estadosri", r.data.estado);
            } else if (r.data.estado == "YA SE AUTORIZO") {
              this.makeToast("Información", r.data.message, "info");
            }
            console.log(r.data);
            this.sending = false;
          })
          .catch((e) => {
            console.log("x");
            console.log();

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
    showModalMails() {
      this.$refs["modal-mails"].show();
    },
    showModal() {
      this.$refs["modal-errors"].show();
    },
    hideModal() {
      this.$refs["modal-errors"].hide();
      this.$refs["modal-error"].hide();
      this.$refs["modal-mails"].hide();
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
    this.seleccionados2 = this.seleccionados;

    this.enviarSri();
  },
};
</script>

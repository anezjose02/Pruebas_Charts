
<template>
  <div>
    <!-- <div class="loader-sm" v-if="loading" >
  <div></div>
  </div> -->
    <div v-if="persona" class="row">
      <div class="col-12 col-sm-6 col-lg-4 col-xl-4 mb-2">
        <div class="row">
          <div class="col-5 px-1">
            <label for="" class="float-right mt-1">Tipo ident:</label>
          </div>
          <div class="col-7 px-1">
            <b-form-select
              name="identificacion_tipo"
              v-model="tipoIdentificacion"
              size="sm"
              :options="tiposIdentificacion"
              @change="gestionTipo"
            ></b-form-select>
          </div>
        </div>
      </div>

      <div class="col-12 col-sm-6 col-lg-3 col-xl-3 mb-2">
        <div class="row">
          <div class="col-5 px-1">
            <label for="" class="float-right"> Identificación: </label>
          </div>
          <div class="col-7 px-1">
            <div
              class="input-group m-0 p-0"
              v-if="tipoIdentificacion == 'CÉDULA'"
            >
              <input
                ref="input_cedula"
                maxlength="10"
                class="
                  form-control form-control-sm
                  m-0
                  p-0
                  required
                  min(10)
                  max(10)
                "
                type="text"
                data-valid="number"
                name="identificacion"
                data-tipo="prueba"
                v-model="persona.identificacion"
                placeholder="0000000000"
                @keyup="getPersona"
                :class="{ 'border-danger': noencontrado }"
              />
              <div class="input-group-append">
                <button
                  @click.prevent="getPersona"
                  :disabled="searchclient"
                  class="btn btn-sm btn-success"
                >
                  <i v-if="!searchclient" class="fas fa-search"></i>
                  <i v-if="searchclient" class="fas fa-spinner fa-spin"></i>
                </button>
              </div>
            </div>

            <div
              class="input-group m-0 p-0"
              v-else-if="tipoIdentificacion == 'RUC'"
            >
              <input
                ref="input_ruc"
                maxlength="13"
                class="form-control form-control-sm required min(13) max(13)"
                type="text"
                name="identificacion"
                data-tipo="prueba"
                v-model="persona.identificacion"
                @keyup="getPersona"
                size="sm"
                placeholder="0000000000000"
                :class="{ 'border-danger': noencontrado }"
              />
              <div class="input-group-append">
                <button
                  @click.prevent="getPersona"
                  :disabled="searchclient"
                  class="btn btn-sm btn-success"
                >
                  <i v-if="!searchclient" class="fas fa-search"></i>
                  <i v-if="searchclient" class="fas fa-spinner fa-spin"></i>
                </button>
              </div>
            </div>

            <div
              class="input-group m-0 p-0"
              :disabled="searchclient"
              v-else-if="tipoIdentificacion == 'PASAPORTE'"
            >
              <input
                @keyup="getPersona"
                placeholder="Num. Pasaporte"
                ref="input_pasaporte"
                maxlength="25"
                class="form-control form-control-sm required min(5)"
                type="text"
                name="identificacion"
                v-model="persona.identificacion"
              />
              <div class="input-group-append">
                <button
                  @click.prevent="getPersona"
                  class="btn btn-sm btn-success"
                >
                  <i v-if="!searchclient" class="fas fa-search"></i>
                  <i v-if="searchclient" class="fas fa-spinner fa-spin"></i>
                </button>
              </div>
            </div>

            <b-form-input
              v-else
              :readonly="tipoIdentificacion == 'CONSUMIDOR FINAL'"
              v-model="persona.identificacion"
              size="sm"
              placeholder="0000000000000"
            ></b-form-input>

            <div class="text-error text-warning2" v-if="noencontrado">
              No encontrado.
            </div>
            <div v-if="preerrorsv" class="text-error">
              {{ preerrorsv.identificacion }}
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 col-sm-6 col-lg-5 col-xl-5 mb-2">
        <div class="row">
          <div class="col-5 px-1">
            <label for="" class="float-right"> Razón social: </label>
          </div>
          <div class="col-7 px-1">
            <b-form-input
              class="required"
              name="razonsocial"
              v-model="persona.razonsocial"
              size="sm"
              placeholder="Juan Perez"
              maxlength="100"
            ></b-form-input>
            <div v-if="preerrorsv" class="text-error">
              {{ preerrorsv.razonsocial }}
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 col-sm-6 col-lg-4 col-xl-4 mb-2">
        <div class="row">
          <div class="col-5 px-1">
            <label for="" class="float-right"> Nombre comercial: </label>
          </div>
          <div class="col-7 px-1">
            <b-form-input
              maxlength="100"
              name="NOMBRE_COMERCIAL"
              class=""
              :disabled="this.tipoIdentificacion == 'CONSUMIDOR FINAL'"
              v-model="persona.NOMBRE_COMERCIAL"
              size="sm"
              placeholder="Soluciones SA"
            ></b-form-input>
            <!-- <div v-if="preerrorsv"  class="text-error">{{preerrorsv.NOMBRE_COMERCIAL}} </div> -->
          </div>
        </div>
      </div>

      <div class="col-12 col-sm-6 col-lg-4 col-xl-4 mb-2">
        <div class="row">
          <div class="col-5 px-1">
            <label for="" class="float-right"> Teléfono: </label>
          </div>
          <div class="col-7 px-1">
            <b-form-input
              maxlength="20"
              :disabled="this.tipoIdentificacion == 'CONSUMIDOR FINAL'"
              v-model="persona.telefono"
              name="telefono"
              size="sm"
              placeholder="(02)454 4545"
            ></b-form-input>
          </div>
        </div>
      </div>

      <div class="col-12 col-sm-6 col-lg-4 col-xl-4 mb-2">
        <div class="row">
          <div class="col-5 px-1">
            <label for="" class="float-right"> Celular: </label>
          </div>
          <div class="col-7 px-1">
            <b-form-input
              maxlength="20"
              name="celular"
              :disabled="this.tipoIdentificacion == 'CONSUMIDOR FINAL'"
              v-model="persona.celular"
              size="sm"
              placeholder="0991771990"
            ></b-form-input>
          </div>
        </div>
      </div>

      <div class="col-12 col-sm-6 col-lg-4 col-xl-4 mb-2">
        <div class="row">
          <div class="col-5 px-1">
            <label for="" class="float-right"> Email: </label>
          </div>
          <div class="col-7 px-1">
            <b-form-input
              maxlength="100"
              name="email"
              :disabled="this.tipoIdentificacion == 'CONSUMIDOR FINAL'"
              v-model="persona.email"
              size="sm"
              placeholder="test@empresa.com"
            ></b-form-input>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-6 col-lg-4 col-xl-4 mb-2">
        <div class="row">
          <div class="col-5 px-1">
            <label for="" class="float-right"> Ciudad: </label>
          </div>
          <div class="col-7 px-1">
            <b-form-input
              maxlength="100"
              :disabled="this.tipoIdentificacion == 'CONSUMIDOR FINAL'"
              name="ciudad"
              v-model="persona.ciudad"
              size="sm"
              placeholder=""
            ></b-form-input>
          </div>
        </div>
      </div>

      <div class="col-8 mb-2">
        <div class="input-group">
          <span class="input-group-text ml-5"> Dirección: </span>
          <b-form-input
            maxlength="255"
            :disabled="this.tipoIdentificacion == 'CONSUMIDOR FINAL'"
            name="direccion"
            v-model="persona.direccion"
            size="sm"
            placeholder="Av. Colón y 10 de Agosto"
          ></b-form-input>
        </div>
      </div>
    </div>

    <input
      :disabled="this.tipoIdentificacion == 'CONSUMIDOR FINAL'"
      ref="persona_id"
      type="hidden"
      class="form-control form-control-sm"
      name="persona_id"
      v-model="persona.id"
    />
  </div>
</template>
<script>
import { validation, validation2 } from "../../helpers.js";

export default {
  props: [
    "persona_id",
    "identificacion",
    "identificacion_tipo",
    "empresaid",
    "esproveedor",
    "personanotnull",
    "preerrorsv",
  ],
  data() {
    if (!this.esproveedor & !this.personanotnull) {
      return {
        persona: null,
        tiposIdentificacion: ["CONSUMIDOR FINAL", "RUC", "CÉDULA", "PASAPORTE"],
        tipoIdentificacion: "CONSUMIDOR FINAL",
        mostrarDatos: false,
        errorsV: [],
        searchclient: false,
        noencontrado: false,
        btnsavedisabled: false,
        loading: true,
        errorsv: true,
      };
    } else {
      return {
        persona: null,
        tiposIdentificacion: ["RUC", "CÉDULA", "PASAPORTE"],
        tipoIdentificacion: "RUC",
        mostrarDatos: false,
        errorsV: [],
        searchclient: false,
        noencontrado: false,
        btnsavedisabled: false,
        loading: true,
        errorsv: true,
      };
    }
  },
  methods: {
    validate(value, valid = []) {
      return validation2(value, valid);
    },
    gestionTipo() {
      this.noencontrado = false;
      // this.preerrorsv = [];
      //   this.getPersona();
      this.resetPersona();
      if (this.tipoIdentificacion == "CONSUMIDOR FINAL") {
        this.resetPersonaCF();
        // this.mostrarDatos = false;
      }

      this.disabledSave();
    },
    pregestionTipo() {
      this.getPersona_id();
      if (this.persona.identificacion == "9999999999999") {
        this.tipoIdentificacion = "CONSUMIDOR FINAL";
        this.resetPersonaCF();
      } else if (this.persona.identificacion.length == 13) {
        this.persona.NUMERO_RUC = this.persona.identificacion;
        this.persona.identificacion = this.persona.NUMERO_RUC.substring(0, 10);
        this.tipoIdentificacion = "RUC";
      } else if (this.persona.identificacion.length == 10) {
        this.tipoIdentificacion = "CÉDULA";
      } else if (this.persona.identificacion.length > 5) {
        this.tipoIdentificacion = "PASAPORTE";
      }
    },
    disabledSave() {
      if (!this.persona.identificacion || !this.persona.razonsocial) {
        this.btnsavedisabled = true;
        this.$emit("btnsavedisabled", true);
      } else {
        this.btnsavedisabled = false;
        this.$emit("btnsavedisabled", false);
      }
    },
    // async getPasaporte() {
    //   this.noencontrado = false;
    //   this.resetPersona();

    //   var controladorTiempo = "";
    //   clearTimeout(controladorTiempo);
    //   controladorTiempo = setTimeout(codigoAJAX, 250);
    // },

    getPersona() {
      
      this.errorsV = [];
      this.noencontrado = false;

      if (this.tipoIdentificacion == "PASAPORTE") {
      } else if (
        (this.tipoIdentificacion == "RUC") &
        (this.persona.identificacion.length !== 13)
      ) {
        this.resetPersonaNoIdent();
        this.disabledSave();
        return;
      } else if (
        (this.tipoIdentificacion == "CÉDULA") &
        (this.persona.identificacion.length !== 10)
      ) {
        this.resetPersonaNoIdent();
        this.disabledSave();
        return;
      } else if (this.persona.identificacion == 9999999999999) {
        this.resetPersonaCF();
        this.disabledSave();
        return;
      }
      this.searchclient = true;

      clearTimeout(this.timeOut);

      this.timeOut = setTimeout(() => {
        this.getPerson();
      }, 1000);
    },
    async getPerson() {
      var pasaporte = "";
      if (this.tipoIdentificacion == "PASAPORTE") {
        pasaporte = "?pasaporte=true";
      }
      if (!this.esproveedor) {
        console.log("get-cliente");
        console.log(this.persona.identificacion);
        console.log(this.persona.empresaid);


       
        await axios
          .get(
            "/get-cliente/" +
              this.persona.identificacion +
              "/empresa/" +
              this.empresaid +
              pasaporte
          )
          .then((r) => {
           
            console.log(r.data);
            if (r.data) {
              this.persona = r.data;
              if (
                r.data.identificacion_tipo &&
                this.tipoIdentificacion == "PASAPORTE"
              ) {
                this.tipoIdentificacion = r.data.identificacion_tipo;
                this.identificacion = r.data.identificacion;
              }
              this.$emit("idcliente", r.data.id);
            } else {
              this.noencontrado = true;
              this.resetPersonaNoIdent();
            }
          })
          .catch(function (error) {
            console.log("error-cliente");
            console.log(error.response.data);
            if (error.response) {
              console.log(error.response.data);
            }
          });

        this.searchclient = false;
        this.disabledSave();
        return;
      } else {
        this.searchclient = true;
        await axios
          .get(
            "/get-proveedor/" +
              this.persona.identificacion +
              "/empresa/" +
              this.empresaid +
              pasaporte
          )
          .then((r) => {
            console.log(r.data);
            if (r.data) {
              this.persona = r.data;
              if (
                r.data.identificacion_tipo &&
                this.tipoIdentificacion == "PASAPORTE"
              ) {
                this.tipoIdentificacion = r.data.identificacion_tipo;
                this.identificacion = r.data.identificacion;
              }
              this.$emit("idcliente", r.data.id);
            } else {
              this.noencontrado = true;
              this.resetPersonaNoIdent();
              this.c = true;
            }
          })
          .catch((e) => {
            console.log(e);
          });
        this.searchclient = false;
        this.disabledSave();
      }
    },
    identificacionNoEncontrada() {
      this.$bvToast.toast(
        "Identificación no encontrada, se creara un nuevo cliente al guardar la factura.",
        {
          title: "Atención",
          autoHideDelay: 5000,
          variant: "warning",
        }
      );
    },

    async getPersona_id() {
      
      this.loading = true;
      if (!this.esproveedor) {
      
        this.searchclient = true;
        try {
          await axios
            .get("/get-cliente-id/" + this.persona_id)
            .then((r) => {
              console.log(r.data);

              if (r.data) {
                this.persona = r.data;
                this.tipoIdentificacion = r.data.identificacion_tipo;
                this.identificacion = r.data.identificacion;
                this.$emit("idcliente", r.data.id);
              } else {
                this.resetPersona();
              }
              this.loading = false;
              this.searchclient = false;
            })
            .catch(function (error) {
              this.loading = false;
              this.searchclient = false;
              if (error.response) {
                console.log(error.response.data);
              }
            });
        } catch (err) {
          console.log(err);
        }
        this.searchclient = false;
        this.disabledSave();
        return;
      } else {
        this.searchclient = true;
        await axios
          .get(
            "/get-proveedor-id/" +this.persona_id
          )
          .then((r) => {
            console.log("proveedor data");
            console.log(r.data);

            if (r.data) {
              this.persona = r.data;
                this.tipoIdentificacion = r.data.identificacion_tipo;
                this.identificacion = r.data.identificacion;
                this.$emit("idcliente", r.data.id);
            } else {
              this.resetPersona();
            }
            this.loading = false;
            this.searchclient = false;
          })
          .catch((e) => {
            console.log(e);
            this.loading = false;
            this.searchclient = false;
          
          });
        this.searchclient = false;
        this.disabledSave();
      }
    },
    async setPersona() {
      console.log(this.persona);
      if (!this.empresaid) {
        await axios
          .post("/set-persona/" + this.persona.id, this.persona)
          .then((r) => {
            // this.persona = r.data;
          })
          .catch((e) => {
            console.log(e);
          });
        return;
      }

      if (!this.esproveedor) {
        await axiosthis.empresaid
          .post(
            "/set-cliente/" +
              this.persona.identificacion +
              "/empresa/" +
              this.empresaid,
            this.persona
          )
          .then((r) => {
            // this.persona = r.data;
            this.$emit("idcliente", r.data.id);
          })
          .catch((e) => {
            console.log(e);
          });
        return;
      }

      await axios
        .post(
          "/set-proveedor/" +
            this.persona.identificacion +
            "/empresa/" +
            this.empresaid,
          this.persona
        )
        .then((r) => {
          // this.persona = r.data;
          this.$emit("idproveedor", r.data.id);
        })
        .catch((e) => {
          console.log(e);
        });
    },
    resetPersonaCF() {
      if (this.esproveedor) {
        this.resetPersona();
        return;
      } else if (this.personanotnull) {
        this.resetPersona();
        return;
      }
      this.persona = {
        id: "",
        identificacion: "9999999999999",
        razonsocial: "CONSUMIDOR FINAL",
        direccion: "",
        telefono: "",
        celular: "",
        email: "",
        NUMERO_RUC: "",
        NOMBRE_COMERCIAL: "",
      };
    },
    resetPersona() {
      this.persona = {
        id: "",
        identificacion: "",
        razonsocial: "",
        direccion: "",
        telefono: "",
        celular: "",
        ciudad: "",
        email: "",
        NUMERO_RUC: "",
        NOMBRE_COMERCIAL: "",
      };
    },
    resetPersonaNoIdent() {
      this.persona.id = "";
      this.persona.razonsocial = "";
      this.persona.direccion = "";
      this.persona.telefono = "";
      this.persona.celular = "";
      this.persona.ciudad = "";
      this.persona.email = "";
      this.persona.NUMERO_RUC = "";
      this.persona.NOMBRE_COMERCIAL = "";
    },
  },
  computed: {
    // persona_id: function () {
    //   return this.persona & this.persona.id ? this.persona.id : 0;
    // },
  },
  mounted() {

    this.resetPersona();
    if (this.identificacion) {
      this.persona.identificacion = this.identificacion;
      
      this.getPersona_id();
      this.pregestionTipo();
      this.gestionTipo();
    } else {
      this.resetPersonaCF();
    }
  },
};
</script>

<style></style>


<template>
  <div>
    <!-- <b-card no-body> -->
    <!-- <b-card-body> -->
    <!-- <hr class="m-0 mb-2" /> -->
    <div v-if="persona" class="row">
      <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-2">
        <div class="row">
          <div class="col-5 px-1">
            <label for="" class="float-right mt-1">Tipo ident: </label>
          </div>
          <div class="col-7 px-1">
            <b-form-select
              v-model="tipoIdentificacion"
              size="sm"
              :options="tiposIdentificacion"
              @change="gestionTipo"
            ></b-form-select>
          </div>
        </div>
      </div>

      <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-2">
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
                class="form-control form-control-sm m-0 p-0"
                type="text"
                data-valid="number"
                name="identificacion"
                data-tipo="prueba"
                v-model="persona.identificacion"
                placeholder="0000000000"
                @keyup="getPersona"
                @change="getPersona"
                :class="{ 'border-danger': noencontrado }"
              />
              <div class="input-group-append">
                <button :disabled="searchclient" class="btn btn-sm btn-success">
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
                class="form-control form-control-sm"
                type="text"
                name="identificacion"
                data-tipo="prueba"
                v-model="persona.identificacion"
                @keyup="getPersona"
                @change="getPersona"
                size="sm"
                placeholder="0000000000000"
                :class="{ 'border-danger': noencontrado }"
              />
              <div class="input-group-append">
                <button :disabled="searchclient" class="btn btn-sm btn-success">
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
                ref="input_pasaporte"
                maxlength="15"
                class="form-control form-control-sm"
                type="text"
                name="identificacion"
                v-model="persona.identificacion"
                placeholder=""
              />
              <div class="input-group-append">
                <button class="btn btn-sm btn-success">
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

            <div
              class="text-error col-12"
              v-if="tipoIdentificacion == 'CÉDULA'"
            >
              {{
                validate(persona.identificacion, [
                  "number",
                  "min:10",
                  "nullable",
                ])
              }}
            </div>
            <div
              class="text-error col-12 mt-1"
              v-if="tipoIdentificacion == 'RUC'"
            >
              {{
                validate(persona.identificacion, [
                  "number",
                  "min:13",
                  "nullable",
                ])
              }}
            </div>
            <div
              class="text-error col-12 mt-1"
              v-if="tipoIdentificacion == 'PASAPORTE'"
            >
              {{
                validate(persona.identificacion, ["number&text", "nullable"])
              }}
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-2">
        <div class="row">
          <div class="col-5 px-1">
            <label for="" class="float-right"> Razón social: </label>
          </div>
          <div class="col-7 px-1">
            <b-form-input
              :disabled="this.tipoIdentificacion == 'CONSUMIDOR FINAL'"
              @change="setPersona"
              v-model="persona.razonsocial"
              size="sm"
              placeholder="Juan Perez"
            ></b-form-input>
          </div>
        </div>
      </div>

      <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-2">
        <div class="row">
          <div class="col-5 px-1">
            <label for="" class="float-right"> Nombre comercial: </label>
          </div>
          <div class="col-7 px-1">
            <b-form-input
              :disabled="this.tipoIdentificacion == 'CONSUMIDOR FINAL'"
              @change="setPersona"
              v-model="persona.NOMBRE_COMERCIAL"
              size="sm"
              placeholder="Soluciones SA"
            ></b-form-input>
          </div>
        </div>
      </div>

      <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-2">
        <div class="row">
          <div class="col-5 px-1">
            <label for="" class="float-right"> Teléfono: </label>
          </div>
          <div class="col-7 px-1">
            <b-form-input
              :disabled="this.tipoIdentificacion == 'CONSUMIDOR FINAL'"
              @change="setPersona"
              v-model="persona.telefono"
              size="sm"
              placeholder="(02)454 4545"
            ></b-form-input>
          </div>
        </div>
      </div>

      <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-2">
        <div class="row">
          <div class="col-5 px-1">
            <label for="" class="float-right"> Celular: </label>
          </div>
          <div class="col-7 px-1">
            <b-form-input
              :disabled="this.tipoIdentificacion == 'CONSUMIDOR FINAL'"
              @change="setPersona"
              v-model="persona.celular"
              size="sm"
              placeholder="0991771990"
            ></b-form-input>
          </div>
        </div>
      </div>

      <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-2">
        <div class="row">
          <div class="col-5 px-1">
            <label for="" class="float-right"> Email: </label>
          </div>
          <div class="col-7 px-1">
            <b-form-input
              :disabled="this.tipoIdentificacion == 'CONSUMIDOR FINAL'"
              @change="setPersona"
              v-model="persona.email"
              size="sm"
              placeholder="test@empresa.com"
            ></b-form-input>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-2">
        <div class="row">
          <div class="col-5 px-1">
            <label for="" class="float-right"> Ciudad: </label>
          </div>
          <div class="col-7 px-1">
            <b-form-input
              :disabled="this.tipoIdentificacion == 'CONSUMIDOR FINAL'"
              @change="setPersona"
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
            :disabled="this.tipoIdentificacion == 'CONSUMIDOR FINAL'"
            @change="setPersona"
            v-model="persona.direccion"
            size="sm"
            placeholder="Av. Colón y 10 de Agosto"
          ></b-form-input>
        </div>
      </div>
    </div>
    <!-- <hr class="m-0 mb-1" /> -->

    <input type="hidden" name="persona_id" :value="persona_id" />
    
  </div>
</template>

<script>
import { validation, validation2 } from "../../helpers.js";

export default {
  props: ["identificacion", "empresaid", "esproveedor"],
  data() {
    return {
      persona: null,
      tiposIdentificacion: ["RUC", "CÉDULA", "PASAPORTE"],
      tipoIdentificacion: "RUC",
    };
  },
  methods: {
    validate(value, valid = []) {
      return validation2(value, valid);
    },
    gestionTipo() {
     
      this.errorsvalid = "";
    
      this.resetPersona();
      if (this.tipoIdentificacion == "CONSUMIDOR FINAL") {
        this.resetPersonaCF();
       
      } else if (this.tipoIdentificacion == "RUC") {
     
      } else if (this.tipoIdentificacion == "CÉDULA") {
      
      } else if (this.tipoIdentificacion == "PASAPORTE") {
        
      }
      this.disabledSave();
    },
    pregestionTipo() {
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
    disabledSave(){
      if(!this.persona.identificacion || !this.persona.razonsocial){
        this.btnsavedisabled = true;
        this.$emit("btnsavedisabled", true);
      }else{
        this.btnsavedisabled = false;
        this.$emit("btnsavedisabled", false);
      }
    },
    async getPersona() {

      this.noencontrado = false;

      if (!this.esproveedor) {
        if (
          (this.tipoIdentificacion == "RUC") &
          (this.persona.identificacion.length !== 13)
        ) {
          this.resetPersonaNoIdent();
           this.disabledSave();
          return;
        } else if (
          this.tipoIdentificacion == "CÉDULA" &&
          this.persona.identificacion.length !== 10
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
        try {
          await axios
            .get(
              "/get-cliente/" +
                this.persona.identificacion +
                "/empresa/" +
                this.empresaid
            )
            .then((r) => {
              if (r.data) {
                this.persona = r.data;
                // if (r.data.razonsocial) {
                //   this.mostrarDatos = true;
                // } else {
                //   this.mostrarDatos = false;
                // }
                this.$emit("idcliente", r.data.id);
              } else {
                this.noencontrado = true;
              }
              console.log(r.data);

              console.log("aca en then");
            })
            .catch(function (error) {
              console.log("ERR");
              if (error.response) {
                console.log(error.response.data);
                console.log(error.response.status);
                console.log(error.response.headers);
              }
            });
        } catch (err) {
          console.log(err);
        }
        this.searchclient = false;
         this.disabledSave();
        return;
      } else {
        await axios
          .get(
            "/get-proveedor/" +
              this.persona.identificacion +
              "/empresa/" +
              this.empresaid
          )
          .then((r) => {
            // if (r.data) {
            //   this.persona = r.data;
            //   this.$emit("idproveedor", r.data.id);
            // }
          })
          .catch((e) => {
            console.log(e);
          });
        this.searchclient = false;
      }

      if (!this.persona.id) {
        await axios
          .get("/get-persona/" + this.persona.identificacion)
          .then((r) => {
            if (r.data) {
              this.persona = r.data;
            }
          })
          .catch((e) => {
            console.log(e);
          });
        this.searchclient = false;
        
        return;
      }
    },
    async setPersona() {
      if (!this.empresaid) {
        await axios
          .post("/set-persona/" + this.persona.identificacion, this.persona)
          .then((r) => {
            this.persona = r.data;
          })
          .catch((e) => {
            console.log(e);
          });
        return;
      }

      if (!this.esproveedor) {
        await axios
          .post(
            "/set-cliente/" +
              this.persona.identificacion +
              "/empresa/" +
              this.empresaid,
            this.persona
          )
          .then((r) => {
            this.persona = r.data;
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
          this.persona = r.data;
          this.$emit("idproveedor", r.data.id);
        })
        .catch((e) => {
          console.log(e);
        });
    },
    resetPersonaCF() {
      this.persona = {
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
        identificacion: "",
        razonsocial: "",
        direccion: "",
        telefono: "",
        celular: "",
        email: "",
        NUMERO_RUC: "",
        NOMBRE_COMERCIAL: "",
      };
    },
    resetPersonaNoIdent() {
      this.persona.razonsocial = "";
      this.persona.razonsocial = "";
      this.persona.direccion = "";
      this.persona.telefono = "";
      this.persona.celular = "";
      this.persona.email = "";
      this.persona.NUMERO_RUC = "";
      this.persona.NOMBRE_COMERCIAL = "";
    },
  },
  computed: {
    persona_id: function () {
      return this.persona && this.persona.id ? this.persona.id : 0;
    },
  },
  mounted() {
    this.resetPersona();
    if (this.identificacion) {
      this.persona.identificacion = this.identificacion;
      this.getPersona();
      this.pregestionTipo();
      this.gestionTipo();
    } else {
      this.resetPersonaCF();
    }
  },
};
</script>

<style></style>

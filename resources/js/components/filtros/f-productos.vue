<template>
  <div>
    
    <div class="row">
      <div class="col-xl-4 col-lg-6">
        <h5>Productos  </h5>
      </div>
      <div class="col-xl-4 col-lg-6"></div>

      <div class="col-xl-4 col-lg-6">
        <div class="mb-1">
           <button class="btn btn-secondary btn-sm btn-ico btn-square float-right" v-if="filters" @click="ResetForm"> <i class="fas fa-sync"></i> </button>
          <div class="row">
           
            <div class="col-12">
             
              <div class="input-group">
                <input
                ref="search"
                  type="text"
                  class="form-control form-control-sm square-right"
                  placeholder="Buscar"
                  name="search"
                />
                <span class="input-group-text">
                  <button ref="submit" type="submit" class="btn btn-primary btn-sm btn-ico"> <i class="fas fa-search"></i> </button>
                </span>
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </div>
    <hr v-if="mostrarAvanzados" class="mt-1 mb-2" />
    <div class="row" v-if="mostrarAvanzados">
      <div class="col-xl-4 col-lg-6 px-1">
        <div class="mb-1">
          <div class="row">
            <div class="col-6">
              <label for="" class="float-right"> Producto </label>
            </div>
            <div class="col-6">
              <input
                name="producto"
                type="text"
                class="form-control form-control-sm"
              />
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-lg-6 px-1">
        <div class="mb-1">
          <div class="row">
            <div class="col-6">
              <label for="" class="float-right">Serie</label>
            </div>
            <div class="col-6">
              <input
                type="text"
                class="form-control form-control-sm"
                aria-label="Username"
                aria-describedby="basic-addon1"
              />
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-4 col-lg-6 px-1">
        <div class="mb-1">
          <div class="row">
            <div class="col-6">
              <label for="" class="float-right">Categoría de cliente</label>
            </div>
            <div class="col-6">
              <input
                type="text"
                class="form-control form-control-sm"
                aria-label="Username"
                aria-describedby="basic-addon1"
              />
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-4 col-lg-6 px-1">
        <div class="mb-1">
          <div class="row">
            <div class="col-6">
              <label for="" class="float-right">Centro de costo</label>
            </div>
            <div class="col-6">
              <input
                type="text"
                class="form-control form-control-sm"
                aria-label="Username"
                aria-describedby="basic-addon1"
              />
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-4 col-lg-6 px-1">
        <div class="mb-1">
          <div class="row">
            <div class="col-6">
              <label for="" class="float-right">Nro de documento</label>
            </div>
            <div class="col-6">
              <input
                name="numerodoc"
                type="text"
                class="form-control form-control-sm"
                aria-label="Username"
                aria-describedby="basic-addon1"
              />
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-4 col-lg-6 px-1">
        <div class="mb-1">
          <div class="row">
            <div class="col-6">
              <label for="" class="float-right">Nro de Retención</label>
            </div>
            <div class="col-6">
              <input
                type="text"
                class="form-control form-control-sm"
                aria-label="Username"
                aria-describedby="basic-addon1"
              />
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-lg-6 px-1">
        <div class="mb-1">
          <div class="row">
            <div class="col-6">
              <label for="" class="float-right">Tipo de listado</label>
            </div>
            <div class="col-6">
              <div class="row">
                <div class="col-6">
                  <div class="form-check">
                    <input
                      class="form-check-input"
                      type="radio"
                      name="exampleRadios"
                      value="option1"
                      checked
                    />
                    <label class="form-check-label" for="exampleRadios1">
                      General
                    </label>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-check">
                    <input
                      class="form-check-input"
                      type="radio"
                      name="exampleRadios"
                      value="option1"
                    />
                    <label class="form-check-label" for="exampleRadios1">
                      Detallado
                    </label>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12">
        <button
          v-if="!mostrarAvanzados"
          type="submit"
          class="btn btn-sm btn-success float-right"
        >
          <i class="fas fa-sync"></i> Aplicar filtros
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["errores", "campos", "datosfiltros","filters"],
  data() {
    return {
      mostrarAvanzados: false,
      tipofecha: "",
      
    };
  },
  computed: {
    inputVal: {
      get() {
        return this.value;
      },
      set(val) {
        this.$emit("input", val);
      },
    },
  },
  methods: {
    cambioTioFecha(e) {
      console.log(e.target.value);
      this.tipofecha = e.target.value;
      console.log(this.tipofecha);
    },

    ResetForm(){
      this.$refs['search'].value = "";
      // this.$refs['submit'].value = "";

    }


  },
};
</script>

<style></style>

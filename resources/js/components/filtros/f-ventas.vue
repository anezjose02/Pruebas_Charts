<template>
    <div>

         
        <div class="row">
            <div class="col-xl-4 col-lg-6 px-1">
                <div class="mb-1">
                    <div class="row">
                        <div class="col-6">
                            <label for="" class="float-right"
                                >Tipo documento 
                            </label>
                        </div>
                        <div class="col-6">
                            <select
                                name="tipodoc"
                                class="form-control form-control-sm"
                            >
                                <option :value="''">TODOS</option>
                                <option
                                    :value="item.valor"
                                    v-for="item in campos[0].tipodoc"
                                >
                                    {{ item.nombre }}
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mb-1">
                    <div class="row">
                        <div class="col-6">
                            <label for="" class="float-right">Cliente</label>
                        </div>
                        <div class="col-6">
                            <select name="vendedor" class="form-control form-control-sm">
                                <option :value="''">TODOS</option>
                                <option :value="item.id" v-for="item in datosfiltros.clientes"> {{item.razonsocial}} </option>

                            </select>
                        </div>
                    </div>
                </div>
                <div class="mb-1">
                    <div class="row">
                        <div class="col-6">
                            <label for="" class="float-right">Estado</label>
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
                <div class="mb-1">
                    <div class="row">
                        <div class="col-6">
                            <label for="" class="float-right">Estado SRI</label>
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
                <div class="mb-1">
                    <div class="row">
                        <div class="col-6">
                            <label for="" class="float-right"
                                >Forma de pago</label
                            >
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

            <!-- divs fechas -->
            <div class="col-xl-4 col-lg-6">
                <div class="row m-auto" style="max-width: 400px">
                    <div class="col-6 px-1">
                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"
                                    >Desde</span
                                >
                            </div>
                            <input
                                type="date"
                                class="form-control form-control-sm"
                                name="fdesde"
                                style="max-width: 150px"
                            />
                        </div>
                        <label class="text-error" v-if="errores.fdesde">
                            {{ errores.fdesde[0] }}
                        </label>
                    </div>
                    <div class="col-6 px-1" v-if="tipofecha == 'creacion' || tipofecha == 'edicion'">
                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"
                                    >Hora</span
                                >
                            </div>
                            <input
                                
                                type="time"
                                value="00:00:00"
                                class="form-control form-control-sm"
                            
                                style="max-width: 150px"
                            />
                        </div>
                    </div>
                    <div class="col-6 px-1">
                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"
                                    >Hasta</span
                                >
                            </div>
                            <input
                                type="date"
                                name="fhasta"
                                class="form-control form-control-sm"
                                aria-label="Username"
                                aria-describedby="basic-addon1"
                                style="max-width: 150px"
                            />
                        </div>
                        <label class="text-error" v-if="errores.fhasta">
                            {{ errores.fhasta[0] }}
                        </label>
                    </div>
                    <div class="col-6 px-1"  v-if="tipofecha == 'creacion' || tipofecha == 'edicion'">
                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"
                                    >Hora</span
                                >
                            </div>
                            <input
                                type="time"
                                value="00:00:00"
                                class="form-control form-control-sm"
                               
                                style="max-width: 150px"
                            />
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-6">
                <div class="mb-1">
                    <div class="row">
                        <div class="col-6">
                            <label for="" class="float-right">Fecha de:</label>
                        </div>
                        <div class="col-6">
                            <select @change="cambioTioFecha"
                              value=""
                                name="tipoFecha"
                                class="form-control form-control-sm"
                            >
                            <option value="emision">EMISÍON</option>
                            <option value="creacion">CREACÍON</option>
                            <option value="edicion">EDICION</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mb-1">
                    <div class="row">
                        <div class="col-6">
                            <label for="" class="float-right">Usuario</label>
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
                <div class="mb-1">
                    <div class="row">
                        <div class="col-6">
                            <label for="" class="float-right">Vendedor</label>
                        </div>
                        <div class="col-6">
                            <select name="vendedor" class="form-control form-control-sm">
                                <option :value="''">TODOS</option>
                                <option :value="item.id" v-for="item in datosfiltros.vendedores"> {{item.razonsocial}} </option>

                            </select>
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    <button v-if="!mostrarAvanzados"
                        type="submit"
                        class="btn btn-sm btn-success float-right"
                    >
                        <i class="fas fa-sync"></i> 
                        Aplicar filtros 
                    </button>

                     

                    <a
                        @click.prevent="mostrarAvanzados = !mostrarAvanzados"
                        href=""
                        class="link-sm float-right mr-2 mt-1"
                    >
                        <i v-if="!mostrarAvanzados" class="fas fa-plus"></i>
                        <i v-if="mostrarAvanzados" class="fas fa-minus"></i>
                        Filtros avanzados</a
                    >
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
                            <label for="" class="float-right">Almacen</label>
                        </div>
                        <div class="col-6">

                            
                             <select name="almacen" class="form-control form-control-sm">
                                <option :value="''">TODOS</option>
                                <option :value="item.id" v-for="item in datosfiltros.almacenes"> {{item.nombre}} </option>

                            </select>
                            
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-6 px-1">
                <div class="mb-1">
                    <div class="row">
                        <div class="col-6">
                            <label for="" class="float-right"
                                >Categoría de cliente</label
                            >
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
                            <label for="" class="float-right"
                                >Centro de costo</label
                            >
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
                            <label for="" class="float-right"
                                >Nro de documento</label
                            >
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
                            <label for="" class="float-right"
                                >Nro de Retención</label
                            >
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
                            <label for="" class="float-right"
                                >Tipo de listado</label
                            >
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
                                        <label
                                            class="form-check-label"
                                            for="exampleRadios1"
                                        >
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
                                        <label
                                            class="form-check-label"
                                            for="exampleRadios1"
                                        >
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
                     <button v-if="!mostrarAvanzados"
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
    props: ["errores", "campos","datosfiltros"],
    data() {
        return {
            mostrarAvanzados: false,
            tipofecha:""
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
        cambioTioFecha(e){
            console.log(e.target.value);
            this.tipofecha = e.target.value;
            console.log(this.tipofecha);
        }
    },
};
</script>

<style></style>

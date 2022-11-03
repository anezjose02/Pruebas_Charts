<template>
    <div>
        <b-modal
            body-class="p-0"
            ref="my-modal-v3"
            :size="'lg'"
            lazy
            scrollable
            :hide-header="true"
            :hide-footer="true"
        >
            <div class="relative">
                <div class="loader-sm" v-if="sending">
                    <div></div>
                </div>

                <div class="card-body" v-if="send">
                    <h5 class="text-center my-2">
                        <span class="notification alert-success">
                            <i class="fas fa-check"></i> Documentos enviados con
                            éxito</span
                        >
                    </h5>
                </div>

                <div class="card-footer" v-if="send">
                    <button
                        class="btn btn-secondary float-right"
                        @click="hideModal()"
                    >
                        <i class="fas fa-times"></i> Cerrar
                    </button>
                </div>
                <form @submit.prevent="enviarDocs" v-if="!send">
                    <input type="hidden" name="venta_id" :value="id" />
                    <div class="modal-header">
                        <h5>
                            Enviar
                            <span v-if="tipodoc == '01'"
                                >Factura - {{ numerodoc }}</span
                            >
                            <span v-if="tipodoc == '02'"
                                >Nota de venta - {{ numerodoc }}</span
                            >
                            a correo:
                        </h5>
                    </div>

                    <div class="modal-body">
                        <div>
                            <h6 class="text-info">Tipo de documento:</h6>

                            <div class="row">
                                <div class="col-3">
                                    <div class="form-check">
                                        <input
                                            type="checkbox"
                                            class="form-check-input"
                                            id="exampleCheck1"
                                            name="pdf"
                                            checked
                                        />
                                        <label
                                            class="form-check-label"
                                            for="exampleCheck1"
                                            >PDF</label
                                        >
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="form-check">
                                        <input
                                            type="checkbox"
                                            class="form-check-input"
                                            id="exampleCheck1"
                                            name="xml"
                                            checked
                                        />
                                        <label
                                            class="form-check-label"
                                            for="exampleCheck1"
                                            >XML</label
                                        >
                                    </div>
                                </div>
                            </div>
                            <br />
                            <h6 class="text-info">Correo(s):</h6>

                            <div class="row">
                                <div class="col-3" v-for="index in correos">
                                    <div class="input-group-prepend">
                                        <label
                                            for=""
                                            v-if="correocliente && index == 1"
                                            >Correo cliente</label
                                        >
                                        <label for="" v-else>
                                            Correo {{ index }}</label
                                        >
                                    </div>

                                    <div class="input-group">
                                        <input
                                            v-if="correocliente && index == 1"
                                            name="correos"
                                            type="text"
                                            class="form-control form-control-sm"
                                            readonly
                                            :value="correocliente"
                                        />
                                        <input
                                            v-else
                                            name="correos"
                                            type="text"
                                            class="form-control form-control-sm"
                                        />
                                        <div
                                            @click="removeCcliente"
                                            class="input-group-append"
                                            v-if="correos.length == 1"
                                        >
                                            <button
                                                class="btn btn-ico btn-sm btn-secondary"
                                                type="button"
                                            >
                                                <i
                                                    class="fas fa-times px-1"
                                                ></i>
                                            </button>
                                        </div>
                                        <div
                                            @click="removeC"
                                            class="input-group-append"
                                            v-if="
                                                index == correos.length &&
                                                correos.length != 1
                                            "
                                        >
                                            <button
                                                class="btn btn-ico btn-sm btn-warning"
                                                type="button"
                                            >
                                                <i
                                                    class="fas fa-times px-1"
                                                ></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <button
                                        type="button"
                                        @click="addC"
                                        class="btn btn-info btn-sm"
                                        style="margin-top: 22px"
                                    >
                                        <i class="fas fa-plus"></i> Adicionar
                                        correo
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            @click="hideModal()"
                        >
                            <i class="fas fa-times"></i> Cancelar
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-envelope"></i> Enviar documentos
                        </button>
                    </div>
                </form>
            </div>
        </b-modal>
    </div>
</template>

<script>
export default {
    props: ["id", "tipodoc", "numerodoc", "correo"],

    data() {
        return {
            correos: [1],
            correocliente: "",
            variables: [],
            send: false,
            sending: false,
        };
    },
    methods: {
        showModal(ctx) {
            this.$refs["my-modal-v3"].show();
            return this.items;
        },

        hideModal() {
            this.$refs["my-modal-v3"].hide();
            self = this;
            
            setTimeout(function () {
                self.$emit("hide");
            }, 1000);
        },
        addC() {
            this.correos.push(this.correos.length + 1);
        },
        removeC() {
            this.correos.splice(-1, 1);
        },
        removeCcliente() {
            this.correocliente = "";
        },

        async enviarDocs(submitEvent) {
            this.sending = true;
            var count = 0;
            var data = {};
            var correos = [];
            for (let item of submitEvent.target.elements) {
                if (item.name == "correos") {
                    correos.push(item.value);
                } else {
                    if (item.value && item.name) {
                        // data.push({ [item.name]: item.value })
                        data[item.name] = item.value;
                        count++;
                    }
                }
            }
            // data.push({ correos: correos });
            data.correos = correos;

            await axios
                .post("/enviar-documentos",data)
                .then((r) => {
                    // console.log("success");
                    this.sending = false;
                    this.send = true;
                    
                    this.$emit("reload");
                })
                .catch((e) => {
                    // console.log(e.response.data);
                    this.sending = false;
                });
        },
    },

    mounted() {
      
        if (this.correo) {
            this.correocliente = this.correo;
            // console.log("cliente");
            // this.correocliente = this.correocliente.email;
            // console.log(this.correocliente);
        }
        this.showModal();
    },
};
</script>

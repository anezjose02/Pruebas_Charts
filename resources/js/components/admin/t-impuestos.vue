<template>
    <div>
        <t-general title="Impuestos"
                url="/admin/get-impuestos"
                :prefields="fields"
                :preactions="actions"
                :premultiactions="multiactions"
                :prebuscadores="buscadores"
                :reloadtabla.sync="reloadtabla">
                    <b-btn class="float-right btn-sm" variant="success" @click="showModal()">
                        <i class="fas fa-plus"></i>
                    </b-btn>
        </t-general>

        <b-modal ref="my-modal" :title="newImpuesto && newImpuesto.id? 'Impuesto - '+newImpuesto.nombre : 'Nuevo Impuesto'" hide-footer>

            <center v-if="cargando">
                <h1>
                    <b-spinner></b-spinner>
                    Cargando...
                </h1>
            </center>
            <div v-else-if="newImpuesto" class="row">

                <b-form-group class="col-12 col-sm-6" label="" label-class="text-danger" label-size="sm">
                    <label for=""> Nombre: <span class="text-danger">*</span> </label>
                    <b-form-input v-model="newImpuesto.nombre" size="sm" placeholder="ICE"></b-form-input>
                </b-form-group>
                <b-form-group class="col-12 col-sm-6" label="" label-class="text-danger" label-size="sm">
                     <label for=""> Código: <span class="text-danger">*</span> </label>
                    <b-form-input v-model="newImpuesto.codigo" size="sm" placeholder="ICE"></b-form-input>
                </b-form-group>
                <b-form-group class="col-12 col-sm-6" label="" label-class="text-danger" label-size="sm">
                     <label for=""> Código de porcentaje: <span class="text-danger">*</span> </label>
                    <b-form-input v-model="newImpuesto.codigoPorcentaje" size="sm" placeholder="ICE"></b-form-input>
                </b-form-group>
                <b-form-group class="col-12 col-sm-6" label="" label-class="text-danger" label-size="sm">
                     <label for=""> Tarifa: <span class="text-danger">*</span> </label>
                    <b-form-input v-model="newImpuesto.tarifa" size="sm" placeholder="ICE"></b-form-input>
                </b-form-group>

                <div class="col-12 mt-2">
                    <b-btn variant="primary float-right" @click="saveImpuesto">
                        Guardar
                    </b-btn>
                </div>
            </div>

        </b-modal>
    </div>
</template>

<script>

export default {
    data(){
        return {
            fields: [
                {key:'action',label:'Acción',sortable:false},
                {key:'nombre',label:'Nombre',sortable:true},
                {key:'codigo',label:'Código',sortable:true},
                {key:'codigoPorcentaje',label:'Código de porcentaje',sortable:true},
                {key:'tarifa',label:'Tarifa %',sortable:true},
            ],
            actions: [
                {
                    variant: 'primary',
                    icon: 'pen',
                    callback: this.showModal
                },
                {
                    rapida: true,
                    txt: "¿Desea borrar este impuesto?",
                    variant: 'danger',
                    icon: 'trash',
                    callback: this.delImpuesto
                },
            ],
            multiactions: [

            ],
            buscadores: [

            ],

            reloadtabla: 0,

            cargando: false,

            newImpuesto: null,
        }
    },
    methods: {
        showModal(item=null){
            if (item) {
                console.log(item);
                this.newImpuesto = Object.assign({},item);
            } else {
                this.newImpuesto = {
                    nombre: '',
                    codigo: 0,
                    codigoPorcentaje: 0,
                    tarifa: 0,
                };
            }

            this.$refs["my-modal"].show();
        },
        hideModal(){
            this.$refs["my-modal"].hide();
            this.newImpuesto = null;
        },
        async saveImpuesto(){
            let faltantes='' + (!this.newImpuesto.nombre? ' Nombre.':'')
                            + (!this.newImpuesto.codigo? ' Código.':'')
                            + (!this.newImpuesto.codigoPorcentaje? ' Cod. Porcentaje.':'')
                            + (!this.newImpuesto.tarifa? ' Tarifa.':'')
            if (faltantes) {
                this.makeToast("Campos obligatorios:",faltantes,"danger");
                return;
            }
            if (this.newImpuesto.codigo == 2 || this.newImpuesto.codigo == '2') {
                this.makeToast("No agregar:",'El codigo 2 es reservado al IVA, el porcentaje deberá cambiarse en la configuaración de cada sistema.',"danger");
                return;
            }


            this.cargando = true;
            await axios.post('/admin/impuesto'+(this.newImpuesto.id? '/'+this.newImpuesto.id:'') , this.newImpuesto).then(r=>{
                this.reloadtabla++;
                this.cargando = false;
                this.hideModal();
                this.makeToast("Exito","Datos guardados exitosamente.","success");
            }).catch(e=>{
                console.log(e);
                this.makeToast("Error","Existió un error al intentar guardar los datos.","danger");
                this.cargando = false;
            });
        },
        async delImpuesto(item){
            await axios.get('/admin/delete-impuesto/' + item.id).then(r=>{
                this.reloadtabla++;
                this.makeToast("Exito","Datos eliminados exitosamente.","success");
            }).catch(e=>{
                console.log(e);
                this.makeToast("Error","Existió un error al intentar borrar los datos.","danger");
            })
        },
        makeToast(title,msg,variant="secondary") {
            this.$bvToast.toast(msg, {
                title,
                autoHideDelay: 5000,
                variant
            })
        },
    },
}
</script>

<style>

</style>
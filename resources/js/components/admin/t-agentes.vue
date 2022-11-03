<template>
    <div>
        <t-general title="Agentes de retención"
                url="/get-agentes"
                :prefields="fields"
                :preactions="actions"
                :premultiactions="multiactions"
                :prebuscadores="buscadores"
                :reloadtabla.sync="reloadtabla">
                    <b-btn class="float-right btn-sm" variant="success" @click="showModal()">
                        <i class="fas fa-plus"></i>
                    </b-btn>
        </t-general>

        <b-modal size="sm" ref="my-modal" :title="newCodigo && newCodigo.id? 'Agente de retención - '+newCodigo.nombre : 'Nuevo Agente de retención'" hide-footer>

            <center v-if="cargando">
                <h1>
                    <b-spinner></b-spinner>
                    Cargando...
                </h1>
            </center>
            <div v-else-if="newCodigo" class="row">
                
                <b-form-group class="col-12" label="" label-class="text-danger" label-size="sm">
                    <label for=""> Nombre: <span class="text-danger">*</span> </label>
                    <b-form-input v-model="newCodigo.nombre" size="sm" placeholder="Agente 1"></b-form-input>
                </b-form-group>
                <b-form-group class="col-12" label="" label-class="text-danger" label-size="sm">
                    <label for=""> Código: <span class="text-danger">*</span> </label>
                    <b-form-input v-model="newCodigo.codigo" size="sm" placeholder="1234"></b-form-input>
                </b-form-group>
                
                <div class="col-12 mt-2">
                    <b-btn variant="primary float-right" @click="saveCodigo">
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
            ],
            actions: [
                {
                    variant: 'primary',
                    icon: 'pen',
                    callback: this.showModal
                },
                {
                    rapida: true,
                    txt: "¿Desea borrar este agente?",
                    variant: 'danger',
                    icon: 'trash',
                    callback: this.delCodigo
                },
            ],
            multiactions: [

            ],
            buscadores: [

            ],

            reloadtabla: 0,

            cargando: false,

            newCodigo: null,
        }
    },
    methods: {
        showModal(item=null){
            if (item) {
                console.log(item);
                this.newCodigo = Object.assign({},item);
            } else {
                this.newCodigo = {
                    nombre: '',
                    codigo: ''
                };
            }

            this.$refs["my-modal"].show();
        },
        hideModal(){
            this.$refs["my-modal"].hide();
            this.newCodigo = null;
        },
        async saveCodigo(){
            let faltantes='' + (!this.newCodigo.nombre? ' Nombre.':'')
                            + (!this.newCodigo.codigo? ' Código.':'');
            if (faltantes) {
                this.makeToast("Campos obligatorios:",faltantes,"danger");
                return;
            }


            this.cargando = true;
            await axios.post('/agente'+(this.newCodigo.id? '/'+this.newCodigo.id:'') , this.newCodigo).then(r=>{
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
        async delCodigo(item){
            await axios.get('/delete-agente/' + item.id).then(r=>{
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
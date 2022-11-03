<template>
    <div>
        <t-general title="Planes"
                url="/admin/get-planes"
                :prefields="fields"
                :preactions="actions"
                :premultiactions="multiactions"
                :prebuscadores="buscadores"
                :reloadtabla.sync="reloadtabla">
                    <b-btn class="btn-sm float-right" variant="success" @click="showModal()">
                        <i class="fas fa-plus"></i>
                    </b-btn>
        </t-general>

        <b-modal ref="my-modal" :title="newPlan && newPlan.id? 'Plan - '+newPlan.nombre : 'Nuevo plan'" hide-footer size="lg">

            <center v-if="cargando">
                <h1>
                    <b-spinner></b-spinner>
                    Cargando...
                </h1>
            </center>
            <div v-else-if="newPlan" class="row">
                
                <b-form-group class="col-12 col-sm-4" label="" label-class="text-danger" label-size="sm">
                    <label for="">Nombre: <span class="text-danger">*</span></label>
                    <b-form-input v-model="newPlan.nombre" size="sm" placeholder="Básico"></b-form-input>
                </b-form-group>
                <b-form-group class="col-12 col-sm-4" label="" label-class="text-danger" label-size="sm">
                    <label for="">Licencia: <span class="text-danger">*</span></label>
                    <b-form-select :options="licencias" size="sm" v-model="newPlan.licencia"></b-form-select>
                </b-form-group>
                <b-form-group class="col-12 col-sm-4" label="" label-class="text-danger" label-size="sm">
                    <label for="">Precio: <span class="text-danger">*</span></label>
                    <b-form-input v-model="newPlan.precio" size="sm" type="number"></b-form-input>
                </b-form-group>
                
                <b-form-group class="col-12 col-sm-4" description="Para representar lo Imlimitado coloque 1000000" label="" label-class="text-danger" label-size="sm">
                    <label for="">Max. Facturas: <span class="text-danger">*</span></label>
                    <b-form-input v-model="newPlan.limite_facturas" size="sm" type="number"></b-form-input>
                </b-form-group>
                <b-form-group class="col-12 col-sm-4" description="Para representar lo Imlimitado coloque 1000000" label="" label-class="text-danger" label-size="sm">
                    <label for="">Max. Empresas: <span class="text-danger">*</span></label>
                    <b-form-input v-model="newPlan.max_empresas" size="sm" type="number"></b-form-input>
                </b-form-group>
                <b-form-group class="col-12 col-sm-4" description="Para representar lo Imlimitado coloque 1000000" label="" label-class="text-danger" label-size="sm">
                    <label for="">Max. Sucursales por empresa: <span class="text-danger">*</span></label>
                    <b-form-input v-model="newPlan.max_sucursales" size="sm" type="number"></b-form-input>
                </b-form-group>
                <b-form-group class="col-12 col-sm-4" description="Para representar lo Imlimitado coloque 1000000" label="" label-class="text-danger" label-size="sm">
                    <label for="">Max. Usuarios: <span class="text-danger">*</span></label>
                    <b-form-input v-model="newPlan.max_usuarios" size="sm" type="number"></b-form-input>
                </b-form-group>
                <b-form-group class="col-12 col-sm-4" description="Para representar lo Imlimitado coloque 1000000" label="" label-class="text-danger" label-size="sm">
                    <label for="">Max. Ptos Emisión por sucursal: <span class="text-danger">*</span></label>
                    <b-form-input v-model="newPlan.max_puntos" size="sm" type="number"></b-form-input>
                </b-form-group>
                <b-form-group class="col-12 col-sm-4" description="Para representar lo Imlimitado coloque 1000000" label="" label-class="text-danger" label-size="sm">
                    <label for=""> Max. Cajas por sucursal: <span class="text-danger">*</span></label>
                    <b-form-input v-model="newPlan.max_cajas" size="sm" type="number"></b-form-input>
                </b-form-group>

                <b-form-group class="col-12" label="Módulos:" label-size="sm">
                    <b-checkbox-group size="sm" v-model="newPlan.modulos" :options="modulos">
                    </b-checkbox-group>
                </b-form-group>

                <div class="col-12 mt-2">
                    <b-btn class="float-right" variant="primary" @click="savePlan">
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
                {key:'licencia',label:'Licencia',sortable:true},
                {key:'precio',label:'Precio',sortable:true},
                {key:'limite_facturas',label:'Max. Facturas',sortable:true},
                {key:'max_empresas',label:'Max. Empresas',sortable:true},
                {key:'max_sucursales',label:'Max. Sucursales',sortable:true},
                {key:'max_usuarios',label:'Max. Usuarios',sortable:true},
                {key:'max_puntos',label:'Max. Puntos de emisión',sortable:true},
                {key:'max_cajas',label:'Max. Cajas',sortable:true},
            ],
            actions: [
                {
                    variant: 'primary',
                    icon: 'pen',
                    callback: this.showModal
                },
                {
                    rapida: true,
                    txt: "¿Desea borrar este plan?",
                    variant: 'danger',
                    icon: 'trash',
                    callback: this.delPlan
                },
            ],
            multiactions: [

            ],
            buscadores: [

            ],

            reloadtabla: 0,

            cargando: false,

            newPlan: null,

            modulos: [],
            licencias: ['MENSUAL','ANUAL','PERMANENTE'],
        }
    },
    methods: {
        showModal(item=null){
            if (item) {
                console.log(item);
                this.newPlan = Object.assign({},item,{modulos:JSON.parse(item.modulos)});
            } else {
                this.newPlan = {
                    nombre: '',
                    modulos: [],
                    licencia: 'MENSUAL',
                    precio: 0,
                    limite_facturas: 0,
                    max_empresas: 0,
                    max_sucursales: 0,
                    max_usuarios: 0,
                    max_puntos: 0,
                    max_cajas: 0,
                };
            }

            this.$refs["my-modal"].show();
        },
        hideModal(){
            this.$refs["my-modal"].hide();
            this.newPlan = null;
        },
        async getModulos(){
            await axios.get('/get-constante-modulos').then(r=>{
                this.modulos = r.data;
            }).catch(e=>{
                console.log(e);
            });
        },
        async savePlan(){
            let faltantes='' + (!this.newPlan.nombre? ' Nombre.':'')
                            + (!this.newPlan.licencia? ' Licencia.':'')
                            + (!this.newPlan.precio? ' Precio.':'')
                            + (!this.newPlan.limite_facturas? ' Max. Facturas.':'')
                            + (!this.newPlan.max_empresas? ' Max. Empresas.':'')
                            + (!this.newPlan.max_sucursales? ' Max. Sucursales por empresa.':'')
                            + (!this.newPlan.max_usuarios? ' Max. Usuarios.':'')
                            + (!this.newPlan.max_puntos? ' Max. Ptos Emisión por sucursal.':'')
                            + (!this.newPlan.max_cajas? ' Max. Cajas por sucursal.':'');
            if (faltantes) {
                this.makeToast("Campos obligatorios:",faltantes,"danger");
                return;
            }


            this.cargando = true;
            await axios.post('/admin/plan'+(this.newPlan.id? '/'+this.newPlan.id:'') , this.newPlan).then(r=>{
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
        async delPlan(item){
            await axios.get('/admin/delete-plan/' + item.id).then(r=>{
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
    mounted(){
        this.getModulos();
    },
}
</script>

<style>

</style>
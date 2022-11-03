<template>
    <div>
        <t-general title="Roles"
                url="/get-roles"
                :prefields="fields"
                :preactions="actions"
                :premultiactions="multiactions"
                :prebuscadores="buscadores"
                :reloadtabla.sync="reloadtabla">
                    <b-btn class="float-right" size="sm" v-if="essuperuser || puedecrear" variant="success" @click="showModal()">
                        <i class="fas fa-plus"></i>
                    </b-btn>
        </t-general>

        <b-modal ref="my-modal" :title="newRole && newRole.id? 'Rol - '+newRole.nombre : 'Nuevo rol'" hide-footer size="xl">

            <center v-if="cargando">
                <h1>
                    <b-spinner></b-spinner>
                    Cargando...
                </h1>
            </center>
            <div v-else-if="newRole" class="row">
                
                <div class="col-12">
                    <b-form-group style="max-width:300px"  label-class="text-danger" label-size="sm">
                    <label for=""> Nombre:  <span class="text-danger">*</span></label>
                    <b-form-input v-model="newRole.nombre" size="sm" placeholder="Gerente"></b-form-input>
                </b-form-group>
                </div>

                <div class="col-12">
                    <div class="accordion row" role="tablist">
                        <div class="col-12 col-lg-4 col-sm-6 col-xl-3" v-for="(m,i) in modulos" :key="i">
                            <b-card  no-body class="mb-1 card-round">
                                <b-card-header v-b-toggle="'accordion-' + m" header-tag="header" class="p-1 hover" role="tab">
                                    <b-button size="sm" class="float-right" variant="success">
                                        <i class="fas fa-chevron-down"></i>
                                    </b-button>
                                    <h5>{{m}}</h5>
                                </b-card-header>
                                <b-collapse :id="'accordion-' + m" accordion="my-accordion" role="tabpanel">
                                    <b-card-body>
                                        <span v-for="(p,ip) in permisos" :key="ip">
                                            <b-form-checkbox v-model="p.check" @input="seleccionarPermisos(ip)" v-if="p.value.indexOf(m) > -1" value="1" size="sm" unchecked-value="0">
                                                {{ p.text }}
                                            </b-form-checkbox>
                                        </span>
                                    </b-card-body>
                                </b-collapse>
                            </b-card>                            
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-2">
                    <b-btn variant="primary float-right" @click="saveRole">
                       <i class="fas fa-save"></i> Guardar
                    </b-btn>
                </div>
            </div>

        </b-modal>
    </div>
</template>

<script>

export default {
    props: ['essuperuser','puedecrear','puedeeditar','puedeborrar','premodulos'],
    data(){
        return {
            fields: [
                {key:'action',label:'Acción',sortable:false},
                {key:'nombre',label:'Nombre',sortable:true},
            ],
            actions: [
                
            ],
            multiactions: [

            ],
            buscadores: [

            ],

            reloadtabla: 0,

            cargando: false,

            newRole: null,

            permisos: [],
            modulos: [],
        }
    },
    methods: {
        seleccionarPermisos(ip){
            if (this.permisos[ip].check == 1) {
                this.newRole.permisos.push(this.permisos[ip].value);
            }else{
                for (let i = 0; i < this.newRole.permisos.length; i++) {
                    if (this.newRole.permisos[i] == this.permisos[ip].value) {
                        this.newRole.permisos.splice(i,1);
                        i--;
                    }
                }
            }

            this.filtrarModulos();
        },

        filtrarModulos(){
            this.newRole.modulos = [];

            for (let i = 0; i < this.newRole.permisos.length; i++) {
                let x = this.newRole.permisos[i].split('.');

                this.newRole.modulos.push(x[0]);
            }

            for (let i = 0; i < this.newRole.modulos.length; i++) {
                for (let j = i+1; j < this.newRole.modulos.length; j++) {
                    if (this.newRole.modulos[i] == this.newRole.modulos[j]) {
                        this.newRole.modulos.splice(j,1);
                        j--;
                    }
                }
            }
        },
        showModal(item=null){
            if (item) {
                this.newRole = Object.assign({},item,{permisos:JSON.parse(item.permisos),modulos:JSON.parse(item.modulos)});
                console.log(this.newRole);
            } else {
                this.newRole = {
                    nombre: '',
                    permisos: [],
                    modulos: [],
                };
            }

            for (let i = 0; i < this.permisos.length; i++) {
                this.permisos[i].check = 0;
                if (this.newRole.permisos.indexOf(this.permisos[i].value) > -1) {
                    this.permisos[i].check = 1;
                }
                
            }

            this.$refs["my-modal"].show();
        },
        hideModal(){
            this.$refs["my-modal"].hide();
            this.newRole = null;
        },
        async getPermisos(){
            await axios.get('/get-constante-permisos').then(r=>{
                this.permisos = r.data;
            }).catch(e=>{
                console.log(e);
            });
        },
        async saveRole(){
            let faltantes='' + (!this.newRole.nombre? ' Nombre.':'');
            if (faltantes) {
                this.makeToast("Campos obligatorios:",faltantes,"danger");
                return;
            }


            this.cargando = true;
            await axios.post('/role'+(this.newRole.id? '/'+this.newRole.id:'') , this.newRole).then(r=>{
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
        async delRole(item){
            await axios.get('/delete-role/' + item.id).then(r=>{
                this.reloadtabla++;
                this.makeToast("Exito","Datos eliminados exitosamente.","success");
            }).catch(e=>{
                console.log(e);
                this.makeToast("Error","Existió un error al intentar borrar los datos.","danger");
            })
        },
        async delRoleMulti(items){
            for (let i = 0; i < items.length; i++) {
                await axios.get('/delete-role/' + items[i].id).then(r=>{
                    this.reloadtabla++;
                    this.makeToast("Exito","Datos eliminados exitosamente.","success");
                }).catch(e=>{
                    console.log(e);
                    this.makeToast("Error","Existió un error al intentar borrar los datos.","danger");
                })
            }
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
        if (this.essuperuser || this.puedeeditar) {
            this.actions.push({
                variant: 'primary',
                icon: 'pen',
                callback: this.showModal
            });
        }if (this.essuperuser || this.puedeborrar) {
            this.actions.push({
                rapida: true,
                txt: "¿Desea borrar este rol?",
                variant: 'danger',
                icon: 'trash',
                callback: this.delRole
            });
            this.multiactions.push({
                txt: "¿Desea borrar los roles selecionados?",
                variant: 'danger',
                icon: 'trash',
                callback: this.delRoleMulti
            });
        }
        if (this.premodulos) {
            this.modulos = JSON.parse(this.premodulos);
        }
        this.getPermisos();
    },
}
</script>

<style>

</style>
<template>
    <div>
        <t-general title="Puntos"
                url="/get-puntos"
                :prefields="fields"
                :preactions="actions"
                :premultiactions="multiactions"
                :prebuscadores="buscadores"
                :reloadtabla.sync="reloadtabla">
                    <b-btn class="btn-sm float-right" v-if="essuperuser || puedecrear" variant="success" @click="showModal()">
                        <i class="fas fa-plus"></i>
                    </b-btn>
        </t-general>

        <b-modal ref="my-modal" :title="newPunto && newPunto.id? 'Punto - '+newPunto.nombreComercial : 'Nuevo Punto'" hide-footer size="xl">

            <center v-if="cargando">
                <h1>
                    <b-spinner></b-spinner>
                    Cargando...
                </h1>
            </center>
            <div v-else-if="newPunto" class="row">
                <b-form-group label="" label-class="text-danger" class="col-12 col-md-4 col-lg-3" label-size="sm">
                    <label for="">Empresa: <span class="text-danger">*</span> </label>
                    <b-form-select size="sm" @change="setSucursalesOP" :options="empresas" v-model="newPunto.empresa_id"></b-form-select>
                </b-form-group>
                <b-form-group label="" label-class="text-danger" class="col-12 col-md-4 col-lg-3" label-size="sm">
                    <label for="">Sucursal: <span class="text-danger">*</span> </label>
                    <b-form-select size="sm" :options="sucursales_op" v-model="newPunto.sucursales_id"></b-form-select>
                </b-form-group>
                <b-form-group label="" label-class="text-danger" class="col-12 col-md-4 col-lg-3" label-size="sm">
                    <label for="">Punto: <span class="text-danger">*</span> </label>
                    <b-form-input size="sm" v-model="newPunto.ptoEmi" placeholder="001"></b-form-input>
                </b-form-group>

                <b-form-group label="" label-class="text-danger" class="col-12 col-md-4 col-lg-3" label-size="sm">
                    <label for="">Secuencial de facturas: <span class="text-danger">*</span> </label>
                    <b-form-input size="sm" v-model="newPunto.secuencialfactura" placeholder="000000001"></b-form-input>
                </b-form-group>
                <b-form-group label="" label-class="text-danger" class="col-12 col-md-4 col-lg-3" label-size="sm">
                    <label for="">Secuencial de retenciones: <span class="text-danger">*</span> </label>
                    <b-form-input size="sm" v-model="newPunto.secuencialretencion" placeholder="000000001"></b-form-input>
                </b-form-group>
                <b-form-group label="" label-class="text-danger" class="col-12 col-md-4 col-lg-3" label-size="sm">
                    <label for="">Secuencial n. crédito: <span class="text-danger">*</span> </label>
                    <b-form-input size="sm" v-model="newPunto.secuencialnotacredito" placeholder="000000001"></b-form-input>
                </b-form-group>
                
                <b-form-group label="" label-class="text-danger" class="col-12 col-md-4 col-lg-3" label-size="sm">
                    <label for="">Secuencial n. débito: <span class="text-danger">*</span> </label>
                    <b-form-input size="sm" v-model="newPunto.secuencialnotadebito" placeholder="000000001"></b-form-input>
                </b-form-group>
                <b-form-group label="" label-class="text-danger" class="col-12 col-md-4 col-lg-3" label-size="sm">
                    <label for="">Secuencial g. remisión: <span class="text-danger">*</span> </label>
                    <b-form-input size="sm" v-model="newPunto.secuencialguiaremision" placeholder="000000001"></b-form-input>
                </b-form-group>
                <b-form-group label="" label-class="text-danger" class="col-12 col-md-4 col-lg-3" label-size="sm">
                    <label for="">Secuencial liquidaciones compra: <span class="text-danger">*</span> </label>
                    <b-form-input size="sm" v-model="newPunto.secuencialliquidacioncompra" placeholder="000000001"></b-form-input>
                </b-form-group>

                <div class="col-12 mt-2">
                    <b-btn variant="primary" class="float-right btn-primary" @click="savePunto">
                        Guardar
                    </b-btn>
                </div>
            </div>

        </b-modal>
    </div>
</template>

<script>

export default {
    props: ['essuperuser','puedecrear','puedeeditar','puedeborrar'],
    data(){
        return {
            fields: [
                {key:'action',label:'Acción',sortable:false},
                {key:'ptoEmi',label:'Punto de emisión',sortable:true},
                {key:'secuencialfactura',label:'Secuencial Facturas',sortable:true},
                {key:'secuencialretencion',label:'Secuencial retenciones',sortable:true},
                {key:'secuencialnotacredito',label:'Secuencial N. crédito',sortable:true},
                {key:'secuencialnotadebito',label:'Secuencial N. débito',sortable:true},
                {key:'secuencialguiaremision',label:'Secuencial Guías de remisión',sortable:true},
                {key:'secuencialliquidacioncompra',label:'Secuencial licquidaciones de compra',sortable:true},
            ],
            actions: [
                
            ],
            multiactions: [

            ],
            buscadores: [

            ],

            reloadtabla: 0,

            cargando: false,

            newPunto: null,

            empresas: [],
            sucursales: [],
            sucursales_op: [],
        }
    },
    methods: {
        showModal(item=null){
            if (item) {
                console.log(item);
                this.newPunto = Object.assign({},item);

                Object.keys(this.newPunto).forEach(key => {
                    if (this.newPunto[key]=='null') {
                        this.newPunto[key]=null;
                    }
                });

                this.setSucursalesOP();
            } else {
                this.newPunto = {
                    empresa_id: 0,
                    sucursales_id: 0,
                    ptoEmi: '',
                    secuencialfactura: 1,
                    secuencialretencion: 1,
                    secuencialnotacredito: 1,
                    secuencialnotadebito: 1,
                    secuencialguiaremision: 1,
                    secuencialliquidacioncompra: 1,
                };

                this.sucursales_op = [];
            }

            this.$refs["my-modal"].show();
        },
        hideModal(){
            this.$refs["my-modal"].hide();
            this.newPunto = null;
        },
        setSucursalesOP(){
            this.sucursales_op = [];
            for (let i = 0; i < this.sucursales.length; i++) {
                if (this.sucursales[i].empresa_id == this.newPunto.empresa_id) {
                    this.sucursales_op.push(this.sucursales[i]);
                }
            }
        },
        async getEmpresas(){
            await axios.get("/get-all-empresas").then(r=>{
                for (let i = 0; i < r.data.length; i++) {
                    let x = {
                        value: r.data[i].id,
                        text: r.data[i].nombreComercial? r.data[i].nombreComercial : r.data[i].razonSocial
                    }
    
                    this.empresas.push(x);                    
                }
            }).catch(e=>{
                console.log(e);
            })
        },
        async getSucursales(){
            await axios.get("/get-all-sucursales").then(r=>{
                for (let i = 0; i < r.data.length; i++) {
                    let x = {
                        empresa_id: r.data[i].empresa_id,
                        value: r.data[i].id,
                        text: r.data[i].estab
                    }
    
                    this.sucursales.push(x);                    
                }
            }).catch(e=>{
                console.log(e);
            })
        },
        async savePunto(){
            let faltantes='' + (!this.newPunto.empresa_id? ' Empresa.':'')
                            + (!this.newPunto.sucursales_id? ' Sucursal.':'')
                            + (!this.newPunto.ptoEmi? ' Punto de emisión.':'')
                            + (!this.newPunto.secuencialfactura? ' Secuencial de Facturas.':'')
                            + (!this.newPunto.secuencialretencion? ' Secuencial de retenciones.':'')
                            + (!this.newPunto.secuencialnotacredito? ' Secuencial de notas de crédito.':'')
                            + (!this.newPunto.secuencialnotadebito? ' Secuencial de notas de débito.':'')
                            + (!this.newPunto.secuencialguiaremision? ' Secuencial de guías de remisión.':'')
                            + (!this.newPunto.secuencialliquidacioncompra? ' Secuencial de liquidaciones de compra.':'');
            if (faltantes) {
                this.makeToast("Campos obligatorios:",faltantes,"danger");
                return;
            }
            if (this.newPunto.secuencialfactura.length + '' > 9) {
                this.makeToast("Error:","El secuencial de facturas solo puede tener 9 digitos, o un numero inferior a 1000000000.","danger");
                return;
            }
            if (this.newPunto.secuencialretencion.length + '' > 9) {
                this.makeToast("Error:","El secuencial de proforma solo puede tener 9 digitos, o un numero inferior a 1000000000.","danger");
                return;
            }
            if (this.newPunto.secuencialnotacredito.length + '' > 9) {
                this.makeToast("Error:","El secuencial de notas de crédito solo puede tener 9 digitos, o un numero inferior a 1000000000.","danger");
                return;
            }
            if (this.newPunto.secuencialnotadebito.length + '' > 9) {
                this.makeToast("Error:","El secuencial de notas de débito solo puede tener 9 digitos, o un numero inferior a 1000000000.","danger");
                return;
            }
            if (this.newPunto.secuencialguiaremision.length + '' > 9) {
                this.makeToast("Error:","El secuencial de guías de remisión solo puede tener 9 digitos, o un numero inferior a 1000000000.","danger");
                return;
            }
            if (this.newPunto.secuencialliquidacioncompra.length + '' > 9) {
                this.makeToast("Error:","El secuencial de liquidaciones de compra solo puede tener 9 digitos, o un numero inferior a 1000000000.","danger");
                return;
            }

            this.cargando = true;
            await axios.post('/punto'+(this.newPunto.id? '/'+this.newPunto.id:'') , this.newPunto).then(r=>{
                                this.reloadtabla++;
                                this.cargando = false;
                                this.hideModal();
                                if (r.data) {
                                    this.makeToast("Exito","Datos guardados exitosamente.","success");
                                    
                                } else {
                                    this.makeToast("Limite de plan","Límite de creacion alcanzado, para crear mas elementos solicite un plan avanzado.","warning");
                                }
            }).catch(e=>{
                console.log(e);
                this.makeToast("Error","Existió un error al intentar guardar los datos.","danger");
                this.cargando = false;
            });
        },
        async delPunto(item){
            await axios.get('/delete-punto/' + item.id).then(r=>{
                this.reloadtabla++;
                this.makeToast("Exito","Datos eliminados exitosamente.","success");
            }).catch(e=>{
                console.log(e);
                this.makeToast("Error","Existió un error al intentar borrar los datos.","danger");
            })
        },
        async delPuntoMulti(items){
            for (let i = 0; i < items.length; i++) {
                await axios.get('/delete-punto/' + items[i].id).then(r=>{
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
                txt: "¿Desea borrar esta punto?",
                variant: 'danger',
                icon: 'trash',
                callback: this.delPunto
            });
            this.multiactions.push({
                txt: "¿Desea borrar las puntos selecionadas?",
                variant: 'danger',
                icon: 'trash',
                callback: this.delPuntoMulti
            });
        }

        this.getEmpresas();
        this.getSucursales();
    },
}
</script>

<style>

</style>
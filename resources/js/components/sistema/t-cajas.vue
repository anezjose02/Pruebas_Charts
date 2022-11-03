<template>
    <div>
        <t-general title="Cajas"
                url="/get-cajas"
                :prefields="fields"
                :preactions="actions"
                :premultiactions="multiactions"
                :prebuscadores="buscadores"
                :reloadtabla.sync="reloadtabla">
                    <b-btn class="float-right" size="sm" v-if="essuperuser || puedecrear" variant="success" @click="showModal()">
                       <i class="fas fa-plus"></i>
                    </b-btn>
        </t-general>

        <b-modal ref="my-modal" :title="newCaja && newCaja.id? 'Caja - '+newCaja.nombreComercial : 'Nueva Caja'" hide-footer size="xl">

            <center v-if="cargando">
                <h1>
                    <b-spinner></b-spinner>
                    Cargando...
                </h1>
            </center>
            <div v-else-if="newCaja" class="row">
                <b-form-group label="" label-class="text-danger" class="col-12 col-sm-3" label-size="sm">
                    <label for="">Empresa: <span class="text-danger">*</span></label>
                    <b-form-select size="sm" @change="setSucursalesOP" :options="empresas" v-model="newCaja.empresa_id"></b-form-select>
                </b-form-group>
                <b-form-group label="" label-class="text-danger" class="col-12 col-sm-3" label-size="sm">
                    <label for="">Sucursal: <span class="text-danger">*</span></label>
                    <b-form-select size="sm" @change="setPuntosOP" :options="sucursales_op" v-model="newCaja.sucursales_id"></b-form-select>
                </b-form-group>
                <b-form-group label=" " label-class="text-danger" class="col-12 col-sm-3" label-size="sm">
                    <label for="">Punto de emisión: <span class="text-danger">*</span></label>
                    <b-form-select size="sm" :options="puntos_op" v-model="newCaja.punto_id"></b-form-select>
                </b-form-group>
                <b-form-group label="" label-class="text-danger" class="col-12 col-sm-3" label-size="sm">
                    <label for="">Nombre: <span class="text-danger">*</span></label>
                    <b-form-input size="sm" v-model="newCaja.nombre" placeholder="CAJA 1"></b-form-input>
                </b-form-group>
                <b-form-group label="" class="col-12 col-sm-3" label-size="sm">
                    <label for="">Ambiente: <span class="text-danger">*</span></label>
                    <b-form-select size="sm" v-model="newCaja.ambiente" :options="[{value:1,text:'PRUEBAS'},{value:2,text:'PRODUCCIÓN'}]"></b-form-select>
                </b-form-group>

                
                          <div class="col-12 col-md-3">
                            <br>
                    <b-form-checkbox v-model="newCaja.facturafisica" value="1" unchecked-value="0" size="sm">
                        Factura física.
                    </b-form-checkbox>
                </div>
                <div class="col-12 col-md-3">
                    <br>
                    <b-form-checkbox v-model="newCaja.envioautomatico" value="1" unchecked-value="0" size="sm">
                        Envío automático
                    </b-form-checkbox>
                </div>
                <div class="col-12 col-md-3">
                    <br>
                    <b-form-checkbox v-model="newCaja.efectivo" value="1" unchecked-value="0" size="sm">
                        Caja de efectivo.
                    </b-form-checkbox>
                </div>
                  

                <div class="col-12 mt-2">
                    <b-btn class="float-right" variant="primary" @click="saveCaja">
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
                {key:'nombre',label:'Caja',sortable:true},
                {key:'ambiente',label:'Ambiente',sortable:true,formatter: (value)=>{
                    if (value == 2) {
                        return 'PRODUCCIÓN'
                    } else {
                        return 'PRUEBAS'
                    }
                }},
                {key:'facturafisica',label:'Factura física',sortable:true,formatter: (value)=>{
                    if (value) {
                        return 'SI';
                    } else {
                        return 'NO';
                    }
                }},
                {key:'envioautomatico',label:'Envío automático',sortable:true,formatter: (value)=>{
                    if (value) {
                        return 'SI';
                    } else {
                        return 'NO';
                    }
                }},
                {key:'efectivo',label:'Caja de efectivo',sortable:true,formatter: (value)=>{
                    if (value) {
                        return 'SI';
                    } else {
                        return 'NO';
                    }
                }},
            ],
            actions: [
                
            ],
            multiactions: [

            ],
            buscadores: [

            ],

            reloadtabla: 0,

            cargando: false,

            newCaja: null,

            empresas: [],
            sucursales: [],
            puntos: [],

            sucursales_op: [],
            puntos_op: [],
        }
    },
    methods: {
        showModal(item=null){
            if (item) {
                console.log(item);
                this.newCaja = Object.assign({},item);

                Object.keys(this.newCaja).forEach(key => {
                    if (this.newCaja[key]=='null') {
                        this.newCaja[key]=null;
                    }
                });

                this.setSucursalesOP();
            } else {
                this.newCaja = {
                    empresa_id: 0,
                    sucursales_id: 0,
                    punto_id: 0,
                    nombre: '',
                    ambiente: '1',
                    facturafisica: 0,
                    envioautomatico: 0,
                    efectivo: 0
                };

                this.sucursales_op = [];
            }

            this.$refs["my-modal"].show();
        },
        hideModal(){
            this.$refs["my-modal"].hide();
            this.newCaja = null;
        },
        setSucursalesOP(){
            this.sucursales_op = [];
            for (let i = 0; i < this.sucursales.length; i++) {
                if (this.sucursales[i].empresa_id == this.newCaja.empresa_id) {
                    this.sucursales_op.push(this.sucursales[i]);
                }
            }

            this.setPuntosOP();
        },
        setPuntosOP(){
            this.puntos_op = [];
            for (let i = 0; i < this.puntos.length; i++) {
                if (this.puntos[i].sucursales_id == this.newCaja.sucursales_id) {
                    this.puntos_op.push(this.puntos[i]);
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
        async getPuntos(){
            await axios.get("/get-all-puntos").then(r=>{
                for (let i = 0; i < r.data.length; i++) {
                    let x = {
                        sucursales_id: r.data[i].sucursales_id,
                        value: r.data[i].id,
                        text: r.data[i].ptoEmi
                    }
    
                    this.puntos.push(x);                    
                }
            }).catch(e=>{
                console.log(e);
            })
        },
        async saveCaja(){
            let faltantes='' + (!this.newCaja.empresa_id? ' Empresa.':'')
                            + (!this.newCaja.sucursales_id? ' Sucursal.':'')
                            + (!this.newCaja.punto_id? ' Punto de emisión.':'')
                            + (!this.newCaja.nombre? ' Nombre.':'');
            if (faltantes) {
                this.makeToast("Campos obligatorios:",faltantes,"danger");
                return;
            }

            this.cargando = true;
            await axios.post('/caja'+(this.newCaja.id? '/'+this.newCaja.id:'') , this.newCaja).then(r=>{
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
        async delCaja(item){
            await axios.get('/delete-caja/' + item.id).then(r=>{
                this.reloadtabla++;
                this.makeToast("Exito","Datos eliminados exitosamente.","success");
            }).catch(e=>{
                console.log(e);
                this.makeToast("Error","Existió un error al intentar borrar los datos.","danger");
            })
        },
        async delCajaMulti(items){
            for (let i = 0; i < items.length; i++) {
                await axios.get('/delete-caja/' + items[i].id).then(r=>{
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
                txt: "¿Desea borrar esta caja?",
                variant: 'danger',
                icon: 'trash',
                callback: this.delCaja
            });
            this.multiactions.push({
                txt: "¿Desea borrar las cajas selecionadas?",
                variant: 'danger',
                icon: 'trash',
                callback: this.delCajaMulti
            });
        }

        this.getEmpresas();
        this.getSucursales();
        this.getPuntos();
    },
}
</script>

<style>

</style>
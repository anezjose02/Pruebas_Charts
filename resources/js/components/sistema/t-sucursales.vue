<template>
    <div>
        <t-general title="Sucursales"
                url="/get-sucursales"
                :prefields="fields"
                :preactions="actions"
                :premultiactions="multiactions"
                :prebuscadores="buscadores"
                :reloadtabla.sync="reloadtabla">
                    <b-btn class="float-right" v-if="essuperuser || puedecrear" variant="success" size="sm" @click="showModal()">
                        <i class="fas fa-plus"></i>
                    </b-btn>
        </t-general>

        <b-modal ref="my-modal" :title="newSucursal && newSucursal.id? 'Sucursal - '+newSucursal.nombreComercial : 'Nueva Sucursal'" hide-footer size="xl">

            <center v-if="cargando">
                <h1>
                    <b-spinner></b-spinner>
                    Cargando...
                </h1>
            </center>
            <div v-else-if="newSucursal" class="row">
                <b-form-group  label-class="text-danger" class="col-12 col-md-4" label-size="sm">
                        <label for="">Empresa: <span class="text-danger">*</span></label>
                    <b-form-select size="sm" :options="empresas" v-model="newSucursal.empresa_id"></b-form-select>
                </b-form-group>
                <b-form-group label="" label-class="text-danger" class="col-12 col-md-3" label-size="sm">
                     <label for="">Cod. Establecimiento: <span class="text-danger">*</span></label>
                    <b-form-input size="sm" v-model="newSucursal.estab" placeholder="001"></b-form-input>
                </b-form-group>
                <b-form-group label="" label-class="text-danger" class="col-12 col-md-5" label-size="sm">
                    <label for="">Dirección: <span class="text-danger">*</span></label>
                    <b-form-input size="sm" v-model="newSucursal.direccion" placeholder="Av. Colon y 10 de Agosto"></b-form-input>
                </b-form-group>
                
                <b-form-group label="Email:"  class="col-12 col-lg-3" label-size="sm">
                    <b-form-input size="sm" v-model="newSucursal.email" placeholder="mi@web.com"></b-form-input>
                </b-form-group>
                <b-form-group label="Celular:"  class="col-12 col-lg-3" label-size="sm">
                    <b-form-input size="sm" v-model="newSucursal.celular" placeholder="0995885996"></b-form-input>
                </b-form-group>
                <b-form-group label="Teléfono:"  class="col-12 col-lg-3" label-size="sm">
                    <b-form-input size="sm" v-model="newSucursal.telefono" placeholder="02 455 4555"></b-form-input>
                </b-form-group>
                <b-form-group label="Web:"  class="col-12 col-lg-3" label-size="sm">
                    <b-form-input size="sm" v-model="newSucursal.web" placeholder="www.mi-web.com"></b-form-input>
                </b-form-group>
                
                <b-form-group label="Leyenda facturas:"  class="col-12 col-md-3" label-size="sm">
                    <b-form-input size="sm" v-model="newSucursal.facturas1" placeholder="importador jc"></b-form-input>
                </b-form-group>
                <b-form-group label="Leyenda facturas 2:"  class="col-12 col-md-3" label-size="sm">
                    <b-form-input size="sm" v-model="newSucursal.facturas2" placeholder="importador jc"></b-form-input>
                </b-form-group>
                <b-form-group label="Leyenda proformas:"  class="col-12 col-md-3" label-size="sm">
                    <b-form-input size="sm" v-model="newSucursal.proformas1" placeholder="importador jc"></b-form-input>
                </b-form-group>
                <b-form-group label="Leyenda proformas 2:"  class="col-12 col-md-3" label-size="sm">
                    <b-form-input size="sm" v-model="newSucursal.proformas2" placeholder="importador jc"></b-form-input>
                </b-form-group>

                <b-form-group label="" label-class="text-danger" class="col-12 col-md-3" label-size="sm">
                    <label for="">Secuencial de proforma: <span class="text-danger">*</span></label>
                    <b-form-input size="sm" v-model="newSucursal.secuencialproforma" placeholder="000000001"></b-form-input>
                </b-form-group>

       

                <b-form-group label="Logo Factura:(PNG,JPG,JPEG)" class="col-12 col-lg-3">
                    <b-form-file
                        v-model="newSucursal.file_1"
                        accept=".p12"
                        :state="true"
                        placeholder="Seleccione una imagen..."
                        drop-placeholder="Arrastre su imagen aqui..."
                        size="sm"
                    ></b-form-file>
                </b-form-group>
                <b-form-group label="Logo Proforma:(PNG,JPG,JPEG)" class="col-12 col-lg-3">
                    <b-form-file
                        v-model="newSucursal.file_2"
                        accept=".p12"
                        :state="true"
                        placeholder="Seleccione una imagen..."
                        drop-placeholder="Arrastre su imagen aqui..."
                        size="sm"
                    ></b-form-file>
                </b-form-group>
                <b-form-group label="Logo marca de agua:(PNG,JPG,JPEG)" class="col-12 col-lg-3">
                    <b-form-file
                        v-model="newSucursal.file_3"
                        accept=".p12"
                        :state="true"
                        placeholder="Seleccione una imagen..."
                        drop-placeholder="Arrastre su imagen aqui..."
                        size="sm"
                    ></b-form-file>
                </b-form-group>
                <b-form-group label="Logo contrato:(PNG,JPG,JPEG)" class="col-12 col-lg-3">
                    <b-form-file
                        v-model="newSucursal.file_4"
                        accept=".p12"
                        :state="true"
                        placeholder="Seleccione una imagen..."
                        drop-placeholder="Arrastre su imagen aqui..."
                        size="sm"
                    ></b-form-file>
                </b-form-group>
                         <div class="col-12">
                    <b-form-checkbox value="1" unchecked-value="0" v-model="newSucursal.aplicaservicios">
                        Aplica servicios
                    </b-form-checkbox>
                </div>
                <div class="col-12 mt-2">
                    <b-btn variant="primary float-right" @click="saveSucursal">
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
                {key:'estab',label:'Establecimiento',sortable:true},
                {key:'direccion',label:'Dirección',sortable:true},
                {key:'email',label:'Email',sortable:true},
                {key:'celular',label:'Celular',sortable:true},
                {key:'telefono',label:'Teléfono',sortable:true},
                {key:'web',label:'Sitio Web',sortable:true},
                {key:'aplicaservicios',label:'Aplica servicios',sortable:true, formatter: (value)=>{
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

            newSucursal: null,

            empresas: [],
        }
    },
    methods: {
        showModal(item=null){
            if (item) {
                console.log(item);
                this.newSucursal = Object.assign({},item);
                this.newSucursal.file_1 = null;
                this.newSucursal.file_2 = null;

                Object.keys(this.newSucursal).forEach(key => {
                    if (this.newSucursal[key]=='null') {
                        this.newSucursal[key]=null;
                    }
                });
            } else {
                this.newSucursal = {
                    empresa_id: 0,
                    estab: '',
                    direccion: '',
                    email: '',
                    celular: '',
                    telefono: '',
                    web: '',
                    aplicaservicios: 0,
                    facturas1: '',
                    facturas2: '',
                    proformas1: '',
                    proformas2: '',
                    secuencialproforma: 1,


                    file_1: null,
                    file_2: null,
                    file_3: null,
                    file_4: null,
                };
            }

            this.$refs["my-modal"].show();
        },
        hideModal(){
            this.$refs["my-modal"].hide();
            this.newSucursal = null;
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
        async saveSucursal(){
            let faltantes='' + (!this.newSucursal.empresa_id? ' Empresa.':'')
                            + (!this.newSucursal.estab? ' Cod. Establecimiento.':'')
                            + (!this.newSucursal.direccion? ' Dirección.':'')
                            + (!this.newSucursal.secuencialproforma? ' Secuencial de proforma.':'');
            if (faltantes) {
                this.makeToast("Campos obligatorios:",faltantes,"danger");
                return;
            }
            if (this.newSucursal.secuencialproforma.length + '' > 9) {
                this.makeToast("Error:","El secuencial de proforma solo puede tener 9 digitos, o un numero inferior a 1000000000.","danger");
                return;
            }
            
            if (this.newSucursal.file_1) {
                let extimgA = this.newSucursal.file_1.name.split('.');
                let extimg = extimgA[extimgA.length-1];

                if (extimg!='PNG' && extimg!='png' && extimg!='jpg' && extimg!='JPG' && extimg!='JPEG' && extimg!='jpeg') {
                    this.makeToast("Error de archivos:","El logo de facturas solo puede ser una inagen PNG, JPG o JPEG, porfavor elija otra.","danger");
                    return;
                }
            }
            if (this.newSucursal.file_2) {
                let extimgA = this.newSucursal.file_1.name.split('.');
                let extimg = extimgA[extimgA.length-1];

                if (extimg!='PNG' && extimg!='png' && extimg!='jpg' && extimg!='JPG' && extimg!='JPEG' && extimg!='jpeg') {
                    this.makeToast("Error de archivos:","El logo de proformas solo puede ser una inagen PNG, JPG o JPEG, porfavor elija otra.","danger");
                    return;
                }
            }
            if (this.newSucursal.file_3) {
                let extimgA = this.newSucursal.file_1.name.split('.');
                let extimg = extimgA[extimgA.length-1];

                if (extimg!='PNG' && extimg!='png' && extimg!='jpg' && extimg!='JPG' && extimg!='JPEG' && extimg!='jpeg') {
                    this.makeToast("Error de archivos:","El logo de marcas de agua solo puede ser una inagen PNG, JPG o JPEG, porfavor elija otra.","danger");
                    return;
                }
            }
            if (this.newSucursal.file_4) {
                let extimgA = this.newSucursal.file_1.name.split('.');
                let extimg = extimgA[extimgA.length-1];

                if (extimg!='PNG' && extimg!='png' && extimg!='jpg' && extimg!='JPG' && extimg!='JPEG' && extimg!='jpeg') {
                    this.makeToast("Error de archivos:","El logo de contratos solo puede ser una inagen PNG, JPG o JPEG, porfavor elija otra.","danger");
                    return;
                }
            }

            let formData = new FormData();
            Object.keys(this.newSucursal).forEach(key => formData.append(key, this.newSucursal[key]));

            formData.append('file_1',this.newSucursal.file_1);
            formData.append('file_2',this.newSucursal.file_2);
            formData.append('file_3',this.newSucursal.file_3);
            formData.append('file_4',this.newSucursal.file_4);

            this.cargando = true;
            await axios.post('/sucursal'+(this.newSucursal.id? '/'+this.newSucursal.id:'') , formData, {
                                headers: {
                                    'Content-Type': 'multipart/form-data'
                                }
                            }).then(r=>{
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
        async delSucursal(item){
            await axios.get('/delete-sucursal/' + item.id).then(r=>{
                this.reloadtabla++;
                this.makeToast("Exito","Datos eliminados exitosamente.","success");
            }).catch(e=>{
                console.log(e);
                this.makeToast("Error","Existió un error al intentar borrar los datos.","danger");
            })
        },
        async delSucursalMulti(items){
            for (let i = 0; i < items.length; i++) {
                await axios.get('/delete-sucursal/' + items[i].id).then(r=>{
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
                txt: "¿Desea borrar esta sucursal?",
                variant: 'danger',
                icon: 'trash',
                callback: this.delSucursal
            });
            this.multiactions.push({
                txt: "¿Desea borrar las sucursales selecionadas?",
                variant: 'danger',
                icon: 'trash',
                callback: this.delSucursalMulti
            });
        }

        this.getEmpresas();
    },
}
</script>

<style>

</style>
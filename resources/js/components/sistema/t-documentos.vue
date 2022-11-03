<template>
    <div>
        <t-general title="Documentos"
                url="/get-documentos"
                :prefields="fields"
                :preactions="actions"
                :premultiactions="multiactions"
                :prebuscadores="buscadores"
                :reloadtabla.sync="reloadtabla">
        </t-general>
    </div>
</template>

<script>

export default {
    props: ['essuperuser','puedecompra','puedeventa','puedegasto','puedeborrar'],
    data(){
        return {
            fields: [
                {key:'action',label:'Acción',sortable:false},
                {key:'codDoc',label:'Tipo de documento',sortable:true, formatter: (value, key, item)=>{
                    if (value == '01') {
                        return 'FACTURA';
                    }else if (value == '03') {
                        return 'LIQUIDACIÓN DE COMPRA DE BIENES Y PRESTACIÓN DE SERVICIOS';
                    }else if (value == '04') {
                        return 'NOTA DE CRÉDITO';
                    }else if (value == '05') {
                        return 'NOTA DE DÉBITO';
                    }else if (value == '06') {
                        return 'GUÍA DE REMISIÓN';
                    }else if (value == '07') {
                        return 'COMPROBANTE DE RETENCIÓN';
                    }else if (value == '02') {
                        return 'NOTA DE VENTA';
                    }else if (value == '00') {
                        return 'PROFORMA';
                    }
                }},
                {key:'numerodoc',label:'Número de documento',sortable:false,formatter: (value, key, item)=>{
                    return item.estab + '-' + item.ptoEmi  + '-' + item.secuencial;
                }},
                {key:'ambiente',label:'Ambiente',sortable:true,formatter: (value, key, item)=>{
                    if (value == 2) {
                        return 'PRODUCCIÓN';
                    } else {
                        return 'PRUEBAS';
                    }
                }},
                {key:'razonSocial',label:'Razón Social',sortable:true},
                {key:'nombreComercial',label:'Nombre comercial',sortable:true},
                {key:'ruc',label:'RUC',sortable:true},
                {key:'claveAcceso',label:'Clave de acceso',sortable:true},
                {key:'dirMatriz',label:'Dirección matriz',sortable:true},
                {key:'regimenMicroempresas',label:'Régimen microempresas',sortable:true},
                {key:'agenteRetencion',label:'Agente de retención',sortable:true},
                {key:'fecha_emision',label:'Fecha de emisión',sortable:true},
                {key:'subtotal_sin_impuestos',label:'Subtotal sin impuestos',sortable:true},
                {key:'subtotal_cero',label:'Subtotal 0%',sortable:true},
                {key:'subtotal_iva',label:'Subtotal IVA',sortable:true},
                {key:'subtotal_otros',label:'Subtotal otros impuestos',sortable:true},
                {key:'subtotal',label:'Subtotal',sortable:true},
                {key:'descuento',label:'Descuenbto',sortable:true},
                {key:'propina',label:'Propina',sortable:true},
                {key:'total',label:'Total',sortable:true},
            ],
            actions: [
                
            ],
            multiactions: [

            ],
            buscadores: [

            ],

            reloadtabla: 0,

            cargando: false,
        }
    },
    methods: {
        convertirCompra(item){
            if (item.codDoc == '01') {
                location.replace('/documento-compra/'+item.id);
                
            }else{
                alert("Solo puedes convertir en compras FACTURAS");
            }
        },
        convertirgasto(item){
            if (item.codDoc == '01') {
                location.replace('/documento-gasto/'+item.id);
                
            }else{
                alert("Solo puedes convertir en gastos FACTURAS");
            }
        },
        async delDocumento(item){
            if (item.nombre == 'GENERAL') {
                this.makeToast("Negacion:","No puedes eliminar este documento, es usado por el sistema base.","danger");
                return;
            }
            await axios.get('/delete-documento/' + item.id).then(r=>{
                this.reloadtabla++;
                this.makeToast("Exito","Datos eliminados exitosamente.","success");
            }).catch(e=>{
                console.log(e);
                this.makeToast("Error","Existió un error al intentar borrar los datos.","danger");
            })
        },
        async delDocumentoMulti(items){
            for (let i = 0; i < items.length; i++) {
                if (items[i].nombre == 'GENERAL') {
                    this.makeToast("Negacion:","No puedes eliminar este documento, es usado por el sistema base.","danger");
                    return;
                }
                await axios.get('/delete-documento/' + items[i].id).then(r=>{
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
        /*if (this.essuperuser || this.puedeeditar) {
            this.actions.push({
                variant: 'primary',
                icon: 'pen',
                callback: this.showModal
            });
        }*/
        if (this.essuperuser || this.puedepuedecompra) {
            this.actions.push({
                rapida: true,
                txt: "Convertir este documento en compra?",
                variant: 'dark',
                icon: 'cart',
                callback: this.convertirCompra
            });
        }
        if (this.essuperuser || this.puedepuedegasto) {
            this.actions.push({
                rapida: true,
                txt: "Convertir este documento en gasto?",
                variant: 'outline-dark',
                icon: 'cart',
                callback: this.convertirgasto
            });
        }
        if (this.essuperuser || this.puedeborrar) {
            this.actions.push({
                rapida: true,
                txt: "¿Desea borrar esta documento?",
                variant: 'danger',
                icon: 'trash',
                callback: this.delDocumento
            });
            this.multiactions.push({
                txt: "¿Desea borrar las documentos selecionadas?",
                variant: 'danger',
                icon: 'trash',
                callback: this.delDocumentoMulti
            });
        }
    },
}
</script>

<style>

</style>
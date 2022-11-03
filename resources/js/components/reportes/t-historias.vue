<template>
    <div>
        <t-general title="Historial de acciones"
                url="/get-historias"
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
    data(){
        return {
            fields: [
                {key:'action',label:'',sortable:false},
                {key:'created_at',label:'Fecha',sortable:true},
                {key:'accion',label:'Acción',sortable:true},
                {key:'email',label:'Usuario',sortable:true},
                {key:'name',label:'Nombre',sortable:true},
                {key:'rol',label:'Rol',sortable:true},
                {key:'sistema',label:'Sistema',sortable:true},
            ],
            actions: [
                
            ],
            multiactions: [

            ],
            buscadores: [

            ],

            reloadtabla: 0,
        }
    },
    methods: {
        makeToast(title,msg,variant="secondary") {
            this.$bvToast.toast(msg, {
                title,
                autoHideDelay: 5000,
                variant
            })
        },
    },
    mounted(){
    },
}
</script>

<style>

</style>
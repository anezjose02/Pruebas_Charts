<template>
    <span>
        <span @click="showModal">
            <slot name="boton"></slot>
        </span>

        <b-modal
            ref="my-modal-v2"
            :size="size ? size : 'lg'"
            lazy
            scrollable
            :hide-header="true"
            :hide-footer="true"
        >
            <slot name="contenido"></slot>
        </b-modal>
    </span>
</template>

<script>
export default {
    props: ["title", "size", "footer"],
    methods: {
        showModal() {
            this.$refs["my-modal-v2"].show();
        },
        hideModal() {
            this.$refs["my-modal-v2"].hide();
        },
        emitOk() {
            this.$emit("ok");
            this.hideModal();
        },
        emitCancel() {
            this.$emit("cancel");
            this.hideModal();
        },
    },
};
</script>

<style></style>

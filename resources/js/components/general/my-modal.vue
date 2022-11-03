<template>
  <span>
    
    <b-button
      :disabled="estado_documento == 'ANULADA' || (estado_documento == 'ANULADO' & tooltip != 'Refacturar') || (tooltip == 'Editar' && estado_sri == 'AUTORIZADO') || disabled"
      v-b-tooltip.hover="tooltip"
      v-bind:class="{ 'btn-ico': !btntxt }"
      :variant="btnvariant ? btnvariant : 'secondary'"
      :size="btnsize ? btnsize : 'sm'"
      @click="showModal"
    >
      <featherIcon
        class="feather-ico"
        v-if="featherIcon"
        :icon="featherIcon"
      ></featherIcon>

      <span v-if="!featherIcon">
        <i
          v-if="btnicon == 'times'"
          style="padding-left: 7.5px"
          class="fas fa-times"
        >
        </i>
        <i v-if="btnicon == 'trash'" class="fas fa-trash"> </i>
        <i v-if="btnicon == 'plus'" class="fas fa-plus"> </i>

        <i
          v-if="btnicon == 'pen'"
          class="fas fa-edit"
          style="padding-left: 2px"
        >
        </i>
        <i
          v-if="btnicon == 'cart'"
          class="fas fa-shopping-cart"
          style="margin-left: 1px"
        >
        </i>

        <b-icon
          :icon="btnicon"
          v-if="
            btnicon != 'plus' &&
            btnicon != 'trash' &&
            btnicon != 'cart' &&
            btnicon != 'pen'
          "
        ></b-icon>
      </span>

      <span v-if="btntxt">
        {{ btntxt }}
      </span>
    </b-button>

    <b-modal
      ref="my-modal"
     
      :header-bg-variant="headvariant ? headvariant : 'secondary'"
      :header-text-variant="headvarianttext ? headvarianttext : 'white'"
      :hide-header="true"
      :hide-footer="footer ? false : true"
      :header-close-variant="headvariant ? headvariant : 'secondary'"
      :size="size ? size : 'sm'"
      :ok-title="oktitle ? oktitle : 'Aceptar'"
      :ok-variant="okvariant ? okvariant : alert"
      :cancel-title="canceltitle ? canceltitle : 'Cancelar'"
      :cancel-variant="cancelvariant ? cancelvariant : 'secondary'"
      lazy
      scrollable
      @ok="emitOk"
      @cancel="emitCancel"
    >
   
      <div class="text-center my-2">
        <i v-if="alert == 'info'" class="icon-lg text-info fas fa-info"></i>
        <i
          v-else-if="alert == 'warning'"
          class="icon-lg text-warning fas fa-exclamation-triangle"
        ></i>
        <i
          v-else-if="alert == 'danger'"
          class="icon-lg text-danger fas fa-exclamation-circle"
        ></i>
           <i
          v-else
          class="icon-lg text-info fas fa-info"
        ></i>
        <h5 class="mt-2">
          {{title}}
        </h5>

        <div v-html="htmltxt">
            
        </div>
        
      </div>
    </b-modal>
   
  </span>
</template>

<script>
export default {
  props: [
    "tooltip",
    "cancelvariant",
    "canceltitle",
    "btnicon",
    "btntxt",
    "btnvariant",
    "btnsize",
    "title",
    "size",
    "footer",
    "oktitle",
    "okvariant",
    "headvariant",
    "headvarianttext",
    "featherIcon",
    "estado_sri",
    "estado_documento",
    "alert",
    "htmltxt",
    "disabled"

  ],
  methods: {
    showModal() {
      this.$refs["my-modal"].show();
    },
    hideModal() {
      this.$refs["my-modal"].hide();
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

<template>
  <div>
    <b-modal
    no-close-on-backdrop
      body-class="p-0"
      ref="modalMSG"
      :size="'md'"
      lazy
      scrollable
      :hide-header="true"
      :hide-footer="true"
    >
      <div class="card-body">
        <div class="text-center my-2">
          <i
            v-if="alertModal == 'success'"
            class="icon-lg text-success fas fa-check"
          ></i>
          <i
            v-if="alertModal == 'warning'"
            class="icon-lg text-warning fas fa-exclamation-triangle"
          ></i>
          <i
            v-if="alertModal == 'danger'"
            class="icon-lg text-danger fas fa-exclamation-circle"
          ></i>
          <h5 class="mt-2">{{ messageModal }}</h5>
        </div>
      </div>

      <div class="card-footer">
        <button
          :class="{
            'btn-warning': alertModal == 'warning',
            'btn-success': alertModal == 'success',
            'btn-danger': alertModal == 'danger',
          }"
          class="btn float-right ml-2"
          @click="aceptar()"
        >
          <i class="fas fa-check"></i> Aceptar
        </button>

        <button class="btn btn-secondary float-right" @click="hideModal()">
          <i class="fas fa-times"></i> Cerrar
        </button>
      </div>
    </b-modal>
  </div>
</template>


<script>
export default {
  props: ["alertModal", "messageModal"],

  data() {
    return {};
  },
  methods: {
    showModal(ctx) {
      this.$refs["modalMSG"].show();
    },

    aceptar() {
        this.$refs["modalMSG"].hide();
      this.$emit("result");
    },

    hideModal() {
      this.$refs["modalMSG"].hide();
      self = this;

      setTimeout(function () {
        self.$emit("hideModalMessage");
      }, 500);
    },
  },

  mounted() {
    this.showModal();
  },
};
</script>

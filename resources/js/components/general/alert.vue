<template>
  <div></div>
</template>

<script>
export default {
  props: ["message", "alert"],

  data() {
    return {
      message: null,
      alert: null,
    };
  },

  methods: {
    makeToast(title, msg, variant = "secondary") {
      this.$bvToast.toast(msg, {
        title,
        autoHideDelay: 8000,
        variant,
      });
    },
  },

  mounted() {
    this.message2 = this.message;
    this.alert2 = this.alert;
    this.makeToast("Información", this.message2, this.alert2);
  },
};
</script>


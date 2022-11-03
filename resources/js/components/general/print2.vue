<template>
  <div>
    <div class="loader-sm" v-if="load">
      <div></div>
    </div>
    <div style="width: 0px; height: 0px; overflow: hidden">
      <div id="printMe" v-html="content"></div>
    </div>

    <span ref="button_print" v-print="'#printMe'"></span>
  </div>
</template>

<script>
import print from "vue-print-nb";

export default {
  directives: {
    print,
  },
  props: ["url","tipo"],

  data() {
    return {
      content: "",
      load: false,

    };
  },
  methods: {
    async print() {
      
      this.load = true;
      try {
        await axios
          .get(this.url+'?print=true', { params: { tipo: this.tipo } })
          .then((r) => {
            console.log(this.url);
            console.log(r.data);
            this.content = r.data;
            // this.$ref["button_print"].click;
            var self = this;
            this.$refs["button_print"].click();
            setTimeout(function () {
              self.load = false;
              self.content = "";
            }, 2000);
          })
          .catch((e) => {
            console.log(e);
          });
      } catch (error) {}
    },
  },

  mounted() {
    this.print();
    console.log("PRINT");
  },
};
</script>

<style></style>

<script>
import Botoes from "../Botoes.vue"

export default {
  components: {
    Botoes
  },
  data() {
    return {
      Tela: this.$route.path,
    };
  },
  mounted() {
      console.log(this.$route.path);
  },
};
</script>

<template>     
      <div class="w-100 h-100">
        <img src="../../assets/logo.svg" class="w-100 h-100 py-5">
      </div>
</template>
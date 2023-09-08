<script>
import Botoes from "../Botoes.vue"
import axios from 'axios'

export default {
  components: {
    Botoes
  },
  data() {
    return {
      Tela: this.$route.path,
      dadosTela: {},
      itemExcluido: false,
      message: ''
    };
  },
  mounted() {
    this.trazDados();
  },
  methods: {
    removeItem(id) {
      axios.delete(`http://127.0.0.1:8000/api/categoria/excluir/${id}`)
      .then(response => {
        this.trazDados();
        this.message = response.data.message;
        this.itemExcluido = true;
        setTimeout(()=>{
          this.itemExcluido = false;
          
        }, 1000);
      }).catch(error => {
        console.error('Erro:', error);
      });
    },
    trazDados() {
      axios.get('http://127.0.0.1:8000/api/categoria/index')
      .then(response => {
        this.dadosTela = response.data;
      }).catch(error => {
        console.log(error);
      })
    }
  }
}
</script>

<template>
      <botoes :Tela="Tela"></botoes>      
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Cadastro de Categoria Veicular</h1>
      </div>
      <div class="alert alert-success w-100 d-flex align-items-center text-center" role="alert" v-if="itemExcluido">
        <font-awesome-icon :icon="['fas', 'trash-can']" />
        <div class="ms-2">
          {{ message }}
        </div>
      </div>
      <div class="row" v-for="dados in dadosTela">
        <div class="col-md-11 pb-3">
          {{ dados.id }} - {{ dados.categoria }}
        </div>
        <div class="col-md-1 pb-3">
          <span role="button" class="ursor-pointer" id="basic-addon2" @click="removeItem(dados.id)"><font-awesome-icon :icon="['fas', 'circle-minus']" size="xl" style="color: #d81313;" /></span>
        </div>  
        <hr>
      </div>
      
</template>
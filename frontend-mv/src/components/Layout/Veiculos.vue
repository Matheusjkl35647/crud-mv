<script>
import Botoes from "../Botoes.vue"
import axios from 'axios'
import { mapMutations } from 'vuex'

export default {
  components: {
    Botoes
  },
  data() {
    return {
      Tela: this.$route.path,
      dadosTela: {},
      idExclui: ''
    };
  },
  mounted() {
    this.trazDados();
    this.resetSelecPessoaID();
  },
  methods: {
    ...mapMutations(['setResetAll']),
    resetSelecPessoaID() {
      this.setResetAll();
    },
    trazDados() {
      axios.get('http://127.0.0.1:8000/api/veiculo/index')
      .then(response => {
        this.dadosTela = response.data;
      }).catch(error => {
        console.log(error);
      })
    },
    populaID(id) {
      this.$store.commit('setSelectVeiculo', { veiculoID: id})
      this.idExclui = id;
    }
  }
};
</script>

<template>
      <botoes :Tela="Tela" :IdExclui="this.IdExclui"></botoes>      
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Cadastro de Veículos</h1>
      </div>

      <div class="row overflow-auto">
        <div class="col-md-12">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">ID</th>
                <th scope="col">Placa</th>
                <th scope="col">Marca</th>
                <th scope="col">Modelo</th>
                <th scope="col">Categoria</th>
                <th scope="col">Custo Aluguel</th>
              </tr>
            </thead>      
            <tbody>    
              <tr v-for="dados, key in dadosTela" :key="key">
                <td><input type="radio" :id="'veiculo'+ dados.id" name="veiculo" @click="populaID(dados.id)" :value="dados.id"/></td>
                <td><label :for="'veiculo'+ dados.id">{{ dados.id }}</label></td>
                <td><label :for="'veiculo'+ dados.id">{{ dados.placa }}</label></td>
                <td><label :for="'veiculo'+ dados.id">{{ dados.marca }}</label></td>
                <td><label :for="'veiculo'+ dados.id">{{ dados.modelo }}</label></td>
                <td><label :for="'veiculo'+ dados.id">{{ dados.categoria_id }}</label></td>
                <td><label :for="'veiculo'+ dados.id">{{ dados.custo_aluguel }}</label></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
</template>
<script>
import Botoes from "../Botoes.vue"
import axios from "axios";
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
      this.resetSelecPessoaID();
      axios.get('http://127.0.0.1:8000/api/usuario/index')
      .then(response => {
        this.dadosTela = response.data;
      }).catch(error => {
        console.log(error)
      });
  },
  methods: {
    ...mapMutations(['setResetAll']),
    resetSelecPessoaID() {
      this.setResetAll();
    },
    populaID(id) {
      this.$store.commit('setSelectPessoa', { pessoaID: id})
      this.idExclui = id;
    }
  }
};
</script>

<template>
      <botoes :Tela="Tela" :IdExclui="this.idExclui"></botoes>      
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Cadastro de Usuários</h1>
      </div>
      <div class="row overflow-auto">
        <div class="col-md-12">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">ID</th>
                <th scope="col">Usuário</th>
                <th scope="col">Nome</th>
                <th scope="col">E-mail</th>
                <th scope="col">Tipo</th>
              </tr>
            </thead>      
            <tbody>    
              <tr v-for="dados, key in dadosTela" :key="key">
                <td><input type="radio" :id="'usuario'+ dados.id" name="usuario" @click="this.populaID(dados.id)" :value="dados.id"/></td>
                <td><label :for="'usuario'+ dados.id">{{ dados.id }}</label></td>
                <td><label :for="'usuario'+ dados.id">{{ dados.usuario }}</label></td>
                <td><label :for="'usuario'+ dados.id">{{ dados.nome }}</label></td>
                <td><label :for="'usuario'+ dados.id">{{ dados.email }}</label></td>
                <td><label :for="'usuario'+ dados.id">{{ dados.tpPessoa == 'F' ? 'Funcionário' : 'Cliente' }}</label></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
</template>
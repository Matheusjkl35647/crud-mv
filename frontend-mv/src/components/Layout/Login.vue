<script>
import "../../assets/TelaHome.css"
import TelaHome from '../TelaHome.vue'
import axios from 'axios'


export default {
  components: {
    TelaHome
  },
  data() {
    return {
      formData: {
        usuario: '',
        senha: '',
      },
      acessaSistema: false,
      loadingAguarde: false,
      erroLogin: false,
      message: ''
    }
  },
  methods: {
    async acessoSistema() {
      for (const key in this.formData) {
        if (Object.hasOwnProperty.call(this.formData, key)) {
          const value = this.formData[key];
          if(value == "") {
            return alert("Preencha todos os campos, por favor!")
          }
        }
      }

      await axios.post('http://127.0.0.1:8000/api/usuario/login', {
          nome: this.formData.usuario,
          senha: this.formData.senha
      }).then(response => {
        this.message = response.data.message;
        this.loadingAguarde = true;
        this.erroLogin = false;
        this.$store.commit('setPessoa', { nome: response.data.pessoa.nome, pessoaID: response.data.pessoa.pessoaID, tpPessoa: response.data.pessoa.tpPessoa });

        setTimeout(()=>{
          this.acessaSistema = true;
        }, 3000);
        
      }).catch(error => {
        this.message = 'Erro ' + error.response.status + ': ' + error.response.data.message;
        this.erroLogin = true;
        this.loadingAguarde = false;
      })

    }
  }
}

</script>

<template>
   <div class="position-absolute top-50 start-50 translate-middle h-100 w-100" v-if="acessaSistema == false">
      <main class="form-signin m-3 mx-5 text-center" >
      <img class="my-2" src="../../assets/logo.svg" alt="" width="250" height="125">
      <h4 class="mb-3 fw-normal">Faça Login para acessar o sistema</h4>

      <div class="form-floating">
          <input type="text" class="form-control my-3" id="nomeUsuario" v-model="formData.usuario">
          <label for="nomeUsuario">Usuário</label>
      </div>
      <div class="form-floating">
          <input type="password" class="form-control my-3" id="senhaUsuario" v-model="formData.senha">
          <label for="senhaUsuario">Senha</label>
      </div>
      <button class="btn btn-success mb-3 w-100" type="button" disabled v-if="loadingAguarde">
        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
        {{ message }}
      </button>
      <button class="btn btn-danger mb-3 w-100" type="button" disabled v-if="erroLogin">
        {{ message }}
      </button>

      <button class="w-100 btn btn-lg btn-success" @click="acessoSistema">Entrar</button>
      <p class="mt-3 mb-3 text-muted fixed-bottom">Matheus J. Santos &copy; 2023</p>
    </main>
  </div>  
  <div v-else>
    <TelaHome></TelaHome>
  </div>

</template>
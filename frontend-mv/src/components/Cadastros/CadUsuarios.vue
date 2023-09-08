<script>
import { DropZone } from 'dropzone-vue';
import axios from 'axios';

export default {
  components: {
    DropZone,
  },
  data() {
    return {
      formData: {
        usuario: '',
        senha: '',
        nomeID: ''
      },
      urlSite: window.location.href ,
      clienteFunc: '',
      pNome: '',
      dadosTpPessoa: {},
      ativaInput: false,
      message : '',
      itemSalvo : false,
      itemErro : false,
    }
  },
  mounted(){
    if (this.$store.state.cadPessoa && this.$store.state.cadPessoa.pessoaID !== null) {
      axios.get('http://127.0.0.1:8000/api/usuario/trazUsuario/' + this.$store.state.cadPessoa.pessoaID).then(response => {
        let data = response.data[0];

        this.clienteFunc = data.tipo;
        this.formData.nomeID = data.pessoaID;
        this.formData.usuario = data.nome;
        this.formData.nvHierarquia = data.nvHierarquia;
        this.idUsuario = data.id;

        this.pNome = data.pNome;
        this.ativaInput = true;
        
      }).catch(error => {
        alert(error);
        this.$router.push('/Pessoas');
      });
    }
  },
  methods: {
    enviaDadosUsuario() {
        let newUsuario = this.formData.usuario.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
        newUsuario.replace(/[^a-zA-Z0-9]+/g, '');

        for (const key in this.formData) {
          if (Object.hasOwnProperty.call(this.formData, key)) {
            const value = this.formData[key];
            if(value == "") {
              return alert("Preencha todos os campos, por favor!")
            }
          }
        }

        let url = '';
        let method = '';

        if (this.$store.state.cadPessoa && this.$store.state.cadPessoa.pessoaID !== null) {
          url = `http://127.0.0.1:8000/api/usuario/editar/${this.idUsuario}`;
          method = 'put';
        } else {
          url = 'http://127.0.0.1:8000/api/usuario/incluir';
          method = 'post';
        }

        const valores = {
          usuario: newUsuario,
          senha: this.formData.senha,
        }

        if(method == 'post') {
            valores.nomeID = this.formData.nomeID;
          }

        axios[method](url, valores)
        .then(response => {
          this.message = response.data.message;
          this.itemSalvo = true;
          this.itemErro = false;
          setTimeout(() => {
            this.$router.push('/Usuarios');
          }, 3000);
          // this.resetSelecPessoaID();
        }).catch(error => {
          this.message = error;
          this.itemSalvo = false;
          this.itemErro = true;
        });
    },
    excluiDados() {
      axios.delete(`http://127.0.0.1:8000/api/usuario/excluir/${this.idUsuario}`)
      .then(response => {
        this.message = response.data.message;
        this.itemSalvo = true;
        setTimeout(()=>{
          this.itemSalvo = false;
          this.$router.push('/Usuarios');
        }, 1000);
      }).catch(error => {
        console.error('Erro:', error);
      });
    }
  },
  watch: {
    clienteFunc(valor) {
      axios.get('http://127.0.0.1:8000/api/pessoa/trazPessoaTipo/' + valor).then(response => {
        this.dadosTpPessoa = response.data;
      }).catch(error => {
        console.log(error);
      });
    },
  },
}
</script>

<template>
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><font-awesome-icon :icon="['fas', 'user-plus']" /> Incluir Usuário </h1>
        <div class="col-md-3">
          <button @click="excluiDados" v-if="this.$store.state.cadPessoa && this.$store.state.cadPessoa.pessoaID !== null" type="button" class="btn btn-danger btn-lg mx-2 px-5"><font-awesome-icon :icon="['fas', 'circle-xmark']" /> Excluir</button>
        </div>
      </div>
      <div class="alert alert-success w-100 d-flex align-items-center text-center" role="alert" v-if="itemSalvo">
        <font-awesome-icon :icon="['fas', 'circle-check']" />
        <div class="ms-2">
          {{ message }}
        </div>
      </div>
      <div class="alert alert-danger w-100 d-flex align-items-center text-center" role="alert" v-if="itemErro">
        <font-awesome-icon :icon="['fas', 'circle-xmark']" />
        <div class="ms-2">
          {{ message }}
        </div>
      </div>
      <div class="row">
        <div class="col-md-9"></div>
        <div class="col-md-3">
            <label for="ClienteFunc" class="form-label">Selecione o tipo de pessoa</label>
            <select v-if="ativaInput == false" class="form-select bg-black text-white" id="ClienteFunc" aria-label="Floating label select example" v-model="clienteFunc">
              <option value="C">Cliente</option>
              <option value="F">Funcionário</option>
            </select>
            <input  v-if="ativaInput == true" disabled type="text" class="form-control" id="usuarioCliente" maxlength="255" :value="clienteFunc == 'F' ? 'Funcionário' : 'Cliente'">
          </div>
        <div>
      </div>
      
        <form class="row g-3" v-if="clienteFunc != ''">
          <div class="col-md-12">
            <label for="nomeCliente" class="form-label">Nome do  {{clienteFunc == 'C' ? 'Cliente' : 'Funcionário'}}</label>
            <select v-if="ativaInput == false" class="form-select" id="ClienteFunc" aria-label="Floating label select example" v-model="formData.nomeID" >
              <option v-for="dados in dadosTpPessoa" :value="dados.id">{{dados.nome}}</option>
            </select>
            <input  v-if="ativaInput == true" disabled type="text" class="form-control" id="usuarioCliente" maxlength="255" v-model="pNome">
          </div>
          <div class="col-md-6">
            <label for="usuarioCliente" class="form-label">Usuário</label>
            <input type="text" class="form-control" id="usuarioCliente" maxlength="255" placeholder="Digite o usuário aqui" v-model="formData.usuario">
          </div>
          <div class="col-md-6">
            <label for="senhaCliente" class="form-label">Senha</label>
            <input type="password" class="form-control" id="senhaCliente" maxlength="255" placeholder="Digite a senha aqui" v-model="formData.senha">
          </div>

        </form>

        <div class="text-center text-md-end fixed-bottom">
          <router-link to="/Usuarios">
            <button type="button" class="btn btn-danger btn-lg mx-2 px-5" ><font-awesome-icon :icon="['fas', 'backward']" /> Voltar</button>
          </router-link>

          <button @click="enviaDadosUsuario" class="btn btn-success btn-lg m-2 px-5"><font-awesome-icon :icon="['fas', 'circle-check']" /> Salvar</button>
        </div>
      </div>
</template>
<script>
import { DropZone } from 'dropzone-vue';
import axios from 'axios';
import { mapMutations } from 'vuex';

export default {
  components: {
    DropZone,
  },
  data() {
    return {
      formData: {
        nome: '',
        cpf: '',
        dtNascimento: '',
        email: '',
        tpPessoa: '',
        nvHierarquia: 0
      },
      message: '',
      itemSalvo: false,
      itemErro: false,
      urlSite: window.location.href      
    }
  },
  mounted(){
    if (this.$store.state.cadPessoa && this.$store.state.cadPessoa.pessoaID !== null) {
      axios.get('http://127.0.0.1:8000/api/pessoa/trazPessoa/' + this.$store.state.cadPessoa.pessoaID).then(response => {
        let data = response.data;

        this.formData.nome = data.nome;
        this.formData.cpf = data.cpf;
        this.formData.dtNascimento = data.dataNascimento;
        this.formData.email = data.email;
        this.formData.tpPessoa = data.tpPessoa;
        this.formData.nvHierarquia = data.nvHierarquia;

      }).catch(error => {
        alert(error);
        this.$router.push('/Pessoas');
      });
    }
  },
  methods: {
    ...mapMutations(['setResetAll']),
    resetSelecPessoaID() {
      this.setResetAll();
    },
    enviaDadosPessoa() {
      if (this.formData.email.indexOf('@') == -1 || this.formData.email.indexOf('.com') == -1) {
        return alert('Preencha o campo corretamente com o e-mail do cliente, por favor. Se o problema persistir, entre em contato com o suporte!');
      }

      for (const key in this.formData) {
        if (Object.hasOwnProperty.call(this.formData, key)) {
          const value = this.formData[key];
          if(value == "" && this.formData.nvHierarquia != 0) {
            return alert("Preencha todos os campos, por favor!")
          }
        }
      }

      let url = '';
      let method = '';

      if (this.$store.state.cadPessoa && this.$store.state.cadPessoa.pessoaID !== null) {
        url = `http://127.0.0.1:8000/api/pessoa/editar/${this.$store.state.cadPessoa.pessoaID}`;
        method = 'put';
      } else {
        url = 'http://127.0.0.1:8000/api/pessoa/incluir';
        method = 'post';
      }

      const valores = {
        nome: this.formData.nome,
        cpf: this.formData.cpf,
        dtNascimento: this.formData.dtNascimento,
        email: this.formData.email,
        tpPessoa: this.formData.tpPessoa,
        nvHierarquia: this.formData.nvHierarquia
      };

      axios[method](url, valores).then(response => {
        this.message = response.data.message;
        this.itemSalvo = true;
        this.itemErro = false;
        setTimeout(() => {
          this.$router.push('/Pessoas');
        }, 3000);
        // this.resetSelecPessoaID();
      }).catch(error => {
        this.message = error;
        this.itemSalvo = false;
        this.itemErro = true;
      });
    },
    excluiDados() {
      axios.delete(`http://127.0.0.1:8000/api/pessoa/excluir/${this.$store.state.cadPessoa.pessoaID}`)
      .then(response => {
        this.message = response.data.message;
        this.itemSalvo = true;
        setTimeout(()=>{
          this.itemSalvo = false;
          this.$router.push('/Pessoas');
        }, 1000);
      }).catch(error => {
        console.error('Erro:', error);
      });
    }
  }
}
</script>

<template>
    
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><font-awesome-icon :icon="['fas', 'person-circle-plus']" /> Incluir Pessoa </h1>
        <button @click="excluiDados" v-if="this.$store.state.cadPessoa && this.$store.state.cadPessoa.pessoaID !== null" type="button" class="btn btn-danger btn-lg mx-2 px-5"><font-awesome-icon :icon="['fas', 'circle-xmark']" /> Excluir</button>
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
      <div>
        <form class="row g-3">
          <div class="col-md-12">
            <label for="ClienteFunc" class="form-label">Selecione o tipo de pessoa</label>
            <select class="form-select" id="ClienteFunc" aria-label="Floating label select example" v-model="formData.tpPessoa">
              <option value="C">Cliente</option>
              <option value="F">Funcionário</option>
            </select>
          </div>
          <div class="col-md-12">
            <label for="nomeCliente" class="form-label">Nome</label>
            <input type="text" class="form-control" maxlength="255" id="nomeCliente" placeholder="Digite o nome do Cliente aqui" title="Nome do Cliente" v-model="formData.nome">
          </div>
          <div class="col-md-6">
            <label for="cpfCliente" class="form-label">CPF</label>
            <input type="text" class="form-control" id="cpfCliente" maxlength="14" placeholder="Digite o CPF - Somente números" v-model="formData.cpf">
          </div>
          <div class="col-md-6">
            <label for="dtNascimento" class="form-label">Data Nascimento</label>
            <input type="date" class="form-control" id="dtNascimento" v-model="formData.dtNascimento">
          </div>
          <div class="col-md-12">
            <label for="emailCliente" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="emailCliente" maxlength="255" placeholder="Digite o e-mail aqui" v-model="formData.email">
          </div>

          <div class="col-md-12" v-if="formData.tpPessoa == 'F'">
            <label for="ClienteFunc" class="form-label">Selecione a hierarquia</label>
            <select class="form-select" id="ClienteFunc" aria-label="Floating label select example" v-model="formData.nvHierarquia">
              <option value="1">1 - Gerente</option>
              <option value="2">2 - Administrativo</option>
              <option value="3">3 - Limpeza</option>
              <option selected value="4">4 - Outro</option>
            </select>
          </div>

        </form>

        <div class="text-center text-md-end fixed-bottom">
          <router-link to="/Pessoas">
            <button type="button" class="btn btn-danger btn-lg mx-2 px-5" ><font-awesome-icon :icon="['fas', 'backward']" /> Voltar</button>
          </router-link>

          <button @click="enviaDadosPessoa" class="btn btn-success btn-lg m-2 px-5"><font-awesome-icon :icon="['fas', 'circle-check']" /> Salvar</button>
        </div>
      </div>
</template>
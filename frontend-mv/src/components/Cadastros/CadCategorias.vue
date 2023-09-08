<script>
/************************************************************
* Nome: Matheus J. Santos                                   *
* Tela: Cadastro de categorias                              *
* CRUD-MV: Full Stack                                       *
************************************************************/
import axios from 'axios';

export default {
  data() {
    return {
      categorias: [],
      nomeCategoria: '',
      itemSalvo: false,
      itemErro: false,
      message: ''
    }
  },
  methods: {
    enviaDadosCategoria() {
      // Envia dados via Axios
      axios.post('http://127.0.0.1:8000/api/categoria/incluir', this.categorias)
      .then(response => {
        this.message = response.data.message;
        this.itemSalvo = true;
        this.itemErro = false;
        setTimeout(()=>{
          this.$router.push('/Categorias');
        }, 1000);
        
      }).catch(error => {
        this.message = error;
        this.itemSalvo = false;
        this.itemErro = true;
      })
      
    },
    AdicionaItem() {
      if (this.nomeCategoria.length != 0) {
        this.categorias.push(this.nomeCategoria);
        this.nomeCategoria = '';
      } else {
        return alert('Campo vázio');
      }
    },
    removeItem(position) {
      this.categorias.splice(position, 1);
    }
  }
}
</script>

<template>
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><font-awesome-icon :icon="['fas', 'list']" /> Cadastro de Categoria</h1>
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
          <div class="col-md-12">
            <label for="placaVeiculo" class="form-label">Categoria de veículo</label>
            <div class="input-group mb-3">
              <input type="text" class="form-control" maxlength="255" id="placaVeiculo" placeholder="Digite o nome de uma categoria" title="Digite o nome de uma categoria" v-model="nomeCategoria">
              <span role="button" class="input-group-text cursor-pointer" id="basic-addon2" @click="AdicionaItem"><font-awesome-icon :icon="['fas', 'circle-plus']" size="2xl" style="color: #0bb716;" /></span>
            </div>
          </div>

        <div v-for="cat, chave in categorias" :key="chave" class="d-flex justify-content-around py-3 border-bottom">
          <div class="col-md-11">
            ({{chave }}) - {{ cat }}
          </div>
          <div>
            <span role="button" class="ursor-pointer" id="basic-addon2" @click="removeItem(chave)"><font-awesome-icon :icon="['fas', 'circle-minus']" size="xl" style="color: #d81313;" /></span>
          </div>          
        </div>
        
        <div class="text-center text-md-end fixed-bottom">
          
          <router-link to="/Categorias">
            <button type="button" class="btn btn-danger btn-lg mx-2 px-5" ><font-awesome-icon :icon="['fas', 'backward']" /> Voltar</button>
          </router-link>

          <button @click="enviaDadosCategoria" class="btn btn-success btn-lg m-2 px-5"><font-awesome-icon :icon="['fas', 'circle-check']" /> Salvar</button>
        </div>
      </div>
</template>
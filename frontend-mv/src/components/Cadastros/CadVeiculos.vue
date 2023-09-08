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
        placa: '',
        marca: '',
        descricao: '',
        modelo: '',
        categoriaID: '',
        custoAluguel: '',
      },
      categorias: {},
      selecionaArquivos: [],
      sobeImagens: [],
      urlSite: window.location.origin,
      message : '',
      itemSalvo : false,
      itemErro : false 
    }
  },
  mounted(){
    axios.get('http://127.0.0.1:8000/api/categoria/index')
    .then(response => {
      this.categorias = response.data;
    }).catch(error => {
      console.log(error);
    })
    
    if (this.$store.state.cadVeiculo && this.$store.state.cadVeiculo.veiculoID !== null) {
      axios.get('http://127.0.0.1:8000/api/veiculo/trazVeiculo/' + this.$store.state.cadVeiculo.veiculoID).then(response => {
        let data = response.data;

        this.formData.placa = data.placa;
        this.formData.marca = data.marca;
        this.formData.descricao = data.descricao;
        this.formData.modelo = data.modelo;
        this.formData.custoAluguel = data.custo_aluguel;
        this.formData.categoriaID = data.categoria_id;
        
      }).catch(error => {
        alert(error);
        this.$router.push('/Veiculos');
      });
    }
  },
  methods: {
    enviaDadosVeiculo() {
      for (const key in this.formData) {
        if (Object.hasOwnProperty.call(this.formData, key)) {
          const value = this.formData[key];
          if(value == "") {
            return alert("Preencha todos os campos, por favor!")
          }
        }
      }

      //FUI FAZER DEU ALGUNS ERROS E COM O TEMPO CURTO, NÃO DEU TEMPO... 
      // if (this.selecionaArquivos.length === 0) {
      //   alert("Selecione um ou mais arquivos primeiro.");
      //   return;
      // }

      // const formData = new FormData();

      // this.selecionaArquivos.forEach(file => {
      //   formData.append("files[]", file);
      // });

      let url = '';
      let method = '';

      if (this.$store.state.cadVeiculo && this.$store.state.cadVeiculo.veiculoID !== null) {
        url = `http://127.0.0.1:8000/api/veiculo/editar/${this.$store.state.cadVeiculo.veiculoID}`;
        method = 'put';
      } else {
        url = 'http://127.0.0.1:8000/api/veiculo/incluir';
        method = 'post';
      }

      const valores = {
        placa: this.formData.placa,
        marca: this.formData.marca,
        descricao: this.formData.descricao,
        modelo: this.formData.modelo,
        categoriaID: this.formData.categoriaID,
        custoAluguel: this.formData.custoAluguel,
        anexo : this.formData.anexo
      }

      axios[method](url, valores)
      .then(response => {
        this.message = response.data.message;
        this.itemSalvo = true;
        this.itemErro = false;
        setTimeout(() => {
          this.$router.push('/Veiculos');
        }, 3000);
        // this.resetSelecPessoaID();
      }).catch(error => {
        this.message = error;
        this.itemSalvo = false;
        this.itemErro = true;
      });
      
    },
    // alteraArquivo(event) {
    //   this.sobeImagens = [];
    //   this.selecionaArquivos = Array.from(event.target.files);
    // },
    excluiDados() {
      axios.delete(`http://127.0.0.1:8000/api/veiculo/excluir/${this.$store.state.cadVeiculo.veiculoID}`)
      .then(response => {
        this.message = response.data.message;
        this.itemSalvo = true;
        setTimeout(()=>{
          this.itemSalvo = false;
          this.$router.push('/Veiculos');
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
        <h1 class="h2"><font-awesome-icon :icon="['fas', 'car-side']" /> Incluir Veículo</h1>
        <button @click="excluiDados" v-if="this.$store.state.cadVeiculo && this.$store.state.cadVeiculo.veiculoID !== null" type="button" class="btn btn-danger btn-lg mx-2 px-5"><font-awesome-icon :icon="['fas', 'circle-xmark']" /> Excluir</button>
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
          <div class="col-md-6">
            <label for="placaVeiculo" class="form-label">Placa</label>
            <input type="text" class="form-control" maxlength="7" id="placaVeiculo" placeholder="Digite a placa aqui. Ex: ABC1D23" title="Placa do veículo sem espaços ou caracter especial" v-model="formData.placa">
          </div>
          <div class="col-md-6">
            <label for="marcaVeiculo" class="form-label">Marca</label>
            <input type="text" class="form-control" id="marcaVeiculo" maxlength="255" placeholder="Marca do veículo aqui" v-model="formData.marca">
          </div>
          <div class="col-12">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea class="form-control" placeholder="Descrição do carro aqui. Ex: Cor, quantidade de portas, cambio, etc.." id="descricao" maxlength="255" v-model="formData.descricao"></textarea>
          </div>
          <div class="col-md-4">
            <label for="modeloCarro" class="form-label">Modelo</label>
            <input type="text" class="form-control" id="modeloCarro" v-model="formData.modelo" placeholder="Modelo do veículo aqui" >
          </div>
          <div class="col-md-4">
            <label for="categoria" class="form-label">Categoria</label>
            <select id="categoria" class="form-select" v-model="formData.categoriaID">
              <option v-for="cat in categorias" :value="cat.id">{{cat.categoria}}</option>
            </select>
          </div>
          <div class="col-md-4">
            <label for="custoAluguel" class="form-label">Custo do Aluguel</label>
            <div class="input-group">
              <span class="input-group-text">R$</span>
              <input type="number" class="form-control" id="custoAluguel" placeholder="00" v-model="formData.custoAluguel">
            </div>
          </div>
        </form>
        <!-- <div class="col-md-12 pt-2 pb-3">
          <span class="form-label">Anexar Imagem</span>
          <div class="w-100">
            <input type="file" ref="fileInput" multiple @change="alteraArquivo">

            <div v-for="(image, index) in sobeImagens" :key="index">
              <img :src="image" alt="Imagem" style="max-width: 200px;">
            </div>
          </div>
        </div> -->

        <div class="text-center text-md-end fixed-bottom">
          <router-link to="/Veiculos">
            <button type="button" class="btn btn-danger btn-lg mx-2 px-5" ><font-awesome-icon :icon="['fas', 'backward']" /> Voltar</button>
          </router-link>

          <button @click="enviaDadosVeiculo" class="btn btn-success btn-lg m-2 px-5"><font-awesome-icon :icon="['fas', 'circle-check']" /> Salvar</button>
        </div>
      </div>
</template>
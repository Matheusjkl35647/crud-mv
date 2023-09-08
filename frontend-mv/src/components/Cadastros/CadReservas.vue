<script>
/************************************************************
* Nome: Matheus J. Santos                                   *
* Tela: Cadastro de reservas                                *
* CRUD-MV: Full Stack                                       *
************************************************************/
import axios from 'axios'

export default {
  data() {
    return {
      formData: {
        nomeID: '',
        veiculoID: '',
        dataDe: '',
        dataAte: ''
      },
      pessoas: '',
      veiculos: '',
      valor: 0,
      message : '',
      itemSalvo : false,
      itemErro : false 
    }
  },
  mounted(){
    axios.get('http://127.0.0.1:8000/api/pessoa/trazPessoaCliente').then(response => {
      this.pessoas = response.data;
    }).catch(error => {
      console.log(error);
    });

    axios.get('http://127.0.0.1:8000/api/veiculo/index').then(response => {
      this.veiculos = response.data;
    }).catch(error => {
      console.log(error);
    });
  },
  methods: {
    enviaDadosReserva() {
      for (const key in this.formData) {
        if (Object.hasOwnProperty.call(this.formData, key)) {
          const value = this.formData[key];
          if(value == "") {
            return alert("Preencha todos os campos, por favor!")
          }
        }
      };

      const valores = {
        nomeID: this.formData.nomeID,
        veiculoID: this.formData.veiculoID,
        dataDe: this.formData.dataDe,
        dataAte: this.formData.dataAte,
      }

      axios.post('http://127.0.0.1:8000/api/reserva/incluir', valores)
      .then(response => {
        this.message = response.data.message;
        this.itemSalvo = true;
        this.itemErro = false;
        setTimeout(() => {
          this.$router.push('/Reservas');
        }, 3000);
      }).catch(error => {
        this.message = error;
        this.itemSalvo = false;
        this.itemErro = true;
      });
    },
    calculaDataValorVeiculo(){
      if((this.formData.dataDe != '' && this.formData.dataAte != '') && this.formData.veiculoID != '') {
        let data1Time = new Date(this.formData.dataDe).getTime();
        let data2Time = new Date(this.formData.dataAte).getTime();
        
        let diferencaEmMilissegundos = Math.abs(data2Time - data1Time);
        
        let diferencaEmDias = Math.floor(diferencaEmMilissegundos / ( 1000 * 60 * 60 * 24));
        
        diferencaEmDias == 0 ? this.formData.valor = this.valor :  this.formData.valor = this.valor * diferencaEmDias;
        let valorFinal  = parseFloat(this.formData.valor);
        return valorFinal.toFixed(2);
      }
    }
  },
  watch :{
    'formData.veiculoID': function(valor) {
      axios.get('http://127.0.0.1:8000/api/veiculo/trazVeiculo/' + valor)
      .then(response => {
        this.valor = response.data.custo_aluguel;
        this.calculaDataValorVeiculo();
      }).catch(error => {
        console.log(error);
      })
    },
  }
}
</script>

<template>
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><font-awesome-icon :icon="['fas', 'key']" /> Solicitar Reserva</h1>
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
        <form class="row g-3 py-4">
          <div class="col-md-12">
            <label for="placanomePessoaVeiculo" class="form-label">Nome</label>
            <select class="form-select" id="nomePessoa" aria-label="Floating label select example" v-model="formData.nomeID">
              <option v-for="pessoa in pessoas" :value="pessoa.id">{{ pessoa.nome }}</option>
            </select>
          </div>
          <div  class="col-md-6">
            <label for="dataDe" class="form-label">De</label>
            <input type="date" class="form-control" @blur="this.calculaDataValorVeiculo()" id="dataDe" v-model="formData.dataDe">
          </div>
          <div  class="col-md-6">
            <label for="dataAte" class="form-label">Até</label>
            <input type="date" class="form-control" id="dataAte"  @blur="this.calculaDataValorVeiculo()" v-model="formData.dataAte">
          </div>
          <div class="col-md-12" v-if="formData.dataDe != '' && formData.dataAte != ''">
            <label for="placaVeiculo" class="form-label">Veículo</label>
            <select class="form-select" id="ClienteFunc" aria-label="Floating label select example" v-model="formData.veiculoID">
              <option v-for="veiculo in veiculos" :value="veiculo.id">Veículo: {{ veiculo.modelo }} - R$ {{ veiculo.custo_aluguel }} - Placa: {{ veiculo.placa }}</option>
            </select>
          </div>
          <div class="col-md-12 mb-5"  v-if="formData.dataDe !== '' && formData.dataAte != ''">
            <label for="custoAluguel" class="form-label">Custo do Aluguel</label>
            <div class="input-group">
              <span class="input-group-text">R$</span>
              <input type="text" class="form-control" id="custoAluguel" disabled placeholder="00" v-model="formData.valor">
            </div>
            <h6 class="my-3">*Obs: cálculo do valor (aluguel diário X dias)</h6>
          </div>
        </form>

        <div class="text-center text-md-end fixed-bottom ">
          <router-link to="/Reservas">
            <button type="button" class="btn btn-danger btn-lg mx-2 px-5" ><font-awesome-icon :icon="['fas', 'backward']" /> Voltar</button>
          </router-link>
          <button @click="enviaDadosReserva" class="btn btn-success btn-lg m-2 px-5"><font-awesome-icon :icon="['fas', 'circle-check']" /> Reservar</button>
        </div>
      </div>
</template>
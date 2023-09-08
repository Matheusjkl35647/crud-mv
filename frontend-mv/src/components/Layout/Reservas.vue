<script>
/************************************************************
* Nome: Matheus J. Santos                                   *
* Tela: Index de reservas e cancelamento de reservas        *
* CRUD-MV: Full Stack                                       *
************************************************************/
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
      message: '',
      dataCompare: '',
      diaMessage: '' 
    };
  },
  mounted() {
    this.trazDados();
  },
  methods: {
    removeItem(id) {
      axios.patch(`http://127.0.0.1:8000/api/reserva/cancelar/${id}`)
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
      axios.get('http://127.0.0.1:8000/api/reserva/index')
      .then(response => {
        this.dadosTela = response.data;
      }).catch(error => {
        console.log(error);
      })
    }
  }
};
</script>

<template>
      <botoes :Tela="Tela"></botoes>  
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Reservas de veículos</h1>
      </div>    
      <div class="alert alert-success w-100 d-flex align-items-center text-center" role="alert" v-if="itemExcluido">
        <font-awesome-icon :icon="['fas', 'trash-can']" />
        <div class="ms-2">
          {{ message }}
        </div>
      </div>
      <div class="row overflow-auto">
        <div class="col-md-12">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Reservante</th>
                <th scope="col">Veículo</th>
                <th scope="col">Data de</th>
                <th scope="col">Data até</th>
                <th scope="col"><font-awesome-icon :icon="['fas', 'trash-can']" /></th>
              </tr>
            </thead>      
            <tbody>    
              <tr v-for="dados, key in dadosTela" :key="key" >
                  <td v-if="dados.reserva_ativa == '1'"><label :for="'usuario'+ dados.id">{{ dados.id }}</label></td>
                  <td v-if="dados.reserva_ativa == '1'"><label :for="'usuario'+ dados.id">{{ dados.nome }}</label></td>
                  <td v-if="dados.reserva_ativa == '1'"><label :for="'usuario'+ dados.id">{{ dados.marca }}</label></td>
                  <td v-if="dados.reserva_ativa == '1'"><label :for="'usuario'+ dados.id">{{ dados.data_reserva_de }}</label></td>
                  <td v-if="dados.reserva_ativa == '1'"><label :for="'usuario'+ dados.id">{{ dados.data_reserva_ate }}</label></td>
                  <td v-if="dados.reserva_ativa == '1'">
                    <div class="col-md-1 pb-3">
                      <span role="button" class="ursor-pointer" id="basic-addon2" @click="removeItem(dados.id)"><font-awesome-icon :icon="['fas', 'circle-minus']" size="xl" style="color: #d81313;" /></span>
                    </div>
                  </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Histórico de Reservas</h1>
      </div>
      <div class="row overflow-auto">
        <div class="col-md-12">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Reservante</th>
                <th scope="col">Veículo</th>
                <th scope="col">Data de</th>
                <th scope="col">Data até</th>
                <th scope="col"></th>
              </tr>
            </thead>      
            <tbody>    
              <tr v-for="dados, key in dadosTela" :key="key" >
                  <td v-if="dados.reserva_ativa == '0'"><label :for="'usuario'+ dados.id">{{ dados.id }}</label></td>
                  <td v-if="dados.reserva_ativa == '0'"><label :for="'usuario'+ dados.id">{{ dados.nome }}</label></td>
                  <td v-if="dados.reserva_ativa == '0'"><label :for="'usuario'+ dados.id">{{ dados.marca }}</label></td>
                  <td v-if="dados.reserva_ativa == '0'"><label :for="'usuario'+ dados.id">{{ dados.data_reserva_de }}</label></td>
                  <td v-if="dados.reserva_ativa == '0'"><label :for="'usuario'+ dados.id">{{ dados.data_reserva_ate }}</label></td>
                  <td v-if="dados.reserva_ativa == '0'">
                    <b>{{ dados.reserva_ativa == '0' ? 'Cancelado' : 'Término de prazo'}}</b>
                  </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>



</template>
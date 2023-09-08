/************************************************************
* Nome: Matheus J. Santos                                   *
* Código: Definições de dados globais                       *
* CRUD-MV: Full Stack                                       *
************************************************************/

import { createStore } from 'vuex';

const store = createStore({
  state: {
    pessoa: null,
    cadCategoria: null,
    cadReserva: null,
    cadCliente: null,
    cadPessoa: null,
    cadVeiculo: null
  },
  mutations: {
    setPessoa(state, pessoa) {
      state.pessoa = pessoa;
    },
    setSelectPessoa(state, cadPessoa) {
      state.cadPessoa = cadPessoa;
    },
    setSelectVeiculo(state, cadVeiculo) {
      state.cadVeiculo = cadVeiculo;
    },
    setResetAll(state) {
      state.cadPessoa = null;
      state.cadCategoria = null;
      state.cadReserva = null;
      state.cadCliente = null;
      state.cadPessoa = null;
      state.cadVeiculo = null;
    },
  },
});

export default store;
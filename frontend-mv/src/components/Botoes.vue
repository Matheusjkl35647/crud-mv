<script>
/************************************************************
* Nome: Matheus J. Santos                                   *
* Código: componente de botões CREATE E UPDATE              *
* CRUD-MV: Full Stack                                       *
************************************************************/

export default {
  props: {
    Tela: String,
    IdExclui: String
  },
  data() {
    return {
      dados: [],
    };
  },
};
</script>

<template>
      <div class="d-grid gap-1 d-md-block mt-2 text-center text-sm-start">
        <router-link :to="Tela + '/Cadastro'">
            <button type="button" class="btn btn-success btn-lg m-2 px-5"><font-awesome-icon :icon="['fas', 'circle-plus']" /> Incluir</button>
        </router-link>
        <router-link :to="IdExclui == '' ?  Tela : Tela + '/Cadastro'" >
            <button type="button" :disabled="IdExclui == ''" class="btn btn-warning btn-lg m-2 px-5" v-if="Tela != '/Reservas' && Tela != '/Categorias'"><font-awesome-icon :icon="['fas', 'pen-to-square']" /> Editar</button>
        </router-link>
      </div>
</template>
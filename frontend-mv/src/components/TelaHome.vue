<script setup>
import "../assets/TelaHome.css"

defineProps({
  data() {
    return {
      componenteTelas: ''
    }
  }
})
</script>

<template>
  <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <router-link class="navbar-brand col-md-3 col-lg-2 me-0 px-3" to="/"><img src="../assets/logo.svg" alt="" width="170" height="50"></router-link>
  
  <div class="navbar-nav">
    <div class="nav-item text-nowrap p-3">
      <button class="navbar-toggler px-2 d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </div>
</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar overflow-auto">
      <div class="position-sticky">
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center mt-0 px-3 mb-1 text-muted mt-md-5">
          <span>Principal</span>
        </h6>
        <ul class="nav flex-column">
          <li class="nav-item">
            <router-link class="nav-link" to="/Reservas">
              <font-awesome-icon :icon="['fas', 'circle-plus']" /> Reservas
            </router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/Veiculos"  v-if="$store.state.pessoa.tpPessoa == 'F'">
              <font-awesome-icon :icon="['fas', 'car']" /> Cadastro de Veículos
            </router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/Categorias" v-if="$store.state.pessoa.tpPessoa == 'F'">
              <span data-feather="home"></span>
              <font-awesome-icon :icon="['fas', 'list-check']" /> Cadastro de Categorias
            </router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/Pessoas">
              <span data-feather="home"></span>
              <font-awesome-icon :icon="['fas', 'circle-user']" /> Cadastro de Pessoas
            </router-link>
          </li>      
          <li class="nav-item">
            <router-link class="nav-link" to="/Usuarios">
              <span data-feather="home"></span>
              <font-awesome-icon :icon="['fas', 'user']" /> Cadastro de Usuários
            </router-link>
          </li> 
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Contatos Matheus</span>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" aria-current="page"  href="https://www.linkedin.com/in/matheus-jhonatan-santos/" target="_blank">
              LinkedIn
            </a>
          </li> 
          <li class="nav-item">
            <a class="nav-link" aria-current="page"  href="https://github.com/Matheusjkl35647" target="_blank">
              GitHub
            </a>
          </li> 
          <li class="nav-item">
            <a class="nav-link" aria-current="page"  href="https://api.whatsapp.com/send?phone=5511972317718&text=Ol%C3%A1%20Matheus,%20vimos%20o%20seu%20projeto%20(CRUD%20-%20MV)%20e%20gostamos%20muito.%20Podemos%20conversar?" target="_blank">
              WhatsApp
            </a>
          </li> 
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Outras Opções</span>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            
            <a class="nav-link" aria-current="page" :to="'/'">
              <span data-feather="sairSistema"></span>
              <font-awesome-icon :icon="['fas', 'right-from-bracket']" /> Sair  ({{ $store.state.pessoa.nome }})
            </a>
          </li> 
        </ul>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <router-view></router-view>
    </main>
    <p class="mt-3 mb-3 text-muted fixed-bottom">Matheus J. Santos &copy; 2023</p>

  </div>
</div>

</template>
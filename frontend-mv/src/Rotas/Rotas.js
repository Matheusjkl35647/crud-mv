import { createRouter, createWebHistory } from 'vue-router'

import TelaInicial from "../components/Layout/TelaPrincipal.vue"
import ReservasVue from "../components/Layout/Reservas.vue"
import CadReservasVue from "../components/Cadastros/CadReservas.vue"
import Categoria from "../components/Layout/Categoria.vue"
import CadCategoria from "../components/Cadastros/CadCategorias.vue"
import Veiculo from "../components/Layout/Veiculos.vue"
import CadVeiculo from "../components/Cadastros/CadVeiculos.vue"
import Usuario from "../components/Layout/Usuario.vue"
import CadUsuario from "../components/Cadastros/CadUsuarios.vue"
import Cliente from "../components/Layout/Pessoas.vue"
import CadCliente from "../components/Cadastros/CadPessoas.vue"

const rota = createRouter({
    history: createWebHistory(),
    routes: [
        { path: '/', component: TelaInicial },
        { path: '/Reservas', component: ReservasVue },
        { path: '/Reservas/Cadastro', component: CadReservasVue },
        { path: '/Veiculos', component: Veiculo },
        { path: '/Veiculos/Cadastro', component: CadVeiculo },
        { path: '/Categorias', component: Categoria },
        { path: '/Categorias/Cadastro', component: CadCategoria },
        { path: '/Pessoas', component: Cliente },
        { path: '/Pessoas/Cadastro', component: CadCliente },
        { path: '/Usuarios', component: Usuario },
        { path: '/Usuarios/Cadastro', component: CadUsuario },
    ]
});


export default rota;
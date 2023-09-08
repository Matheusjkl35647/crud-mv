/************************************************************
* Nome: Matheus J. Santos                                   *
* Código: Configurações detalhadas com '//'                 *
* CRUD-MV: Full Stack                                       *
************************************************************/

import DropZone from 'dropzone-vue'; // Para anexo de imagens
import 'dropzone-vue/dist/dropzone-vue.common.css'; // Estilo DropZone

import "bootstrap/dist/css/bootstrap.min.css" // Estilos
import "bootstrap" // Estilos
 
import { library } from '@fortawesome/fontawesome-svg-core' // Ícones Font Awesome
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome' // Ícones Font Awesome
import { fas} from '@fortawesome/free-solid-svg-icons' // Ícones Font Awesome

library.add(fas);

import rota from "./Rotas/Rotas"; //Rotas SPA
import { createApp } from 'vue';
import App from './App.vue';
import store from './store/store'; // VUEX para variável Global

const app = createApp(App);
app.component('font-awesome-icon', FontAwesomeIcon);
app.use(store);
app.use(rota);
app.use(DropZone);
app.mount('#app');


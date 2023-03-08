import { createApp } from 'vue'
import './style.css'
import App from './App.vue'
import router from './router'
// import 'bootstrap-vue/dist/bootstrap-vue.css';
// import 'bootstrap/dist/css/bootstrap.css';
// import 'bootstrap'

const app = createApp(App);

app.use(router);

app.mount('#app');


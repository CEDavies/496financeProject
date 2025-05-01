import './bootstrap';
import { createApp } from 'vue';
import App from './App.vue'; // Root component
import router from './router';

const app = createApp(App);
app.use(router);
app.mount('#app');

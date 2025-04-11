import './bootstrap';
import Welcome from './components/Welcome.vue';
import { createApp } from 'vue';

const app = createApp();

app.component('welcome', Welcome);

app.mount('#app');
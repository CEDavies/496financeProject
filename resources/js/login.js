import './bootstrap';
import Login from './components/Login.vue';
import { createApp } from 'vue'

const app = createApp()

app.component('login',Login)

app.mount('#login')
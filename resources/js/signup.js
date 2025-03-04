import './bootstrap';
import Signup from './components/Signup.vue';
import { createApp } from 'vue'

const app = createApp()

app.component('signup',Signup)

app.mount('#signup')
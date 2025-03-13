import './bootstrap';
import Welcome from './components/welcome.vue';
import { createApp } from 'vue'

const app = createApp()


app.component('welcome', Welcome)

app.mount('#app')
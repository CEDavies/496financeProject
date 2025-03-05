import './bootstrap';
import Counter from './components/Counter.vue'
import Welcome from './components/welcome.vue';
import { createApp } from 'vue'

const app = createApp()

app.component('counter', Counter)
app.component('welcome', Welcome)

app.mount('#app')
import './bootstrap';
import Counter from './components/Counter.vue'
import { createApp } from 'vue'

const app = createApp()

app.component('counter', Counter)

app.mount('#app')
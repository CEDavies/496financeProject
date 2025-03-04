import './bootstrap';
import teachDashboard from '../components/teacher/teachDashboard.vue';
import { createApp } from 'vue'

const app = createApp()

app.component('teachDashboard',teachDashboard)

app.mount('#teachDashboard')
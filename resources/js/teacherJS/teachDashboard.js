import '../bootstrap';
import teachDashboard from '../components/teacher/teachDashboard.vue';
import { createApp } from 'vue'

const app = createApp(teachDashboard)

app.component('teachDashboard',teachDashboard)

app.mount('#teachDashboard')
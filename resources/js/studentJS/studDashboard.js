import studDashboard from '../components/student/studDashboard.vue';
import { createApp } from 'vue'

const app = createApp()

app.component('studDashboard',studDashboard)

app.mount('#studDashboard')
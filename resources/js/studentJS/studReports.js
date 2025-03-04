import './bootstrap';
import studReports from '../components/student/studReports.vue';
import { createApp } from 'vue'

const app = createApp()

app.component('studReport',studReports)

app.mount('#studReport')
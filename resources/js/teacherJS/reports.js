import '../bootstrap';
import reports from '../components/teacher/reports.vue';
import { createApp } from 'vue'

const app = createApp(reports)

app.component('reports',reports)

app.mount('#reports')
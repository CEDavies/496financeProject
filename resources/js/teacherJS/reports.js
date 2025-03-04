import './bootstrap';
import reports from '../components/teacher/reports.vue';
import { createApp } from 'vue'

const app = createApp()

app.component('reports',reports)

app.mount('#reports')
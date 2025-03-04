import './bootstrap';
import studProject from '../components/student/studProject.vue';
import { createApp } from 'vue'

const app = createApp()

app.component('studProject',studProject)

app.mount('#studProject')
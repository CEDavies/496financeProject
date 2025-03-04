import './bootstrap';
import projects from '../components/teacher/projects.vue';
import { createApp } from 'vue'

const app = createApp()

app.component('projects',projects)

app.mount('#teachProject')
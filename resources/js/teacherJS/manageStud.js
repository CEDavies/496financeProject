import '../bootstrap';
import manageStud from '../components/teacher/manageStud.vue';
import { createApp } from 'vue'

const app = createApp(manageStud)

app.component('manageStud',manageStud)

app.mount('#manageStud')
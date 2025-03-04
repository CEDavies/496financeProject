import './bootstrap';
import investmenOpt from '../components/student/investmenOpt.vue';
import { createApp } from 'vue'

const app = createApp()

app.component('studInvestment',investmenOpt)

app.mount('#studInvestment')
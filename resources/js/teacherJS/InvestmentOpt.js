import './bootstrap';
import InvestmentOpt from '../components/teacher/InvestmentOpt.vue';
import { createApp } from 'vue'

const app = createApp()

app.component('teachInvestment',InvestmentOpt)

app.mount('#teachInvestment')
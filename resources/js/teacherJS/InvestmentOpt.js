import '../bootstrap';
import InvestmentOpt from '../components/teacher/InvestmentOpt.vue';
import { createApp } from 'vue'

const app = createApp(InvestmentOpt)

app.component('teachInvestment',InvestmentOpt)

app.mount('#teachInvestment')
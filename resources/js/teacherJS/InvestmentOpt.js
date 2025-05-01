import '../bootstrap';
import InvestmentOpt from '../components/teacher/InvestmentOpt.vue';
import { createApp } from 'vue';
import i18n from '../i18n';

document.addEventListener('DOMContentLoaded', () => {
    // Routes for the Vue.js to use
    const homeRoute = document.getElementById('teachInvestment').getAttribute('home-route');
    const projectRoute = document.getElementById('teachInvestment').getAttribute('project-route');
    const manageStud = document.getElementById('teachInvestment').getAttribute('manage-stud');
    const manageInvest = document.getElementById('teachInvestment').getAttribute('manage-invest');
    const reportRoute = document.getElementById('teachInvestment').getAttribute('report-route');

    const app = createApp({
        components: {
            'investment-opt': InvestmentOpt, // Register the component locally
        },
        template: '<investment-opt :home-route="homeRoute" :project-route="projectRoute" :report-route="reportRoute" :manage-stud="manageStud" :manage-invest="manageInvest" />',
        data() {
            return {
                homeRoute: homeRoute,
                projectRoute: projectRoute,
                manageStud: manageStud,
                manageInvest: manageInvest,
                reportRoute: reportRoute,
            };
        }
    });

    app.use(i18n);
    app.mount('#teachInvestment');
});
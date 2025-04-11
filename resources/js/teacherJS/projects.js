import '../bootstrap';
import projects from '../components/teacher/projects.vue';
import { createApp } from 'vue'

document.addEventListener('DOMContentLoaded', () => {
    //routes for the vuejs to use
    const homeRoute = document.getElementById('teachProject').getAttribute('home-route');
    const projectRoute = document.getElementById('teachProject').getAttribute('project-route');
    const manageStud = document.getElementById('teachProject').getAttribute('manage-stud');
    const manageInvest = document.getElementById('teachProject').getAttribute('manage-invest');
    const reportRoute = document.getElementById('teachProject').getAttribute('report-route');
    const app = createApp({
        components: {
            'projects': projects // Register the component locally within this app instance
        },
        //what will be ran when js finds div with id
        template: '<projects :home-route="homeRoute" :project-route="projectRoute" :report-route="reportRoute" :manage-stud="manageStud" :manage-invest="manageInvest" />',
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

    app.mount('#teachProject');
});
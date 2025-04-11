import '../bootstrap';
import teachDashboard from '../components/teacher/teachDashboard.vue';
import { createApp } from 'vue';

//routes for the vuejs to use
const homeRoute = document.getElementById('teachDashboard').getAttribute('home-route');
const projectRoute = document.getElementById('teachDashboard').getAttribute('project-route');
const manageStud = document.getElementById('teachDashboard').getAttribute('manage-stud');
const manageInvest = document.getElementById('teachDashboard').getAttribute('manage-invest');
const reportRoute = document.getElementById('teachDashboard').getAttribute('report-route');
const app = createApp({
  components: {
    'teach-dashboard': teachDashboard // Register the component locally within this app instance
  },
  //what will be ran when js finds div with id (teachDashboard)
  template: '<teach-dashboard :home-route="homeRoute" :project-route="projectRoute" :report-route="reportRoute" :manage-stud="manageStud":manage-invest="manageInvest" />',
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

app.mount('#teachDashboard');
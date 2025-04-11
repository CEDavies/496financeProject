import '../bootstrap';
import reports from '../components/teacher/reports.vue';
import { createApp } from 'vue'


//routes for the vuejs to use
const homeRoute = document.getElementById('reports').getAttribute('home-route');
const projectRoute = document.getElementById('reports').getAttribute('project-route');
const manageStud = document.getElementById('reports').getAttribute('manage-stud');
const manageInvest = document.getElementById('reports').getAttribute('manage-invest');
const reportRoute = document.getElementById('reports').getAttribute('report-route');
const app = createApp({
  components: {
    'reports': reports // Register the component locally within this app instance
  },
  //what will be ran when js finds div with id 
  template: '<reports :home-route="homeRoute" :project-route="projectRoute" :report-route="reportRoute" :manage-stud="manageStud":manage-invest="manageInvest" />',
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

app.mount('#reports')
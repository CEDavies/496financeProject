import '../bootstrap';
import manageStud from '../components/teacher/manageStud.vue';
import { createApp } from 'vue'

//routes for the vuejs to use
const homeRoute = document.getElementById('manageStud').getAttribute('home-route');
const projectRoute = document.getElementById('manageStud').getAttribute('project-route');
const manageStuds = document.getElementById('manageStud').getAttribute('manage-stud');
const manageInvest = document.getElementById('manageStud').getAttribute('manage-invest');
const reportRoute = document.getElementById('manageStud').getAttribute('report-route');

const app = createApp({
  components: {
    'manage-stud': manageStud // Register the component locally within this app instance
  },
  //what will be ran when js finds div with id 
  template: '<manage-stud :home-route="homeRoute" :project-route="projectRoute" :report-route="reportRoute" :manage-stud="manageStud":manage-invest="manageInvest" />',
  data() {
    return {
      homeRoute: homeRoute,
      projectRoute: projectRoute,
      manageStuds: manageStuds,
      manageInvest: manageInvest,
      reportRoute: reportRoute,
    };
  }
});

app.mount('#manageStud')
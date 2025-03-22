import '../bootstrap.js';
import studDashboard from '../components/student/studDashboard.vue';
import { createApp } from 'vue';

// for non .app views - need to have the vuejs in the create app
const app = createApp(studDashboard); //StudDashboard is the root component

app.component('StudDashboard',studDashboard);

app.mount('#studDashboard');
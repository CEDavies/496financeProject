import '../bootstrap.js';
import studDashboard from '../components/student/studDashboard.vue';
import { createApp } from 'vue';

// for non .app views - need to have the vuejs in the create app
// Create the app and mount it to the div with the id 'studDashboard'
const app = createApp(studDashboard);
app.mount('#studDashboard');
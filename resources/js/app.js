import './bootstrap';
import Welcome from './components/Welcome.vue';
import { createApp } from 'vue';

const app = createApp();

app.component('welcome', Welcome);

app.mount('#app');

// Add this to include Google SDK
const googleScript = document.createElement('script');
googleScript.src = "https://apis.google.com/js/platform.js";
googleScript.async = true;
googleScript.defer = true;
document.head.appendChild(googleScript);

import App from './App.vue'
//import router from './router/index.js'

createApp(App).use(router).mount('#app')

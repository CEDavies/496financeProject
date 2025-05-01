import { createRouter, createWebHistory } from 'vue-router';
import LoginCallback from './views/LoginCallback.vue';
import Dashboard from './views/Dashboard.vue'; //change this as needed
import Welcome from './components/Welcome.vue';

const routes = [
  { path: '/', component: Welcome, props: { loginRoute: '/auth/redirect', signupRoute: '/signup' } },
  { path: '/auth/callback', component: LoginCallback },
  { path: '/dashboard', component: Dashboard },
  // Add more routes as needed
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
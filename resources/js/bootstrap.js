import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Set CSRF token in axios headers
axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// Ensure cookies (sessions) are sent with requests
axios.defaults.withCredentials = true;

// Set the base URL for all API requests to the Laravel backend
axios.defaults.baseURL = 'http://localhost:8000'; 

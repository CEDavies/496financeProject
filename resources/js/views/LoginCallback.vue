<template>
    <div class="text-center mt-10">Logging you in...</div>
  </template>
  
  <script setup>
  import { onMounted } from 'vue';
  import axios from 'axios';
  import { useRouter } from 'vue-router';
  
  const router = useRouter();
  
  onMounted(async () => {
    try {
      const response = await axios.get('/api/user');
      console.log('User info:', response.data);
  
      router.push('/dashboard');
    } catch (error) {
      console.error('Failed to fetch user:', error);
      router.push('/login'); // fallback if login failed
    }
  });
  </script>
import Vue from 'vue';
import VueRouter from 'vue-router';

<script setup>
</script>

<template>
  <!-- Main container to center everything -->
  <div class="relative h-screen flex items-center justify-center bg-gray-100">
    
    <!-- Logo as a background or separate layered item -->
    <img 
      class="object-contain z-10" 
      src="/resources/assets/temp logo.png" 
      alt="temporary logo - WCPS"
    />
    
    <!-- Centered content container -->
    <div class="relative z-20 text-center">
      <h2 class="text-xl font-semibold mb-4">Welcome, please login or sign up!</h2>

      <div class="space-x-20 px-10">
        <router-link to="/Login">
          <button type="button" class="px-6 py-2 bg-blue-500 text-white rounded-md">Login</button>
        </router-link>

        <RouterLink to="/Signup">
          <button type="button" class="px-6 py-2 bg-green-500 text-white rounded-md">Sign Up</button>
        </RouterLink>
      </div>
    </div>
  </div>
</template>

<style scoped>
/* Optional: Add styles for better appearance */
</style>

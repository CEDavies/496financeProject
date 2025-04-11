<script setup>
const { loginRoute, signupRoute } = defineProps({
  loginRoute: String,
  signupRoute: String,
});

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
        <a type="button" :href="loginRoute" class="px-6 py-2 bg-blue-500 text-white rounded-md">Login</a>
        <a type="button" :href="signupRoute" class="px-6 py-2 bg-green-500 text-white rounded-md">Sign Up</a>
      </div>
    </div>
  </div>
</template>


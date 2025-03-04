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
    <div class="relative z-20 text-center space-y-6">
      <h2 class="text-xl font-semibold mb-4">Please enter your login information.</h2>

      <div class="space-y-4 px-10">
        <!-- Username/Input field -->
        <input type="text" class="px-6 py-2 bg-gray-50 text-black rounded-md w-full border-2" placeholder="Username/Email" />

        <!-- Password/Input field -->
        <input type="password" class="px-6 py-2 bg-gray-50 text-black rounded-md w-full border-2" placeholder="Password" />

        <!-- Authentication buttons -->
        <div class="mt-10">
          <button type="button" class="px-6 py-2 bg-yellow-500 text-white rounded-md w-full">Google Auth</button>
          <button type="button" class="px-6 py-2 bg-blue-500 text-white rounded-md w-full mt-3">Login</button>
        </div>
      </div>
    </div>
    
  </div>
</template>

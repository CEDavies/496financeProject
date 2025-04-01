<script setup>
</script>

<template>
  <!-- Navbar Container -->
  <nav class="bg-blue-600 p-4">
    <div class="flex items-center justify-between">
      <!-- Left Side: Title -->
      <div class="text-white text-lg font-semibold">
        Teacher Dashboard
      </div>

      <!-- Right Side: Navigation Links and Signout Button -->
      <div class="space-x-20">
        <a href="#" class="text-white hover:text-gray-300">Home</a>
        <a href="#" class="text-white hover:text-gray-300">Manage Student</a>
        <a href="#" class="text-white hover:text-gray-300">Manage Investment Options</a>
        <a href="#" class="text-white hover:text-gray-300">Projects</a>
        <a href="#" class="text-white hover:text-gray-300">Reports</a>
      </div>

      <button class="text-white bg-red-500 px-4 py-2 rounded-md hover:bg-red-600">
          Signout
        </button>
    </div>
  </nav>

  <!-- Main container to center everything -->
  <div class="relative h-screen flex justify-center bg-gray-100">
    <!-- Centered content container -->
    <div class="relative z-20 py-10">
      <h2 class="text-xl font-semibold mb-4">Welcome to the Student Dashboard</h2>
      <input type="hidden" name="_token" v-bind:value="csrf"> 

      <div class="md:col-span-2 bg-white rounded shadow w-full h-3/4 text-left">
        <h1 class="my-5 px-5 py-5">Students: ##</h1>
        <h1 class="my-5 px-5 py-2">Projects Submitted: ##</h1>
        <h1 class="my-5 px-5 py-2">Projects Remaining to be Graded: ##</h1>
      </div>
    </div>
  </div>
</template>


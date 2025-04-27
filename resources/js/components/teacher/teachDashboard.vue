<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

//setup the props
const { homeRoute, manageStud, manageInvest, projectRoute, reportRoute } = defineProps({
  homeRoute: {required:true, type: String},
  manageStud: {required:true, type: String},
  manageInvest: {required:true, type: String},
  projectRoute: {required:true, type: String}, 
  reportRoute: {required:true, type: String},
});

onMounted(() => {
  csrf.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
});

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
        <a type="button" :href="homeRoute" class="text-white hover:text-gray-300">Home</a>
        <a type="button" :href="manageStud" class="text-white hover:text-gray-300">Manage Student</a>
        <a type="button" :href="manageInvest" class="text-white hover:text-gray-300">Manage Investment Options</a>
        <a type="button" :href="projectRoute" class="text-white hover:text-gray-300">Projects</a>
        <a type="button" :href="reportRoute" class="text-white hover:text-gray-300">Reports</a>
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


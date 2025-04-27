<script setup>
import { ref, onMounted} from 'vue';

//setup the props
const { homeRoute, manageStud, manageInvest, projectRoute, reportRoute } = defineProps({
  homeRoute: {required:true, type: String},
  manageStud: {required:true, type: String},
  manageInvest: {required:true, type: String},
  projectRoute: {required:true, type: String}, 
  reportRoute: {required:true, type: String},
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
      <h2 class="text-xl font-semibold mb-4">Investment Options</h2>

      <div class="flex space-x-6"> 
        <table class="w-full border-collapse"> 
          <thead>
            <tr>
              <th class="border px-4 py-2">NAME</th> 
              <th class="border px-4 py-2">Duration</th>
              <th class="border px-4 py-2">Interest Type</th>
              <th class="border px-4 py-2">Interest Rate</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="border px-4 py-2">Name</td>
              <td class="border px-4 py-2">Duration</td>
              <td class="border px-4 py-2">Interest Type</td>
              <td class="border px-4 py-2">Interest Rate</td>
            </tr>
            <tr>
              <td class="border px-4 py-2">Name</td>
              <td class="border px-4 py-2">Duration</td>
              <td class="border px-4 py-2">Interest Type</td>
              <td class="border px-4 py-2">Interest Rate</td>
            </tr>
            <tr>
              <td class="border px-4 py-2">Name</td>
              <td class="border px-4 py-2">Duration</td>
              <td class="border px-4 py-2">Interest Type</td>
              <td class="border px-4 py-2">Interest Rate</td>
            </tr>
          </tbody>
        </table>

        <div class="space-y-4">
          <input type="hidden" name="_token" v-bind:value="csrf"> 
          <button type="button" class="px-6 py-2 bg-yellow-500 text-white rounded-md w-full">Add</button>
          <button type="button" class="px-6 py-2 bg-yellow-500 text-white rounded-md w-full">Edit</button>
          <button type="button" class="px-6 py-2 bg-blue-500 text-white rounded-md w-full mt-3">Delete</button>
        </div>
      </div>
    </div>
  </div>
</template>


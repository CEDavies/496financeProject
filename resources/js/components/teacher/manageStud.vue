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
      <h2 class="text-xl font-semibold mb-4">Students</h2>

      <div class="flex space-x-6"> 
        <table class="w-full border-collapse"> 
          <thead>
            <tr>
              <th class="border px-4 py-2">NAME</th> 
              <th class="border px-4 py-2">Project</th>
              <th class="border px-4 py-2">Status</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="border px-4 py-2">Student 1 Name</td>
              <td class="border px-4 py-2">Project A</td>
              <td class="border px-4 py-2">In Progress</td>
            </tr>
            <tr>
              <td class="border px-4 py-2">Student 2 Name</td>
              <td class="border px-4 py-2">Project B</td>
              <td class="border px-4 py-2">Submitted</td>
            </tr>
          </tbody>
        </table>

        <div class="space-y-4">
          <input type="search" class="border-2">
          <button type="button" class="mx-1 px-6 py-2 bg-green-500 text-white rounded-md">Search</button>
          <button type="button" class="px-6 py-2 bg-yellow-500 text-white rounded-md w-full">Add</button>
          <button type="button" class="px-6 py-2 bg-yellow-500 text-white rounded-md w-full">Edit</button>
          <button type="button" class="px-6 py-2 bg-blue-500 text-white rounded-md w-full mt-3">Delete</button>
        </div>
      </div>
    </div>
  </div>
</template>


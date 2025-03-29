<script setup>
</script>

<template>
  <nav class="bg-blue-600 p-4">
    <div class="flex items-center justify-between">
      <div class="text-white text-lg font-semibold">
        Teacher Dashboard
      </div>
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

  <div class="relative h-screen flex justify-center bg-gray-100">
    <div class="py-10 w-full max-w-2xl"> <h2 class="text-xl font-semibold m-4">Student Reports</h2>
      <table class="w-full border-collapse border-2 border-gray-300">
        <caption>
          <div class="py-2 text-center text-lg font-semibold">Projects</div>
          <input type="hidden" name="_token" v-bind:value="csrf"> 
        </caption>
        <thead>
          <tr class="bg-gray-200">
            <th class="border border-gray-300 px-4 py-2">Student</th>
            <th class="border border-gray-300 px-4 py-2">Project File</th>
            <th class="border border-gray-300 px-4 py-2">Portfolio File</th>
            <th class="border border-gray-300 px-4 py-2">Feedback/Grade</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="border border-gray-300 px-4 py-2">Student Name 1</td>
            <td class="border border-gray-300 px-4 py-2">[Link to File]</td>
            <td class="border border-gray-300 px-4 py-2">[Link to File]
              <button class="bg-gray-200 hover:bg-gray-300 px-4 py-2 my-2 rounded">Download</button>
            </td>
            <td class="border border-gray-300 px-4 py-2">[Grade/Feedback]</td>
          </tr>
          <tr>
            <td class="border border-gray-300 px-4 py-2">Student Name 2</td>
            <td class="border border-gray-300 px-4 py-2">[Link to File] </td>
            <td class="border border-gray-300 px-4 py-2">[Link to File]
              <button class="bg-gray-200 hover:bg-gray-300 px-4 py-2 my-2 rounded">Download</button>
            </td>
            <td class="border border-gray-300 px-4 py-2">Send Feedback</td>
          </tr>
          <tr>
            <td class="border border-gray-300 px-4 py-2">Student Name 3</td>
            <td class="border border-gray-300 px-4 py-2">N/A</td>
            <td class="border border-gray-300 px-4 py-2"><button class="bg-gray-200 hover:bg-gray-300 px-4 py-2 my-2 rounded">Generate Report</button></td>
            <td class="border border-gray-300 px-4 py-2">[Grade/Feedback]</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
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

const projects=ref([]);

const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

const getProj = async () => {
  try {
    const response = await fetch('http://127.0.0.1:8000/api/projects', {
      headers: {
        'X-CSRF-TOKEN': csrf,
      },
    });
    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }
    projects.value = await response.json();
  } catch (error) {
    console.error('Cannot get the students:', error);
  }
};

onMounted(() => {
  getProj();
});
</script>

<template>
  <nav class="bg-blue-600 p-4">
    <div class="flex items-center justify-between">
      <div class="text-white text-lg font-semibold">
        Teacher Dashboard
      </div>
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

  <!-- Main body -->
  <div class="relative h-screen flex justify-center bg-gray-100">
    <div class="py-10 w-full max-w-2xl"> <h2 class="text-xl font-semibold m-4">Student Projects</h2>
      <input type="hidden" name="_token" v-bind:value="csrf"> 

      <!-- Need to add JS for SQL Queries for table -->
      <table class="w-full border-collapse border-2 border-gray-300">
        <caption>
          <div class="py-2 text-center text-lg font-semibold">Projects</div>
        </caption>
        <thead>
          <tr class="bg-gray-200">
            <th class="border border-gray-300 px-4 py-2">Student</th>
            <th class="border border-gray-300 px-4 py-2">Project File</th>
            <th class="border border-gray-300 px-4 py-2">Investment Option</th>
            <th class="border border-gray-300 px-4 py-2">Portfolio File</th>
            <th class="border border-gray-300 px-4 py-2">Feedback/Grade</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="project in projects" :key="project.id">
            <td class="border border-gray-300 px-4 py-2">{{project.student_name}}</td>
            <td class="border border-gray-300 px-4 py-2">{{project.project_filepath}}</td>
            <td class="border border-gray-300 px-4 py-2">{{project.option_name}}</td>
            <td class="border border-gray-300 px-4 py-2">{{project.initial_investment}}
              <button class="bg-gray-200 hover:bg-gray-300 px-4 py-2 my-2 rounded">Download</button>
            </td>
            <td class="border border-gray-300 px-4 py-2">{{project.grade}}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
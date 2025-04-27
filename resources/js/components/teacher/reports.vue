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

//want to get the information for getting the sepcific project from the database
const student_id = ref(2); //static values for right now
const teacher_id = ref(1);
const project_id = ref(2);

//need to get multiple options AHH
const investment_ids = ref(1); //need to do
const intialAmt = ref(0);

const route = 'teacherViews/reports';
//take it from student_investment then put it in portfilo

// onMounted(() => {
//   csrf.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
// });

//gets the file from the database
const getUploadedFile = () => {
  let formData = new FormData();
  formData.append('student_id', student_id.value);
  formData.append('teacher_id', teacher_id.value);
  formData.append('project_id', project_id.value);
  const object = Object.fromEntries(formData.entries());
  console.log(object); 
  //formData.append('_token', this.csrf); // Append CSRF token

  //need these ones in getting the file? could just be for the portfolio generation
  // formData.append('investment_ids', investment_ids);
  // formData.append('intialAmt', intialAmt);


  //does a POST request
  axios.post(route, formData)
    .then(response => {
      console.log('File Found Successfully', response.data);
      alert('File Found successfully!');
    })
    .catch(error => {
      console.error('Error finding file:', error);
      alert('Error finding file');
    });
};
</script>

<template>
  <head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>
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
            <td class="border border-gray-300 px-4 py-2">
              <form @submit.prevent="getUploadedFile()" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" v-bind:value="csrf"> 
                <button type="submit" class="bg-gray-200 hover:bg-gray-300 px-4 py-2 my-2 rounded">Generate Report</button>
              </form>
            </td>
            <td class="border border-gray-300 px-4 py-2">[Grade/Feedback]</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
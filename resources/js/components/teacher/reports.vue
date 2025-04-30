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

const reports=ref([]);

const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

//gets the reports to display
const getReports = async () => {
  try {
    const response = await axios.get('api/reports', {
      headers: {
        'X-CSRF-TOKEN': csrf,
      },
    });
    reports.value = response.data;
  } catch (error) {
    console.error('Cannot get investments:', error);
  }
};

onMounted(() => {
  getReports();
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

  <div class="relative h-screen flex justify-center bg-gray-100">
    <div class="py-10 w-full max-w-2xl">
      <h2 class="text-xl font-semibold m-4">Student Reports</h2>
      <template v-if="reports.length > 0">
        <table class="w-full border-collapse border-2 border-gray-300">
          <caption>
            <div class="py-2 text-center text-lg font-semibold">Projects</div>
            <input type="hidden" name="_token" v-bind:value="csrf">
          </caption>
          <thead>
            <tr class="bg-gray-200">
              <th class="border border-gray-300 px-4 py-2">Student</th>
              <th class="border border-gray-300 px-4 py-2">Year</th>
              <th class="border border-gray-300 px-4 py-2">Portfolio File</th>
              <th class="border border-gray-300 px-4 py-2">Value of Portfolio</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="report in reports" :key="report.id">
              <td class="border border-gray-300 px-4 py-2">{{ report.portfolio_id }}</td>
              <td class="border border-gray-300 px-4 py-2">{{ report.year }}</td>
              <td class="border border-gray-300 px-4 py-2">[Link to File]
                <button class="bg-gray-200 hover:bg-gray-300 px-4 py-2 my-2 rounded">Download</button>
              </td>
              <td class="border border-gray-300 px-4 py-2">{{ report.portfolio_value }}</td>
            </tr>
          </tbody>
        </table>
      </template>
      <div v-else class="text-center mt-6">
        No reports available.
      </div>
    </div>
  </div>
</template>
<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios'; // Import Axios

// Setup the props
const { homeRoute, manageStud, manageInvest, projectRoute, reportRoute } = defineProps({
  homeRoute: { required: true, type: String },
  manageStud: { required: true, type: String },
  manageInvest: { required: true, type: String },
  projectRoute: { required: true, type: String },
  reportRoute: { required: true, type: String },
});

// Adding investments
const newInvestment = ref({
  name: '',
  amount: '',
  interest_type: 'simple', // Default value
  interest_rate: '',
});

const investments = ref([]);

const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// Method to toggle the visibility of the add form
const showAddForm = ref(false);

const toggleAddForm = () => {
  showAddForm.value = !showAddForm.value;
};

const addInvestment = async () => {
  let formData = new FormData();
  formData.append('name', newInvestment.value.name);
  formData.append('interest_type', newInvestment.value.interest_type);
  formData.append('interest_rate', newInvestment.value.interest_rate);
  formData.append('duration_year', newInvestment.value.duration_year);

  const object = Object.fromEntries(formData.entries());
  console.log(object);

  axios.post('teacherViews/InvestmentOpt', formData) // <--- ENSURE THIS IS CORRECT
    .then(response => {
      console.log('Investment Added Successfully', response.data);
      alert('Investment Added successfully!');
      getInvest(); // Reload investments after adding
      showAddForm.value = false; // Hide the form after submission
    })
    .catch(error => {
      console.error('Error adding investment:', error);
      alert('Error adding investment');
    });
}

const getInvest = async () => {
  try {
    const response = await axios.get('api/investment', {
      headers: {
        'X-CSRF-TOKEN': csrf,
      },
    });
    investments.value = response.data;
    console.log(investments.value);
  } catch (error) {
    console.error('Cannot get investments:', error);
  }
};

onMounted(() => {
  getInvest();
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
          <tbody v-if="investments.length > 0">
            <tr v-for="investment in investments" :key="investment.id">
              <td class="border px-4 py-2 break-words w-1/4">{{ investment.name || 'Missing name' }}</td>
              <td class="border px-4 py-2">{{ investment.duration_year }}</td>
              <td class="border px-4 py-2">{{ investment.interest_type }}</td>
              <td class="border px-4 py-2">{{ investment.interest_rate }}</td>
            </tr>
          </tbody>
          <tbody v-else>
            <tr>
              <td colspan="4" class="text-center py-4">No investment options found.</td>
            </tr>
          </tbody>
        </table>

        <div class="space-y-4">
          <input type="hidden" name="_token" v-bind:value="csrf"> 
          <button type="button" class="px-6 py-2 bg-yellow-500 text-white rounded-md w-full" @click="toggleAddForm">
            Add
          </button>

          <!-- Conditional Add Investment Form -->
          <div v-if="showAddForm">
            <h2>Add New Investment</h2>

            <!-- Add Investment Form -->
            <form @submit.prevent="addInvestment">
              <div>
                <label for="name">Investment Name</label>
                <input type="text" id="name" v-model="newInvestment.name" required />
              </div>

              <div>
                <label for="interest_type">Interest Type</label>
                <select id="interest_type" v-model="newInvestment.interest_type" required>
                  <option value="simple">Simple</option>
                  <option value="compound">Compound</option>
                </select>
              </div>

              <div>
                <label for="interest_rate">Interest Rate (%)</label>
                <input type="number" id="interest_rate" v-model="newInvestment.interest_rate" required />
              </div>

              <div>
                <label for="duration_year">Duration Year(s)</label>
                <input type="number" id="duration_year" v-model="newInvestment.duration_year" required />
              </div>

              <button type="submit" class="mt-4 px-4 py-2 bg-green-500 text-white rounded-md">
                Submit
              </button>
            </form>
          </div>
          
          <button type="button" class="px-6 py-2 bg-yellow-500 text-white rounded-md w-full">Edit</button>
          <button type="button" class="px-6 py-2 bg-blue-500 text-white rounded-md w-full mt-3">Delete</button>
        </div>
      </div>
    </div>
  </div>
</template>

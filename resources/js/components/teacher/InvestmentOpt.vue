<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios'; // Import Axios
import { useI18n } from 'vue-i18n';

// Setup the props
const { homeRoute, manageStud, manageInvest, projectRoute, reportRoute } = defineProps({
  homeRoute: { required: true, type: String },
  manageStud: { required: true, type: String },
  manageInvest: { required: true, type: String },
  projectRoute: { required: true, type: String },
  reportRoute: { required: true, type: String },
});

// Adding/Editing investments
const editingInvestmentId = ref(null);
const editInvestmentData = ref({
  name: '',
  interest_type: 'simple',
  interest_rate: '',
  duration_year: '',
});

const newInvestment = ref({ // Still used for adding
  name: '',
  interest_type: 'simple',
  interest_rate: '',
  duration_year: '',
});

const investments = ref([]);
const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// Visibility of forms
const showAddForm = ref(false);
const showEditForm = ref(false);

const toggleAddForm = () => {
  showAddForm.value = !showAddForm.value;
  showEditForm.value = false; // Ensure only one form is visible
  editingInvestmentId.value = null; // Reset editing ID
  // Clear the add form
  newInvestment.value = { name: '', interest_type: 'simple', interest_rate: '', duration_year: '' };
};

const openEditForm = (investment) => {
  editingInvestmentId.value = investment.option_id;
  editInvestmentData.value = { ...investment }; // Populate edit form with investment data
  showEditForm.value = true;
  showAddForm.value = false; // Ensure only one form is visible
};

const addInvestment = async () => {
  try {
    await axios.post('teacherViews/InvestmentOpt', newInvestment.value, {
      headers: {
        'X-CSRF-TOKEN': csrf,
      },
    });
    alert('Investment Added successfully!');
    getInvest(); // Reload investments after adding
    showAddForm.value = false; // Hide the form after submission
    // Clear the add form
    newInvestment.value = { name: '', interest_type: 'simple', interest_rate: '', duration_year: '' };
  } catch (error) {
    console.error('Error adding investment:', error);
    alert('Error adding investment');
  }
};

//editing the investments
const editInvestment = async () => {
  if (!editingInvestmentId.value) return;

  try {
    await axios.put(`teacherViews/InvestmentOpt/${editingInvestmentId.value}`, editInvestmentData.value, { // Changed URL
      headers: {
        'X-CSRF-TOKEN': csrf,
      },
    });
    alert('Investment updated successfully!');
    getInvest(); // Reload investments after editing
    showEditForm.value = false; // Hide the edit form
    editingInvestmentId.value = null; // Reset editing ID
  } catch (error) {
    console.error('Error updating investment:', error);
    alert('Error updating investment');
  }
};

//delete an investment from database
const deleteInvestment = async (investmentId) => {
  console.log('Investment ID:', investmentId);
  if (confirm("Are you sure you want to delete this investment?")) {
    try {
      await axios.delete(`teacherViews/InvestmentOpt/${investmentId}`, {
        headers: {
          'X-CSRF-TOKEN': csrf,
        },
      });
      alert('Investment deleted successfully!');
      getInvest(); // Reload investments after deleting
    } catch (error) {
      console.error('Error deleting investment:', error);
      alert('Error deleting investment');
    }
  }
};

//gets the investment options to display
const getInvest = async () => {
  try {
    const response = await axios.get('api/investment', {
      headers: {
        'X-CSRF-TOKEN': csrf,
      },
    });
    investments.value = response.data;
  } catch (error) {
    console.error('Cannot get investments:', error);
  }
};

const { locale } = useI18n();

//const selectedLanguage = ref('en');
const isDropdownOpen = ref(false); 

const changeLanguage = (language) => {
  locale.value = language; // Update the i18n locale
  localStorage.setItem('selectedLanguage', language); // Save to localStorage
  console.log(`Language changed to: ${language}`);
};

onMounted(() => {
  getInvest();
  const savedLanguage = localStorage.getItem('selectedLanguage');
  if (savedLanguage) {
    locale.value = savedLanguage; // Restore saved language
  }
});
</script>

<template>
  <head>
      <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>
  <!-- Navbar Container -->
  <nav class="bg-blue-600 p-4">
    <div class="flex items-center justify-between">
      <div class="text-white text-lg font-semibold">
        {{ $t('welcome') }}
      </div>
      <div class="space-x-20">
        <a type="button" :href="homeRoute" class="text-white hover:text-gray-300">{{ $t('home') }}</a>
        <a type="button" :href="manageStud" class="text-white hover:text-gray-300">{{ $t('manageStudent') }}</a>
        <a type="button" :href="manageInvest" class="text-white hover:text-gray-300">{{ $t('manageInvestment') }}</a>
        <a type="button" :href="projectRoute" class="text-white hover:text-gray-300">{{ $t('projects') }}</a>
        <a type="button" :href="reportRoute" class="text-white hover:text-gray-300">{{ $t('reports') }}</a>
      </div>
      <div class="relative">
      <button @click="isDropdownOpen = !isDropdownOpen" class="px-4 py-2 bg-blue-500 text-white rounded-md">
        {{ $t('selectLanguage') }}
      </button>
      <div v-if="isDropdownOpen" class="mt-2 w-48 bg-white border border-gray-300 rounded-md shadow-lg">
        <ul v-show="isDropdownOpen" class="dropdown-options">
            <!----><li @click="changeLanguage('en')" class="px-4 py-2 hover:bg-gray-100 cursor-pointer">English</li>
            <li @click="changeLanguage('es')" class="px-4 py-2 hover:bg-gray-100 cursor-pointer">Spanish</li>
            <li @click="changeLanguage('fr')" class="px-4 py-2 hover:bg-gray-100 cursor-pointer">French</li>
          </ul>
      </div>
    </div>
      <button class="text-white bg-red-500 px-4 py-2 rounded-md hover:bg-red-600">
        {{ $t('signout') }}
      </button>
    </div>
  </nav>

  <div class="relative h-screen flex justify-center bg-gray-100">
    <div class="relative z-20 py-10">
      <h2 class="text-xl font-semibold mb-4">{{ $t('investmentOptions') }}</h2>

      <div class="flex space-x-6">
        <table class="w-full border-collapse">
          <thead>
            <tr>
              <th class="border px-4 py-2">NAME</th>
              <th class="border px-4 py-2">Duration</th>
              <th class="border px-4 py-2">Interest Type</th>
              <th class="border px-4 py-2">Interest Rate</th>
              <th class="border px-4 py-2">Actions</th>
            </tr>
          </thead>
          <tbody v-if="investments.length > 0">
            <tr v-for="investment in investments" :key="investment.option_id">
              <td class="border px-4 py-2 break-words w-1/4">{{ investment.name || 'Missing name' }}</td>
              <td class="border px-4 py-2">{{ investment.duration_year }}</td>
              <td class="border px-4 py-2">{{ investment.interest_type }}</td>
              <td class="border px-4 py-2">{{ investment.interest_rate }}</td>
              <td class="border px-4 py-2 space-x-2">
                <button
                  @click="openEditForm(investment)"
                  class="px-4 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600"
                >
                  Edit
                </button>
                <button
                  @click="deleteInvestment(investment.option_id)"
                  class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600"
                >
                  Delete
                </button>
              </td>
            </tr>
          </tbody>
          <tbody v-else>
            <tr>
              <td colspan="5" class="text-center py-4">No investment options found.</td>
            </tr>
          </tbody>
        </table>

        <div class="space-y-4">
          <input type="hidden" name="_token" v-bind:value="csrf">
          <button
            type="button"
            class="px-6 py-2 bg-green-500 text-white rounded-md w-full"
            @click="toggleAddForm"
          >
            Add
          </button>

          <div v-if="showAddForm">
            <h2>{{ $t('addInvestment') }}</h2>
            <form @submit.prevent="addInvestment">
              <div>
                <label for="add-name">Investment Name</label>
                <input type="text" id="add-name" v-model="newInvestment.name" required />
              </div>
              <div>
                <label for="add-interest_type">Interest Type</label>
                <select id="add-interest_type" v-model="newInvestment.interest_type" required>
                  <option value="simple">Simple</option>
                  <option value="compound">Compound</option>
                </select>
              </div>
              <div>
                <label for="add-interest_rate">Interest Rate (%)</label>
                <input type="number" id="add-interest_rate" v-model="newInvestment.interest_rate" required />
              </div>
              <div>
                <label for="add-duration_year">Duration Year(s)</label>
                <input type="number" id="add-duration_year" v-model="newInvestment.duration_year" required />
              </div>
              <button type="submit" class="mt-4 px-4 py-2 bg-green-400 text-white rounded-md">
                Submit
              </button>
              <button type="button" @click="toggleAddForm" class="mt-2 px-4 py-2 bg-gray-400 text-white rounded-md">
                Cancel
              </button>
            </form>
          </div>

          <div v-if="showEditForm">
            <h2>Edit Investment</h2>
            <form @submit.prevent="editInvestment">
              <div>
                <label for="edit-name">Investment Name</label>
                <input type="text" id="edit-name" v-model="editInvestmentData.name" required />
              </div>
              <div>
                <label for="edit-interest_type">Interest Type</label>
                <select id="edit-interest_type" v-model="editInvestmentData.interest_type" required>
                  <option value="simple">Simple</option>
                  <option value="compound">Compound</option>
                </select>
              </div>
              <div>
                <label for="edit-interest_rate">Interest Rate (%)</label>
                <input type="number" id="edit-interest_rate" v-model="editInvestmentData.interest_rate" required />
              </div>
              <div>
                <label for="edit-duration_year">Duration Year(s)</label>
                <input type="number" id="edit-duration_year" v-model="editInvestmentData.duration_year" required />
              </div>
              <button type="submit" class="mt-4 px-4 py-2 bg-orange-400 text-white rounded-md">
                Update
              </button>
              <button type="button" @click="showEditForm = false; editingInvestmentId.value = null;" class="mt-2 px-4 py-2 bg-gray-400 text-white rounded-md">
                Cancel
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
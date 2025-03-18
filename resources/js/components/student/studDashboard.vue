<script>
import axios from 'axios';

export default {
  data() {
    return {
      file: null,
      uploading: false,
      uploadSuccess: false,
      uploadError: null,
      filePath: '',
    };
  },
  methods: {
    handleFileUpload(event) {
      this.file = event.target.files[0];
    },
    async uploadFile() {
        if (!this.file) {
        alert('Please select a file first');
        return;
        }

        this.uploading = true;
        this.uploadSuccess = false;
        this.uploadError = null;

        const formData = new FormData();
        formData.append('file', this.file);

        try {
        const response = await axios.post('/upload', formData, {
            headers: {
            'Content-Type': 'multipart/form-data',
            },
        });
        
        this.uploadSuccess = true;
        this.filePath = response.data.path;
        }catch (error) {
            this.uploadError = error.response?.data?.message || 'Something went wrong';
        } finally {
            this.uploading = false;
        }
    },
  },
};
</script>

<template>
  <!-- Navbar Container -->
  <nav class="bg-blue-600 p-4">
        <div class="container mx-auto flex items-center justify-between">
            <div class="text-white text-lg font-semibold">
                StudentDashboard
            </div>
            <h3 class="text-white text-left">Welcome, <span class="font-bold">STUDENT NAME</span></h3>
            <button class="text-white bg-red-500 px-4 py-2 rounded-md hover:bg-red-600">
                Sign out
            </button>
        </div>
    </nav>


    <main class="container mx-auto p-4 grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
        <section class="md:col-span-2">
            <!-- Project upload -->
            <div class="bg-white rounded shadow p-4 mb-4">
              <h2 class="text-lg font-semibold mb-2">Project upload</h2>
                <form action="upload" method="POST" enctype="multipart/form-data"> 
                    <div class="border-2 border-dashed border-gray-400 p-8 text-center">
                        <input type="file" name="projectFile" @change="handleFileUpload" class="mb-4">
                        <button type="submit" @click="uploadFile" class="bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded">Upload</button>

                        <div v-if="uploading">Uploading...</div>
                        <div v-if="uploadSuccess">
                            File uploaded successfully! Path: {{ filePath }}
                        </div>
                        <div v-if="uploadError" class="error">
                            Error: {{ uploadError }}
                        </div>
                    </div>
                </form>
            </div>

            <!-- Investment amount input -->
            <div class="bg-white rounded shadow p-4">
                <h2 class="text-lg font-semibold mb-2">Investment Amount</h2>
                <input type="number" placeholder="Input Investment Amount" class="border rounded w-full p-2">
            </div>
        </section>

        <!-- Investment options -->
        <!-- need to have multiple options be able to be selected -->
        <section>
            <div class="bg-white rounded shadow p-4 mb-4">
                <h2 class="text-lg font-semibold mb-2">Investment Options</h2>
                <div class="space-y-2">
                    <label class="flex items-center">
                        <input type="radio" name="investment" class="form-radio h-5 w-5 text-indigo-600">
                        <span class="ml-2">Option 1</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="investment" class="form-radio h-5 w-5 text-indigo-600">
                        <span class="ml-2">Option 2</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="investment" class="form-radio h-5 w-5 text-indigo-600">
                        <span class="ml-2">Option 3</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="investment" class="form-radio h-5 w-5 text-indigo-600">
                        <span class="ml-2">Option 4</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="investment" class="form-radio h-5 w-5 text-indigo-600">
                        <span class="ml-2">Option 5</span>
                    </label>
                </div>
            </div>

            <!-- Grade and Feedback Results -->
            <div class="bg-white rounded shadow p-4">
                <h2 class="text-lg font-semibold mb-2">Grade/Feedback</h2>
                <div class="grid grid-cols-2 gap-2">
                    <div>Grade</div>
                    <div>LETTERGRADE</div>
                    <div>Feedback</div>
                    <div>Row 4</div>
                </div>
            </div>
        </section>
    </main>

    <footer class="container mx-auto p-4 mt-6 text-center">
        <button class="bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded">Save</button>
    </footer>
</template>


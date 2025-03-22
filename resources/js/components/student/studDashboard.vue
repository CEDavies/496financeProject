<script>
export default {
    props: {
        fileUploadUrl: String
    },
    data(){
        return {
        //csrf token
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }
    }
}
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
                <form :action="fileUploadUrl" method="POST" enctype="multipart/form-data">
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <input type="hidden" name="_token" v-bind:value="csrf">
                    <input type="file" name="project_file" id="project_file" class="mx-4" required>
                    <button type="submit" class="bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded">Upload</button>
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


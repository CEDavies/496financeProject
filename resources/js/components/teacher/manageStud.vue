<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

// Setup the props
const { homeRoute, manageStud, manageInvest, projectRoute, reportRoute } = defineProps({
    homeRoute: { required: true, type: String },
    manageStud: { required: true, type: String },
    manageInvest: { required: true, type: String },
    projectRoute: { required: true, type: String },
    reportRoute: { required: true, type: String },
});

// Define the progress options
const progressOptions = ['in progress', 'submitted'];

// Adding/Editing students
const editingStudentId = ref(null);
const editStudentData = ref({
    student_name: '',
    project: '',
    progress: 'in progress',
});

const newStudent = ref({
    student_name: '',
    project: '',
    progress: 'in progress',
    teacher_id: null,
});

const students = ref([]);
const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// Visibility of forms
const showAddForm = ref(false);
const showEditForm = ref(false);

const toggleAddForm = () => {
    showAddForm.value = !showAddForm.value;
    showEditForm.value = false;
    editingStudentId.value = null;
    newStudent.value = { student_name: '', project: '', progress: 'in progress', teacher_id: null };
};

const openEditForm = (student) => {
    editingStudentId.value = student.student_id;  // Use student.student_id here
    editStudentData.value = { ...student }; // Populate edit form with student data
    showEditForm.value = true;
    showAddForm.value = false; // Ensure only one form is visible
};


const addStudent = async () => {
    try {
        // Generate a random teacher ID (between 1 and 100)
        newStudent.value.teacher_id = Math.floor(Math.random() * 100) + 1;

        const response = await axios.post('teacherViews/manageStud', newStudent.value, {
            headers: {
                'X-CSRF-TOKEN': csrf,
            },
        });
        alert('Student Added successfully!');
        getStud();
        showAddForm.value = false;
        newStudent.value = { student_name: '', project: '', progress: 'in progress', teacher_id: null };
    } catch (error) {
        console.error('Error adding student:', error);
        alert('Error adding student');
    }
};

const editStudent = async () => {
    if (!editingStudentId.value) return;

    try {
        const response = await axios.put(`api/students/${editingStudentId.value}`, editStudentData.value, {
            headers: {
                'X-CSRF-TOKEN': csrf,
            },
        });
        alert('Student updated successfully!');
        getStud();
        showEditForm.value = false;
        editingStudentId.value = null;
    } catch (error) {
        console.error('Error updating student:', error);
        alert('Error updating student');
    }
};

const deleteStudent = async (studentId) => {
    console.log("Deleting student with ID:", studentId); // Debugging line
    if (confirm("Are you sure you want to delete this student?")) {
        try {
            await axios.delete(`api/students/${studentId}`, {
                headers: {
                    'X-CSRF-TOKEN': csrf,
                },
            });
            alert('Student deleted successfully!');
            getStud();
        } catch (error) {
            console.error('Error deleting student:', error);
            alert('Error deleting student');
        }
    }
};

const getStud = async () => {
    try {
        const response = await axios.get('api/students', {
            headers: {
                'X-CSRF-TOKEN': csrf,
            },
        });

        if (response.status === 200) {
            students.value = response.data;
        } else {
            throw new Error(`Failed to fetch students, status: ${response.status}`);
        }
    } catch (error) {
        console.error('Cannot get the students:', error);
    }
};

onMounted(() => {
    getStud();
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
                <a type="button" :href="manageInvest" class="text-white hover:text-gray-300">Manage Investment
                    Options</a>
                <a type="button" :href="projectRoute" class="text-white hover:text-gray-300">Projects</a>
                <a type="button" :href="reportRoute" class="text-white hover:text-gray-300">Reports</a>
            </div>

            <button class="text-white bg-red-500 px-4 py-2 rounded-md hover:bg-red-600">
                Signout
            </button>
        </div>
    </nav>

    <div class="relative h-screen flex justify-center bg-gray-100">
        <div class="relative z-20 py-10">
            <h2 class="text-xl font-semibold mb-4">Students</h2>

            <div class="flex space-x-6">
                <table class="w-full border-collapse">
                    <thead>
                        <tr>
                            <th class="border px-4 py-2">NAME</th>
                            <th class="border px-4 py-2">Project</th>
                            <th class="border px-4 py-2">Status</th>
                            <th class="border px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody v-if="students.length > 0">
                        <tr v-for="student in students" :key="student.student_id">
                            <td class="border px-4 py-2">{{ student.student_name }}</td>
                            <td class="border px-4 py-2">{{ student.project }}</td>
                            <td class="border px-4 py-2">{{ student.progress }}</td>
                            <td class="border px-4 py-2 space-x-2">
                                <button @click="openEditForm(student)"
                                    class="px-4 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600">
                                    Edit
                                </button>
                                <button @click="deleteStudent(student.student_id)"
                                    class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    </tbody>
                    <tbody v-else>
                        <tr>
                            <td colspan="4" class="text-center py-4">No Students found.</td>
                        </tr>
                    </tbody>
                </table>

                <div class="space-y-4">
                    <input type="hidden" name="_token" v-bind:value="csrf">
                    <button type="button" class="px-6 py-2 bg-green-500 text-white rounded-md w-full"
                        @click="toggleAddForm">
                        Add
                    </button>

                    <div v-if="showAddForm">
                        <h2>Add New Student</h2>
                        <form @submit.prevent="addStudent">
                            <div>
                                <label for="add-name">Student Name</label>
                                <input type="text" id="add-name" v-model="newStudent.student_name" required />
                            </div>
                            <div>
                                <label for="add-project">Project</label>
                                <input type="text" id="add-project" v-model="newStudent.project" required />
                            </div>
                            <div>
                                <label for="add-progress">Progress</label>
                                <select id="add-progress" v-model="newStudent.progress" required>
                                    <option value="in progress">In Progress</option>
                                    <option value="submitted">Submitted</option>
                                </select>
                            </div>
                            <button type="submit" class="mt-4 px-4 py-2 bg-green-400 text-white rounded-md">
                                Submit
                            </button>
                            <button type="button" @click="toggleAddForm"
                                class="mt-2 px-4 py-2 bg-gray-400 text-white rounded-md">
                                Cancel
                            </button>
                        </form>
                    </div>

                    <div v-if="showEditForm">
                        <h2>Edit Student</h2>
                        <form @submit.prevent="editStudent">
                            <input type="hidden" id>
                            <div>
                                <label for="edit-name">Student Name</label>
                                <input type="text" id="edit-name" v-model="editStudentData.student_name" required />
                            </div>
                            <div>
                                <label for="edit-project">Project</label>
                                <input type="text" id="edit-project" v-model="editStudentData.project" required />
                            </div>
                            <div>
                                <label for="edit-progress">Progress</label>
                                <select id="edit-progress" v-model="editStudentData.progress" required>
                                        <option  value="in progress">In Progress</option>
                                         <option  value="submitted">Submitted</option>
                                </select>
                            </div>
                            <button type="submit" class="mt-4 px-4 py-2 bg-orange-400 text-white rounded-md">
                                Update
                            </button>
                            <button type="button" @click="showEditForm = false; editingStudentId.value = null;"
                                class="mt-2 px-4 py-2 bg-gray-400 text-white rounded-md">
                                Cancel
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

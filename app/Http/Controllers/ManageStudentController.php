<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ManageStudentController extends Controller
{
    //gets all the students in the table
    public function getStudents()
    {
        try {
            $students = DB::table('student')->get();
            return response()->json($students);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to fetch student data', 'message' => $e->getMessage()], 500);
        }
    }

    //adds students
    public function addStudent(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'student_name' => 'required|string|max:40',
            'project' => 'nullable|string|max:40',
            'progress' => ['required', Rule::in(['in progress', 'submitted'])],
            'teacher_id' => 'nullable|integer', // Add validation for teacher_id
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422); // Use 422 for validation errors
        }

        try {
            $validatedData = $validator->validated();
            DB::table('student')->insert($validatedData);
            return response()->json(['message' => 'Student added successfully!'], 201); // 201 Created
        } catch (\Exception $e) {
            Log::error('Error adding student: ' . $e->getMessage());
            return response()->json(['message' => 'Database error', 'error' => $e->getMessage()], 500);
        }
    }

    //deletes students
    public function deleteStudent($id)
    {
        $student = DB::table('student')->where('student_id', $id)->delete();
        // Check if student exists
        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        // Respond with success message
        return response()->json(['message' => 'Student deleted successfully']);
    }

    //edits students
    public function updateStudent(Request $request, $id)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'student_name' => 'required|string|max:40',
            'project' => 'nullable|string|max:40',
            'progress' => ['required', Rule::in(['in progress', 'submitted'])],
            'teacher_id' => 'nullable|integer', // Add validation for teacher_id
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $validatedData = $validator->validated();
            $updated = DB::table('student')
                ->where('student_id', $id)
                ->update($validatedData);

            if ($updated) {
                return response()->json(['message' => 'Student updated successfully']);
            } else {
                return response()->json(['message' => 'Student not found'], 404);
            }
        } catch (\Exception $e) {
            Log::error('Error updating student: ' . $e->getMessage());
            return response()->json(['message' => 'Database error', 'error' => $e->getMessage()], 500);
        }
    }
}

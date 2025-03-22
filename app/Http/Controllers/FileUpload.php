<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Http\Contollers\Contoller;

class FileUpload extends Controller
{
    // Store file and save file path to the database
    public function store(Request $request)
    {
        // Validate the uploaded file and other fields
        $validated = $request->validate([
            'project_id' => 'required|integer',
            'teacher_id' => 'required|integer',
            'initial_investment' => 'nullable|numeric',
            'student_id' => 'required|integer',
            'project_file' => 'required|file|mimes:doc,docx,pdf|max:2048',
        ]);

        // Handle the file upload
        if ($request->hasFile('project_file') && $request->file('project_file')->isValid()) {
            Log::info("File found in the request.");

            // Store the file and get the file path (relative to the 'storage/app' directory)
            $filePath = $request->file('project_file')->store('project_files');

            // Prepare data to insert into the database
            $data = [
                'project_id' => $validated['project_id'],
                'teacher_id' => $validated['teacher_id'],
                'initial_investment' => $validated['initial_investment'],
                'student_id' => $validated['student_id'],
                'project_file_path' => $filePath,  // Store the file path in the database
            ];

            // Insert data into the database (assuming you have a table 'project_files')
            DB::table('project_files')->insert($data);

            // Return a success message or redirect
            return redirect()->route('studDashboard')->with('message', 'File uploaded successfully!');
        }

        return redirect()->route('studDashboard')->with('message', 'No file uploaded or invalid file');
    }
}

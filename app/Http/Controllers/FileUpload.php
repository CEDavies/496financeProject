<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Project;
use Illuminate\Support\Facades\Validator;

class FileUpload extends Controller
{
    public function store(Request $request)
    {
        //validates it matches the database
        $validator = Validator::make($request->all(),[
            'project_id' => 'integer', // Or 'integer' if not auto-increment
            'teacher_id' => 'integer',
            'initial_investment' => 'required|numeric',
            'student_id' => 'integer',
            'project_filepath' => 'required|file|mimes:doc,docx,pdf|max:2048',
        ]);

        // Return the message
        if($validator->fails()){
            return response()->json([
                'error' => true,
                'message' => $validator->errors()
            ]);
        }

        //end of validation
        $validatedData = $validator->safe()->all();

        //verifies if theres a valid file
        if ($request->hasFile('project_filepath') && $request->file('project_filepath')->isValid()) {
            try {
                // File handling
                if ($request->hasFile('project_filepath')) {
                    $file = $request->file('project_filepath');
                    $filePath = $file->store('projects'); // Store in storage/app/projects
                    $validatedData['project_filepath'] = $filePath;
                    Log::info('File Path: ' . $filePath);
                }

                //insert into database
                try {
                    DB::table('project')->insert([
                        'project_id' => $validatedData['project_id'],
                        'teacher_id' => $validatedData['teacher_id'],
                        'initial_investment' => $validatedData['initial_investment'],
                        'student_id' => $validatedData['student_id'],
                        'project_filepath' => $filePath,
                    ]);

                    Log::info('Database insertion successful', ['file_path' => $filePath]);
                } catch (\Exception $dbException) {
                    Log::info(DB::getQueryLog());
                    Log::error('Database insertion error', ['error' => $dbException->getMessage()]);
                    return response()->json(['message' => 'Database error',  'trace' => $dbException->getTraceAsString()], 500);
                }

                return response()->json([
                    'message' => 'File uploaded and path stored successfully!',
                    'file_path' => $filePath,
                ]);
            } catch (\Exception $fileException) {
                Log::error('File upload error', ['error' => $fileException->getMessage()]);
                return response()->json(['message' => 'File upload error'], 500);
            }
        }

        return response()->json(['message' => 'No file uploaded or invalid file'], 400);
    }
}
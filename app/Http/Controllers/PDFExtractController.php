<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Project;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Process\Process; // Don't forget to use the Process class

//controller to handle pdf text/table/image extraction
class PDFExtractController extends Controller
{
    //function to extract the data
    public function extractData(Request $request)
    {
        //validates it matches the database
        $validator = Validator::make($request->all(), [
            'project_id' => 'integer|required',
            'teacher_id' => 'integer|required',
            'student_id' => 'integer|required',
        ]);

        // Return the message
        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => $validator->errors()
            ]);
        }

        //end of validation
        $validatedData = $validator->safe()->all();

        //get the file path from the database
        try {
            $project = DB::table('project')
                ->where('project_id', $validatedData['project_id'])
                ->where('teacher_id', $validatedData['teacher_id'])
                ->where('student_id', $validatedData['student_id'])
                ->first(); // Use first() to get a single object

            if (!$project) {
                return response()->json(['error' => 'Project not found'], 404);
            }

            // Assuming your 'project' table has a column named 'project_filepath'
            $pdfPath = $project->project_filepath;

            if (!$pdfPath) {
                return response()->json(['error' => 'File path not found for this project'], 404);
            }

        } catch (\Exception $dbException) {
            Log::info(DB::getQueryLog());
            Log::error('Database retrieval error', ['error' => $dbException->getMessage()]);
            return response()->json(['message' => 'Database error', 'trace' => $dbException->getTraceAsString()], 500);
        }

        //Construct the full path to the file 
        $storagePath = storage_path('app/private');
        $fullPdfPath = $storagePath . DIRECTORY_SEPARATOR . $pdfPath;
        $fullPdfPath = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $fullPdfPath);

        // Log::info('Full PDF Path: ' . $fullPdfPath);  // <---- ADD THIS LOG LINE

        //Check if the file exists
        if (!file_exists($fullPdfPath)) {
            Log::error('PDF file does not exist: ' . $fullPdfPath);
            return response()->json(['error' => 'PDF file does not exist'], 404);
        }

        // Construct the Python command
        $pythonScriptPath = base_path('resources/pythonScript/extract_pdf.py'); // Path to Python script
        $command = ['python', $pythonScriptPath, $fullPdfPath];

        //makes a process to get the python script
        Log::info('Python Command: ', ['command' => $command]);
        $process = new Process($command);
        $process->run();

        // Capture both stdout and stderr
        if ($process->isSuccessful()) {
            $output = $process->getOutput();  // Capture standard output
            $errorOutput = $process->getErrorOutput();  // Capture standard error
            Log::info("Python Script Output: ", ['output' => $output]);
            Log::info("Python Script Error Output: ", ['errorOutput' => $errorOutput]);

            // Decode the output from Python (which should now be valid JSON)
            $decodedOutput = json_decode($output, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                Log::error("Failed to decode JSON", ['output' => $output, 'json_error' => json_last_error_msg()]);
                return response()->json(['error' => 'Failed to decode JSON from Python script'], 500);
            }

            // Now, check if the decoded output contains the expected structure
            if (isset($decodedOutput['output'])) {
                return response()->json(['data' => $decodedOutput['output']]);
            } else {
                return response()->json(['error' => 'Invalid JSON structure'], 500);
            }
        } else {
            $errorOutput = $process->getErrorOutput();
            Log::error('Python Script Execution Error: ', ['error' => $errorOutput]);
            return response()->json(['error' => 'Failed to extract data', 'details' => $errorOutput], 500);
        }       

        // You likely won't reach this line anymore if you're fetching from the database
        // return response()->json(['error' => 'No PDF file uploaded'], 400);
    }

    //upload it to the database but in reports
    public function uploadReport(Request $request)
    {
        // ... your upload report logic here
    }
}
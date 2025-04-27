<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InvestmentOptController extends Controller
{
    public function getInvestments()
    {
        try {
            $investments = DB::table('investment_option')->get();
            return response()->json($investments);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to fetch data', 'message' => $e->getMessage()], 500);
        }

    }

    /*
    public function extractInvestment(Request $request)
    {
        //validates it matches the database
        $validator = Validator::make($request->all(), [
            'name' => 'string|required',
            'duration_year' => 'integer|required',
            'interest_type' => 'enum|required',
            'interest_rate' => 'decimal|required',
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
            $project = DB::table('investment_option')
                ->where('name', $validatedData['name'])
                ->where('duration_year', $validatedData['duration_year'])
                ->where('interest_type', $validatedData['interest_type'])
                ->where('interest_rate', $validatedData['interest_rate'])
                ->first(); // Use first() to get a single object

            if (!$investment_option) {
                return response()->json(['error' => 'Investment options not found'], 404);
            }

            // Assuming your 'project' table has a column named 'project_filepath'
            $pdfPath = $project->project_filepath;


        } catch (\Exception $dbException) {
            Log::info(DB::getQueryLog());
            Log::error('Database retrieval error', ['error' => $dbException->getMessage()]);
            return response()->json(['message' => 'Database error', 'trace' => $dbException->getTraceAsString()], 500);
        }
    }*/
}

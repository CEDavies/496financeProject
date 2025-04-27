<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
class InvestmentOptController extends Controller
{
    //gets the investments from the 
    public function getInvestments()
    {
        try {
            $investments = DB::table('investment_option')->get();
            return response()->json($investments);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to fetch data', 'message' => $e->getMessage()], 500);
        }

    }

    //adds a investment option
    public function addInvestment(Request $request){
        //validates it matches the database
        $validator = Validator::make($request->all(),[
            // 'id' => 'required|integer',
            'name' => 'required|string|max:40',
            'duration_year' => 'required|integer|min:1', // Assuming duration is at least 1 year
            'interest_type' => ['required', Rule::in(['simple', 'compound'])],
            'interest_rate' => 'nullable|numeric|min:0', // Assuming interest rate can be 0 or positive
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

         //insert into database
        try {
            DB::table('investment_option')->insert([
                'option_id' => $validatedData['id'] ?? null, // Use null coalescing operator
                'name' =>  $validatedData['name'],
                'duration_year' => $validatedData['duration_year'],
                'interest_type' => $validatedData['interest_type'],
                'interest_rate' => $validatedData['interest_rate'],
            ]);

            Log::info('Database insertion successful');
        } catch (\Exception $dbException) {
            Log::info(DB::getQueryLog());
            Log::error('Database insertion error', ['error' => $dbException->getMessage()]);
            return response()->json(['message' => 'Database error',  'trace' => $dbException->getTraceAsString()], 500);
        }

        return response()->json([
            'message' => 'Data uploaded and path stored successfully!',
        ]);

        return response()->json(['message' => 'No file uploaded or invalid file'], 400);
    }
}

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

    //delete the specfiic investment entry
    public function destroy($id)
    {
        $investment = DB::table('investment_option')->where('option_id', $id)->delete();
        // Check if investment exists
        if (!$investment) {
            return response()->json(['message' => 'Investment not found', $id], 404);
        }

        // Respond with success message
        return response()->json(['message' => 'Investment deleted successfully']);
    }

    //updates the specific investment entry
    public function updateInvestment(Request $request, $id)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:40',
            'duration_year' => 'required|integer|min:1',
            'interest_type' => ['required', Rule::in(['simple', 'compound'])],
            'interest_rate' => 'nullable|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $updated = DB::table('investment_option')
                ->where('option_id', $id)
                ->update($validator->safe()->all());

            if ($updated) {
                return response()->json(['message' => 'Investment updated successfully']);
            } else {
                return response()->json(['message' => 'Investment not found'], 404);
            }
        } catch (\Exception $e) {
            Log::error('Error updating investment:', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Database error', 'error' => $e->getMessage()], 500);
        }
    }
}

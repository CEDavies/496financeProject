<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GradesController extends Controller
{
    public function saveFeedback(Request $request, $projectId) // Removed Project $project, added $projectId
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'grade' => 'nullable|numeric',
            'feedback' => 'nullable|string',
        ]);

        try {
            // Use DB::table to insert a new grade record
            DB::table('grade')->insert([ // Ensure 'grades' is your table name
                'project_id' => $projectId, // Use the $projectId from the route
                'grade' => $validatedData['grade'] ?? null,
                'feedback' => $validatedData['feedback'] ?? null,
            ]);

            return response()->json(['message' => 'Feedback saved successfully']);
        } catch (\Exception $e) {
            \Log::error('Error saving feedback:', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Failed to save feedback'], 500);
        }
    }
}
<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ManageStudentController extends Controller
{
    public function getStudents()
    {
        try {
            $students = DB::table('student')->get();
            return response()->json($students);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to fetch student data', 'message' => $e->getMessage()], 500);
        }

    }
}

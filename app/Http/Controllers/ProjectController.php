<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProjectController extends Controller
{
    public function getProjects()
    {
        try {
            $projects = DB::table('project')
                ->join('student', 'project.student_id', '=', 'student.student_id')
                ->select('project.*', 'student.student_name as student_name') // Select the project columns and the student's name, and investment option name
                ->get();
            return response()->json($projects);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to fetch project data with student names', 'message' => $e->getMessage()], 500);
        }
    }
}
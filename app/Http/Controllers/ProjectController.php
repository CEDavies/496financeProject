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
                ->leftJoin('grade', 'project.project_id', '=', 'grade.project_id') // Left join to get grades (may not exist yet)
                ->select(
                    'project.*',
                    'student.student_name as student_name',
                    'grade.grade as grade', // Select the grade
                    'grade.feedback as feedback', // Select the feedback
                    'grade.grade_id as grade_id' // Optionally select the grade ID
                )
                ->get(); //might be able to use last to get the upadted one?
            return response()->json($projects);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to fetch project data with student names and grades', 'message' => $e->getMessage()], 500);
        }
    }
}
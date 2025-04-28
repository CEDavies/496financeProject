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
            $projects = DB::table('project')->get();
            return response()->json($projects);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to fetch student data', 'message' => $e->getMessage()], 500);
        }

    }
}

<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;

class ReportsController extends Controller
{
    //gets the reports for each student 
    public function getReports()
    {
        //can get id when that is implmented
        try {
            $reports = DB::table('portfolio')->get();
            return response()->json($reports);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to fetch student data', 'message' => $e->getMessage()], 500);
        }

    }
}

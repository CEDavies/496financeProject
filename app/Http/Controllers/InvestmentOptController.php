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
}

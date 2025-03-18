<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\DB;

//This is an example query to show the database connection
Route::get('/show-queries', function () {
    // Enable query log
    DB::enableQueryLog();

    // Perform some database operations
    $users = DB::table('client')->get("client_id");

    // Get the executed queries
    $queries = DB::getQueryLog();

    // Display in browser
    return response()->json($users);
});


//File Test - 3/16/25
// routes/api.php
Route::post('/studDashboard', [FileUploadController::class, 'upload']);

//Webpages
Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/signup', function () {
    return view('signup');
});

// Student View routes
Route::get('/studDashboard', function () {
    return view('studentViews/studDashboard');
});


// Teacher View routes
Route::get('/teachInvestment', function () {
    return view('teacherViews/InvestmentOpt');
});

Route::get('/manageStudents', function () {
    return view('teacherViews/manageStud');
});

Route::get('/projects', function () {
    return view('teacherViews/projects');
});

Route::get('/teachReports', function () {
    return view('teacherViews/reports');
});

Route::get('/teacherDashboard', function () {
    return view('teacherViews/teachDashboard');
});
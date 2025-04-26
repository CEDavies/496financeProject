<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FileUpload;
use App\Http\Middleware\VerifyCsrfToken;

//This is an example query to show the database connection
Route::get('/show-queries', function () {
    // Enable query log
    DB::enableQueryLog();

    // Perform some database operations
    $what = DB::table('project')->get("teacher_id");

    // Get the executed queries
    $queries = DB::getQueryLog();

    // Display in browser
    return response()->json($users);
});


//Webpages
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/signup', function () {
    return view('signup');
})->name('signup');

// Student View routes
Route::get('/studDashboard', function () {
    return view('studentViews/studDashboard');
});

//Route::post('/studDashboard', [FileUpload::class, 'store'])->name('file.store');

//middleware - verifies the csrf token (required for security)
Route::middleware([VerifyCsrfToken::class])->group(function () {
    Route::post('studentViews/studDashboard', [App\Http\Controllers\FileUpload::class,'store'])->name('file.store');
});

// Teacher View routes
Route::get('/teachInvestment', function () {
    return view('teacherViews/InvestmentOpt');
})->name('manageInvest');

Route::get('/manageStudents', function () {
    return view('teacherViews/manageStud');
})->name('manageStud');

Route::get('/projects', function () {
    return view('teacherViews/projects');
})->name('projects');

Route::get('/teachReports', function () {
    return view('teacherViews/reports');
})->name('reports');

Route::get('/teacherDashboard', function () {
    return view('teacherViews/teachDashboard');
})->name('teachDash');

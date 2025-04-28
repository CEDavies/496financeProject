<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FileUpload;
use App\Http\Controllers\InvestmentOptController;
use App\Http\Controllers\ManageStudentController;
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

Route::get('/api/investments', [InvestmentOptController::class, 'getInvestments']);

//middleware - verifies the csrf token (required for security)
Route::middleware([VerifyCsrfToken::class])->group(function () {
    Route::post('studentViews/studDashboard', [App\Http\Controllers\FileUpload::class,'store'])->name('file.store');
});

Route::middleware([VerifyCsrfToken::class])->group(function () {
    Route::get('/api/investments', [InvestmentOptController::class, 'getInvestments']);
    #Route::post('teacherViews/InvestmentOpt', [App\Http\Controllers\InvestmentOptController::class,'extractInvestment'])->name('file.extract');

});

// Teacher View routes
Route::get('/teachInvestment', function () {
    return view('teacherViews/InvestmentOpt');
})->name('manageInvest');

Route::get('/manageStudents', function () {
    return view('teacherViews/manageStud');
})->name('manageStud');

Route::get('api/students', [ManageStudentController::class, 'getStudents']);

//for adding investment options
Route::middleware([VerifyCsrfToken::class])->group(function () {
    Route::post('teacherViews/manageStud', [ManageStudentController::class, 'addStudent']);
});

//deleting investment options
Route::delete('api/students/{id}', [ManageStudentController::class, 'deleteStudent'])->name('student.deleteStudent');

//editing the investment options
Route::put('/api/students/{id}', [ManageStudentController::class, 'updateStudent']);

Route::get('/projects', function () {
    return view('teacherViews/projects');
})->name('projects');

Route::get('/teachReports', function () {
    return view('teacherViews/reports');
})->name('reports');

Route::get('/teacherDashboard', function () {
    return view('teacherViews/teachDashboard');
})->name('teachDash');
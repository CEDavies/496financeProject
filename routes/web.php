<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FileUpload;
use App\Http\Controllers\InvestmentOptController;
use App\Http\Middleware\VerifyCsrfToken;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Http\Controllers\LoginController;

Route::get('/auth/redirect/google', [LoginController::class, 'redirectToGoogle']);
Route::get('/auth/callback/google', [LoginController::class, 'handleGoogleCallback']);


Route::get('auth/redirect/google', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('auth/callback/google', function () {
    $googleUser = Socialite::driver('google')->user();
    $user = User::firstOrCreate(
        ['email' => $googleUser->getEmail()],
        ['name' => $googleUser->getName(), 'password' => bcrypt(str_random(24))]
    );
    auth()->login($user);
    return redirect('/dashboard');
});


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

//uses different name to get the table info to the correct vuejs
Route::get('api/investment', [InvestmentOptController::class, 'getInvestments']);

//for adding investment options
Route::middleware([VerifyCsrfToken::class])->group(function () {
    Route::post('teacherViews/InvestmentOpt', [InvestmentOptController::class, 'addInvestment']);
});

//deleting investment options
Route::delete('/teacherViews/InvestmentOpt/{id}', [InvestmentOptController::class, 'destroy'])->name('investment.destroy');

//editing the investment options
Route::put('/teacherViews/InvestmentOpt/{id}', [InvestmentOptController::class, 'updateInvestment']);

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

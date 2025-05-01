<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FileUpload;
use App\Http\Controllers\InvestmentOptController;
use App\Http\Controllers\ManageStudentController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\GradesController;
use App\Http\Middleware\VerifyCsrfToken;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Http\Controllers\AuthController;

Route::get('/auth/redirect', [AuthController::class, 'redirectToGoogle']);
Route::get('/auth/callback', [AuthController::class, 'handleGoogleCallback']);


Route::get('auth/google', function () {
    return Socialite::driver('google')->redirect();
})->name('google.login');

Route::get('auth/google/callback', function () {
    $googleUser = Socialite::driver('google')->stateless()->user();

    // Find or create user
    $user = User::updateOrCreate(
        ['email' => $googleUser->getEmail()],
        [
            'name' => $googleUser->getName(),
            'google_id' => $googleUser->getId(),
            'avatar' => $googleUser->getAvatar(),
            'password' => bcrypt(Str::random(24)),
        ]
    );

    Auth::login($user);

    return redirect('/dashboard'); // or wherever you want
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

// Show the set password form
Route::get('/set-password', function () {
    return view('set-password');
})->middleware('auth')->name('password.set-form');

// Handle the form submit
Route::post('/set-password', function (\Illuminate\Http\Request $request) {
    $request->validate([
        'password' => 'required|confirmed|min:8',
    ]);

    $user = Auth::user();
    $user->password = bcrypt($request->password);
    $user->save();

    return redirect('/dashboard')->with('success', 'Password set successfully!');
})->middleware('auth')->name('password.set');


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

Route::get('/api/students', [ManageStudentController::class, 'getStudents']);

Route::get('/api/projects', [ProjectController::class, 'getProjects']);

Route::get('/api/reports', [ReportsController::class, 'getReports']);

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

//uses different name to get the table info to the correct vuejs
Route::get('api/investment', [InvestmentOptController::class, 'getInvestments']);

//for adding investment options
Route::middleware([VerifyCsrfToken::class])->group(function () {
    Route::post('teacherViews/InvestmentOpt', [InvestmentOptController::class, 'addInvestment']);
});

//deleting investment options
Route::delete('teacherViews/InvestmentOpt/{id}', [InvestmentOptController::class, 'destroy'])->name('investment.destroy');

//editing the investment options
Route::put('/teacherViews/InvestmentOpt/{id}', [InvestmentOptController::class, 'updateInvestment']);

Route::get('/manageStudents', function () {
    return view('teacherViews/manageStud');
})->name('manageStud');

Route::get('api/students', [ManageStudentController::class, 'getStudents']);

//for adding investment options
Route::middleware([VerifyCsrfToken::class])->group(function () {
    Route::post('teacherViews/manageStud', [ManageStudentController::class, 'addStudent']);
});


//deleting student options
Route::delete('api/students/{id}', [ManageStudentController::class, 'deleteStudent'])->name('student.deleteStudent');

//editing the student options
Route::put('/api/students/{id}', [ManageStudentController::class, 'updateStudent']);

Route::get('/projects', function () {
    return view('teacherViews/projects');
})->name('projects');

//adding the grades/feeback
Route::middleware([VerifyCsrfToken::class])->group(function () {
    Route::post('api/projects/{project}/feedback', [GradesController::class, 'saveFeedback']);
});

Route::get('/teachReports', function () {
    return view('teacherViews/reports');
})->name('reports');

Route::get('/teacherDashboard', function () {
    return view('teacherViews/teachDashboard');
})->name('teachDash');

// Set Password Form
Route::get('/set-password', function () {
    return view('set-password');
})->middleware('auth')->name('password.set-form');

// Set Password POST Handler
Route::post('/set-password', function (\Illuminate\Http\Request $request) {
    $request->validate([
        'password' => 'required|confirmed|min:8',
    ]);

    $user = Auth::user();
    $user->password = bcrypt($request->password);
    $user->save();

    return redirect('/dashboard')->with('success', 'Password set successfully!');
})->middleware('auth')->name('password.set');

<?php

use Illuminate\Support\Facades\Route;

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
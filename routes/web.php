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
Route::get('/studInvestment', function () {
    return view('studentViews/investmentOpt');
});

Route::get('/studDashboard', function () {
    return view('studentViews/studDashboard');
});

Route::get('/studProject', function () {
    return view('studentViews/studProject');
});

Route::get('/studReport', function () {
    return view('studentViews/studReports');
});

// Teacher View routes
Route::get('/teachInvestment', function () {
    return view('teacherViews/InvestmentOpt');
});

Route::get('/ManageStudents', function () {
    return view('teacherViews/manageStud');
});

Route::get('/Projects', function () {
    return view('teacherViews/projects');
});

Route::get('/teachReports', function () {
    return view('teacherViews/reports');
});

Route::get('/teacherDashboard', function () {
    return view('teacherViews/teachDashboard');
});
<?php

use App\Http\Controllers\AuthController;

Route::middleware('auth')->get('/user', [AuthController::class, 'getAuthenticatedUser']);

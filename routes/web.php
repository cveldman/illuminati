<?php

use App\Http\Controllers\App\ProjectController;
use App\Http\Controllers\App\ProjectIssueController;
use App\Http\Controllers\App\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function() {
    Auth::loginUsingId(1);

    return to_route('projects.index');
});

Route::resource('users', UserController::class);
Route::resource('projects', ProjectController::class);
Route::resource('projects.issues', ProjectIssueController::class);

<?php

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

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);

Auth::routes();

Route::resource('departments', \App\Http\Controllers\DepartmentController::class)->except(['show']);
Route::resource('positions', \App\Http\Controllers\PositionController::class)->except(['show']);
Route::resource('genders', \App\Http\Controllers\GenderController::class)->except(['show']);
Route::resource('employees', \App\Http\Controllers\EmployeeController::class)->except(['show']);
Route::get('position-list', [\App\Http\Controllers\PositionController::class, 'positionList']);

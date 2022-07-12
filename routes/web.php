<?php

use Illuminate\Support\Facades\Route;

//controller
use App\Http\Controllers\SuperHeroController;
use App\Http\Controllers\SkillController;

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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::resource('xmen', SuperHeroController::class);
Route::resource('skill', SkillController::class);

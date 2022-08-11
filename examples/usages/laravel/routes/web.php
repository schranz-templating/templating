<?php

use App\Http\Controllers\TemplateController;
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

Route::get('/', [TemplateController::class, 'home']);
Route::get('/blade', [TemplateController::class, 'bladeRenderer']);
Route::get('/handlebars', [TemplateController::class, 'handlebarsRenderer']);
Route::get('/mustache', [TemplateController::class, 'mustacheRenderer']);
Route::get('/plates', [TemplateController::class, 'platesRenderer']);

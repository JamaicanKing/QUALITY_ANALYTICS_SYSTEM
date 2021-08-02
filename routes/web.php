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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('category',App\Http\Controllers\CategoryController::class);
Route::resource('rating',App\Http\Controllers\RatingController::class);
Route::resource('attribute',App\Http\Controllers\AttributeController::class);
Route::resource('reason',App\Http\Controllers\ReasonController::class);
Route::resource('agent',App\Http\Controllers\AgentController::class);
Route::resource('evaluation',App\Http\Controllers\EvaluationResultController::class);
Route::resource('query',App\Http\Controllers\QueryCategoryController::class);
Route::resource('manager',App\Http\Controllers\ManagerController::class);
Route::resource('teamleader',App\Http\Controllers\TeamleaderController::class);
Route::resource('primaryFunction',App\Http\Controllers\PrimaryFunctionController::class);
Route::resource('departments',App\Http\Controllers\DepartmentsController::class);
Route::resource('locations',App\Http\Controllers\LocationsController::class);
Route::resource('classifications',App\Http\Controllers\ClassificationController::class);
Route::resource('market',App\Http\Controllers\MarketController::class);
Route::resource('skillset',App\Http\Controllers\SkillsetController::class);
Route::resource('observationType',App\Http\Controllers\ObservationTypeController::class);
Route::resource('evaluationClassification',App\Http\Controllers\EvaluationClassificationController::class);

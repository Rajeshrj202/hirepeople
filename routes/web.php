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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

	
 		Route::group(['prefix' => 'candidate'], function () {

 			// Candidate Routes

            Route::get('/',[App\Http\Controllers\CandidateController::class, 'index'])->name('candidate.index');
            Route::get('/assigned',[App\Http\Controllers\CandidateController::class, 'getAssignedCandidate'])->name('candidate.assigned');
            Route::get('edit/{id}', [App\Http\Controllers\CandidateController::class, 'edit'])->name('candidate.edit');
            Route::post('update/{id}',[App\Http\Controllers\CandidateController::class, 'update'])->name('candidate.update');
            Route::get('create', [App\Http\Controllers\CandidateController::class, 'create'])->name('candidate.create');
            Route::post('store/', [App\Http\Controllers\CandidateController::class, 'store'])->name('candidate.store');
           

            // Feedback Routes

            Route::get('show/{id}', [App\Http\Controllers\CandidateFeedbackController::class, 'show'])->name('candidate.show');
            Route::post('feedback/store/{id}', [App\Http\Controllers\CandidateFeedbackController::class, 'store'])->name('candidate.feedback.store');
            Route::get('show-cv/{id}', [App\Http\Controllers\CandidateFeedbackController::class, 'streampdf'])->name('candidate.streampdf');
        });



        Route::group(['prefix' => 'user'], function () {

 			// Manage User Routes

            Route::get('/',[App\Http\Controllers\UserController::class, 'index'])->name('user.index');
            Route::get('edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
            Route::post('update/{id}',[App\Http\Controllers\UserController::class, 'update'])->name('user.update');
            Route::get('create', [App\Http\Controllers\UserController::class, 'create'])->name('user.create');
            Route::post('store/', [App\Http\Controllers\UserController::class, 'store'])->name('user.store');
            

            
        });
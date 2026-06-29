<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PerceptronController;
use App\Http\Controllers\ForwardController;
use App\Http\Controllers\BackpropController;
use App\Http\Controllers\HopfieldController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\HistoryController;

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

// Perceptron Simple
Route::get('/perceptron', [PerceptronController::class, 'index'])->name('perceptron.index');
Route::post('/perceptron/solve', [PerceptronController::class, 'solve'])->name('perceptron.solve');

// Forward Propagation
Route::get('/forward', [ForwardController::class, 'index'])->name('forward.index');
Route::post('/forward/solve', [ForwardController::class, 'solve'])->name('forward.solve');

// Backpropagation
Route::get('/backprop', [BackpropController::class, 'index'])->name('backprop.index');
Route::post('/backprop/solve', [BackpropController::class, 'solve'])->name('backprop.solve');

// Hopfield Networks
Route::get('/hopfield', [HopfieldController::class, 'index'])->name('hopfield.index');
Route::post('/hopfield/solve', [HopfieldController::class, 'solve'])->name('hopfield.solve');

// Quiz (Kahoot-style)
Route::get('/quiz', [QuizController::class, 'index'])->name('quiz.index');
Route::get('/quiz/play', [QuizController::class, 'play'])->name('quiz.play');
Route::post('/quiz/results', [QuizController::class, 'results'])->name('quiz.results');

// Study Guide
Route::get('/guide', [GuideController::class, 'index'])->name('guide.index');

// History
Route::get('/history', [HistoryController::class, 'index'])->name('history.index');
Route::post('/history/delete/{id}', [HistoryController::class, 'delete'])->name('history.delete');
Route::post('/history/clear', [HistoryController::class, 'clear'])->name('history.clear');
Route::get('/history/repeat/{id}', [HistoryController::class, 'repeat'])->name('history.repeat');

// Aula Multimedia
Route::get('/media', function () {
    return view('media.index');
})->name('media.index');


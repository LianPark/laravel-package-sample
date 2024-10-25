<?php

use Illuminate\Support\Facades\Route;
use Lianpark\Contactform\Http\Controllers\ContactFormController;

Route::get('/', function () {
  return 'This is home page.';
});

Route::middleware(['guest', 'web'])->group(function () {
    Route::get('/contact', [ContactFormController::class, 'contact']);
    Route::post('/submit/contact', [ContactFormController::class, 'submit']);
});

/**
 * 테스트용
 */
Route::get('/test', function () {
  return view('contactform::test');
});

Route::get('/sample', [ContactFormController::class, 'index']);
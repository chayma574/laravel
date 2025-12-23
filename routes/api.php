<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\InscriptionController;

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::get('me', 'me');
});

Route::controller(FormationController::class)->group(function () {
    Route::get('formations', 'index');
    Route::get('formations/{id}', 'show');
    Route::post('formations', 'store');
    Route::put('formations/{id}', 'update');
    Route::delete('formations/{id}', 'destroy');
});

Route::controller(InscriptionController::class)->group(function () {
    Route::get('inscriptions', 'index');
    Route::post('inscriptions', 'store');
    Route::delete('inscriptions/{id}', 'destroy');
});


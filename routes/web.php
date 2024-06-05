<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CharacterController;

Route::get('/test', [CharacterController::class, 'test']);

Route::get('/', [CharacterController::class, 'index'])->name('index');
Route::get('/character/{id}', [CharacterController::class, 'show'])->name('show');
Route::get('/api/characters', [CharacterController::class, 'getInitialData']);

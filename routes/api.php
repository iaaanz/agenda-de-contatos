<?php

use App\Http\Controllers\AgendaController;
use Illuminate\Support\Facades\Route;

Route::get('agenda', [AgendaController::class, 'index']);
Route::post('agenda/create', [AgendaController::class, 'store']);
Route::get('agenda/edit/{id}', [AgendaController::class, 'edit']);
Route::get('agenda/{id}', [AgendaController::class, 'show']);
Route::patch('agenda/{id}', [AgendaController::class, 'update']);
Route::delete('agenda/{id}', [AgendaController::class, 'delete']);

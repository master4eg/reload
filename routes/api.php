<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventsController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::resource('events', EventsController::class);
Route::post('/events', [EventsController::class, 'store']);
Route::get('/events/{id}/edit', [EventsController::class, 'edit']);
Route::put('/events/{id}', [EventsController::class, 'update'])->where(['id' => '[0-9]+']);
Route::delete('/events/{id}', [EventsController::class, 'destroy'])->where(['id' => '[0-9]+']);
Route::post('/events/showInterval', [EventsController::class, 'showInterval']);


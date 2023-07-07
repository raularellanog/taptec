<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\CoachsController;
use App\Http\Controllers\CodesController;
use App\Http\Controllers\PlayersController;
use App\Http\Controllers\TrainingsUsersController;
use App\Http\Controllers\TeamsController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});




Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});


Route::prefix('/roles')->group(function () {
    Route::post('/add', [RolesController::class, 'add'])->name('roleAdd');
    Route::post('/edit', [RolesController::class, 'edit'])->name('roleEdit');
    Route::post('/delete', [RolesController::class, 'delete'])->name('roleDelete');
});

Route::prefix('/code')->group(function () {
    Route::post('/validated', [CodesController::class, 'validated']);
});
Route::prefix('/coachs')->group(function () {
    Route::get('/get', [CoachsController::class, 'get_all']);
});
Route::prefix('/teams')->group(function () {
    Route::get('/get', [TeamsController::class, 'get_all']);
});
Route::prefix('/trainings')->group(function () {
    Route::get('/get', [TrainingsUsersController::class, 'get_all']);
});

Route::prefix('/players')->group(function () {
    Route::get('/get', [PlayersController::class, 'get_all']);
});
// players

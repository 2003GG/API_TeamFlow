<?php

use App\Http\Controllers\api\ProjectController;
use App\Http\Controllers\api\TaskController;
use App\Http\Controllers\api\WorkspaceController;
use App\Http\Controllers\api\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    Route::apiResource('/projects', ProjectController::class);
    Route::post('/project/{id}/tasks',[ProjectController::class,'addTask']);
    Route::get('/project/{id}/tasks',[ProjectController::class,'showTask']);
    Route::apiResource('/tasks', TaskController::class);
    Route::apiResource('/workspaces', WorkspaceController::class);
     });



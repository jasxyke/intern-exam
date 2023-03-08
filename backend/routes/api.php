<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AuthController;


Route::post('/login', [AuthController::class, 'login']);

//protects the routes, must be logged in first
Route::group(['middleware' => ['auth:sanctum']], function(){
    // all of the crud api for the roles is protected
    
    //get all roles
    Route::get('/roles', [RolesController::class, 'index']);

    //get role
    Route::get('/roles/{id}', [RolesController::class, 'show']);

    //create role
    Route::post('/add-role', [RolesController::class, 'store']);

    //update role
    Route::put('/roles/{id}', [RolesController::class, 'update']);

    //delete role
    Route::delete('/roles/{id}', [RolesController::class, 'destroy']);
    
    //user routes api, cannot be access when not logged in

    //get all users
    Route::get('/users', [UsersController::class, 'index']);

    //get a single user
    Route::get('/users/{id}', [UsersController::class, 'show']);

    //create a user
    Route::post('/add-user', [UsersController::class, 'store']);

    //update a user
    Route::put('/users/{id}', [UsersController::class, 'update']);

    //delete a user
    Route::delete('/users/{id}', [UsersController::class, 'destroy']);

    //gets the current user
    Route::get('/user', [UsersController::class, 'current']);
    
    //logout route is only available when logged in
    Route::post('/logout', [AuthController::class, 'logout']);


});

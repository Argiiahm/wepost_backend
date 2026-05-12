<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;

Route::get("/user", function (Request $request) {
    return $request->user();
})->middleware("auth:sanctum");

// get User
Route::get('/user/{id}', [ProfileController::class, 'getUser']);

Route::post("/login", [AuthController::class, "login"]);
Route::post("/register", [AuthController::class, "register"]);
Route::get("/posts", [PostController::class, "index"]);
Route::get("/post/{id}", [PostController::class, "show"]);

Route::middleware("auth:sanctum")->group(function () {
    Route::get("/me", [AuthController::class, "me"]);
    Route::post("/logout", [AuthController::class, "logout"]);

    // Posts
    Route::post("/post", [PostController::class, "store"]);
    Route::put("/post/{id}", [PostController::class, "update"]);
    Route::delete("/post/{id}", [PostController::class, "delete"]);
});

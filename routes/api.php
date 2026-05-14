<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FavoritController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;


Route::get("/", function () {
    return "Hello from wepost!";
})->middleware(['throttle:post-limit']);

Route::middleware(['throttle:post-limit'])->group(function () {
    Route::post("/login", [AuthController::class, "login"]);
    Route::post("/register", [AuthController::class, "register"]);
});

Route::middleware(['throttle:posts-limit'])->group(function () {
    // get User
    Route::get('/user/{id}', [ProfileController::class, 'getUser']);

    // get Posts
    Route::get("/posts", [PostController::class, "index"]);
    Route::get("/post/{id}", [PostController::class, "show"]);
});

Route::middleware("auth:sanctum")->group(function () {
    Route::get("/me", [AuthController::class, "me"]);
    Route::post("/logout", [AuthController::class, "logout"]);

    // Posts
    Route::middleware(['throttle:post-limit'])->group(function () {
        Route::post("/post", [PostController::class, "store"]);
        Route::put("/post/{id}", [PostController::class, "update"]);
        Route::delete("/post/{id}", [PostController::class, "delete"]);
    });

    // Activity
    Route::get("/like-activity", [LikeController::class, "likeActivity"]);
    Route::get("/favorits-activity", [FavoritController::class, 'ActivityFavorit']);

    Route::middleware(['throttle:interaction-limit'])->group(function () {
        // likes
        Route::post("/post/{id}/like", [LikeController::class, "like"]);
        // Favorit
        Route::post("/post/{id}/favorit", [FavoritController::class, 'Favorit']);
    });
});

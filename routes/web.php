<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;



Route::get("/", [UserController::class, "posts"]);


Route::post("/register", [UserController::class, "register"]);
Route::post("/logout", [UserController::class, "logout"]);
Route::post("/login", [UserController::class, "login"]);



Route::post("/create-post", [PostController::class, "createPost"]);
Route::get("/edit-post/{post}", [PostController::class, "goToEditPage"]);
Route::put("/edit-post/{post}", [PostController::class, "editPost"]);
Route::delete("/delete-post/{post}", [PostController::class, "deletePost"]);

Route::get('/delete-post/{post}', function () {
    return redirect('/')->with('error', 'Invalid method used. This action requires a DELETE request.');
});

<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('home', function () {
    return view('home.index');
})->name('home');

// Route::get('posts/{post:slug}/', [PostController::class, "show"]);
Route::resource('posts', PostController::class)
    ->scoped(["post" => "slug"])
    ->names("posts");

Route::resource('images', ImageController::class);

Route::resource('posts/{post}/comments', CommentController::class)
    ->scoped([
        "post" => "slug",
        "comment" => "id",
    ])
    ->names("comments");

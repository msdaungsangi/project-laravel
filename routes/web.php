<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', 'login');

Auth::routes();
Route::prefix('/')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('auth.login');
    Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/password/change', [HomeController::class, 'passwordChange'])->name('pass.change')->middleware('auth');
    Route::get('/password/Update', [HomeController::class, 'updatePassword'])->name('pass.update')->middleware('auth');
    Route::get('/register/user', [UserController::class, 'registUser'])->name('user.register');
});

Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('users.index');
    Route::get('/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/store', [UserController::class, 'store'])->name('users.store');
    Route::get('/detail/{id}', [UserController::class, 'show'])->name('users.show');
    Route::group(['middleware' => 'user'], function () {
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/update/{id}', [UserController::class, 'update'])->name('users.update');
        Route::get('/destroy/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    });
});

Route::prefix('posts')->group(function () {
    Route::get('/', [PostController::class, 'posts'])->name('posts.index');
    Route::get('/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/store', [PostController::class, 'createPost'])->name('posts.store');
    Route::get('/detail/{id}', [PostController::class, 'detail'])->name('posts.detail')->middleware('detailPrivate');
    Route::group(['middleware' => 'post'], function () {
        Route::get('/{id}/edit', [PostController::class, 'edit'])->name('posts.edit')->middleware('detailPrivate');
        Route::put('/update/{id}', [PostController::class, 'update'])->name('posts.update')->middleware('detailPrivate');
    });
    Route::get('/destroy', [PostController::class, 'destroy'])->name('posts.delete');
});

Route::prefix('comments')->group(function () {
    Route::post('/', [CommentController::class, 'storeComment'])->name('comments.store');
    Route::put('/update/{id}', [CommentController::class, 'updateComment'])->name('comments.update');
    Route::get('/destroy/{id}', [CommentController::class, 'destroy'])->name('comments.delete');
});

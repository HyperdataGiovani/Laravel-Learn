<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;

// Route::get('/', function () {
//     return view('home', ['title' => 'Home Page']);
// });

Route::get('/', [LoginController::class, 'index'])->name('auth.login');
Route::post('/login_proses', [LoginController::class, 'login_proses'])->name('auth.login_proses');
Route::get('/logout', [LoginController::class, 'logout'])->name('auth.logout');

Route::get('/register', [LoginController::class, 'register'])->name('auth.register');
Route::post('/register_proses', [LoginController::class, 'register_proses'])->name('auth.register_proses');

Route::group(['prefix' => 'admin', 'middleware' => ['auth'], 'as' => 'admin.'], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('index');
    Route::get('/create', [HomeController::class, 'create'])->name('user.create');
    Route::post('/store', [HomeController::class, 'store'])->name('user.store');
    Route::get('/edit/{id}', [HomeController::class, 'edit'])->name('user.edit');
    Route::put('/update/{id}', [HomeController::class, 'update'])->name('user.update');
    Route::delete('/delete/{id}', [HomeController::class, 'delete'])->name('user.delete');

    Route::get('/about', function () {
        return view('about', ['title' => 'About Page']);
    });

    Route::get('/posts', function () {
        return view('posts', ['title' => 'Blog Page', 'posts' => Post::filter(request(['search', 'category', 'author']))->latest()->paginate(2)->withQueryString()]);
    });

    Route::get('/posts/{post:slug}', function (Post $post) {
        return view('post', ['title' => 'Single Post', 'post' => $post]);
    });

    Route::get('/authors/{user:username}', function (User $user) {
        // $posts = $user->posts->load(['author', 'category']);
        return view('posts', ['title' => count($user->posts) . ' Writings by ' . $user->name, 'posts' => $user->posts]);
    });

    Route::get('/categories/{category:slug}', function (Category $category) {
        // $posts = $category->posts->load(['category', 'author']);
        return view('posts', ['title' => 'Category : ' . $category->name, 'posts' => $category->posts]);
    });

    Route::get('/contact', function () {
        return view('contact', ['title' => 'Contact Page']);
    });
});



<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', ['name' => 'Maki Zenin', 'title' => 'Home Page']);
});

Route::get('/about', function () {
    return view('about', ['title'=> 'About Page']);
});

Route::get('/posts', function () {
    return view('posts', ['title'=> 'Blog Page', 'posts' => Post::filter(request(['search', 'category', 'author']))->latest()->paginate(2)->withQueryString()]);
});

Route::get('/posts/{post:slug}', function(Post $post){
    return view('post', ['title' => 'Single Post', 'post' => $post]);
});

Route::get('/authors/{user:username}', function(User $user){
    // $posts = $user->posts->load(['author', 'category']);
    return view('posts', ['title' => count($user->posts) . ' Writings by ' . $user->name, 'posts' => $user->posts]);
});

Route::get('/categories/{category:slug}', function(Category $category){
    // $posts = $category->posts->load(['category', 'author']);
    return view('posts', ['title' => 'Category : ' . $category->name, 'posts' => $category->posts]);
});

Route::get('/contact', function(){
    return view('contact', ['title'=> 'Contact Page']);
});


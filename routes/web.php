<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\CommentController;


use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardPostController;

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

Route::get('/', function(){
    return view('auth.login');
})->middleware('guest');




Auth::routes(['verify' => true]);

Route::middleware(['auth','verified'])->group(function () {
    Route::get('/home', [PostController::class, 'index']);
    
    Route::get('/latest', [PostController::class, 'latest']);

    Route::post('/like/{post:slug}', [LikeController::class, 'like']);
    Route::post('/unlike/{post:slug}', [LikeController::class, 'unlike']);
    Route::post('/likecomment/{comment:id}', [LikeController::class, 'likeComment']);
    Route::post('/unlikecomment/{comment:id}', [LikeController::class, 'unlikeComment']);
    Route::post('/follow/{user:id}', [FollowController::class, 'follow']); 
    Route::post('/unfollow/{user:id}', [FollowController::class, 'unfollow']);

    Route::post('/comment/{post:slug}', [CommentController::class, 'comment']);
    Route::post('/reply/{comment:id}', [CommentController::class, 'reply']);
    Route::get('/comment/delete/{comment:id}', [CommentController::class, 'delete']);
    Route::put('/comment/edit/{comment:id}', [CommentController::class, 'edit']);

    Route::get('/search', [SearchController::class, 'search'])->name('search');
    Route::post('/search/filter', [SearchController::class, 'tag']);


    Route::get('/about', [UserController::class, 'userIndex']);
    
    //halaman categories
    Route::get('/categories', [CategoryController::class, 'index']);
    
    //halaman single post
    Route::get('posts/{post:slug}', [PostController::class, 'show']);
    
    //halaman category
    Route::get('/category/{category:slug}', [CategoryController::class, 'category']);
    
    Route::get('/author/{user:name}', [PostController::class, 'author']);
    Route::get('/dashboard/user', [HomeController::class, 'index']);
    Route::get('/dashboard/following', [HomeController::class, 'following']);
    Route::get('/dashboard/user/{user:name}', [HomeController::class, 'edit']);
    Route::put('/dashboard/user/{user:name}', [HomeController::class, 'update']);
    Route::get('/dashboard/posts/create/write', function() {
        return view('auth.dashboard.posts.write');
    });
    Route::resource('/dashboard/posts', DashboardPostController::class);

});






<?php

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\TagController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\AdminController;
use App\Http\Controllers\API\AuthorController;
use App\Http\Controllers\API\CommentController;
use App\Http\Controllers\API\RegisterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::prefix('blogs')->group(function(){
    Route::get('/', [PostController::class,'index']);
    Route::post('/create', [PostController::class, 'create']);
    Route::get('/search', [PostController::class, 'search']);
    Route::delete('/delete/{id}', [PostController::class, 'delete']);
    Route::put('/update/{id}', [PostController::class, 'update']);
    Route::get('/tag/{tagid}',[PostController::class, 'displayTagPost']);
    Route::get('/user/{userid}', [PostController::class, 'displayUsersPosts']);
    Route::post('/{id}/like', [PostController::class, 'likePost'] );
    Route::post('/{id}/unlike', [PostController::class, 'unlikePost'] );
    Route::get('/{id}',[PostController::class, 'displayPost']);
});

Route::prefix('tags')->group(function(){
    Route::get('/', [TagController::class, 'index']);
    Route::post('/create', [TagController::class, 'create']);
    Route::get('/delete/{id}', [TagController::class, 'delete']);
    Route::get('/{id}', [TagController::class, 'blogsWithTags']);
});

Route::prefix('comments')->group(function(){
    Route::get('/', [CommentController::class,'index']);
    Route::post('create/{postid}', [CommentController::class,'create']);
    Route::put('update/{id}', [CommentController::class,'update']);
    Route::delete('delete/{id}', [CommentController::class,'delete']);
    Route::post('/{id}/like', [CommentController::class, 'likeComment'] );
    Route::post('/{id}/unlike', [CommentController::class, 'unlikeComment'] );
});

Route::prefix('user')->group(function(){

    Route::get('/', [AuthorController::class,'index']);
    Route::post('/update/{id}', [AuthorController::class,'update']);
    Route::post('/update/picture/{id}', [AuthorController::class,'updateProfilePicture']);
    Route::post('/update/password/{id}', [AuthorController::class,'updatePasswordSave']);
    Route::delete('/delete/{id}', [AuthorController::class,'delete']);
});

Route::prefix('author')->group(function(){
    Route::get('/', [RegisterController::class,'index']);
    Route::post('/signup', [RegisterController::class, 'store']);
    Route::post('/login', [RegisterController::class, 'login']);
    Route::post('/forgot-password', [RegisterController::class, 'forgotPassword']);
    Route::post('/reset-password', [RegisterController::class, 'resetPassword']);


Route::group(['middleware' => ['auth:api']], function(){
    Route::post('/logout', [RegisterController::class, 'logout']);
});

});











Route::middleware('auth:api')->group(function () {
Route::middleware(IsAdmin::class)->group(function(){
    Route::prefix('admin')->group(function(){

            Route::get('/users', [AdminController::class, 'showUsers']);
            Route::get('/posts', [AdminController::class, 'showPosts']);
            Route::get('/tags', [AdminController::class, 'showTags']);
            Route::get('/comments', [AdminController::class, 'showComments']);
            Route::get('/posts', [AdminController::class, 'showPosts']);
            Route::delete('/users/delete/{id}', [AdminController::class, 'deleteUser']);
            Route::delete('/posts/delete/{id}', [AdminController::class, 'deletePost']);
            Route::delete('/tags/delete/{id}', [AdminController::class, 'deleteTag']);
            Route::delete('/comments/delete/{id}', [AdminController::class, 'deleteComments']);
            Route::get('/users/{id}', [AdminController::class, 'showUserDetails']);

});
});

});



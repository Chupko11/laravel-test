<?php

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\TagController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\CommentController;

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
    Route::get('/', [PostController::class,'index'])->name('displayBlogs');
    Route::post('/create', [PostController::class, 'create'])->name('createPost');
    Route::get('/search', [PostController::class, 'search'])->name('searchPost');
    Route::delete('/delete/{id}', [PostController::class, 'delete'])->name('deletePost');
    Route::put('/update/{id}', [PostController::class, 'update'])->name('updatePost');
    Route::get('/tag/{tagid}',[PostController::class, 'displayTagPost'])->name('displayTagPost');
    Route::get('/user/{userid}', [PostController::class, 'displayUsersPosts'])->name('displayUsersPosts');
    Route::post('/{id}/like', [PostController::class, 'likePost'] )->name('likePost');
    Route::post('/{id}/unlike', [PostController::class, 'unlikePost'] )->name('unlikePost');
    Route::get('/{id}',[PostController::class, 'displayPost'])->name('displayPost');
});

Route::prefix('tags')->group(function(){
    Route::get('/', [TagController::class, 'index'])->name('displayTags');
    Route::post('/create', [TagController::class, 'create'])->name('createTags');
    Route::get('/delete/{id}', [TagController::class, 'delete'])->name('deleteTag');
    Route::get('/{id}', [TagController::class, 'blogsWithTags'])->name('displayBlogsWithTags');
});

Route::prefix('comments')->group(function(){
    Route::get('/', [CommentController::class,'index'])->name('displayComments');
    Route::post('create/{postid}', [CommentController::class,'create'])->name('createComment');
    Route::put('update/{id}', [CommentController::class,'update'])->name('updateComment');
    Route::delete('delete/{id}', [CommentController::class,'delete'])->name('deleteComment');

});



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



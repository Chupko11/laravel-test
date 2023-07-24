<?php

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\TagController;
use App\Http\Controllers\API\PostController;

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
    Route::delete('/delete/{id}', [PostController::class, 'delete'])->name('deletePost');
    Route::put('/update/{id}', [PostController::class, 'update'])->name('updatePost');
    Route::get('/tag/{tagid}',[PostController::class, 'displayTagPost'])->name('displayTagPost');
    Route::get('/user/{userid}', [PostController::class, 'displayUsersPosts'])->name('displayUsersPosts');
    Route::get('/{id}',[PostController::class, 'displayPost'])->name('displayPost');

});

Route::prefix('tags')->group(function(){
    Route::get('/', [TagController::class, 'index'])->name('displayTags');
    Route::get('/{id}', [TagController::class, 'blogsWithTags'])->name('displayBlogsWithTags');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



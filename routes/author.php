<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use \App\Http\Controllers\AuthorController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\RegisterController;



//grupacija route -> u ovom slucaju bi bio http://127.0.0.1:8000 sa dodatkom /author
Route::prefix('author')->name('author.')->group(function(){

    //Ova linija koda omogućuje osobama koji nisu korisnici da otvore dva view-a (login i forgot-password)
        Route::middleware(['guest:web'])->group(function () {
            Route::get('/homeguest', [RegisterController::class,'index'])->name('homeGuest');
            Route::view('/login','back.pages.auth.login')->name('login');

            Route::get('/signup', [RegisterController::class, 'create'])->name('signup');
            Route::post('/signup', [RegisterController::class, 'store'])->name('signupStore');
            Route::post('/login', [RegisterController::class, 'login'])->name('Loginrequest');

            Route::view('/forgot-password','back.pages.auth.forgot')->name('forgot-passwordView');   //otvara forgot password view - input email
            Route::post('/forgot-password',[RegisterController::class, 'forgotPassword'])->name('forgot-password');//šalje se mail korisniku
            Route::post('/reset-password', [RegisterController::class, 'resetPasswordSave'])->name('resetPasswordSave'); //sprema se novi password
            Route::get('/reset-password/{token}', [RegisterController::class, 'resetPassword'])->name('resetPassword'); //otvara novi view gdje korisnik unosi novi password
        });

        //The next part of the code is saying that for pages in the 'author' group,
        //if someone is logged in (which is what the empty brackets mean), they should be able to access a page called 'home'.
        //This page is represented by a function called 'index' in a class called 'AuthorController'.
        Route::middleware(['auth:web'])->group(function() {
            Route::get('/home', [AuthorController::class,'index'])->name('home');
            Route::post('/logout', [AuthorController::class, 'logout'])->name('logout');
            Route::get('/profile', [AuthorController::class, 'profile'])->name('profile');
            Route::post('/update-profile', [AuthorController::class, 'update'])->name('update');
            Route::post('/profile/picture', [AuthorController::class, 'updateProfilePicture'])->name('pictureUpdate');
            Route::post('/profile/password', [AuthorController::class, 'updatePasswordSave'])->name('postPasswordUpdate');
            Route::post('/profile/delete-account', [AuthorController::class, 'deleteAccount'])->name('deleteAccount');


        });

        Route::middleware(['auth:web'])->group(function(){
            Route::get('/posts/create', [PostController::class, 'create'] )->name('createPost');
            Route::post('/posts', [PostController::class, 'store'])->name('storePost');
            Route::get('/tag/create', [PostController::class, 'createTag'])->name('createTag');
            Route::post('/tag', [PostController::class, 'storeTag'])->name('storeTag');
            Route::get('/showPosts', [PostController::class, 'show'])->name('showPosts');
            Route::delete('/deletePost/{id}', [PostController::class, 'delete'])->name('deletePost');
            Route::post('/updatePost/{id}', [PostController::class, 'updatePost'])->name('updatePost');
            Route::post('/updatePost', [PostController::class, 'postUpdatePost'])->name('postUpdatePost');
            Route::delete('/tag/{id}', [PostController::class, 'deleteTag'])->name('deleteTag');
            Route::get('/tag', [PostController::class, 'showTags'])->name('showTags');
        });

        Route::middleware(['auth:web'])->group(function(){
            Route::post('/posts/{post}', [CommentController::class, 'store'])->name('createComment');
            Route::delete('/posts/{id}', [CommentController::class, 'destroy'])->name('deleteComment');
            Route::post('/comments/{id}/like', [CommentController::class, 'likeComment'])->name('comments.like');
            Route::post('/comments/{id}/unlike', [CommentController::class, 'unlikeComment'])->name('comments.unlike');
            Route::post('/comments/{id}', [CommentController::class, 'update'])->name('updateComment');
        });




        Route::get('/search', [PostController::class, 'search'])->name('searchPost');
        Route::get('/searchpost', [PostController::class, 'postSearchPost'])->name('postSearchPost');
        Route::get('/posts/{post}', [PostController::class, 'display'])->name('postsDisplay');
 });


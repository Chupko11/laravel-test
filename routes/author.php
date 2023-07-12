<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\PostController;
use \App\Http\Controllers\AuthorController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\RegisterController;



//grupacija route -> u ovom slucaju bi bio http://127.0.0.1:8000 sa dodatkom /author
Route::prefix('author')->name('author.')->group(function(){

    //Ova linija koda omogućuje osobama koji nisu korisnici da otvore dva view-a (login i forgot-password)
        Route::middleware(['guest:web'])->group(function () {
            Route::get('/homeguest', [RegisterController::class,'index'])->name('homeGuest');
            Route::get('/homeguest/signup', [RegisterController::class, 'create'])->name('signup');
            Route::post('/homeguest/signup', [RegisterController::class, 'store'])->name('signupStore');
            Route::view('/homeguest/login','back.pages.auth.login')->name('login');
            Route::post('/homeguest/login', [RegisterController::class, 'login'])->name('Loginrequest');
            Route::post('/homeguest/forgot-password',[RegisterController::class, 'forgotPassword'])->name('forgot-password');//šalje se mail korisniku
            Route::post('/homeguest/reset-password', [RegisterController::class, 'resetPasswordSave'])->name('resetPasswordSave'); //sprema se novi password
            Route::get('/homeguest/reset-password/{token}', [RegisterController::class, 'resetPassword'])->name('resetPassword'); //otvara novi view gdje korisnik unosi novi password
        });

        Route::middleware(['auth:web'])->group(function() {

            Route::get('/home', [AuthorController::class,'index'])->name('home');
            Route::post('/home/logout', [AuthorController::class, 'logout'])->name('logout');
            Route::get('/home/profile', [AuthorController::class, 'profile'])->name('profile');
            Route::post('/home/update-profile', [AuthorController::class, 'update'])->name('update');
            Route::post('/home/profile/picture', [AuthorController::class, 'updateProfilePicture'])->name('pictureUpdate');
            Route::post('/home/profile/password', [AuthorController::class, 'updatePasswordSave'])->name('postPasswordUpdate');
            Route::post('/home/profile/delete-account', [AuthorController::class, 'deleteAccount'])->name('deleteAccount');



            Route::get('/posts/create', [PostController::class, 'create'] )->name('createPost');
            Route::post('/posts', [PostController::class, 'store'])->name('storePost');
            Route::get('/posts/showPosts', [PostController::class, 'show'])->name('showPosts');
            Route::post('/posts/updatePost', [PostController::class, 'postUpdatePost'])->name('postUpdatePost');
            Route::delete('/posts/deletePost/{id}', [PostController::class, 'delete'])->name('deletePost');
            Route::post('/posts/updatePost/{id}', [PostController::class, 'updatePost'])->name('updatePost');
            Route::post('/posts/{id}/like', [PostController::class, 'likePost'])->name('post.like');
            Route::post('/posts/{id}/unlike', [PostController::class, 'unlikePost'])->name('post.unlike');





            Route::get('/tag/create', [TagController::class, 'createTag'])->name('createTag');
            Route::post('/tag', [TagController::class, 'storeTag'])->name('storeTag');
            Route::get('/tag', [TagController::class, 'showTags'])->name('showTags');
            Route::get('/tag/{tag}', [TagController::class, 'showTagsPosts'])->name('showTagsPosts');
            Route::delete('/tag/{id}', [TagController::class, 'deleteTag'])->name('deleteTag');





            Route::post('/posts/{post}', [CommentController::class, 'store'])->name('createComment');
            Route::delete('/posts/{id}', [CommentController::class, 'destroy'])->name('deleteComment');
            Route::post('/comments/{id}/like', [CommentController::class, 'likeComment'])->name('comments.like');
            Route::post('/comments/{id}/unlike', [CommentController::class, 'unlikeComment'])->name('comments.unlike');
            Route::post('/comments/{id}/like', [CommentController::class, 'likeComment'])->name('comments.like');
            Route::post('/comments/{id}/unlike', [CommentController::class, 'unlikeComment'])->name('comments.unlike');
            Route::post('/comments/{id}', [CommentController::class, 'update'])->name('updateComment');



    });




        Route::view('/forgot-password','back.pages.auth.forgot')->name('forgot-passwordView');
        Route::get('/search', [PostController::class, 'search'])->name('searchPost');
        Route::get('/searchpost', [PostController::class, 'postSearchPost'])->name('postSearchPost');
        Route::get('/posts/{post}', [PostController::class, 'display'])->name('postsDisplay');
});


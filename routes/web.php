<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\PostController;
use \App\Http\Controllers\AuthorController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\RegisterController;
use App\Http\Middleware\IsAdmin;

//grupacija route -> u ovom slucaju bi bio http://127.0.0.1:8000 sa dodatkom /author
Route::prefix('author')->name('author.')->group(function(){

    //Ova linija koda omogućuje osobama koji nisu korisnici da otvore dva view-a (login i forgot-password)
        Route::middleware(['guest:web'])->group(function () {

        Route::prefix('homeguest')->group(function(){
            Route::controller(RegisterController::class)->group(function(){
                Route::get('/', 'index')->name('homeGuest');
                Route::get('/signup', 'create')->name('signup');
                Route::post('/signup', 'store')->name('signupStore');
                Route::view('/login','back.pages.auth.login')->name('loginView');
                Route::post('/login', 'login')->name('Loginrequest');
                Route::post('/forgot-password', 'forgotPassword')->name('forgot-password');//šalje se mail korisniku
                Route::post('/reset-password',  'resetPasswordSave')->name('resetPasswordSave'); //sprema se novi password
                Route::get('/reset-password/{token}',  'resetPassword')->name('resetPassword'); //otvara novi view gdje korisnik unosi novi password
            });

        });
        });

        Route::middleware(['auth:web'])->group(function() {

            Route::prefix('home')->group(function(){
            Route::controller(AuthorController::class)->group(function() {
                Route::get('/', 'index')->name('home');
                Route::post('/logout',  'logout')->name('logout');
                Route::get('/profile',  'profile')->name('profile');
                Route::post('/update-profile',  'update')->name('update');
                Route::post('/profile/picture',  'updateProfilePicture')->name('pictureUpdate');
                Route::post('/profile/password',  'updatePasswordSave')->name('postPasswordUpdate');
                Route::post('/profile/delete-account',  'deleteAccount')->name('deleteAccount');
            });

            });

        Route::prefix('posts')->group(function(){
            Route::controller(PostController::class)->group(function(){
                Route::post('/',  'store')->name('storePost');
                Route::get('/create',  'create' )->name('createPost');
                Route::get('/showPosts',  'show')->name('showPosts');
                Route::post('/updatePost',  'postUpdatePost')->name('postUpdatePost');
                Route::delete('/deletePost/{id}',  'delete')->name('deletePost');
                Route::post('/updatePost/{id}',  'updatePost')->name('updatePost');
                Route::post('/{id}/like',  'likePost')->name('post.like');
                Route::post('/{id}/unlike',  'unlikePost')->name('post.unlike');
                });

            });

        Route::prefix('tag')->group(function(){
            Route::controller(TagController::class)->group(function(){
                Route::get('/',  'showTags')->name('showTags');
                Route::post('/',  'storeTag')->name('storeTag');
                Route::get('/create',  'createTag')->name('createTag');
                Route::get('/{tag}',  'showTagsPosts')->name('showTagsPosts');
                Route::delete('/{id}',  'deleteTag')->name('deleteTag');
            });

        });


        Route::prefix('posts')->group(function(){
            Route::controller(CommentController::class)->group(function(){
                Route::post('/{post}', 'store')->name('createComment');
                Route::delete('/{id}', 'destroy')->name('deleteComment');
                Route::post('/comments/{id}/like', 'likeComment')->name('comments.like');
                Route::post('/comments/{id}/unlike', 'unlikeComment')->name('comments.unlike');
                Route::post('/comments/{id}/reply', 'commentReply')->name('comments.reply');
                Route::post('/reply/{id}/like', 'likeReply')->name('reply.like');
                Route::post('/reply/{id}/unlike', 'unlikeReply')->name('reply.unlike');
                Route::post('/comments/{id}', 'update')->name('updateComment');
            });


        });


        Route::middleware(IsAdmin::class)->group(function(){
            Route::controller(AdminController::class)->group(function(){
                Route::get('/admin/users', 'showUsers')->name('showUsersAdmin');
                Route::get('/admin/posts', 'showPosts')->name('showPostsAdmin');
                Route::get('/admin/comments', 'showComments')->name('showCommentsAdmin');
                Route::get('/admin/tags', 'showTags')->name('showTagsAdmin');
                Route::delete('/admin/users/{id}', 'deleteUser')->name('deleteUserAdmin');
                Route::delete('/admin/posts/{id}', 'deletePosts')->name('deletePostAdmin');
                Route::delete('/admin/comments/{id}', 'deleteComments')->name('deleteCommentsAdmin');
                Route::get('/admin/users/{id}', 'showUserDetails')->name('showUserDetails');

            });
        });
    });




        Route::view('/forgot-password','back.pages.auth.forgot')->name('forgot-passwordView');
        Route::get('/search', [PostController::class, 'search'])->name('searchPost');
        Route::get('/searchpost', [PostController::class, 'postSearchPost'])->name('postSearchPost');
        Route::get('/posts/{post}', [PostController::class, 'display'])->name('postsDisplay');
});


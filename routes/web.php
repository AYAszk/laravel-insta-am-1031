<?php  //🟥 Error Message 'index' is here!! You should check 's'!

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\PostController;

use App\Http\Controllers\CommentController;

use App\Http\Controllers\ProfileController;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\LikeController;

use App\Http\Controllers\FollowController;

use App\Http\Controllers\Admin\UsersController;

use App\Http\Controllers\Admin\PostsController;

use App\Http\Controllers\Admin\CategoriesController;

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

//🟥 Error Message 'index' is here!! You should check 's'!
Auth::routes(); 
 Route::group(['middleware' => 'auth'],function(){ //middleware : 認証されていないユーザーによるアクセスを防ぐために保護
    Route::get('/',[HomeController::class,'index'])->name('index');

    // POST
    Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/post/store', [PostController::class, 'store'])->name('post.store');
    Route::get('/post/{id}/show', [PostController::class, 'show'])->name('post.show');
    Route::get('/post/{id}/edit', [PostController::class, 'edit'])->name('post.edit');
    Route::patch('/post/{id}/update', [PostController::class, 'update'])->name('post.update');
    Route::delete('/post/{id}/destroy', [PostController::class, 'destroy'])->name('post.destroy');

    // COMMENT 11.10 
    Route::post('/comment/{post_id}/store', [CommentController::class, 'store'])->name('comment.store');
    Route::delete('/comment/{id}/destroy', [CommentController::class, 'destroy'])->name('comment.destroy');


    // PROFILE 11.10
    Route::get('/profile/{id}/show', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    //　LIKE 11.13
    Route::post('/like/{post_id}/store',[LikeController::class, 'store'])->name('like.store');
    Route::delete('/like/{post_id}/destroy', [LikeController::class, 'destroy'])->name('like.destroy');

    // FOLLOW 11.14
    Route::post('/follow/{user_id}/store', [FollowController::class, 'store'])->name('follow.store');
    Route::delete('/follow/{user_id}/destroy', [FollowController::class, 'destroy'])->name('follow.destroy');

    // FOLLOWERS 11.15
    Route::get('/profile/{id}/followers', [ProfileController::class, 'followers'])->name('profile.followers');
    
    // FOLLOWING
    Route::get('/profile/{id}/following', [ProfileController::class, 'following'])->name('profile.following');

    // ADMIN 11.16
    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function(){
        // User
        Route::get('/users', [UsersController::class, 'index'])->name('users');  // admin.users

        Route::delete('/users/{id}/deactivate', [UsersController::class, 'deactivate'])->name('users.deactivate'); //admin.users.deactivate

        Route::patch('/users/{id}/activate', [UsersController::class, 'activate'])->name('users.activate'); //admin.users.activate

        // POSTS 11.17
        Route::get('/posts',[PostsController::class, 'index'])->name('posts');

        Route::delete('/posts/{id}/hide', [PostsController::class, 'hide'])->name('posts.hide'); // admin.posts.hide
        Route::patch('/posts/{id}/unhide', [PostsController::class, 'unhide'])->name('posts.unhide'); // admin.posts.unhide

        // CATEGORIES 11.20
        Route::get('/categories', [CategoriesController::class, 'index'])->name('categories'); // admin.categories

        Route::post('/categories/store', [CategoriesController::class, 'store'])->name('categories.store'); // admin.categories.store

        Route::patch('/categories/{id}/update', [CategoriesController::class, 'update'])->name('categories.update'); //admin.categories.update

        Route::delete('/categories/{id}/destroy', [CategoriesController::class, 'destroy'])->name('categories.destroy'); //admin.categories.destroy

    });

    // 11.22
    Route::get('/people',[HomeController::class, 'search'])->name('search');
});
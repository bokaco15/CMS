<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentsController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\front\ContactUsController;
use App\Http\Controllers\front\IndexController;
use App\Http\Controllers\front\PageController;
use App\Http\Controllers\front\PostController;
use Illuminate\Support\Facades\Route;

Route::name('front.')->group(function () {
    Route::get('/', [IndexController::class, 'index'])->name('index');
    Route::get('/blog', [PageController::class, 'blog'])->name('blog.index');
    Route::get('/contact', [ContactUsController::class, 'index'])->name('contact.index');
    Route::post('/contact', [ContactUsController::class, 'store'])->name('contact.store');
    Route::get('/post/{post}/{slug}', [PostController::class, 'index'])->name('post.index');
    Route::post('/post/comment', [PostController::class, 'storeComment'])->name('post.comment');
    Route::get('/category/{category}/{slug}', [PageController::class, 'category'])->name('category.index');
    Route::get('/tag/{tag}/{slug}', [PageController::class, 'tag'])->name('tags.index');
    Route::get('/user-post/{user}/{slug}', [PageController::class, 'userPost'])->name('user.post');
});


Route::middleware('auth')->prefix('/admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');

    Route::prefix('/users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('indexUsers');
        Route::post('/', [UserController::class, 'datatableUsers'])->name('datatableUsers');
        Route::post('/delete', [UserController::class, 'delete'])->name('deleteUser');
        Route::post('/update-status', [UserController::class, 'updateStatus'])->name('updateUserStatus');
        Route::view('/add', 'admin.user.add' )->name('addUser');
        Route::post('/add', [UserController::class, 'add'])->name('addUser');
        Route::get('/edit/{user}/{slug}', [UserController::class, 'editUser'])->name('editUser');
        Route::post('/update/{user}', [UserController::class, 'updateUser'])->name('updateUser');
        Route::post('/deleteAvatar', [UserController::class, 'deleteAvatar'])->name('userDeleteAvatar');
    });


    Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
    Route::prefix('/category')->name('category.')->group(function () {
        Route::post('/resort', [CategoryController::class, 'resort'])->name('resort');
        Route::post('/add', [CategoryController::class, 'add'])->name('add');
        Route::post('/delete', [CategoryController::class, 'delete'])->name('delete');
        Route::post('/category/change-status', [CategoryController::class, 'changeStatus'])->name('changeStatus');
        Route::post('/category/edit', [CategoryController::class, 'edit'])->name('edit');
    });

    //Tags
    Route::get('/tags', [TagController::class, 'index'])->name('tag.index');
    Route::post('/tags/datatable', [TagController::class, 'datatable'])->name('tag.datatable');
    Route::post('/tags/add', [TagController::class, 'add'])->name('tag.add');
    Route::post('/tags/delete', [TagController::class, 'delete'])->name('tag.delete');
    Route::post('/tags/edit', [TagController::class, 'edit'])->name('tag.edit');

    //posts
    Route::prefix('/post')->name('post.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\PostController::class, 'index'])->name('index');
        Route::post('/datatable', [\App\Http\Controllers\Admin\PostController::class, 'datatable'])->name('datatable');
        Route::post('/changeStatus', [\App\Http\Controllers\Admin\PostController::class, 'changeStatus'])->name('changeStatus');
        Route::get('/add', [\App\Http\Controllers\Admin\PostController::class, 'add'])->name('add');
        Route::post('/add', [\App\Http\Controllers\Admin\PostController::class, 'store'])->name('store');
        Route::post('/uploadMedia', [\App\Http\Controllers\Admin\PostController::class, 'uploadMedia'])->name('uploadMedia');
        Route::get('/edit/{post}/{slug}', [\App\Http\Controllers\Admin\PostController::class, 'edit'])->name('edit');
        Route::post('/update/{post}', [\App\Http\Controllers\Admin\PostController::class, 'update'])->name('update');
        Route::post('/delete', [\App\Http\Controllers\Admin\PostController::class, 'delete'])->name('delete');
    });

    //sliders
    Route::prefix('/sliders')->name('slider.')->group(function () {
       Route::get('/', [SliderController::class, 'index'])->name('index');
       Route::post('/resort', [SliderController::class, 'resort'])->name('resort');
       Route::post('/add', [SliderController::class, 'add'])->name('add');
       Route::post('/delete', [SliderController::class, 'delete'])->name('delete');
       Route::post('/slider/change-status', [SliderController::class, 'changeStatus'])->name('changeStatus');
    });

    //comments
    Route::prefix('/comments')->name('comment.')->group(function () {
       Route::get('/', [CommentsController::class, 'index'])->name('index');
       Route::post('/unaccepted-comments', [CommentsController::class, 'unacceptedDatatable'])->name('unaccepted');
       Route::post('/accept-comment', [CommentsController::class, 'accept'])->name('accept');
       Route::post('/accepted-comment', [CommentsController::class, 'acceptedDatatable'])->name('accepted');
       Route::post('/delete-comment', [CommentsController::class, 'delete'])->name('delete');
    });

   Route::prefix('/profile')->group(function () {
       //admin profile - index page
       Route::view('/', 'admin.profile.index')->name('profile.index');
       //change password
       Route::get('/password', [AdminController::class, 'editPassword'])->name('editPassword');
       Route::post('/password/{user}', [AdminController::class, 'updatePassword'])->name('updatePassword');
       //delete avatar
       Route::post('/delete-avatar', [AdminController::class, 'deleteAvatar'])->name('profile.deleteAvatar');
       //update profile
       Route::post('/update-profile', [AdminController::class, 'updateProfile'])->name('profile.update');
   });
   //end profile prefix
});


Auth::routes([
    'register' => false,
]);

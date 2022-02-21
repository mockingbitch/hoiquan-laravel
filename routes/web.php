<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Home\ClientController;
use App\Http\Controllers\Home\PostController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\ClientManagerController;
use App\Http\Controllers\Home\CheerController;
use App\Http\Controllers\Home\CommentController;
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


Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/home',[HomeController::class,'index']);
//Route::middleware(['checkLoginClient'])->group(function (){
//    Route::prefix('client')->group(function (){
//        Route::get('/login',[ClientController::class,'index'])->name('client.login');
//        Route::post('/login',[ClientController::class,'login']);
//        Route::get('/logout',[ClientController::class,'logout'])->name('client.logout');
//    });
//});
    Route::prefix('client')->group(function (){
        Route::get('/login',[ClientController::class,'index'])->name('client.login');
        Route::post('/login',[ClientController::class,'login']);
        Route::get('/logout',[ClientController::class,'logout'])->name('client.logout');
    });
Route::prefix('post')->group(function (){
    Route::get('/create',[PostController::class,'create'])->name('post.create');
    Route::post('/create',[PostController::class,'store'])->name('post.store');
    Route::get('/update/{id}',[PostController::class,'show'])->name('post.show');
    Route::post('/update/{id}',[PostController::class,'update'])->name('post.update');
    Route::get('/delete/{id}',[PostController::class,'delete'])->name('post.delete');
    Route::get('/cheer/{post}',[CheerController::class,'cheering'])->name('cheer');
    Route::get('/comment/{post}',[CommentController::class,'create'])->name('comment.create');
    Route::post('/comment/{post}',[CommentController::class,'store'])->name('comment.store');
    Route::get('/update/{id}',[CommentController::class,'show'])->name('comment.show');
    Route::post('/update/{id}',[CommentController::class,'update'])->name('comment.update');
    Route::get('/delete/{id}',[CommentController::class,'delete'])->name('comment.delete');

});



//BACKEND

Route::prefix('admin')->group(function (){
    Route::get('/index',[AdminController::class,'index'])->name('admin.home');
    Route::post('/login', [AdminController::class, 'login'])->name('admin.login');
    Route::get('/login', [AdminController::class, 'loginView'])->name('admin.login.view');
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');

    Route::prefix('tag')->group(function (){
        Route::get('/index',[TagController::class,'index'])->name('tag.index');
        Route::get('/create',[TagController::class,'create'])->name('tag.create');
        Route::post('/create',[TagController::class,'store'])->name('tag.store');
        Route::get('/update/{id}',[TagController::class,'show'])->name('tag.show');
        Route::post('/update/{id}',[TagController::class,'update'])->name('tag.update');
        Route::get('/delete/{id}',[TagController::class,'delete'])->name('tag.delete');
    });

    Route::prefix('client')->group(function (){
        Route::get('/',[ClientManagerController::class,'index'])->name('clientManager.index');
        Route::get('/delete/{id}',[ClientManagerController::class,'delete'])->name('clientManager.delete');
    });
});


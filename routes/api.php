<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Home\HomeController;
use App\Http\Controllers\Api\Admin\TagController;
use App\Http\Controllers\Api\Admin\AdminController;
use App\Http\Controllers\Api\Home\PostController;
use App\Http\Controllers\Api\Home\CheerController;
use App\Http\Controllers\Api\Home\CommentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//FRONT END
Route::get('/',[HomeController::class,'index'])->name('index');
Route::prefix('post')->group(function (){
    Route::get('/',[PostController::class,'index'])->name('post.index');
    Route::post('/',[PostController::class,'create'])->name('post.create');
    Route::get('/{id}',[PostController::class,'show'])->name('post.show');
    Route::put('/{id}',[PostController::class,'update'])->name('post.update');
    Route::delete('/{id}',[PostController::class,'delete'])->name('post.delete');
    Route::get('/cheer',[CheerController::class,'cheering'])->name('post.cheer');
    Route::post('/comment',[CommentController::class,'create'])->name('comment.create');
    Route::get('/comment/{id}',[CommentController::class,'show'])->name('comment.show');
    Route::put('/comment/{id}',[CommentController::class,'update'])->name('comment.update');
    Route::delete('/comment{id}',[CommentController::class,'delete'])->name('comment/delete');
});




//BACK END
Route::prefix('admin')->group(function (){
    Route::get('/',[AdminController::class,'index'])->name('admin');

//    Tag
    Route::prefix('tag')->group(function (){
        Route::get('/',[TagController::class,'index'])->name('tag.index');
        Route::post('/',[TagController::class,'create'])->name('tag.create');
        Route::get('/{id}',[TagController::class,'show'])->name('tag.show');
        Route::put('/{id}',[TagController::class,'update'])->name('tag.update');
        Route::delete('/{id}',[TagController::class,'delete'])->name('tag.delete');
    });

//    Client
    Route::prefix('client')->group(function (){
        Route::get('/',[ClientManagerController::class,'index'])->name('clientManager.index');
        Route::get('/{id}',[ClientManagerController::class,'show'])->name('clientManager.show');
        Route::delete('/{id}',[ClientManagerController::class,'delete'])->name('clientMangager.delete');
    });
});

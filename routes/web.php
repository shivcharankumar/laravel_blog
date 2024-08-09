<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\DasboardController;
use App\Http\Controllers\Auth\PostController;
use App\Http\Controllers\Auth\CategoryController;
use App\Http\Controllers\Auth\TagController;
use App\Http\Controllers\site\BlogContriller;
use App\Http\Controllers\site\CommentController;
use App\Http\Controllers\Auth\ProfileController;

Route::get('/logout', function () {
    auth()->logout();
    // return view('welcome');
});

 Auth::routes([
    // "register" => false
 ]);

 Route::middleware('auth')->group(function(){

     Route::get('dasboard',[DasboardController::class,'dasboard'])->name('dasboard');     
     Route::resource('auth/posts', PostController::class);     
     Route::get('Auth/categories',[CategoryController::class,'categorypage'])->name('auth.ctegories');     
     Route::get('Auth/tags',[TagController::class,'tagspage'])->name('auth.tags');
     Route::get('Auth/profile',[ProfileController::class,'openprofile'])->name('auth.profile.index');
     Route::post('Auth/profile',[ProfileController::class,'profilestore'])->name('auth.profile.store');

 });





Route::get('/',[BlogContriller::class,'index'])->name('home');
Route::get('single-blog/{id}',[BlogContriller::class,'openSingleBlog'])->name('single-blog');

Route::post('post/comment/{postId}',[CommentController::class,'Postcomment'])->name('post.comment')->middleware('auth');
Route::post('comment/reply/{commentId}',[CommentController::class,'PostcommentReply'])->name('comment.reply');
Route::Delete('comment/reply/delete',[CommentController::class,'deletecommentReply'])->name('comment.reply.delete');



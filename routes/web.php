<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\DasboardController;

Route::get('/logout', function () {
    auth()->logout();
    // return view('welcome');
});

 Auth::routes([
    "register" => false
 ]);

Route::get('dasboard',[DasboardController::class,'dasboard'])->name('dasboard');

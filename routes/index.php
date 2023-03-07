<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:customers')->group(function () {
    Route::get('/', [\App\Http\Controllers\Index\IndexController::class, 'index'])->name("index");
    Route::get('/profile/settings', [\App\Http\Controllers\Index\IndexController::class, 'settings'])->name("profile.settings");
    Route::get('/kols/edit', function () {
        return view('index.kols.setting');
    });


    Route::get('/san-pham', [\App\Http\Controllers\Index\CampaignController::class, 'index'])->name("index.products");

});


Route::get('/ket-noi', [\App\Http\Controllers\Index\PageController::class, 'connect'])->name("index.connect");
Route::get('/dang-ky-kol', [\App\Http\Controllers\Index\PageController::class, 'registerByKol'])->name("index.newkol");
//Route::post('/dang-ky', [\App\Http\Controllers\Index\PageController::class, 'store'])->name("index.newkol.store");
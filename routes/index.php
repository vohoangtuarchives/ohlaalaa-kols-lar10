<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:customers')->group(function () {
    Route::get('/', [\App\Http\Controllers\Index\IndexController::class, 'index'])->name("index");
    Route::get('/ho-so', [\App\Http\Controllers\Index\ProfileController::class, 'index'])->name("profile.settings");
    Route::post('/ho-so', [\App\Http\Controllers\Index\ProfileController::class, 'update'])->name("profile.update");
    Route::get('/doi-mat-khau', [\App\Http\Controllers\Index\ProfileController::class, 'updatePassword'])->name("profile.change-password");
    Route::post('/doi-mat-khau', [\App\Http\Controllers\Index\ProfileController::class, 'storeUpdatePassword'])->name("profile.change-password.store");
    Route::get('/san-pham', [\App\Http\Controllers\Index\CampaignController::class, 'index'])->name("index.products");

    Route::post('/san-pham', [\App\Http\Controllers\Index\CampaignController::class, 'join'])->name("index.campaign.join");

    Route::get('/links', [\App\Http\Controllers\Index\LinkController::class, 'links'])->name("index.links");

});


Route::get('/ket-noi', [\App\Http\Controllers\Index\PageController::class, 'connect'])->name("index.connect");
Route::get('/dang-ky-kol', [\App\Http\Controllers\Index\PageController::class, 'registerByKol'])->name("index.newkol");
//Route::post('/dang-ky', [\App\Http\Controllers\Index\PageController::class, 'store'])->name("index.newkol.store");
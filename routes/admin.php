<?php
use Illuminate\Support\Facades\Route;
Route::get('/settings', [\App\Http\Controllers\Dashboard\SettingController::class, "show"])
    ->permission("View Settings")
    ->name("settings.index");

Route::put('/settings', [\App\Http\Controllers\Dashboard\SettingController::class, "store"])
    ->permission("Change Settings")
    ->name("settings.store");

foreach ([
             'campaign',
            'role',
            'user',
    'customer'
         ] as $keytmp) {
    $key = \Illuminate\Support\Str::plural($keytmp);

    Route::controller("\\App\\Http\\Controllers\\Dashboard\\" . ucfirst($keytmp) . "Controller")->group(function () use ($key) {
        Route::get("{$key}",'show')
            ->permission("Show ".ucfirst($key))
            ->name("{$key}.index");

        Route::get("{$key}/edit/{id}",'edit')
            ->permission("Edit ".ucfirst($key))
            ->name("{$key}.edit");
        Route::get("{$key}/create",'create')
            ->permission("Create ".ucfirst($key))
            ->name("{$key}.create");

        Route::put("{$key}/edit/{id}",'update')
            ->permission("Update ".ucfirst($key))
            ->name("{$key}.update");

        Route::put("{$key}",'store')
            ->permission("Store ".ucfirst($key))
            ->name("{$key}.store");

        Route::delete("{$key}/delete",'delete')
            ->permission("Delete ".ucfirst($key))
            ->name("{$key}.delete");
    });
}


Route::get('/register_campaigns', [\App\Http\Controllers\Dashboard\CampaignController::class, "showCampaignRegister"])
    ->permission("View Register Campaigns")
    ->name("campaigns.register.index");
//Route::get('/pay-kol', [\App\Http\Controllers\Dashboard\PaymentController::class, "index"])
//    ->permission("View Register Campaigns")
//    ->name("campaigns.register.index");
Route::post('/register_campaigns', [\App\Http\Controllers\Dashboard\CampaignController::class, "verifyPaymentCampaign"])
    ->permission("Verify Payment for Register Campaigns")
    ->name("campaigns.register.make-payment");

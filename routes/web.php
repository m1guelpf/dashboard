<?php

use App\Http\Middleware\AccessToken;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UpdateTemperatureController;
use App\Http\Controllers\UpdateIndoorAirQualityController;

Route::group(['middleware' => AccessToken::class], function () {
    Route::get('/', DashboardController::class);
});

Route::ohDearWebhooks('/oh-dear-webhooks');

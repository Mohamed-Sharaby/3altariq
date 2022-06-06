<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\NotificationController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'lang'], function () {
    Route::group(['prefix' => 'auth',], function () {
        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);
        Route::post('confirm', [AuthController::class, 'ConfirmUser']);
        Route::post('confirm/resend', [AuthController::class, 'resendConfirmation']);
        Route::post('forget-password', [AuthController::class, 'forgetPassword']);
        Route::post('forget-password/check', [AuthController::class, 'checkCode']);
        Route::post('forget-password/reset', [AuthController::class, 'resetPassword']);

        Route::group(['middleware' => 'auth:api'], function () {
            Route::get('profile', [AuthController::class, 'profile']);
            Route::put('profile', [AuthController::class, 'update']);

            Route::resources([
                'providers' => ProviderController::class,
                'orders' => OrderController::class,
                'notifications' => NotificationController::class,
            ]);
        });

    });
    Route::get('settings', SettingsController::class);
    Route::resource('reports', ReportController::class);

    Route::resources([
        'categories' => CategoryController::class,
        'banners' => BannerController::class,
        'blogs' => BlogController::class,
        'countries' => CountryController::class,
        'providers' => ProviderController::class
    ]);
    Route::post('counters/{provider}', CounterController::class);

});

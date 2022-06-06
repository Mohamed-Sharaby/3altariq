<?php

namespace App\Http\Controllers\Provider;

use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'auth'], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('confirm', [AuthController::class, 'ConfirmUser']);
    Route::post('confirm/resend', [AuthController::class, 'resendConfirmation']);
    Route::post('forget-password', [AuthController::class, 'forgetPassword']);
    Route::post('forget-password/check', [AuthController::class, 'checkCode']);
    Route::post('forget-password/reset', [AuthController::class, 'resetPassword']);

    Route::group(['middleware' => 'auth:provider'], function () {
        Route::get('profile', [AuthController::class, 'profile']);
        Route::put('profile', [AuthController::class, 'update']);
        Route::resource('notifications', NotificationController::class);
    });

});
Route::group(['middleware' => 'auth:provider'], function () {

    Route::resources([
        'verifications'=>VerificationController::class,
        'orders'=>OrderController::class
    ]);

});

<?php

namespace App\Http\Controllers\Admin;

use App\Jobs\CancelPendingOrders;
use Illuminate\Support\Facades\Route;
Route::view('terms','terms');
Route::view('privacy','privacy');
Route::group(['middleware' => ['auth:admin', 'admin'], 'as' => 'admin.'], function () {

    Route::get('/', [DashboardController::class, 'index'])->name('main');
    Route::resources([
        'roles' => RoleController::class,
        'admins' => AdminController::class,
        'users' => UserController::class,
        'banners' => BannerController::class,
        'categories' => CategoryController::class,
        'providers' => ProviderController::class,
        'reports' => ReportController::class,
        'orders' => OrderController::class,
        'settings' => SettingController::class,
        'countries' => CountryController::class,
        'blogs' => BlogController::class,
        'notifications' => NotificationController::class,
        'providers-notifications' => ProviderNotificationController::class,
        'services' => ServiceController::class,
        'verifications' => VerificationController::class
    ]);

    Route::get('user/sms', [UserController::class, 'index'])->name('users.sendSms');
    Route::get('provider/sms', [ProviderController::class, 'index'])->name('providers.sendSms');
    Route::post('active/{id}/role', [RoleController::class, 'active'])->name('active.role');
    Route::post('active/{id}/{type}', [DashboardController::class, 'active'])->name('active');
    Route::post('reviewed/{id} ', [DashboardController::class, 'reviewed'])->name('reviewed');
    Route::post('report/{id}/solve', [ReportController::class, 'solve'])->name('reports.solve');
    Route::delete('delete/photo/{id}', [DashboardController::class, 'deletePhoto'])->name('deletePhoto');
});

require __DIR__ . '/auth.php';

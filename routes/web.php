<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\MessageController;
use App\Http\Controllers\backend\ApiController;
use App\Http\Controllers\backend\ProfileController;
use App\Http\Controllers\backend\AdvocateController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Middleware\backendAuthenticationMiddleware;
use App\Http\Controllers\backend\AuthenticationController;

Route::redirect('/', 'login');
// backend 
Route::match(['get', 'post'], 'login', [AuthenticationController::class, 'login'])->name('login');
// route prefix
Route::prefix('admin')->group(function () {
    // route name prefix
    Route::name('admin.')->group(function () {
        //middleware
        Route::middleware(backendAuthenticationMiddleware::class)->group(function () {
            Route::get('logout', [AuthenticationController::class, 'logout'])->name('logout');
            //profile
            Route::get('profile', [ProfileController::class, 'profile'])->name('profile');
            Route::post('profile-info/update', [ProfileController::class, 'profile_info_update'])->name('profile.info.update');
            Route::post('profile-password/update', [ProfileController::class, 'profile_password_update'])->name('profile.password.update');
            //dashboard
            Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
            //advocates
            Route::match(['get','post'],'advocate/add',[AdvocateController::class,'advocate_add'])->name('advocate.add');
            Route::match(['get','post'],'advocate/edit/{id}',[AdvocateController::class,'advocate_edit'])->name('advocate.edit');
            Route::get('advocate/list',[AdvocateController::class,'advocate_list'])->name('advocate.list');
            Route::get('advocate/delete/{id}',[AdvocateController::class,'advocate_delete'])->name('advocate.delete');


            //Message
            Route::match(['get','post'],'message/add',[MessageController::class, 'message_add'])->name('message.add');
            Route::match(['get','post'],'message/edit/{id}',[MessageController::class, 'message_edit'])->name('message.edit');
            Route::get('message/list',[MessageController::class, 'message_list'])->name('message.list');
            Route::get('message/delete/{id}',[MessageController::class, 'message_delete'])->name('message.delete');

           
        });
    });
});

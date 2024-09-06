<?php

use App\Http\Controllers\Admin\{AdminController,DashboardController,MastersController};
use Illuminate\Support\Facades\Route;

Route::group(['prefix' =>'admin','as' => 'admin.'],function(){
    //Auth Routes
    Route::get('/login', [AdminController::class,'index'])->name('login');
    Route::post('/login',[AdminController::class,'login'])->name('login.post');

    Route::group(['middleware' => 'Admin-Auth'], function(){

        Route::get('dashboard', [AdminController::class,'dashboard'])->name('dashboard');

        Route::group(['prefix' => 'masters' , 'as' => 'masters.'],function(){
            // Default Pricing Routes
            Route::get('/price', [MastersController::class,'DefaultPrice'])->name('price');
            Route::post('/price', [MastersController::class,'DefaultPriceSubmit'])->name('price.submit');
            Route::get('/pricestatus/{id}', [MastersController::class,'DefaultPriceStatus'])->name('price.status');
            Route::post('/editprice', [MastersController::class,'DefaultPriceEdit'])->name('editprice.submit');
            Route::delete('/pricedelete', [MastersController::class,'DefaultPriceDelete'])->name('price.delete');
            
            // Default Plan Routes
            Route::get('/plan', [MastersController::class,'DefaultPlan'])->name('plan');
            Route::post('/plan', [MastersController::class,'DefaultPlanSubmit'])->name('plan.submit');
            Route::get('/planstatus/{id}', [MastersController::class,'DefaultPlanStatus'])->name('plan.status');
            Route::post('/editplan', [MastersController::class,'DefaultPlanEdit'])->name('editplan.submit');
            Route::delete('/plandelete', [MastersController::class,'DefaultPlanDelete'])->name('plan.delete');

            // Default Service Routes
            Route::get('/service', [MastersController::class,'DefaultService'])->name('service');
            Route::post('/service', [MastersController::class,'DefaultServiceSubmit'])->name('service.submit');
            Route::get('/servicestatus/{id}', [MastersController::class,'DefaultServiceStatus'])->name('service.status');
            Route::post('/editservice', [MastersController::class,'DefaultServiceEdit'])->name('editservice.submit');
            Route::delete('/servicedelete', [MastersController::class,'DefaultServiceDelete'])->name('service.delete');

            // Gifts Routes
            Route::get('/gift', [MastersController::class,'DefaultGift'])->name('gift');
            Route::post('/gift', [MastersController::class,'DefaultGiftSubmit'])->name('gift.submit');
            Route::get('/giftstatus/{id}', [MastersController::class,'DefaultGiftStatus'])->name('gift.status');
            Route::post('/editgift', [MastersController::class,'DefaultGiftEdit'])->name('editgift.submit');
            Route::delete('/giftdelete', [MastersController::class,'DefaultGiftDelete'])->name('gift.delete');
        });

        Route::group(['prefix' => 'influncers' , 'as' => 'influncers.'],function(){
            Route::get('influencer', [AdminController::class,'influencer'])->name('influencer');
        });

        Route::group(['prefix' => 'users' , 'as' => 'users.'],function(){
            Route::get('user-list', [AdminController::class,'user_list'])->name('user-list');
        });

        Route::group(['prefix' => 'payments' , 'as' => 'payments.'],function(){
            
        });

        Route::group(['prefix' => 'transactions' , 'as' => 'transactions.'],function(){
            
        });

        Route::group(['prefix' => 'business-setup' , 'as' => 'business-setup.'],function(){
            
        });
    });

});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\user\UserController;
use App\Http\Controllers\user\ChatController;

use App\Models\User;
use App\Http\Middleware\UserLoginMiddleware;

Route::prefix('app')->group(function () {
    Route::get('/{user:username}/send-message',[UserController::class,'sendMessage'])->name('send-message');
    //Route::get('/{influencer:username}', [UserController::class, 'index']);
    Route::get('/{user:username}/', [UserController::class, 'index'])->name('user.home');
    Route::get('/{user:username}/exclusive', [UserController::class, 'exclusive'])->name('user.post.exclusive');
    Route::get('/{user:username}/prime', [UserController::class, 'prime'])->name('user.post.prime');
    Route::get('/{user:username}/login', [UserController::class, 'login'])->name('user.login');
    Route::post('/{user:username}/login', [UserController::class, 'login_post'])->name('user.login.post');
    Route::get('/{user:username}/verify-login', [UserController::class, 'login_verify'])->name('user.login.verify.otp');
    Route::post('/{user:username}/verify-login-post', [UserController::class, 'login_verify_post'])->name('user.login.verify.post');
    
    
    Route::get('/{user:username}/logout', [UserController::class, 'logout'])->name('user.logout');

    
    Route::get('/{user:username}/register', [UserController::class, 'register'])->name('user.register');
    Route::post('/{user:username}/register', [UserController::class, 'register_post'])->name('user.register.post');
    Route::get('/{user:username}/verifyotp', [UserController::class, 'verifyotp'])->name('user.verify.otp');
    Route::post('/{user:username}/verifyotp', [UserController::class, 'verifyotp_submit'])->name('user.verify.post');
    // Other routes...
    Route::group(['middleware' => UserLoginMiddleware::class],function(){
        Route::get('/{user:username}/wallet', [UserController::class, 'wallet'])->name('user.wallet');
        Route::post('/{user:username}/wallet', [UserController::class, 'wallet_add'])->name('user.wallet.add');
        
        Route::get('/{user:username}/plan/view/{id}', [UserController::class, 'plan_view'])->name('user.plan.view');
        Route::get('/{user:username}/plan/buy/{id}',[UserController::class, 'plan_buy'])->name('user.plan.buy');
        Route::get('/{user:username}/post/view/{id}', [UserController::class, 'post_view'])->name('user.post.view');
        Route::get('/{user:username}/post/unlock/{id}', [UserController::class, 'post_unlock'])->name('user.post.unlock');
        Route::post('/{user:username}/user-send-message',[ChatController::class,'sendMessage'])->name('user.send.message');
        Route::post('/{user:username}/user-send-gift-message',[ChatController::class,'sendGiftMessage'])->name('user.send.gift.message');
        Route::get('/{user:username}/chat', [ChatController::class, 'index'])->name('user.chat');
        Route::get('/{user:username}/check-for-message',[ChatController::class, 'checkBalance'])->name('user.send.message.check');
        Route::get('/{user:username}/view-stream',[ChatController::class, 'viewStream'])->name('user.view-stream');
        Route::get('/{user:username}/token-store',[UserController::class,'storeToken'])->name('fcm.token.store');
        Route::post('/{user:username}/service-book',[UserController::class,'service_book'])->name('user.service.book');

    });
});

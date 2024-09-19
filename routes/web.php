<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\InfluencerMiddleware;


//login
Route::get('influencer-login', function () {
    return view('influencer.login_pages.login');
})->name('influencer.login');
Route::post('influencer-login', [App\Http\Controllers\influencer\LoginController::class,'login'])->name('influencer.login');
Route::get('influencer-login-verify-otp', [App\Http\Controllers\influencer\LoginController::class,'verify_log_otp'])->name('influencer.login.verify.otp');
Route::get('influencer-logout',[App\Http\Controllers\influencer\LoginController::class,'logout'])->name('influencer.logout');
Route::post('influencer-login-verify-otp', [App\Http\Controllers\influencer\LoginController::class,'verify_log_otp_post'])->name('influencer.login.verify.otp.post');
// registration
Route::get('influencer-register', function () {
    return view('influencer.login_pages.signup');
})->name('influencer.signup');

Route::post('influencer-register', [App\Http\Controllers\influencer\LoginController::class,'register'])->name('influencer.signup.post');
Route::get('influencer-verify-otp', [App\Http\Controllers\influencer\LoginController::class,'verify_otp'])->name('influencer.verify.otp');
Route::post('influencer-verify-otp', [App\Http\Controllers\influencer\LoginController::class,'verify_otp_post'])->name('influencer.verify.otp.post');
Route::get('influencer-define-yourself', [App\Http\Controllers\influencer\LoginController::class,'define_yourself'])->name('influencer.define.yourself');
Route::get('infinfluencer-submit-category/{num}',[App\Http\Controllers\influencer\LoginController::class,'define_yourself_post'])->name('influencer.define.yourself.post');

// after login
Route::group(['prefix' => 'influencer','as' => 'influencer.','middleware' => InfluencerMiddleware::class],function(){
    route::get('home',[App\Http\Controllers\influencer\HomeController::class,'home'])->name('home');
    // profile section 
    route::get('profile',[App\Http\Controllers\influencer\HomeController::class,'profile'])->name('profile');
    route::get('profile-edit',[App\Http\Controllers\influencer\HomeController::class,'profile_edit'])->name('profile.edit');
    route::post('profile-edit',[App\Http\Controllers\influencer\HomeController::class,'profile_edit_post'])->name('profile.edit.post');
    route::post('profile-cover-post',[App\Http\Controllers\influencer\HomeController::class,'profile_cover_post'])->name('profile.cover.post');
    route::post('profile-avator-post',[App\Http\Controllers\influencer\HomeController::class,'profile_avator_post'])->name('profile.avator.post');
    Route::get('profile-preview',[App\Http\Controllers\influencer\HomeController::class,'profile_preview'])->name('profile.preview');
    //services section
    route::get('service',[App\Http\Controllers\influencer\ServiceController::class,'index'])->name('services');
    route::post('service-name-update',[App\Http\Controllers\influencer\ServiceController::class,'service_name_update'])->name('services.name.post');
    route::post('service-influencer-update',[App\Http\Controllers\influencer\ServiceController::class,'service_influencer_update'])->name('services.influencer.post');
    route::post('service-influencer-create',[App\Http\Controllers\influencer\ServiceController::class,'service_influencer_create'])->name('services.influencer.create');
    //member ship
    route::get('membership',[App\Http\Controllers\influencer\MembershipController::class,'index'])->name('membership');
    route::post('membership-name-update',[App\Http\Controllers\influencer\MembershipController::class,'membership_name_update'])->name('membership.name.post');
    Route::post('membership-create',[App\Http\Controllers\influencer\MembershipController::class,'membership_submit'])->name('membership.create');
    Route::post('membership-edit',[App\Http\Controllers\influencer\MembershipController::class,'membership_update'])->name('membership.edit');
    //post
    Route::get('post/{type}',[App\Http\Controllers\influencer\PostController::class,'view'])->name('post');
    Route::post('post',[App\Http\Controllers\influencer\PostController::class,'index'])->name('post.submit');
    //
    Route::get('success-uploaded',function(){
        return view('influencer.success');
    })->name('success.page');
});

require "Admin.php";

 

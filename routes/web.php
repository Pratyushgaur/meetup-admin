<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\InfluencerMiddleware;
use App\Models\User;
use Illuminate\Http\Request;


//login
Route::get('influencer-login', function () {
    return view('influencer.login_pages.login');
})->name('influencer.login');
Route::post('influencer-login', [App\Http\Controllers\influencer\LoginController::class,'login'])->name('influencer.login');
Route::get('influencer-login-verify-otp', [App\Http\Controllers\influencer\LoginController::class,'verify_log_otp'])->name('influencer.login.verify.otp');
Route::get('influencer-logout',[App\Http\Controllers\influencer\LoginController::class,'logout'])->name('influencer.logout');
Route::post('influencer-login-verify-otp', [App\Http\Controllers\influencer\LoginController::class,'verify_log_otp_post'])->name('influencer.login.verify.otp.post');
Route::post('check-username',[App\Http\Controllers\influencer\LoginController::class,'check_username'])->name('influencer.checkUsername');
// registration
Route::get('influencer-register', function () {
    return view('influencer.login_pages.signup');
})->name('influencer.signup');

Route::post('influencer-register', [App\Http\Controllers\influencer\LoginController::class,'register'])->name('influencer.signup.post');
Route::get('influencer-verify-otp', [App\Http\Controllers\influencer\LoginController::class,'verify_otp'])->name('influencer.verify.otp');
Route::post('influencer-verify-otp', [App\Http\Controllers\influencer\LoginController::class,'verify_otp_post'])->name('influencer.verify.otp.post');
Route::get('influencer-define-yourself', [App\Http\Controllers\influencer\LoginController::class,'define_yourself'])->name('influencer.define.yourself');
Route::get('infinfluencer-submit-category/{num}',[App\Http\Controllers\influencer\LoginController::class,'define_yourself_post'])->name('influencer.define.yourself.post');
// Route::get('influencer/{user:username}/', [App\Http\Controllers\influencer\HomeController::class, 'show']);;
// after login
Route::group(['prefix' => 'influencer','as' => 'influencer.','middleware' => InfluencerMiddleware::class],function(){
    Route::get('home',[App\Http\Controllers\influencer\HomeController::class,'home'])->name('home');
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
    //links 
    route::get('links',[App\Http\Controllers\influencer\LinksController::class,'index'])->name('links');
    route::post('links',[App\Http\Controllers\influencer\LinksController::class,'save'])->name('links.post');
    route::get('links/delete/{id}',[App\Http\Controllers\influencer\LinksController::class,'delete'])->name('link.delete');

    //post
    Route::get('post/{type}',[App\Http\Controllers\influencer\PostController::class,'view'])->name('post');
    Route::post('post',[App\Http\Controllers\influencer\PostController::class,'index'])->name('post.submit');
    Route::post('videopost',[App\Http\Controllers\influencer\PostController::class,'video_post'])->name('video.post.submit');
    //orders 
    Route::get('orders',[App\Http\Controllers\influencer\OrderController::class,'history'])->name('orders.history');
    Route::get('orders-pending',[App\Http\Controllers\influencer\OrderController::class,'pending'])->name('orders.pending');

    //settings
    Route::get('payout-setting',[App\Http\Controllers\influencer\SettingController::class,'payout_setting'])->name('payout.setting');
    Route::post('payout-setting',[App\Http\Controllers\influencer\SettingController::class,'payout_setting_post'])->name('payout.setting.post');
    Route::post('payout-doc-submit',[App\Http\Controllers\influencer\SettingController::class,'payout_setting_doc_post'])->name('payout.setting.post.doc');
    // notification
    Route::get('notification',[App\Http\Controllers\influencer\NotificationController::class,'index'])->name('notification');
    Route::get('send-notification',[App\Http\Controllers\influencer\NotificationController::class,'send'])->name('notification.send');
    //charts
    Route::get('insights',[App\Http\Controllers\influencer\HomeController::class,'insights'])->name('insights');
    //chat
    Route::get('inbox',[App\Http\Controllers\influencer\ChatController::class,'index'])->name('chat.inbox');
    Route::get('chat-list/{id}',[App\Http\Controllers\influencer\ChatController::class,'chatList'])->name('chat.list');
    Route::post('send-message',[App\Http\Controllers\influencer\ChatController::class,'sendMessage'])->name('send.message');
    Route::post('per-msg-price-set',[App\Http\Controllers\influencer\ChatController::class,'UpdatePerMsgPrice'])->name('perMsgPrice.update');
    Route::post('custom-user-message-price-update/{id}',[App\Http\Controllers\influencer\ChatController::class,'UpdateUserPerMsgPrice'])->name('messagePrice.update');
    // video call
    Route::get('usre-videocall-generate',[App\Http\Controllers\influencer\ChatController::class,'generateVideoCall'])->name('chat.generateCall');
    //
    Route::post('send-audio-chat',[App\Http\Controllers\influencer\ChatController::class,'sendAudio'])->name('send.audio');
    // live streaming 
    Route::post('create-stream',[App\Http\Controllers\influencer\HomeController::class,'create_stream'])->name('stream.create');    

    Route::get('success-uploaded',function(){
        return view('influencer.success');
    })->name('success.page');
});

//  video cal route for usre and influancer 
Route::get('make-call/{id}/{usertype}',[App\Http\Controllers\VideoCallController::class,'makeVideoCall'])->name('makecall');
Route::get('live-stream/{id}/{usertype}',[App\Http\Controllers\VideoCallController::class,'makeLiveStream'])->name('video_stream');
Route::get("update-user/{id}",[App\Http\Controllers\VideoCallController::class,'endLiveStream']);
// 

Route::get('videocall',function(){
    return view('videoskd');
});



require "Admin.php";
require "user.php";


Route::get('/video-call', function () {
    return view('video-call');
});
Route::get('socket',function(){
    return view("socket");
});



 

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    AdminController,
    InfluncerController,
    MastersController,
    UserController,
    BusinessSettingController,
    PaymentController,
    transactionController
};



Route::group(['prefix' =>'admin','as' => 'admin.'],function(){
    //Auth Routes
    Route::get('/login', [AdminController::class,'index'])->name('login');
    Route::post('/login',[AdminController::class,'login'])->name('login.post');

    Route::group(['middleware' => 'Admin-Auth'], function(){

        Route::get('dashboard', [AdminController::class,'dashboard'])->name('dashboard');
        Route::get('logout', [AdminController::class,'logout'])->name('logout');

        Route::group(['prefix' => 'profile' , 'as' => 'profile.'],function(){
            // Admin Profile Routes
            Route::get('/profile', [AdminController::class,'profile'])->name('profile');
            Route::post('/profile', [AdminController::class,'ProfileSubmit'])->name('profileSubmit');
            Route::post('/profile/Password', [AdminController::class,'ProfilepasswordSubmit'])->name('profilepasswordSubmit');
            Route::get('/pricestatus/{id}', [AdminController::class,'DefaultPriceStatus'])->name('price.status');
            Route::post('/editprofile', [AdminController::class,'DefaultPriceEdit'])->name('editprice.submit');
            Route::delete('/pricedelete', [AdminController::class,'DefaultPriceDelete'])->name('price.delete');
        });

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

            // Category Routes
            Route::get('/category', [MastersController::class,'Category'])->name('category');
            Route::post('/category', [MastersController::class,'CategorySubmit'])->name('category.submit');
            Route::get('/categorystatus/{id}', [MastersController::class,'CategoryStatus'])->name('category.status');
            Route::post('/editcategory', [MastersController::class,'CategoryEdit'])->name('editcategory.submit');
            Route::delete('/categorydelete', [MastersController::class,'CategoryDelete'])->name('category.delete');
        });

        Route::group(['prefix' => 'influncers' , 'as' => 'influncers.'], function(){
            // Influncer Analysis Routes
            Route::get('list', [InfluncerController::class,'List'])->name('list');
            Route::post('list', [InfluncerController::class,'List_edit_submit'])->name('list.edit.submit');
            Route::get('/status/{id}', [InfluncerController::class,'InfluncerStatus'])->name('status');

            Route::get('posts/{id}', [InfluncerController::class,'InfluncerPostView'])->name('post.view');
            Route::get('/post/status/{id}', [InfluncerController::class,'InfluncerPostStatus'])->name('post.status');

            Route::get('pending-order', [InfluncerController::class,'PendingOrders'])->name('pending.order');
            Route::get('orders/view/{id}', [InfluncerController::class,'PendingOrdersView'])->name('pending.order.view');
            Route::get('kyc-verification', [InfluncerController::class,'KYCVerification'])->name('kyc.verification');
            Route::get('kyc/view/{id}', [InfluncerController::class,'KYCVerificationView'])->name('kyc.verification.view');
            Route::post('kyc/view/{id}', [InfluncerController::class,'KYCVerificationViewSubmit'])->name('kyc.verification.view.submit');
        });

        Route::group(['prefix' => 'users' , 'as' => 'users.'],function(){
            // User Analysis Routes
            Route::get('list', [UserController::class,'UserList'])->name('list');
            Route::get('/status/{id}', [UserController::class,'UserStatus'])->name('status');

        });

        Route::group(['prefix' => 'payments' , 'as' => 'payments.'],function(){
            Route::get('UnSettlements', [PaymentController::class,'paymentUnSettlements'])->name('unsettlements');
            Route::get('Settlements', [PaymentController::class,'paymentSettlements'])->name('settlements');
            
        });

        Route::group(['prefix' => 'transactions' , 'as' => 'transactions.'],function(){
            Route::get('Userlist', [transactionController::class,'transactionUserList'])->name('Userlist');
            Route::get('influncerlist', [transactionController::class,'transactionInfluncerList'])->name('influncerlist');
            
        });

        Route::group(['prefix' => 'business-setup' , 'as' => 'business-setup.'],function(){
            // Business Settings Routes
            Route::get('term-condition', [BusinessSettingController::class,'TermCondition'])->name('term.condition');
            Route::post('term-condition', [BusinessSettingController::class,'TermConditionSubmit'])->name('term.condition.submit');

            Route::get('privacy-policy', [BusinessSettingController::class,'PrivacyPolicy'])->name('privacy.policy');
            Route::post('privacy-policy', [BusinessSettingController::class,'PrivacyPolicySubmit'])->name('privacy.policy.submit');

            Route::get('company-setup', [BusinessSettingController::class,'CompanySetup'])->name('company.setup');
            Route::post('company-setup', [BusinessSettingController::class,'CompanySetupSubmit'])->name('company.setup.submit');

            Route::get('commission-setup', [BusinessSettingController::class,'CommissionSetup'])->name('commission.setup');
            Route::post('commission-setup', [BusinessSettingController::class,'CommissionSetupSubmit'])->name('commission.setup.submit');

            Route::get('send-notification', [BusinessSettingController::class,'SendNotification'])->name('send.notification');
            Route::post('send-notification', [BusinessSettingController::class,'SendNotificationSubmit'])->name('send.notification.submit');
            Route::post('send-notification/key', [BusinessSettingController::class,'SendNotificationKeySubmit'])->name('send.notificationkey.submit');

            Route::post('/send-notification-edit', [BusinessSettingController::class,'SendNotificationEdit'])->name('edit.send.notification.submit');
            Route::delete('/send-notification-delete', [BusinessSettingController::class,'SendNotificationDelete'])->name('send.notification.delete');

        });
    });
    Route::get('test', function() {
        dd(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'] , Helpers_get_previous_months());
    });
});

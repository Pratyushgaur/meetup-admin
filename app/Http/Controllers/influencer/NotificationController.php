<?php

namespace App\Http\Controllers\influencer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    //

    function index(){
        return view('influencer.notification.index');
    }
    function send(){
        return view('influencer.notification.notification_setting');
    }
}

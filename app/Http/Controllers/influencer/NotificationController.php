<?php

namespace App\Http\Controllers\influencer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    //

    function index(){
        $notification = \App\Models\Notification::where('user_id','=',auth()->user()->id)->orderBy('id','desc')->get();
        \App\Models\Notification::where('user_id','=',auth()->user()->id)->update(['is_read' => '1']);
        return view('influencer.notification.index',compact('notification'));
    }
    function send(){
        return view('influencer.notification.notification_setting');
    }
}

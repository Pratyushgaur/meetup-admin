<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Auth;
class VideoCallController extends Controller
{
    function makeVideoCall($token,$usertype){
        $id = Crypt::decryptString($token);
        $videCall = \App\Models\VideoCall::where('token','=',$token)->firstOrFail();
        if($usertype == "sender"){
            if(!Auth::check()){
                return redirect()->back();
            }
            if($videCall->sender != Auth::id()){
                return redirect()->back();
            }
        }else{
            if(!Auth::guard('customer')->check()){
                return redirect()->back();
            }
            if($videCall->receiver != Auth::guard('customer')->user()->id){
                return redirect()->back();
            }
        }
        
        $url = route('makecall',[$token,'receiver']);

        $senderData = \App\Models\User::where('id','=',$videCall->sender)->first();
        $receiverData = \App\Models\User::where('id','=',$videCall->receiver)->first();
        
        return view('influencer.chat.make_videocall',compact('usertype','url','senderData','receiverData'));

        
    }
}

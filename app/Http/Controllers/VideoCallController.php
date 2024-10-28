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
            $uuid = Auth::id();
        }else{
            if(!Auth::guard('customer')->check()){
                return redirect()->back();
            }
            if($videCall->receiver != Auth::guard('customer')->user()->id){
                return redirect()->back();
            }
            $uuid = Auth::guard('customer')->user()->id;
        }
        
        $url = route('makecall',[$token,'receiver']);
        $agoratoken = $videCall->agora_token;
        $senderData = \App\Models\User::where('id','=',$videCall->sender)->first();
        $receiverData = \App\Models\User::where('id','=',$videCall->receiver)->first();
        
        return view('influencer.chat.make_videocall',compact('usertype','url','senderData','receiverData','agoratoken','uuid'));

        
    }
    function makeLiveStream($encid,$usertype)  {
        $id = Crypt::decryptString($encid);
        $videCall = \App\Models\LiveStream::where('id','=',$id)->firstOrFail();
        
        if($usertype == "sender"){
            
            if(!Auth::check()){
                return redirect()->back();
            }
            
            if($videCall->user_id != Auth::id()){
                return redirect()->back();
            }
            $uuid = Auth::id();
        }else{
            if(!Auth::guard('customer')->check()){
                return redirect()->back();
            }
           
            $uuid = Auth::guard('customer')->user()->id;
        }
        $agoraToken = $videCall->token;
        $streamStatus = $videCall->is_end;
        $is_paid = ($videCall->price > 0) ? "1" : "0";
        $price = $videCall->price;

        return view('influencer.chat.live-stream',compact('agoraToken','usertype','uuid','id','streamStatus','is_paid','price'));

    }
    function checkUserForLivestream(Request $request){
        $request->validate([
            'user_id' =>'required',
            'streamId' =>'required',
        ]);
       
        $user = \App\Models\User::where('id','=',$request->user_id)->first();
        $isBuy = \App\Models\SubscribeLiveStream::where('user_id','=',$request->user_id)->where('stream_id','=',$request->streamId)->exists();
        
        if($isBuy){
            echo json_encode(array('success' => 1,'error' => 0 ,'message' => 'success'));
        }else{
            $stream = \App\Models\LiveStream::where('id','=',$request->streamId)->firstOrFail();
            if($user->balance >= $stream->price ){
                \App\Models\SubscribeLiveStream::buyStream($user ,$stream);
                echo json_encode(array('success' => 1,'error' => 0 ,'message' => 'success'));
            }else{
                echo json_encode(array('success' => 0,'error' => 1 ,'message' => 'Insufficient Balance'));

            }
        }

    }
    function endLiveStream($id){
        \App\Models\User::where('id','=',$id)->update([
            'is_live' => "0"
        ]);
        \App\Models\LiveStream::where('user_id','=',$id)->update([
            'is_end' => "1"
        ]);
        
    }
}

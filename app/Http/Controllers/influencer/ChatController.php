<?php

namespace App\Http\Controllers\influencer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\InfluencerInbox;
use App\Models\Price;
use App\Models\User;
use App\Services\AgoraTokenService;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Events\MessageSent;
use App\Events\MessageSetup;

class ChatController extends Controller
{
    function index(){
        $list = InfluencerInbox::where('influencer_id',\Auth::id())->join('users','influencer_inboxes.user_id','=','users.id')->select('name','users.id')->get();
        $price = Price::get();
        return view('influencer.chat.inbox',compact('list','price'));
    }
    function chatList($id){
        try {
            // Decrypt the encrypted ID
            $id = Crypt::decryptString($id);
            
            $chatlist = \App\Models\Chat::where(['sender' => \Auth::id(),'receiver' => $id])->orWhere(['sender' => $id,'receiver' =>\Auth::id() ])->orderBy('id','ASC')->get();
            
            $userdata = \App\Models\User::where('id','=',$id)->first();
            

            $walletBalance = User::leftJoin('custom_user_msg_prices', function($join) use ($id) {
                                $join->on('users.id', '=', 'custom_user_msg_prices.influencer_id')
                                ->where('custom_user_msg_prices.user_id', '=', $id); 
                            })->where('users.id' ,'=',\Auth::id())
                            ->select(
                                \DB::raw('COALESCE(custom_user_msg_prices.price, users.per_msg_charge) as messagePrice')
                            )->first();
            return view('influencer.chat.chat',compact('userdata','userdata','walletBalance','chatlist'));

        } catch (DecryptException $e) {
            abort(404, 'Invalid encrypted ID');
        }

        
    }
    

    function generateVideoCall(Request $request){
        $check = \DB::table('user_socket_ids')->where('userid','=',$request->id)->exists();
        if($check){
            $tokenService = new AgoraTokenService;
            $token = $tokenService->generateToken("video-test",0,1);
            
            $video = new \App\Models\VideoCall;
            $video->sender = \Auth::id();
            $video->receiver = $request->id;
            $video->agora_token  = $token;
            $video->save();
            $id = $video->id;
            $video->token = Crypt::encryptString($id);
            $video->save();

            echo json_encode(array('is_online' => true,'url' =>  route('makecall',[$video->token,'sender'])));
        }else{  
            echo json_encode(array('is_online' => false));
        }
    }
    function sendMessage(Request $request){
        try{
            $request->validate([
                'message' => 'required',
                'receiver' => 'required',
            ]);
            $message = $request->message;
            $receiver = $request->receiver;
           
            $data = [
                "sender" => \Auth::id(),
                "receiver" => $receiver,
                'message' => $request->message,
                'message_cost' => 1,
                
            ]; 
            \App\Models\Chat::insert($data);
            \App\Models\InfluencerInbox::firstOrCreate([
                'influencer_id' => \Auth::id(),
                'user_id' => $receiver
            ]);
            echo json_encode(array('success' => 1 ,'message' => 'success'));
        }catch(\Exception $e){
            
            echo json_encode(array('success' => 0 ,'message' => $e->getMessage()));
        }
        

    }
    function sendAudio(Request $request){
        try{
            $request->validate([
                'audioFile' => 'required',
                'receiver' => 'required',
            ]);
            if ($request->hasFile('audioFile')) {
                $file = $request->file('audioFile');
                $filename = time().rand(1000,9999).\Auth::id() . '_audio.wav';  // Generate a unique filename
                $filePath = 'chat-audio/';  // Folder to store audio files
        
                // Store the audio file
                $file->move(public_path($filePath), $filename);
                //
               
                $receiver = $request->receiver;
            
                $data = [
                    "sender" => \Auth::id(),
                    "receiver" => $receiver,
                    'message' => "-",
                    'message_cost' => 1,
                    'message_type' => 'audio',
                    'message_file_path' => $filename,
                    
                ]; 
                \App\Models\Chat::insert($data);
                \App\Models\InfluencerInbox::firstOrCreate([
                    'influencer_id' => \Auth::id(),
                    'user_id' => $receiver
                ]);
               
            } else {
                return response()->json(['error' => 'No audio file provided'], 400);
            }
            
            echo json_encode(array('success' => 1 ,'message' => 'success'));
        }catch(\Exception $e){
            
            echo json_encode(array('success' => 0 ,'message' => $e->getMessage()));
        }
    }
    function UpdatePerMsgPrice(Request $request){
        try{
            $request->validate([
                'price' => 'required|numeric'
            ]);
            $message = $request->price;
            \App\Models\User::where('id','=',\Auth::id())->update(['per_msg_charge' => $message]);
            echo json_encode(array('success' => 1 ,'message' => 'Price Changed success'));
        }catch(\Exception $e){
            
            echo json_encode(array('success' => 0 ,'message' => $e->getMessage()));
        }
        


    }
    function UpdateUserPerMsgPrice(Request $request,$userId)  {
        $request->validate([
            'amount' => 'required|numeric'
        ]);
        \App\Models\CustomUserMsgPrice::updateOrCreate(
            [
                'user_id' => $userId,
                'influencer_id' => \Auth::id()
            ],

            [
                'user_id' => $userId,
                'influencer_id' => \Auth::id(),
                'price' =>$request->amount
            ]
            
        );
        return redirect()->back();

    }
}

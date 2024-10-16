<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Events\MessageSent;
use App\Events\MessageSetup;
use Illuminate\Support\Facades\File;


class ChatController extends Controller
{
    function index(User $user){
        $list = \App\Models\Chat::where(['sender' =>auth()->guard('customer')->user()->id,'receiver' => $user->id])->orWhere(['sender' =>$user->id,'receiver' => auth()->guard('customer')->user()->id])->orderBy('id','desc')->limit(50)->get();
        $list =  $list->reverse();
        $spent = \App\Models\Chat::where(['sender' =>auth()->guard('customer')->user()->id,'receiver' => $user->id])->sum('message_cost');
        $girf = \App\Models\Gift::get();
        return view('user.chat',compact('list','spent','girf'));
    }
    function sendMessage(User $user ,Request $request){
        try{
            $request->validate([
                'message' => 'required'
            ]);
            $message = $request->message;
            $walletBalance = User::leftJoin('custom_user_msg_prices', function($join) use ($user) {
                $join->on('users.id', '=', 'custom_user_msg_prices.influencer_id')
                ->where('custom_user_msg_prices.user_id', '=', auth()->guard('customer')->user()->id); 
                })->where('users.id' ,'=',$user->id)
            ->select(
                \DB::raw('COALESCE(custom_user_msg_prices.price, users.per_msg_charge) as messagePrice')
            )->first();
            $data = [
                "sender" => auth()->guard('customer')->user()->id,
                "receiver" => $user->id,
                'message' => $request->message,
                'message_cost' => $walletBalance->messagePrice,
                'type' => 'message'
            ]; 

            \App\Models\Chat::CreateChat($data);

            MessageSent::dispatch($data);
            MessageSetup::dispatch($data);
            
            //\App\Models\Chat::insert($data);
            \App\Models\InfluencerInbox::firstOrCreate([
                'influencer_id' => $user->id,
                'user_id' => auth()->guard('customer')->user()->id
            ]);
            echo json_encode(array('success' => 1 ,'message' => 'success'));
        }catch(\Exception $e){
            
            echo json_encode(array('success' => 0 ,'message' => $e->getMessage()));
        }
        

    }
    function sendGiftMessage(User $user ,Request $request){
        try{
            $request->validate([
                'giftId' => 'required'
            ]);
            $giftId = $request->giftId;
            $gift = \App\Models\Gift::where("id",'=',$request->giftId)->firstOrFail();
            
            
            $data = [
                "sender" => auth()->guard('customer')->user()->id,
                "receiver" => $user->id,
                'message' => '-',
                'message_cost' => $gift->price,
                'type' => 'gift',
                'gift_id' => $request->giftId
                
            ]; 
            $response = \App\Models\Chat::CreateChat($data);
            $data['image'] = \URL::TO('/').'/chat_files/'.$response;
            
            //$sendData = json_encode($data);
            

            MessageSent::dispatch($data);
            MessageSetup::dispatch($data);
            
            //\App\Models\Chat::insert($data);
            \App\Models\InfluencerInbox::firstOrCreate([
                'influencer_id' => $user->id,
                'user_id' => auth()->guard('customer')->user()->id
            ]);
            echo json_encode(array('success' => 1 ,'message' => 'success'));
        }catch(\Exception $e){
            
            echo json_encode(array('success' => 0 ,'message' => $e->getMessage()));
        }
    }
    function getBase64($path){
        if (!File::exists($path)) {
            return response()->json(['error' => 'File not found.'], 404);
        }
    
        // Get the file content
        $fileContent = File::get($path);
        
        // Get the file's MIME type
        $mimeType = File::mimeType($path);
        
        // Encode the file content to Base64
        return $base64String = 'data:' . $mimeType . ';base64,' . base64_encode($fileContent);
    
        
    }
    function checkBalance(User $user ,Request $request){
        if($request->has('type')){
            $user = User::where('id','=',auth()->guard('customer')->user()->id)->select('balance')->first();
            $gift = \App\Models\Gift::where("id",'=',$request->giftid)->first();
            if($user->balance >= $gift->price){
                echo "yes";
            }else{
                echo "no";
            }
            

        }else{
            $walletBalance = User::leftJoin('custom_user_msg_prices', function($join) use ($user) {
                $join->on('users.id', '=', 'custom_user_msg_prices.influencer_id')
                ->where('custom_user_msg_prices.user_id', '=', auth()->guard('customer')->user()->id); 
                })->where('users.id' ,'=',$user->id)
            ->select(
                \DB::raw('COALESCE(custom_user_msg_prices.price, users.per_msg_charge) as messagePrice')
            )->first();
            
            echo  (auth()->guard('customer')->user()->balance >=$walletBalance->messagePrice) ? "yes" : "no" ; 
            


        }
        
    }

    
}

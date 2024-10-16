<?php

namespace App\Http\Controllers\influencer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\InfluencerInbox;
use App\Models\Price;
use App\Models\User;

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
            //\App\Models\Chat::CreateChat($data);
            MessageSent::dispatch($data);
            //MessageSetup::dispatch($data);
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

<?php

namespace App\Listeners;

use App\Events\MessageSetup;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\File;

class MessageSetupListner
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(MessageSetup $event): void
    {
        
        
        \App\Models\User::where('id' ,'=' ,auth()->guard('customer')->user()->id)->update([
            'balance' => auth()->guard('customer')->user()->balance-$event->messageData['message_cost']
        ]);
        if($event->messageData['type']  == 'message'){
            $transction= \App\Models\UserWalletTrasaction::where('influencer_id','=',$event->messageData['receiver'])->where('user_id','=',$event->messageData['sender'])->whereDate('created_at','=', \Carbon\Carbon::today()->toDateString())->where('transction_title','=','Chat');
            if($transction->exists()){
                $exists =  $transction->first();
                \App\Models\UserWalletTrasaction::where('influencer_id','=',$event->messageData['receiver'])->where('user_id','=',$event->messageData['sender'])->whereDate('created_at','=', \Carbon\Carbon::today())->where('transction_title','=','Chat')->update([
                    'amount' => $exists->amount+$event->messageData['message_cost']
                ]);    
            }else{
                $u = \App\Models\User::where('id' ,'=' ,$event->messageData['receiver'])->first();
                \App\Models\UserWalletTrasaction::insert([
                    'influencer_id' => $event->messageData['receiver'],
                    'user_id' => $event->messageData['sender'],
                    'transction_type' => '0',
                    'transction_title' => 'Chat',
                    'transction_desc' => 'Spent in Chat with '.$u->username,
                    'amount' => $event->messageData['message_cost']
                ]);
            }   
        }else{
            
            $u = \App\Models\User::where('id' ,'=' ,$event->messageData['receiver'])->first();
            \App\Models\UserWalletTrasaction::insert([
                'influencer_id' => $event->messageData['receiver'],
                'user_id' => $event->messageData['sender'],
                'transction_type' => '0',
                'transction_title' => 'Gift',
                'transction_desc' => 'Spent in Gift with '.$u->username,
                'amount' => $event->messageData['message_cost']
            ]);
        }
        


    }
}

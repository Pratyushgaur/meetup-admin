<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscribeLiveStream extends Model
{
    use HasFactory;

    public static function  buyStream($user,$stream){
        SubscribeLiveStream::insert([
            'user_id' => $user->id,
            'stream_id' => $stream->id,
            'price' => $stream->price,
        ]);
        //
        \App\Models\User::where('id' ,'=' ,$user->id)->update([
            'balance' => $user->balance-$stream->price
        ]);
        //
        \App\Models\UserWalletTrasaction::insert([
            'influencer_id' => $stream->user_id,
            'user_id' => $user->id,
            'transction_type' => '0',
            'transction_title' => 'Live Stream',
            'transction_desc' => 'Spent in Live Stream Join',
            'amount' =>$stream->price
        ]);
    }
}

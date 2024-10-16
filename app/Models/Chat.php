<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
class Chat extends Model
{
    use HasFactory;

    public static function  CreateChat($data){
        $chat = new \App\Models\Chat;
        $chat->sender  = $data['sender'];
        $chat->receiver  = $data['receiver'];
        $chat->message_cost  = $data['message_cost'];
        $chat->message = ($data['type'] == 'message') ? $data['message'] : '-';
        $chat->message_type = $data['type'];
        $chat->save();
        if($data['type'] != 'message'){
            $id = $chat->id;
            $gift = \App\Models\Gift::where('id','=',$data['gift_id'])->first();
            
            $sourcePath = public_path('gift').'/'.$gift->image;
            
            $destinationPath = public_path('chat_files/'.$id.$gift->image.'');
            if (File::exists($sourcePath)) {
                
                File::copy($sourcePath, $destinationPath);

            }
            $chat->message_file_path = $id.$gift->image;
            $chat->save();
            return $chat->message_file_path;
        }
        
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['post_title','price','post_type','file_type','main_file','more_files','userid','plan_id'];

    public function post()
    {
        return $this->belongsTo(User::class,'userid');
    }
   
}

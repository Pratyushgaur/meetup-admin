<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomUserMsgPrice extends Model
{
    use HasFactory;
    protected $fillable  = ['user_id','influencer_id','price'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfluencerInbox extends Model
{
    use HasFactory;
    protected $fillable =  ["influencer_id","user_id"];
}

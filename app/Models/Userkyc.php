<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserKyc extends Model
{
    use HasFactory;

    public function kyc()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}

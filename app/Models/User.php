<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function post()
    {
        return $this->hasMany(Post::class,'userid','id');
    }

    public function kyc()
    {
        return $this->hasOne(UserKyc::class,'user_id','id');
    }

    public function user()
    {
        return $this->hasOne(UserWalletTrasaction::class,'user_id','id');
    }

    public function order()
    {
        return $this->hasOne(Order::class,'userid','id');
    }

    public function influencer()
    {
        return $this->hasOne(Order::class,'influencer_id','id');
    }

    public function live()
    {
        return $this->hasMany(LiveStream::class,'user_id','id');
    }

    public function income()
    {
        return $this->hasMany(UserWalletTrasaction::class,'user_id','id');
    }
}

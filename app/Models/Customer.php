<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, \App\Models\Traits\CustomerMustVerifyEmail;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'city',
        'district',
        'ward',
        'phone',
        'status',
        'gender',
        'date_of_birth',
        'ward_district_city',
        'avatar',
        'balance',
        'referrer_id',
        'referral_code',
        'campaigns',
        'address',
        'username'
    ];
    public $timestamps = true;
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function referrer(){
        return $this->belongsTo(Customer::class, "referrer_id");
    }

    public function referrals(){
        return $this->hasMany(Customer::class, "referrer_id", 'id');
    }

    public function campaigns(){
        return $this->belongsToMany(Campaign::class, 'customer_campaigns','campaign_id', 'customer_id');
    }

    public function transactions(){
        return $this->hasMany(CustomerTransaction::class);
    }

    public function withdraws(){
        return $this->hasMany(CustomerWithdraw::class, 'customer_withdraws');
    }

}

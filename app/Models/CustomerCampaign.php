<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;

class CustomerCampaign extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['status','amount', 'campaign_id', 'customer_id', 'referrer_id', 'referrer_code'];

    public $timestamps = true;

    public function customer(){
        return $this->belongsTo(Customer::class);
    }
    public function campaign(){
        return $this->belongsTo(Campaign::class);
    }

}

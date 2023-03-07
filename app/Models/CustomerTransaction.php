<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;

class CustomerTransaction extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['content','status','old_balance', 'amount', 'balance', 'customer_id'];

    public $timestamps = true;

}

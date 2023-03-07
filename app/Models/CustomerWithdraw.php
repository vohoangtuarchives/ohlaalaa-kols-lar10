<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;

class CustomerWithdraw extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['content','admount','status', 'reviewed_by'];

    public $timestamps = true;

}

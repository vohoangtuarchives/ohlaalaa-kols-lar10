<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;

class CampaignHistory extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['content', 'campaign_id'];

    public $timestamps = true;

    public function campaign(){
        $this->belongsTo(Campaign::class);
    }
}

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

    protected $fillable = ['content', 'campaign_id', 'type',
        'level_1',
        'level_2',
        'level_3',
        'level_4',
        'level_5',
        'level_6',
        'level_7',
        'level_8',
        'level_9',
        'level_10',];

    public $timestamps = true;

    public function campaign(){
        $this->belongsTo(Campaign::class);
    }
}

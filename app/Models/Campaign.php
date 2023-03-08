<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;

class Campaign extends Model
{
    use HasApiTokens, HasFactory, Notifiable, Sluggable;

    protected $fillable = ['title', 'amount', 'rebate_levels', 'date_start'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function rebates()
    {
        return $this->hasMany(CampaignRebate::class);
    }

    public function history(){
        return $this->hasMany(CampaignHistory::class);
    }

    public function currentRebate(){
        return $this->rebates ? $this->rebates->orderBy("id", "desc")->first() : null;
    }

    public function currenRateLevel_1(){
        return $this->currentRebate()->level_1 ?? 0;
    }

    public function currenRateLevel_2(){
        return $this->currentRebate()->level_2 ?? 0;
    }

    public function currenRateLevel_3(){
        return $this->currentRebate()->level_3 ?? 0;
    }

    public function customers(){
        return $this->belongsToMany(Customer::class, "customer_campaigns");
    }

    public function customer($customerId){
        return $this->customers()->find($customerId);
    }

    protected static function booted()
    {

        static::created(function ($campaign) {
            if(Auth::check()){
                $user = Auth::user();
                CampaignHistory::create([
                    "content" =>  __("admin.event.created", [
                        'name' => $user->name,
                        'target' => $campaign->title
                    ]),
                    'campaign_id' => $campaign->id,
                    'level_1' => $campaign->currentRebate()->level_1,
                    'level_2'=> $campaign->currentRebate()->level_2,
                    'level_3'=> $campaign->currentRebate()->level_3,
                    'level_4'=> $campaign->currentRebate()->level_4,
                    'level_5'=> $campaign->currentRebate()->level_5,
                    'level_6'=> $campaign->currentRebate()->level_6,
                    'level_7'=> $campaign->currentRebate()->level_7,
                    'level_8'=> $campaign->currentRebate()->level_8,
                    'level_9'=> $campaign->currentRebate()->level_9,
                    'level_10' => $campaign->currentRebate()->level_10,
                    'type' => 'created'
                ]);
            }
            $campaign->date_start = date("d-m-Y", time());
            $campaign->save();
        });

        static::updated(function ($campaign) {
            if(Auth::check()) {
                $user = Auth::user();
                CampaignHistory::create([
                    "content" => __("admin.event.updated", [
                            'name' => $user->name,
                            'target' => $campaign->title
                        ]),
                    'campaign_id' => $campaign->id,
                    'level_1' => $campaign->currentRebate()->level_1,
                    'level_2'=> $campaign->currentRebate()->level_2,
                    'level_3'=> $campaign->currentRebate()->level_3,
                    'level_4'=> $campaign->currentRebate()->level_4,
                    'level_5'=> $campaign->currentRebate()->level_5,
                    'level_6'=> $campaign->currentRebate()->level_6,
                    'level_7'=> $campaign->currentRebate()->level_7,
                    'level_8'=> $campaign->currentRebate()->level_8,
                    'level_9'=> $campaign->currentRebate()->level_9,
                    'level_10' => $campaign->currentRebate()->level_10,
                    'type' => 'updated'
                ]);
            }
        });

        static::deleted(function ($campaign) {
            if(Auth::check()) {
                $user = Auth::user();
                CampaignHistory::create([
                    "content" => __("admin.event.deleted", [
                        'name' => $user->name,
                        'target' => $campaign->title
                    ]),
                    'campaign_id' => $campaign->id
                ]);
            }
        });

        static::deleting(function ($campaign) {
            $campaign->rebates()->delete();
        });

        static::deleted(function ($campaign) {
            if(Auth::check()) {
                $user = Auth::user();
                CampaignHistory::create([
                    "content" => __("admin.event.deleted", [
                            'name' => $user->name,
                            'target' => $campaign->title
                        ]),
                    'campaign_id' => $campaign->id
                ]);
            }
        });

    }

}

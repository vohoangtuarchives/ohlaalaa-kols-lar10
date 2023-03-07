<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;

class Permission extends Model
{
    use HasApiTokens, HasFactory, Notifiable, Sluggable;

    protected $fillable = ['title','status','index', 'visibility', 'code',
        'title',
        'route',
        'group'];

    public $timestamps = true;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    public function roles() {

        return $this->belongsToMany(Role::class,'role_permissions');

    }

    public function users() {
        return $this->belongsToMany(User::class,'user_permissions');
    }

    public function hasPermission(){
        $currentRoute = Route::currentRouteName();
    }
}

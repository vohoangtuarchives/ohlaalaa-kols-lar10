<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;

class Role extends Model
{
    use HasApiTokens, HasFactory, Notifiable, Sluggable;

    protected $fillable = ['title','code', 'status','index', 'visibility'];

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

    public function permissions() {

        return $this->belongsToMany(Permission::class,'role_permissions');

    }

    public function users() {

        return $this->belongsToMany(User::class,'user_roles');

    }

    public function hasPermission(string $route){
        $result = $this->permissions->filter(function ($value) use($route){
            return $value->route == $route;
        });
        if($result->first()){
            return true;
        }
        return false;
    }

}

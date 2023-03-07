<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, \App\Models\Traits\MustVerifyEmail;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'city',
        'district',
        'ward',
        'phone',
        'status',
        'first_name',
        'last_name',
        'full_name',
        'gender',
        'date_of_birth',
        'ward_district_city',
        'avatar'
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles(): BelongsToMany {
        return $this->belongsToMany(Role::class,'user_roles');
    }

    public function getRole(){
        return $this->roles()->first();
    }

    public function isRoot(){
        return $this->id === 1;
    }

    public function hasPermission(string $route){

        if($this->isRoot()) return true; //grand full access for root user

        return Cache::remember($route . '_user_' .$this->id, 120, function () use($route){
            foreach ($this->roles as $role){
                return $role->hasPermission($route);
            }
            return false;
        });
    }
}

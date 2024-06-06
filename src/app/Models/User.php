<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Permission;
use App\Support\UserController;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'password',
        'is_superuser',
        'is_staff'
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

    public function isSuperUser(){
        return $this->is_superuser;
    }
    public function isStaffUser(){
        return $this->is_staff;

    }
    public function setPasswordAttribute($value){
        return $this->attributes['password']=bcrypt($value);
    }

    
    public function permissions(){
        return $this->belongsToMany(Permission::class);
    }

    public function roles(){
        return $this->belongsToMany(Role::class);
    }
    
    public function hasPermisssion($permission){      
           return $this->permissions->contains($permission) || $this->hasRole($permission->roles);           
        }
       
    public function hasRole($roles){
      
       return !! $roles->intersect($this->roles)->all();
    }

    public function carts(){
        return $this->hasMany(Cart::class);
    }


}   
    


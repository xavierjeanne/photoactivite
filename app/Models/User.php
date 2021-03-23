<?php

namespace App\Models;


use App\Models\Role;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','first_name', 'email', 'password','address','address_bis','postal_code','country','telephone','siret','dateofbirth'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'dateofbirth','email_verified_at'
    ];

    public function role(){
        return $this->belongsTo('App\Models\Role');
    }

    public function avatar(){
        return $this->belongsTo('App\Models\Avatar');
    }

    public function licences(){
        return $this->belongsToMany('App\Models\Licence');
    }

    public function photoCategories(){
        return $this->belongsToMany('App\Models\PhotoCategory');
    }

    public function photoFavorites(){
        return $this->belongsToMany('App\Models\Photo');
    }

    public function activities(){
        return $this->belongsToMany('App\Models\Activity');
    }

    public function session(){
        return $this->hasOne('App\Models\Session');
    }

}

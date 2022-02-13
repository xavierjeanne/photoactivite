<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','code'
    ];

     public function activities(){
        return $this->belongsToMany('App\Models\Activity');
    }

    public function users(){
        return $this->belongsToMany('App\Models\User');
    }

    public function photos(){
        return $this->belongsToMany('App\Models\Photo');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','description'
    ];

    public function fields(){
        return $this->belongsToMany('App\Models\Field');
    }

     public function categories(){
        return $this->belongsToMany('App\Models\Category');
    }

    public function users(){
        return $this->belongsToMany('App\Models\User');
    }
    
}

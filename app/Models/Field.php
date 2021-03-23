<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','description'
    ];

    public function activities(){
        return $this->belongsToMany('App\Models\Activity');
    }

    public function licences(){
        return $this->belongsToMany('App\Models\Licence');
    }
}

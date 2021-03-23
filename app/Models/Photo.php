<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'name', 'extension'
    ];

    public function users(){
        return $this->belongsToMany('App\Models\User');
    }

    public function categories(){
        return $this->belongsToMany('App\Models\Category');
    }
}

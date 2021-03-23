<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Licence extends Model
{
    protected $fillable = [
        'name','description','price','periodicity'
    ];

    public function users(){
        return $this->belongsToMany('App\Models\User');
    }

    public function fields(){
        return $this->belongsToMany('App\Models\Field');
    }
}

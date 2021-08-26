<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'title', 'slug'
    ];

    public $timestamps = false;

     public function contents(){
        return $this->hasMany('App\Models\Content');
    }

}

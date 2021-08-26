<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    //
    protected $fillable = [
        'page_id', 'bloc_name','content'
    ];

    public $timestamps = false;

    public function page(){
        return $this->belongsTo('App\Models\Page');
    }

}

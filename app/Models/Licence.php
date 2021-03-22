<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Licence extends Model
{
    protected $fillable = [
        'name','description','price','periodicity'
    ];
}

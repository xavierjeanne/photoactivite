<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LicenceController extends Controller
{
    public function form(){
        return view('licence');
    }
}

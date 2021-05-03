<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProController extends Controller
{
    
    /**
     * Show the pro page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('pro');
    }
}

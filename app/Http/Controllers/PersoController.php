<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PersoController extends Controller
{
    /**
     * Show the perso page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('perso');
    }
}

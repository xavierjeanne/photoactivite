<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    /**
     * Show the home page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $home = Page::where('title', 'home')->first();
        $homeContents = $home->contents()->get();
        return view('home')->with('homeContents',$homeContents);
    }
}

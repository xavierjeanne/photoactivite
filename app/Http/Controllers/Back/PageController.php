<?php

namespace App\Http\Controllers\Back;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function list(){
        $pages = Page::all();
        return view('back.page.list',compact('pages'));
    }
}

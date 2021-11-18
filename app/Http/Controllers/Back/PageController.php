<?php

namespace App\Http\Controllers\Back;

use DataTables;
use App\Models\Page;
use Illuminate\Http\Request;
use Response;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function index(Request $request){
        $pages = Page::all();
        return view('back.page.list',compact('pages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function new(Request $request)
    {
        $messages = [
          'required' => 'Ce champ est obligatoire',
          'unique'    => 'Ce nom est dèjà pris dans la base',
        ];

        $data= $request->validate([
            'title'=>'required|unique:pages',
            'slug'=>'required|unique:pages',
        ], $messages);       
        $page = Page::create($data);
        return response()->json($page);
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $page = Page::find($id);
        $messages = [
          'required' => 'Ce champ est obligatoire',
          'unique'    => 'Ce nom est dèjà pris dans la base',
        ];

        $data= $request->validate([
            'title'=>'required|unique:pages',
            'slug'=>'required|unique:pages',
        ], $messages);
        $page::update($data);
        return response()->json($page);
    }

     /**
     *  delete page
     * @return View
     */
    public function delete( $id = false)
    {

        $page = Page::find($id);
        $page->delete();
        return response()->json(['success'=>'Page effacée avec succès.']);
        
    }
}

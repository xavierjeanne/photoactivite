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
        if(isset($request->id) && !is_null($request->id)){
            $page = Page::find($request->id);
            $data= $request->validate([
                'title'=>'required|unique:pages,title,'.$page->id.'',
                'slug'=>'required|unique:pages,slug,'.$page->id.'',
            ], $messages);
            $page->title = $request->title;
            $page->slug = $request->slug;
            $page->save();
        }
        else{
            $data= $request->validate([
                'title'=>'required|unique:pages',
                'slug'=>'required|unique:pages',
            ], $messages);       
            $page = Page::create($data);
        }
        return response()->json($page);
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page_edit = Page::find($id);
    
        return response()->json($page_edit);
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

    public function listContent($id = false){
        $page = Page::find($id);
        $contents = $page->contents();
        var_dump($contents);
    }
}

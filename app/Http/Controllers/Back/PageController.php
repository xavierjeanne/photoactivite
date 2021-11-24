<?php

namespace App\Http\Controllers\Back;

use Response;
use DataTables;
use App\Models\Page;
use App\Models\Content;
use Illuminate\Http\Request;
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
        $contents = $page->contents;
        return view('back.page.content',compact('contents','page'));
    }

    public function newBlock(Request $request){
        $messages = [
          'required' => 'Ce champ est obligatoire',
          'unique'    => 'Ce nom est dèjà pris dans la base',
        ];
        
        if(isset($request->bloc_id) && !is_null($request->bloc_id)){
            $content = Content::find($request->bloc_id);
            $data= $request->validate([
                'bloc_name'=>'required',
                'content'=>'required',
            ], $messages);
            $content->bloc_name = $request->bloc_name;
            $content->content = $request->content;
            $content->save();
        }
        else{
            $data= $request->validate([
                'bloc_name'=>'required',
                'content'=>'required',
            ], $messages);  
            $data['page_id']= $request->page_id;   
            $content = Content::create($data);
        }
        return response()->json($content);
    }

    public function editContent($id,$bloc_id)
    {
        
        $content_edit = Content::find($bloc_id);
    
        return response()->json($content_edit);
    }

      /**
     *  delete page
     * @return View
     */
    public function deleteContent($id,$bloc_id)
    {

        $content = Content::find($bloc_id);
        $content->delete();
        return response()->json(['success'=>'Bloc effacé avec succès.']);
        
    }
}

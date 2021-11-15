<?php

namespace App\Http\Controllers\Back;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Datatables;

class PageController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
                $pages = Page::all();
                return Datatables::of($pages)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
    
                            $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editPage">Edit</a>';
    
                            $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deletePage">Delete</a>';
        
                                return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
            }
        
        return view('back.page.list',compact('pages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Page::updateOrCreate(['id' => $request->product_id],
                ['title' => $request->title, 'slug' => $request->slug]);        
   
        return response()->json(['success'=>'La page à été bien mise à jour.']);
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = Page::find($id);
        return response()->json($page);
    }

     /**
     *  delete page
     * @return View
     */
    public function destroy( $id = false)
    {

        Page::find($id)->delete();
     
        return response()->json(['success'=>'Page effacée avec succès.']);
        
    }
}

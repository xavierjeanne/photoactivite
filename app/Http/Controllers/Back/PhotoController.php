<?php

namespace App\Http\Controllers\Back;

use index;
use App\Models\Photo;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PhotoController extends Controller
{
    //
     public function index(Request $request){
        $photos = Photo::all();
        $categories = Category::orderBy('name')->get();
        return view('back.photo.list',compact('photos','categories'));
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
            $photo = Photo::find($request->id);
            /** traitement de la photo et de ses categories */
            $photo->save();
        }
        else{
            /**traitement de la photo */    
           
            request()->validate([
                'photos'  => 'required',
            ]);
            if($request->hasfile('photos'))
            {   
                $listCategory =[];
                $categories = Category::all();
                foreach($categories as $category){
                    $listCategory[$category->id] = strtolower($category->code);
                }
                foreach($request->file('photos') as $file)
                {
                    $filename = $file->getClientOriginalName();
                    $params = explode('-',$filename);
                    $photo =new Photo();
                    $name = trim($params[0]);
                    $photo->name=str_replace(' ', '',$name);
                    $photo->extension = trim(end($params));
                    $imageName = $photo->name.$photo->extension;
                    $file->move(public_path().'/images/photos/', $imageName);
                    $photo->save();
                    $categoryPhoto = [];
                    foreach($params as $param){
                        $param=strtolower(trim($param));
                        $search=array_search($param, $listCategory);
                        if($search){
                            $categoryPhoto[] = $search;
                        
                        }
                    }
                    foreach($categoryPhoto as $catPhoto){
                        $photo->categories()->attach($catPhoto);
                    }
                    // save the photo first then save photos_category with the categoryPhoto list define before
                    // 
                }
            }
        }
        return response()->json();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $photo = Photo::find($id);
    
        return response()->json($photo);
    }

     /**
     *  delete photo
     * @return View
     */
    public function delete( $id = false)
    {

        $photo = Photo::find($id);
        $photo->delete();
        return response()->json(['success'=>'Photo effacée avec succès.']);
        
    }
}

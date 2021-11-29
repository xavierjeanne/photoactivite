<?php

namespace App\Http\Controllers\Back;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
     public function index(Request $request){
        $categories = Category::orderBy('name')->get();
        return view('back.category.list',compact('categories'));
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
            $category = Category::find($request->id);
            $data= $request->validate([
                'name'=>'required|unique:categories,name,'.$category->id.'',
                'code'=>'required|unique:categories,code,'.$category->id.'',
            ], $messages);
            $category->name = $request->name;
            $category->code = $request->code;
            $category->save();
        }
        else{
            $data= $request->validate([
                'name'=>'required|unique:categories',
                'code'=>'required|unique:categories',
            ], $messages);       
            $category = Category::create($data);
        }
        return response()->json($category);
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category_edit = Category::find($id);
    
        return response()->json($category_edit);
    }

     /**
     *  delete category
     * @return View
     */
    public function delete( $id = false)
    {

        $category = Category::find($id);
        $category->delete();
        return response()->json(['success'=>'Category effacée avec succès.']);
        
    }

}

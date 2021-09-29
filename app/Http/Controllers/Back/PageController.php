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

     /**
     * Action actualite delete actualite
     * @return View
     */
    public function delete(Request $request, $id = false)
    {

        $page = Page::findOrFail($id);
        
        if ($request->isMethod('delete')) {
            if($page->delete()){
                return response()->json(['success' => true, 'callback' => "$('#modalDeletePage').modal('hide');"]);
            }
            else{
                return response()->json(['success' => false, 'callback' => "alert('".__('Impossible de supprimer la page')."')"]);
            }
        }
        else {
            return view('back.page.delete', compact('page'));
        }
        
    }
}

<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function informationPersonnelles(){
        $user = Auth::user();
        return view('back.user.form',compact('user'));
    }
    
    public function save(Request $request){
        $id = $request->id;
        if(Auth::user()->id != $id){
                return view('back.index');
        }
        $user = User::find($id)->firstOrFail();
        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->save();
        return view('back.user.form',compact('user'))->with('successMsg','Vos informations ont été mis à jour!');
    }
}

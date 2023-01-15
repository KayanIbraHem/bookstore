<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use Auth;
class NoteController extends Controller
{
    function notes(){
        // old
        // $notee= Note::where('id','=',Auth::user()->id)->get();
        // return view('notes/create',['notee'=>$notee]);
        return view('notes/create');
    }
    function savenotes(Request $request){
        $note= new Note();
        $note->content=$request->content;
        $note->user_id=Auth::user()->id;
        $note->save();
        return redirect('users/notes');
    }

}

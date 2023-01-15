<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\User;
use Auth;
use App\Models\Category;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    function books(){
        $books=Book::with('categories')->get();
        return response()->json($books);
    }
    function categories(){
        $categories=Category::select('id','name')->get();
        return response()->json($categories);
    }
    function register(Request $request){
        $email=$request->email;
        $password=$request->password;
        $user=new User();
        $user->email=$email;
        $user->password=\Hash::make($password);
        $user->acces_token=\Str::random(64);
        $user->save();

        return response()->json([

            'acces_token'=>$user->acces_token

        ]);
    }
    function login(Request $request){
        $cred=['email'=>$request->email,'password'=>$request->password];
        if(Auth::attempt($cred)){
        if(!isset(Auth::user()->acces_token)){ //checktoken
            Auth::user()->acces_token=\Str::random(64);
            Auth::user()->save();
        }
            return response()->json(['acces_token'=>Auth::user()->acces_token]);//returntoken 
        }else{
            return"Not Valid Email or Password Please Check ur Data";
        } 
    }
    function users(){
        $users=User::with('notes')->get();
        return response()->json($users);
    }
}

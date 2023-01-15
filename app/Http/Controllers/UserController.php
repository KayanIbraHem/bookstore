<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
class UserController extends Controller
{
    function register(){

        return view('users/register');
    }
    function save(Request $request){
        $email=$request->email;
        $password=$request->password;
        $user=new User();
        $user->email=$email;
        $user->password=\Hash::make($password);
        $user->save();
        return redirect('books/list');
        
    }
    function login(){
        // if(Auth::check()){
            
        // }
        return view('users/login');
    }
    function handlelogin(Request $request){
        //make validation as soon as
        //auth
        $cred=['email'=>$request->email,'password'=>$request->password];
        if(Auth::attempt($cred)){
            return redirect('books/list');
        }else{
            return"Not Valid Email or Password Please Check ur Data";
        } 
    }
    function logout(){
        Auth::logout();
        return redirect('users/login');
    }
}

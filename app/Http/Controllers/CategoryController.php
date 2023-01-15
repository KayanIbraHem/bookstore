<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{
    function list(){
        $categories=Category::get();
        return view('categories/list',[
            'categories'=>$categories
        ]);
    }
    function save(Request $request){
        $category=new Category();
        $category->name=$request->name;
        $category->save();
        return redirect('categories/list');

    }

    
}

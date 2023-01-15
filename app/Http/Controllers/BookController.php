<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Book;
use App\Models\Category;
class BookController extends Controller
{
    function list(){

        $books=Book::all();
        
        return view('books',[
            'books'=>$books
        ]);
    }
    
    function show($id){
        $book=Book::where('id','=',$id)->first();
        return view('show',[
            'book'=>$book 
        ]);
    }
    function getName($n){
        $getNamee=Book::where('name','LIKE','%'.$n.'%')->first();
        return view('test',[
            'naame'=>$getNamee
        ]);
    }
    function create(){ // return view to create new book
        $categories=Category::get();
        return view('create',[
            'categories'=>$categories
        ]);
    }
    function edit($id){ //return view edit book with [id]
        $book=Book::find($id);
        return view('edit',[
            'book'=>$book
        ]);
    }
    function store(Request $request){
        $validator = Validator::make($request->all(), [ //validation
            'name' => 'required|max:100|min:4',
            'desc' => 'required|max:100|min:4',
            'image'=> 'required|image|mimes:jpeg,jpg,png,gif,svg|max:2048'
        ]);
        if ($validator->fails()) {
            return redirect('books/create')
                        ->withErrors($validator)
                        ->withInput();
        }
        if($request->hasfile('image')){
            $image=$request->file('image');
            $name=time().\Str::random(20).'.'.$image->getClientOriginalExtension();
            $destinationPath=public_path('/images');
            $image->move($destinationPath,$name);
            $imageName='images/'.$name;
        }
        $_name=$request->name;//get data from [form]
        $_desc=$request->desc;
        $book=new Book();
        $book->name=$_name;//insert into database
        $book->desc=$_desc;
        $book->image=$imageName;
        $book->save();
        $book->categories()->attach($request->categories);
        return redirect('/books/list');
    }
    function update($id,Request $request){ //update book
        $validator = \Validator::make($request->all(), [ //validation
            'name' => 'required|max:100|min:4',
            'desc' => 'required|max:100|min:4',
            'image'=> 'image|mimes:jpeg,jpg,png,gif,svg|max:2048'
        ]);
        if ($validator->fails()) {
            return redirect('books/edit/'.$id)
                        ->withErrors($validator)
                        ->withInput();
        }
        $_name=$request->name;
        $_desc=$request->desc;
        $book=Book::find($id);
        $book->name=$_name;
        $book->desc=$_desc;
        if($request->hasfile('image')){
            $image=$request->file('image');
            $name=time().\Str::random(20).'.'.$image->getClientOriginalExtension();
            $destinationPath=public_path('/images');
            $image->move($destinationPath,$name);
            $imageName='images/'.$name;
            if(isset($book->image))
            unlink($book->image);
            $book->image=$imageName; 
            
        }
        $book->save(); 
        return redirect('books/list');
    }
    function delete($id){//delete book 
        $book=Book::find($id);
        if(isset($book->image))
        unlink($book->image);
        $book->delete();
        return redirect('/books/list');
    }
}


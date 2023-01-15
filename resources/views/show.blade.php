@extends('layouts/books_layout')

@section('title')
{{$book->name}}
@endsection

@section('content')
@if(Auth::user()->is_admin)
<a href="{{url('books/edit',$book->id)}}">Edit</a>
<a href="{{url('books/delete',$book->id)}}">Delete</a>
@endif

<h1>BookName:- {{$book->name}}</h1>
<img src="{{asset($book->image)}}"  width="500">
<br>
<h1>CategoryName:- </h1> 
@foreach($book->categories as $category)
<h4>{{$category->name}}</h4> 
@endforeach
@endsection
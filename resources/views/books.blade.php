@extends('layouts/books_layout')

@section('title')
Route - All Books
@endsection

@section('content')
<h1>Kayan Books Store</h1>
@foreach($books as $book)

<h3><a href="{{url('books/show',$book->id)}}">{{$book->name}}</a></h3>
<p>{{$book->desc}}</p>
@endforeach
@endsection


@extends('layouts/books_layout')

@section('title')
Edit | {{$book->name}}
@endsection

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{url('books/update',$book->id)}}" method="POST" enctype="multipart/form-data">
@csrf
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Book Name</label>
        <input type="text" value="{{$book->name}}" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Description</label>
        <input type="text" value="{{$book->desc}}" name="desc" class="form-control" id="exampleInputPassword1">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Image</label>
        <input type="file"  name="image" class="form-control" id="exampleInputPassword1">
    </div>
    <button type="submit" class="btn btn-primary">Update Book</button>
</form>
@endsection     
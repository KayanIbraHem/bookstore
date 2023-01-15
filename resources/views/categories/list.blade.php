@extends('layouts/books_layout')

@section('title')
Categories
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
<form action="{{url('categories/save')}}" method="POST" enctype="multipart/form-data">
@csrf

    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Name</label>
        <input type="text" value="{{old('name')}}" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    
    <button type="submit" class="btn btn-primary">Add Category</button>
</form>

@foreach($categories as $category)
 <h3>{{$category->name}}</h3>
@foreach($category->books as $book)
{{$book->name}}
@endforeach
@endforeach
@endsection  
@extends('layouts/books_layout')

@section('title')
My Note
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
<form action="{{url('users/savenotes')}}" method="POST" enctype="multipart/form-data">
@csrf

    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Contect</label>
        <input type="text" value="{{old('content')}}" name="content" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    
    <button type="submit" class="btn btn-primary">Add Note</button>
</form>

@foreach(Auth::user()->notes as $note)
<h1>{{$note->content}}-{{$note->user->email}}</h1>
@endforeach

@endsection  
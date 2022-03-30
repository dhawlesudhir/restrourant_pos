@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        @include('layouts.sidebar')  
        <div class="col-md-8">
            <img src="{{asset('image/app.png')}}" width="15px"> Create a Catagory
            <hr>
            @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>    
                    @endforeach
                </ul>    
            </div>
            @endif
            <form action="/manage/category/{{$category->id}}" method="POST">
            @csrf
            @method('PUT')
                <div class="fomr-group">
                    <label for="categoryName">Category Name</label>
                    <input type="text" name="name" class="form-control" value="{{$category->name}}">
                </div>   
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
        
    </div>
</div>
@endsection


@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        @include('layouts.sidebar')   
        <div class="col-md-8">
            <img src="{{asset('image/app.png')}}" width="15px"> Category
            <a href="/manage/category/create" class="btn btn-success btn-sm float-right">Create a Category</a>
            <hr>
            @if(Session()->has('status'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">X</button>
                    {{Session()->get('status')}}
                </div>
            @endif
            
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Category</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <th scope="row">{{$category->id}}</th>
                            <th>{{$category->name}}</th>
                            <th>
                                <a href="/manage/category/{{$category->id}}/edit" class="btn btn-sm btn-warning">Edit</a>
                                
                                <form action="/manage/category/{{$category->id}}" method="POST">
                                 @csrf
                                 @method('DELETE')   
                                    <button type="submit" class="btn btn-sm btn-danger">DELETE</button>
                                </form>
                            </th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$categories->links()}}
        </div>
    </div>
</div>
@endsection


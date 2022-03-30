@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        @include('layouts.sidebar')   

        
        <div class="col-md-8">
            <img src="{{asset('image/menu.png')}}" width="15px"> Menu
            <a href="/manage/menu/create" class="btn btn-success btn-sm float-right">Create a Menu Item</a>
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
                        <th scope="col">Name</th>
                        <th scope="col">Image</th>
                        <th scope="col">Price</th>
                        <th scope="col">Details</th>
                        <th scope="col">Category</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($menus as $menu)
                        <tr>
                            <th scope="row">{{$menu->id}}</th>
                            <td>{{$menu->name}}</td>
                            <td><img src="{{asset('menu_images/'.$menu->image)}}" class="img0thumbnail" alt="{{$menu->name}}" width="120px" height="120px">
                            </td>
                            <td>{{$menu->price}}</td>
                            <td>{{$menu->description}}</td>
                            <td>{{$menu->category->name}}</td>
                            <td>
                                <a href="/manage/menu/{{$menu->id}}/edit" class="btn btn-sm btn-warning">Edit</a>
                                
                                <form action="/manage/menu/{{$menu->id}}" method="POST">
                                 @csrf
                                 @method('DELETE')   
                                    <button type="submit" class="btn btn-sm btn-danger">DELETE</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
                <!-- $categories->links() -->
        </div>
    </div>
</div>
@endsection


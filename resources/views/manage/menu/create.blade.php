@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        @include('layouts.sidebar')
        <div class="col-md-8">
            <img src="{{asset('image/app.png')}}" width="15px"> Create a Item
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
            @if(isset($menuItem))
            <form action="/manage/menu/{{$menuItem->id}}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @else
            <form action="/manage/menu" method="POST" enctype="multipart/form-data">
            @endif
                    @csrf
                    <div class="form-group">

                        <div class="mb-3 col-md-6">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" placeholder="" name="name" value="{{isset($menuItem->name) ? $menuItem->name:''}}">
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="price" class="form-label">Price</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" aria-label="Amount" id="price" name="price" value="{{isset($menuItem->price) ? $menuItem->price:''}}">
                                <span class="input-group-text">INR</span>
                            </div>
                        </div>
                        <div class="mb-3 col-md-8">
                            <label for="desc" class="form-label">Description</label>
                            <textarea class="form-control" id="desc" name="desc" rows="2">{{isset($menuItem->description) ? $menuItem->description:''}}</textarea>
                        </div>
                        
                        @if(isset($menuItem))
                        <div mb-3 col-md-6>
                            <label for="inputGroupFile04" class="form-label">Picture</label>
                            <img class="form-control" src="{{asset('menu_images/'.$menuItem->image)}}" class="rounded mx-auto d-block"  alt="{{$menuItem->name}}" style="width:200px; height:200pt;">
                        </div>
                        @endif

                        <div class="mb-3 col-md-6">
                            <label for="inputGroupFile04" class="form-label">Select Picture</label>
                            <input type="file" class="form-control" id="inputGroupFile04" name="image" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                        </div>


                        <div class="mb-3 col-md-4">
                            <label class="form-label" for="inputGroupSelect01">Category</label>
                            <select class="form-control" id="category" name="category">
                                <option selected>Select Category</option>
                                @foreach($categories as $category)
                                @if(isset($menuItem))
                                <option value="{{$category->id}}" {{ $category->id == $menuItem->category_id ? 'selected' :''}}><b>{{$category->name}} </b></option>
                                @else
                                <option value="{{$category->id}}"><b>{{$category->name}} </b></option>
                                @endif
                                @endforeach
                            </select>
                        </div>


                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>

        </div>
    </div>
</div>
@endsection
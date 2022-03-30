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
            @if(isset($table))
                <form action="/manage/table/{{$table->id}}" method="POST">
                @method('PUT')
            @else
                <form action="/manage/table" method="POST">
            @endif
                @csrf
                    <div class="form-group">

                        <div class="mb-3 col-md-6">
                            <label for="name" class="form-label">Table Name</label>
                            <input type="text" class="form-control" id="name" placeholder="" name="name" value="{{isset($table->name) ? $table->name:''}}">
                        </div>
                        <div class="mb-3 col-md-4">
                            <label class="form-label" for="status">Status</label>
                            <select class="form-control" id="status" name="status">
                                @if(isset($table->status))
                                <option {{$table->status == 'Available' ? 'selected': ''}} >Available</option>
                                <option {{$table->status == 'Unavailable' ? 'selected': ''}}>Unavailable</option>\
                                @else
                                <option>Available</option>
                                <option>Unavailable</option>
                                @endif
                            </select>
                        </div>


                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>

        </div>
    </div>
</div>
@endsection
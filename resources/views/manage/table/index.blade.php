@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        @include('layouts.sidebar')


        <div class="col-md-8">
            <img src="{{asset('image/restaurant.png')}}" width="15px"> Table
            <a href="/manage/table/create" class="btn btn-success btn-sm float-right">Add a Table</a>
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
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tables as $table)
                    <tr>
                        <th scope="row">{{$table->id}}</th>
                        <td>{{$table->name}}</td>

                        <td>{{$table->status}}</td>
                        <td>
                            <a href="/manage/table/{{$table->id}}/edit" class="btn btn-sm btn-warning">Edit</a>

                            <form action="/manage/table/{{$table->id}}" method="POST">
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
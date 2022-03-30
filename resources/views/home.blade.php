@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row text-center">
                        <div class="col-sm-4">
                            <a href="/manage">                            
                                <h4>Manage</h4> 
                                <img src="{{asset('image/protection.gif')}}" width="50px" alt="">
                            </a>   
                            </div>
                        <div class="col-sm-4">
                            <a href="/cashier">
                                <h4>Cashier</h4> 
                                <img src="{{asset('image/money-bag.gif')}}" width="50px" alt="">
                            </a>
                        </div> 
                        <div class="col-sm-4">
                            <a href="/reports">
                                <h4>Reports</h4> 
                                <img src="{{asset('image/notebook.gif')}}" width="50px" alt="">
                            </a>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

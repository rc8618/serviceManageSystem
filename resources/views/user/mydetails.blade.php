@section('title', 'My Details')
@extends('layouts.app')

@section('content')
    @include('navbar')
    <div class="container">

        <div class="row">
            <div class="col-md-6">
                <p class="mytext"><span>My Details</span></p>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="form-group row padding-left-50-px">
                    <label class="col-sm-3" for="inputName">Name  :</label>
                    <label class="col-sm-9" for="inputName">{{ $myDetails->name }}</label>
                </div>
                <div class="form-group row padding-left-50-px">
                    <label class="col-sm-3" for="inputEmail">Email  :</label>
                    <label class="col-sm-9" for="inputEmail">{{ $myDetails->email }}</label>
                </div>
                <div class="form-group row padding-left-50-px">
                    <label class="col-sm-3" for="inputTotalAddress">My total address :</label>
                    <label class="col-sm-9" for="inputTotalAddress">{{ $totalAddress }}</label>
                </div>
                <div class="col-sm-12">
                    <a href="{{ route('home') }}" type="button" class="btn btn-danger">Close</a>
                </div>
            </div>
        </div>
    </div>

@endsection

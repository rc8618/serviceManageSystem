@section('title', 'Edit My Detail')
@extends('layouts.app')

@section('content')
    @include('navbar')
    <div class="container">
        <div class="card" style="margin-top:20px;">
            <div class="card-body">
                <h3 style="text-align:center;">Edit My Detail</h3>
                <hr>
                <form action="{{ route('storeDetail',$myDetail->id) }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
							<input type="text" class="form-control" id="name" 
									name="name"
									placeholder="Please enter name" 
									value="{{ isset($myDetail) ? $myDetail->name : old('name') }}">
                            <span class="error-msg">
                                {{ $errors->first('name') }}
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
							<input type="email" class="form-control" id="email"
									name="email"
								   	placeholder="Please enter email"
								   	value="{{ isset($myDetail) ? $myDetail->email : old('email') }}">
                            <span class="error-msg">
                                {{ $errors->first('email') }}
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
							<a href="{{ route('home') }}" type="button" class="btn btn-danger">Close</a>
                            <button type="submit" class="btn btn-primary" style="float:right;">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

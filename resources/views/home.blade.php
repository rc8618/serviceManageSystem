@section('title', 'Dashboard')
@extends('layouts.app')

@section('content')
    @include('navbar')

    <div class="container">
        @if(session()->has('msg'))
            <div class="alert alert-success alert-dismissible margin-top-20-px" role="alert">
                <strong>Success!</strong> {{ session()->get('msg') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="row margin-top-20-px">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Manage Your Address</h5>
                        <p class="card-text">Here, You can manage your addresses like add new address, edit your address and also delete them.</p>
                        <a href="{{ route('addressIndex') }}" class="btn btn-primary">My Address</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Manage Your Account</h5>
                        <p class="card-text">Here, You can manage your account details like change your name and email.</p>
                        <a href="{{ route('editMyDetails') }}" class="btn btn-primary">My Account</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

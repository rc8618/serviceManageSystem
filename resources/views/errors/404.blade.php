@section('title', '404')
@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/error-style.css') }}">
@section('content')

    <div class="wrapper">
        <div class="content-wrapper">
            <div id="notfound">
                <div class="notfound">
                    <div class="notfound-404">
                        <h1>Oops!</h1>
                    </div>
                    <h2>404 - Page not found</h2>
                    <p> We could not find the page you were looking for. </p>
                    <p>Meanwhile, you may return to homepage.</p>
                    <a href="{{ route('home')  }}">Go To Homepage</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('title', 'Address Management')
@extends('layouts.app')

@section('content')
    @include('navbar')
    <div class="container">

        <div class="row">
            <div class="col-md-6">
                <p class="mytext"><span>Address Management</span></p>
            </div>
            <div class="col-md-6">
                <a href="{{ route('addAddressView') }}" type="button" class="btn btn-light addbtn"><i class="fa fa-plus"></i> Add</a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                @if(session()->has('msg'))
                    <div class="alert alert-success alert-dismissible margin-top-20-px" role="alert">
                        <strong>Success!</strong> {{ session()->get('msg') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if($viewAddress->count() == 0)
                    <div>No Data Available</div>
                @else
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                @foreach($columns as $key => $column)
                                    <th scope="col">{{ $column }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($viewAddress as $address)
                            <tr>
                                <td>{{ $index++ }}</td>
                                <td>{{ $address->name }}</td>
                                <td>{{ $address->email }}</td>
                                <td>{{ $address->created_at ? $address->created_at->format('d/m/Y') : '-' }}</td>
                                <td>
                                    <div class="row icons">
                                        <div class="col-md-3">
                                            <a href="{{ route('editAddressView',$address->id) }}" class="btn btn-info"><i
                                                    class="fas fa-edit"></i></a>
                                        </div>
                                        <div class="col-md-3">
                                            <form action="{{ route('deleteAddress',$address->id) }}"
                                                method="POST">
                                                {{ csrf_field() }}
                                                <button class="btn btn-danger" type="submit"
                                                        onclick="return confirm('Are you sure you want to delete this Address?')">
                                                    <i class="fa fa-trash listdeleteicon"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach  
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
    

@endsection

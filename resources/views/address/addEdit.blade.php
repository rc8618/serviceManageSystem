@section('title', isset($addressDetail) ? 'Edit Address' : 'Add Address')
@extends('layouts.app')

@section('content')
    @include('navbar')
    <div class="container">
        <div class="card" style="margin-top:20px;">
            <div class="card-body">
                <h3 style="text-align:center;">{{isset($addressDetail) ? 'Edit' : 'Add New'}} Address</h3>
                <hr>
                <form action="{{ isset($addressDetail) ? route('storeAddress',$addressDetail->id) : route('storeAddress')}}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
							<input type="text" class="form-control" id="name" 
									name="name"
									placeholder="Please enter name" 
									value="{{ isset($addressDetail) ? $addressDetail->name : old('name') }}">
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
								   	value="{{ isset($addressDetail) ? $addressDetail->email : old('email') }}">
                            <span class="error-msg">
                                {{ $errors->first('email') }}
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="street" class="col-sm-2 col-form-label">Street</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="street"
									name="street"   
									placeholder="Please enter street"
								   	value="{{ isset($addressDetail) ? $addressDetail->street : old('street') }}">
                            <span class="error-msg">
                                {{ $errors->first('street') }}
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone_no" class="col-sm-2 col-form-label">Phone No.</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="phone_no"
									name="phone_no"   
									placeholder="Please enter phone no."
								   	value="{{ isset($addressDetail) ? $addressDetail->phone_no : old('phone_no') }}">
                            <span class="error-msg">
                                {{ $errors->first('phone_no') }}
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="country_id" class="col-sm-2 col-form-label">Country</label>
                        <div class="col-sm-10">
                            <select class="browser-default custom-select" name="country_id">
								<option value="0">Select country</option>
								@foreach($country as $countryName)
									@if(isset($addressDetail))
										<option value="{{$countryName->id}}" {{ isset($addressDetail) ? ($countryName->id == $addressDetail->country_id ? 'selected' : '') : '' }}>{{$countryName->name}}</option>
									@else
										<option value="{{$countryName->id}}" {{ $countryName->id == old('country_id') ? 'selected' : '' }}>{{$countryName->name}}</option>
									@endif
								@endforeach
                            </select>
                            <span class="error-msg">
                                {{ $errors->first('country_id') }}
                            </span>
                        </div>
					</div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-form-label col-sm-2 pt-0">Services</label>
                            <div class="col-sm-10">
                                @foreach(config('constant.services') as $key => $service)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="services[]"
											   id="{{ $service }}" value="{{ $key }}"
											   {{ isset($addressServices) ? (in_array($key, $addressServices) ? 'checked' : '') : '' }}>
                                        <label class="form-check-label">
                                            {{ $service }}
                                        </label>
                                    </div>
                                @endforeach
                                <span class="error-msg">
                                    {{ $errors->first('services') }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
							<a href="{{ route('addressIndex') }}" type="button" class="btn btn-danger">Close</a>
                            <button type="submit" class="btn btn-primary" style="float:right;">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

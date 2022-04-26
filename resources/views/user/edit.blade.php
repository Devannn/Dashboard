@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="justify-content-center">
                <div class="col-md-12">
                    <div class="card top-nav-card">
                        <div class="card-body">
                            <a class="top-nav-card-a-hover" href="{{ url('/home') }}">{{ __('Dashboard') }}</a>
                            <a class="top-nav-card-a-normal">{{ __(' / Account / ') }}</a>
                            <a class="top-nav-card-a-bold" href="{{ url('/user') }}">{{ __('Edit My Account') }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="py-2"></div>
        </div>
        <div class="row">
            <div class="col-sm-3"></div>
            {{-- Edit User Account --}}
            <div class="col-sm-6">
                {{-- Current Task Container --}}
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">{{ __('Edit My Account') }}</div>
                        <div class="card-body">
                            <form action="{{ route('update') }}" id="edit_user_form" method="post">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" value="{{ old('name') ? old('name') : $user->name }}"
                                        class="form-control" id="name" placeholder="Enter Name">
                                    @if ($errors->any('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" value="{{ old('email') ? old('email') : $user->email }}"
                                        class="form-control" id="email" placeholder="Enter Email">
                                    @if ($errors->any('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="phonenumber">Phone Number</label>
                                    <input type="text" name="phonenumber"
                                        value="{{ old('phonenumber') ? old('phonenumber') : $user->phonenumber }}"
                                        class="form-control" id="phonenumber" placeholder="Enter Phone Number">
                                    @if ($errors->any('phonenumber'))
                                        <span class="text-danger">{{ $errors->first('phonenumber') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="profession">Profession</label>
                                    <input type="text" name="profession"
                                        value="{{ old('profession') ? old('profession') : $user->profession }}"
                                        class="form-control" id="profession" placeholder="Enter Profession">
                                    @if ($errors->any('profession'))
                                        <span class="text-danger">{{ $errors->first('profession') }}</span>
                                    @endif
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" name="address"
                                        value="{{ old('address') ? old('address') : $user->address }}" class="form-control"
                                        id="address" placeholder="Enter Address">
                                    @if ($errors->any('address'))
                                        <span class="text-danger">{{ $errors->first('address') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="postal_code">Postal Code</label>
                                    <input type="text" name="postal_code"
                                        value="{{ old('postal_code') ? old('empostal_codeail') : $user->postal_code }}"
                                        class="form-control" id="postal_code" placeholder="Enter Postal Code">
                                    @if ($errors->any('postal_code'))
                                        <span class="text-danger">{{ $errors->first('postal_code') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="city">City Name</label>
                                    <input type="text" name="city" value="{{ old('city') ? old('city') : $user->city }}"
                                        class="form-control" id="city" placeholder="Enter City Name">
                                    @if ($errors->any('city'))
                                        <span class="text-danger">{{ $errors->first('city') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="country">Country</label>
                                    <input type="text" name="country"
                                        value="{{ old('country') ? old('country') : $user->country }}" class="form-control"
                                        id="country" placeholder="Enter Country Name">
                                    @if ($errors->any('country'))
                                        <span class="text-danger">{{ $errors->first('country') }}</span>
                                    @endif
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary ">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3"></div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card top-nav-card">
                    <div class="card-body">
                        <a class="top-nav-card-a-hover" href="{{ url('/home') }}">{{ __('Dashboard') }}</a>
                        <a class="top-nav-card-a-normal">{{ __(' / Extra Pages / ') }}</a>
                        <a class="top-nav-card-a-bold" href="{{ url('/calendar') }}">{{ __('Calendar Log-In') }}</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-2"></div>
        <div class="row">
            <div class="col-sm-3"></div>
            {{-- The Calendar --}}
            <div class="col-sm-6">
                <div class="card top-nav-card">
                    <div class="card-header">Calendar</div>
                    <div class="card-body">
                        <p>To use the Calendar please sign in</p>
                        <a href="/signin" class="btn btn-primary btn-large">Click here to sign in</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-3"></div>
        </div>
    </div>
@endsection

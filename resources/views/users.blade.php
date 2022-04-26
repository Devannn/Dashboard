@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card top-nav-card">
                    <div class="card-body">
                        <a class="top-nav-card-a-normal" href="{{ url('/home') }}">{{ __('Dashboard') }}</a>
                        <a class="top-nav-card-a-normal">{{ __(' / Extra Pages / ') }}</a>
                        <a class="top-nav-card-a-bold" href="{{ url('/users') }}">{{ __('Users') }}</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-2"></div>
        <div class="row">
            @foreach ($users as $user)
                <div class="col-sm-4 col-each-user">
                    <div class="card">
                        <div class="card-body">
                            <div class="users-left-container">
                                <img src="img/uploads/avatars/{{ $user->avatar }}" alt="">
                                <div class="users-profession-container outer"
                                    style="width:100px; height:20px; border:1px solid transparent;">
                                    <div class="users-profession-text">{{ $user->profession }}</div>
                                </div>
                            </div>
                            <div class="users-right-container">
                                <div class="panel-body" style="overflow:auto;">
                                    <div class="users-text-name">
                                        <div>{{ $user->name }}</div>
                                    </div>
                                    <div class="users-text-email">
                                        <a href="mailto:{{ $user->email }}">
                                            <div class="users-text-email">{{ $user->email }}</div>
                                        </a>
                                    </div>
                                    <div class="users-text-name">
                                        <div>{{ $user->address }}</div>
                                    </div>
                                    <div class="users-text-name">
                                        <div>{{ $user->postal_code }}, {{ $user->city }}</div>
                                    </div>
                                    <div class="users-text-name">
                                        <div>{{ $user->country }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

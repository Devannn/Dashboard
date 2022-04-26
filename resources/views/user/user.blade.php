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
                            <a class="top-nav-card-a-bold" href="{{ url('/user') }}">{{ __('My Account') }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="py-2"></div>
        </div>
        <div class="row">
            <div class="col-sm-3"></div>
            {{-- User Account --}}
            <div class="col-sm-6">
                <div class="col-md-12">
                    {{-- Personal Settings Card --}}
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-8">
                                    {{ __('Personal Settings') }}
                                </div>
                                <div class="col-md-4 col-settings">
                                    <a href="{{ url('/user/edit-personal') }}">
                                        <i class='icon icon-edit'>Edit Personal Settings
                                            <x-heroicon-o-pencil-alt style="height: 20px;" />
                                        </i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-1">
                                    <i class='icon'>
                                        <x-heroicon-o-user style="height: 20px;" />
                                    </i>
                                </div>
                                <div class="col-md-11">
                                    <div class="user-text-name">{{ Auth::user()->name }}</div>
                                    <div class="user-text-phonenumber">{{ Auth::user()->phonenumber }}</div>
                                    <div class="user-text-profession">{{ Auth::user()->profession }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="py-2"></div>
                    {{-- Security Settings Card --}}
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    {{ __('Security Settings') }}
                                </div>
                                <div class="col-md-6 col-settings">
                                    <a href="{{ url('/user/edit-security') }}">
                                        <i class='icon icon-edit'>Edit Security Settings
                                            <x-heroicon-o-pencil-alt style="height: 20px;" />
                                        </i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-1">
                                    <i class='icon'>
                                        <x-heroicon-o-shield-check style="height: 20px;" />
                                    </i>
                                </div>
                                <div class="col-md-11">
                                    <div class="user-text-email">{{ Auth::user()->email }}</div>
                                    <div class="user-text-password" style="font-weight: bold;">**********</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="py-2"></div>
                    {{-- Address Settings Card --}}
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-8">
                                    {{ __('Address Settings') }}
                                </div>
                                <div class="col-md-4 col-settings">
                                    <a href="{{ url('/user/edit-address') }}">
                                        <i class='icon icon-edit'>Edit Address Settings
                                            <x-heroicon-o-pencil-alt style="height: 20px;" />
                                        </i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-1">
                                    <i class='icon'>
                                        <x-heroicon-o-location-marker style="height: 20px;" />
                                    </i>
                                </div>
                                <div class="col-md-11">
                                    <div class="user-text-email">{{ Auth::user()->address }}</div>
                                    <div class="user-text-postal_code">{{ Auth::user()->postal_code }},
                                        {{ Auth::user()->city }}</div>
                                    <div class="user-text-country">{{ Auth::user()->country }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3"></div>
        </div>
    </div>
@endsection

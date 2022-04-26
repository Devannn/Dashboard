@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="justify-content-center">
                <div class="col-md-12">
                    <div class="card top-nav-card">
                        <div class="card-body">
                            <a class="top-nav-card-a-hover" href="{{ url('/home') }}">{{ __('Dashboard') }}</a>
                            <a class="top-nav-card-a-normal" href="{{ url('/user') }}">{{ __(' / Account / ') }}</a>
                            <a class="top-nav-card-a-bold"
                                href="{{ url('/user/edit-security') }}">{{ __('Edit My Security Settings') }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="py-2"></div>
        </div>
        <div class="row justify-content-center">
            {{-- Edit User Account --}}
            <div class="col-sm-6">
                {{-- Edit Email Container --}}
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">{{ __('Edit My Email') }}</div>
                        <div class="card-body">
                            <form action="{{ route('update-email') }}" id="edit_user_form" method="post">
                                @csrf
                                @method('PUT')
                                {{-- Email --}}
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="email"
                                        value="{{ old('email') ? old('email') : auth()->user()->email }}"
                                        class="form-control" id="email" placeholder="Enter Email">
                                    @if ($errors->any('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary ">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-2"></div>
        <div class="row justify-content-center">
            {{-- Edit User Account --}}
            <div class="col-sm-6">
                {{-- Edit Password Container --}}
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">{{ __('Edit My Password') }}</div>
                        <div class="card-body">
                            <form action="{{ route('update-password') }}" method="POST">
                                @csrf
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @elseif (session('error'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                {{-- Old Password --}}
                                <div class="form-group">
                                    <label for="oldPasswordInput">Old Password</label>
                                    <input name="old_password" type="password"
                                        class="form-control @error('old_password') is-invalid @enderror"
                                        id="oldPasswordInput" placeholder="Old Password">
                                    @error('old_password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="newPasswordInput">New Password</label>
                                    <input name="new_password" type="password"
                                        class="form-control @error('new_password') is-invalid @enderror"
                                        id="newPasswordInput" placeholder="New Password">
                                    @error('new_password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="confirmNewPasswordInput">Confirm New Password</label>
                                    <input name="new_password_confirmation" type="password" class="form-control"
                                        id="confirmNewPasswordInput" placeholder="Confirm New Password">
                                </div>
                                <br>
                                <button class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-2"></div>
    </div>
@endsection

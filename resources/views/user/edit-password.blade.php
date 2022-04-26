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
                {{-- Edit Password Container --}}
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">{{ __('Edit My Password') }}</div>
                        <div class="card-body">
                            <form action="{{ route('update-password') }}" id="edit_user_form" method="post">
                                @csrf
                                @method('PUT')
                                {{-- Password --}}
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" value="" class="form-control" id="password"
                                        placeholder="Enter Password">
                                    @if ($errors->any('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>

                                {{-- Confirm Password --}}
                                <div class="form-group">
                                    <label for="confirm-password">Confirm Password</label>
                                    <input type="confirm-password" name="confirm-password" value="" class="form-control"
                                        id="confirmpassword" placeholder="Confirm Password">
                                    @if ($errors->any('confirm-password'))
                                        <span class="text-danger">{{ $errors->first('confirm-password') }}</span>
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
    </div>
@endsection

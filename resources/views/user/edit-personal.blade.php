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
                                href="{{ url('/user/edit-personal') }}">{{ __('Edit My Personal Settings') }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="py-2"></div>
        </div>
        <div class="row justify-content-center">
            {{-- Edit User Account --}}
            <div class="col-sm-6">
                {{-- Edit Personal Container --}}
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">{{ __('Edit My Personal Settings') }}</div>
                        <div class="card-body">
                            <form action="{{ route('update-personal') }}" id="edit_user_form" method="post">
                                @csrf
                                @method('PUT')
                                {{-- Name --}}
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" value="{{ old('name') ? old('name') : $user->name }}"
                                        class="form-control" id="name" placeholder="Enter Name">
                                    @if ($errors->any('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>

                                {{-- Phone Number --}}
                                <div class="form-group">
                                    <label for="phonenumber">Phone Number</label>
                                    <input type="text" name="phonenumber"
                                        value="{{ old('phonenumber') ? old('phonenumber') : $user->phonenumber }}"
                                        class="form-control" id="phonenumber" placeholder="Enter Phone Number">
                                    @if ($errors->any('phonenumber'))
                                        <span class="text-danger">{{ $errors->first('phonenumber') }}</span>
                                    @endif
                                </div>

                                {{-- Profession --}}
                                <div class="form-group profession-form-group">
                                    <label for="profession">Profession</label><br>
                                    <select name="profession" id="profession-dropdown">
                                        <option value="">None</option>
                                        <option value="Web Developer">Web Developer</option>
                                        <option value="Software Developer">Software Developer</option>
                                        <option value="Graphic Design">Graphic Design</option>
                                        <option value="Human Resources">Human Resources</option>
                                    </select>
                                </div>

                                <br>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="py-2"></div>

                {{-- Edit Profile Picture --}}
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">{{ __('Edit My Profile Picture') }}</div>
                        <div class="card-body">
                            <form enctype="multipart/form-data" action="/user" method="POST" style="margin-top: -8px;">
                                <label style="font-size: 14px;">Update Profile Image</label>
                                <input type="file" name="avatar" style="font-size: 14px;">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <br>
                                <br>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

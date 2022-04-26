@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card top-nav-card">
                    <div class="card-body">
                        <a class="top-nav-card-a-hover" href="{{ url('/home') }}">{{ __('Dashboard') }}</a>
                        <a class="top-nav-card-a-normal">{{ __(' / Extra Pages / ') }}</a>
                        <a class="top-nav-card-a-bold" href="{{ url('/calendar') }}">{{ __('Calendar - New Event') }}</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-2"></div>
        <div class="row justify-content-center">
            {{-- New Task Container --}}
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header card-header-new-task">{{ __('Add New Event') }}</div>
                    <div class="card-body card-body-new-task">
                        <!-- New Event Form -->
                        <form method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Subject</label>
                                <input type="text" class="form-control" name="eventSubject" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" name="eventAttendees"
                                    placeholder="email@beginstation.nl;email@beginstation.nl" />
                            </div>
                            <div class="row justify-content-center p-7">
                                <div class="col-sm-6">
                                    <!-- Task Title -->
                                    <div class="form-group">
                                        <label>Start</label>
                                        <input type="datetime-local" class="form-control" name="eventStart"
                                            id="eventStart" />
                                    </div>
                                    @error('eventStart')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6">
                                    <!-- Task Body -->
                                    <div class="form-group col-sm-12">
                                        <div class="form-group">
                                            <label>End</label>
                                            <input type="datetime-local" class="form-control" name="eventEnd" />
                                        </div>
                                        @error('eventEnd')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Message</label>
                                <textarea type="text" class="form-control" name="eventBody" rows="3"></textarea>
                            </div>
                            <div class="py-2"></div>
                            <input type="submit" class="btn btn-primary mr-2" value="Create" />
                            <a class="btn btn-secondary"
                                href={{ action('App\Http\Controllers\CalendarController@calendar') }}>Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

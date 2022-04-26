@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card top-nav-card">
                    <div class="card-body">
                        <a class="top-nav-card-a-hover" href="{{ url('/home') }}">{{ __('Dashboard') }}</a>
                        <a class="top-nav-card-a-normal">{{ __(' / Extra Pages / ') }}</a>
                        <a class="top-nav-card-a-bold" href="{{ url('/calendar') }}">{{ __('Calendar') }}</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-2"></div>
        <div class="row">
            <div class="col-sm-2"></div>
            {{-- The Calendar --}}
            <div class="col-sm-8">
                <div class="card top-nav-card">
                    <div class="card-header">
                        <h1>Calendar</h1>
                        <h2>{{ $dateRange }}</h2>
                    </div>
                    <div class="card-body">
                        <a class="btn btn-primary btn-sm mb-3"
                            href={{ action('App\Http\Controllers\CalendarController@getNewEventForm') }}>New event</a>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Organizer</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Start</th>
                                    <th scope="col">End</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($events)
                                    @foreach ($events as $event)
                                        <tr>
                                            <td>{{ $event->getOrganizer()->getEmailAddress()->getName() }}</td>
                                            <td>{{ $event->getSubject() }}</td>
                                            <td>{{ \Carbon\Carbon::parse($event->getStart()->getDateTime())->format('n/j/y g:i A') }}
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($event->getEnd()->getDateTime())->format('n/j/y g:i A') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2"></div>
            </div>
        </div>
    @endsection

@extends('layouts.app')

@section('scripts')
<link rel='stylesheet' href="{{ asset('css/fullcalendar.css') }}" />
<script src="{{ asset('js/moment.min.js') }}"></script>
<script src="{{ asset('js/fullcalendar.js') }}"></script>

</script>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>Calendar of Events</h1>
                </div>

                <div class="panel-body">
                    <div class="col-md-8">
                        {!! $calendar->calendar() !!}
                        {!! $calendar->script() !!}
                    </div>
                    <div class="col-md-4">
                        @if ( Auth::user() !== null and Auth::user()->privilege() === 1 )
                            <a href="/calendar/add-event">Add event</a>
                            @if ($eventToShow !== null)
                            |
                            <a href="/calendar/edit-event/{{ $eventToShow->id }}" class="align-right">Edit event</a>
                            |
                            <a href="/calendar/delete-event/{{ $eventToShow->id }}" class="align-right">Delete event</a>
                            @endif
                        @endif
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h1>Event Details</h1>
                            </div>

                            <div class="panel-body">
                                @if ($eventToShow === null)
                                <p>Click an event to see details.</p>
                                @else
                                <h4>
                                    {{ $eventToShow->title }}
                                    <br>
                                    <small>
                                        {{ date('D, d M Y g:ia', strtotime($eventToShow->startTime)) }} - 
                                        <br>
                                        {{ date('D, d M Y g:ia', strtotime($eventToShow->endTime)) }}
                                    </small>
                                </h4>
                                <p>{{ $eventToShow->description}}</p>
                                <a href="#">Pre-Register Now!</a>
                                @endif
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
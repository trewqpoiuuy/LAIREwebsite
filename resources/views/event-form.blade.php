@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
                <div class="panel-heading"><h1>Add an Event</h1></div>
                <div class="panel-body">
                    @if ($eventID === null)
                    <form class="form-horizontal" role="form" method="POST" action="{{ route($destination) }}">
                    @else
                    <form class="form-horizontal" role="form" method="POST" action="{{ route($destination, ['eventID' => $eventID]) }}">
                    @endif
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">Title</label>
                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title', $title) }}" required autofocus>

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Description</label>
                            <div class="col-md-6">
                                <textarea id="description" class="form-control" name="description">{{ old('description', $description) }}</textarea>

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('startTime') ? ' has-error' : '' }}">
                            <label for="startTime" class="col-md-4 control-label">Start Time</label>
                            <div class="col-md-6">
                                <input id="startTime" type="datetime-local" class="form-control" name="startTime" value="{{ old('startTime', $startTime) }}" required autofocus>

                                @if ($errors->has('startTime'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('startTime') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('endTime') ? ' has-error' : '' }}">
                            <label for="endTime" class="col-md-4 control-label">End Time</label>
                            <div class="col-md-6">
                                <input id="endTime" type="datetime-local" class="form-control" name="endTime" value="{{ old('endTime', $endTime) }}" required autofocus>

                                @if ($errors->has('endTime'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('endTime') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
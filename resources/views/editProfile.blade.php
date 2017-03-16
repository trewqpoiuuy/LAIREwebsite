@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
                <div class="panel-heading"><h1>Edit your Profile</h1></div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('updateProfile', ['username' => $username]) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Real Name</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $realName) }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                            <label for="avatar" class="col-md-4 control-label">Avatar</label>
                            <div class="col-md-6">
                                <input id="avatar" type="file" class="form-control" name="avatar" value="{{ old('avatar') }}">

                                @if ($errors->has('avatar'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('avatar') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('bio') ? ' has-error' : '' }}">
                            <label for="bio" class="col-md-4 control-label">Bio</label>
                            <div class="col-md-6">
                                <textarea id="bio" class="form-control" name="bio">{{ old('bio', $bio) }}</textarea>

                                @if ($errors->has('bio'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('bio') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Save Changes
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
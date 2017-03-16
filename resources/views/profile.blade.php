@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
        	<div class="panel panel-default">
				@if ($userFound)
                <div class="panel-heading">
                <img src="/images/avatars/{{ $avatar }}" alt="{{ $realName }}'s avatar" class="img-thumbnail avatar">
                <h1>{{$realName}} <small>{{$username}} 
						@if ($id == Auth::id())
						<small><a href="./{{$username}}/edit">edit profile</a></small>
						@endif
					</small>
				</h1>
				</div>
                <div class="panel-body">
					<p>{{$bio}}</p>
				</div>

				@else
				<div class="panel-heading">
					<h1>User not found</h1>
				</div>
				<div class="panel-body">
					<p>'{{$username}}' could not be found in our database.</p>
				</div>
				@endif
			</div>
        </div>
    </div>
</div>

@endsection
@extends('layouts.app')

@section('template_title')
	{!! trans('titles.exceeded') !!}
@endsection

@section('content')
	<div class="panel panel-danger">
		<div class="panel-heading">
			{!! trans('titles.exceeded') !!}
		</div>
		<div class="panel-body">
			<p>
				{!! trans('auth.tooManyEmails', ['email' => $email, 'hours' => $hours]) !!}
			</p>
		</div>
	</div>
@endsection

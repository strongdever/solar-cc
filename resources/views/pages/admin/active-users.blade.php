@extends('layouts.app')

@section('template_title')
    {{ trans('titles.activeUsers') }}
@endsection

@section('content')

<div class="row">
    <users-count :registered={{ $users }} ></users-count>
</div>

@endsection

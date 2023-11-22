@extends('layouts.app')

@section('template_title')
	{!! trans('titles.resetPwordSuccess') !!}
@endsection

@section('template_fastload_css')
    .inner-page .alert {
        max-width: 50rem;
        margin-left: auto;
        margin-right: auto;
    }
    .inner-page .alert-danger,
    .inner-page .alert-success {
        display: none;
    }
@endsection

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {!! session('status') !!}
        </div>
    @endif
    <div class="sign-form-card">
        <h3 class="card-title">
            {{ __('パスワードが変更されました') }}
        </h3>
        <div class="card-body text-center">
            <a href="{{ url('/home') }}" class="btn btn-info mx-auto form-submit">
                {{ __('ホーム画面に移動する') }}
            </a>
            
        </div>
    </div>
@endsection

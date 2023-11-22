@extends('layouts.app')

@section('template_title')
	{!! trans('titles.resetPword') !!}
@endsection

@section('template_fastload_css')
    .inner-page .alert {
        max-width: 50rem;
        margin-left: auto;
        margin-right: auto;
    }
    .inner-page .alert-danger {
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
            {{ __('パスワード再設定') }}
        </h3>
        <div class="card-body">
            <form action="{{ route('password.email') }}" method="post" class="form sign-form">
                @csrf
                <ul class="form-group">
                    <li>
                        <div class="input-group">
                            <label for="email" class="label">{{ __('メールアドレス') }}</label>
                            <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                            @if ($errors->has('email'))
                                <p class="invalid-feedback">{{ $errors->first('email') }}</p>
                            @endif
                        </div>
                    </li>
                </ul>
                <div class="form-action">
                    <button type="submit" class="btn btn-block btn-info form-submit">
                        {{ __('送信する') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

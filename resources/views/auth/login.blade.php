@extends('layouts.app')

@section('template_title')
	{!! trans('titles.login') !!}
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

    <div class="sign-form-card">
        <h3 class="card-title">{{ __('販売店様ログイン') }}</h3>
        <div class="card-body">
            <form action="{{ route('login') }}" method="post" class="form sign-form">
                @csrf
                <ul class="form-group">
                    <li>
                        <div class="input-group">
                            <label for="name" class="label">{{ __('ID') }}</label>
                            <input type="text" class="form-control{{ $errors->has('uuid') ? ' is-invalid' : '' }}" name="uuid" value="{{ old('uuid') }}" required autofocus>
                            @if ($errors->has('uuid'))
                                <p class="invalid-feedback">{{ $errors->first('uuid') }}</p>
                            @endif
                        </div>
                    </li>
                    <li>
                        <div class="input-group">
                            <label for="password" class="label">{{ __('パスワード') }}</label>
                            <div class="password-control">
                                <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                <i class="control-icon" aria-hidden="true"></i>
                            </div>
                            @if ($errors->has('password'))
                                <p class="invalid-feedback">{{ $errors->first('password') }}</p>
                            @endif
                        </div>
                    </li>
                </ul>
                <div class="form-meta">パスワードをお忘れの方は<a href="{{ route('password.request') }}">こちら</a></div>
                <div class="form-action">
                    <button type="submit" class="btn btn-block btn-info form-submit">
                        {{ __('ログイン') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection

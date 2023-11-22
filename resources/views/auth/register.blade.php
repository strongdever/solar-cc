@extends('layouts.app')

@section('template_title')
	{!! trans('titles.register') !!}
@endsection

@section('template_fastload_css')
    .inner-page .alert {
        max-width: 50rem;
        margin-left: auto;
        margin-right: auto;
    }
@endsection

@section('content')

    <div class="sign-form-card">
        <h3 class="card-title">
            {{ __('カーポート倶楽部新規登録') }}
        </h3>
        <div class="card-body">
            <form action="{{ route('register') }}" method="post" class="form sign-form">
                @csrf
                <ul class="form-group">
                    <li>
                        <div class="input-group">
                            <label for="uuid" class="label">{{ __('ID') }}</label>
                            <input type="text" class="form-control{{ $errors->has('uuid') ? ' is-invalid' : '' }}" name="uuid" value="{{ old('uuid') }}" required autofocus>
                            @if ($errors->has('uuid'))
                                <p class="invalid-feedback">{{ $errors->first('uuid') }}</p>
                            @endif
                        </div>
                    </li>
                    <li>
                        <div class="input-group">
                            <label for="email" class="label">{{ __('メールアドレス') }}</label>
                            <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                            @if ($errors->has('email'))
                                <p class="invalid-feedback">{{ $errors->first('email') }}</p>
                            @endif
                        </div>
                    </li>
                    <li>
                        <div class="input-group">
                            <label for="password" class="label">{{ __('パスワード') }}</label>
                            <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                            @if ($errors->has('password'))
                                <p class="invalid-feedback">{{ $errors->first('password') }}</p>
                            @endif
                        </div>
                    </li>
                    <li>
                        <div class="input-group">
                            <label for="password" class="label">{{ __('パスワード（確認用）') }}</label>
                            <input type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" required>
                            @if ($errors->has('password_confirmation'))
                                <p class="invalid-feedback">{{ $errors->first('password_confirmation') }}</p>
                            @endif
                        </div>
                    </li>
                </ul>
                <div class="form-term">
                    <label class="form-checkbox">当社の<a href="#">利用規約</a>と<a href="#">プライバシーポリシー</a>に<br>同意する
                        <input type="checkbox" name="confirm_term" value="1">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="form-action">
                    <button type="submit" class="btn btn-block btn-info form-submit" disabled>
                        {{ __('登録する') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection

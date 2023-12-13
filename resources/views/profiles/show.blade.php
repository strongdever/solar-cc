@extends('layouts.app')

@section('template_title')
    {!! trans('profile.title-alt') !!}
@endsection

@section('template_fastload_css')
    .inner-page .alert {
        max-width: 90rem;
        margin-left: auto;
        margin-right: auto;
    }
@endsection

@php
    $levelAmount = trans('usersmanagement.labelUserLevel');
    if ($user->level() >= 2) {
        $levelAmount = trans('usersmanagement.labelUserLevels');
    }
@endphp

@section('content')

<div class="dashboard-wrapper">
    <div class="dashboard-card">
        <div class="card-header">
            <h3 class="lead text-center">
                {!! trans('profile.title-alt') !!}
            </h3>
        </div>
        <div class="card-body">
            <div class="form-card mb-50 mb-sp-40">
                <h3 class="card-title">{{ __('新規カーポートの登録') }}</h3>
                <div class="card-body">
                    <form action="" method="post" class="form">
                    {!! Form::open(array('route' => ['profile.update', $user->uuid], 'method' => 'PATCH', 'role' => 'form', 'class' => 'form needs-validation')) !!}
                        {!! csrf_field() !!}
                        <input type="hidden" name="action" value="update">
                        <ul class="form-group">
                            <li>
                                <div class="input-group">
                                    <label for="uuid" class="label">{{ __('販売店ID') }}</label>
                                    <p class="noinput">{{ $user->uuid }}</p>
                                </div>
                            </li>
                            <li>
                                <div class="input-group">
                                    <label for="company" class="label">{{ __('販売店名称') }}</label>
                                    <input type="text" class="form-control md{{ $errors->has('company') ? ' is-invalid' : '' }}" name="company" value="{{ $user->company }}" placeholder="例）株式会社カーポートソーラーシステム" autofocus>
                                    @if ($errors->has('company'))
                                        <p class="invalid-feedback">{{ $errors->first('company') }}</p>
                                    @endif
                                </div>
                            </li>
                            <li>
                                <div class="input-group">
                                    <label for="zipcode" class="label">{{ __('郵便番号') }}</label>
                                    <input type="text" class="form-control sd{{ $errors->has('zipcode') ? ' is-invalid' : '' }}" name="zipcode" value="{{ $user->zipcode }}" placeholder="例）123-4567">
                                    @if ($errors->has('zipcode'))
                                        <p class="invalid-feedback">{{ $errors->first('zipcode') }}</p>
                                    @endif
                                </div>
                            </li>
                            <li>
                                <div class="form-row">
                                    <div class="form-col">
                                        <div class="input-group">
                                            <label for="address1" class="label">{{ __('住所1') }}</label>
                                            <input type="text" class="form-control sm{{ $errors->has('address1') ? ' is-invalid' : '' }}" name="address1" value="{{ $user->address1 }}" placeholder="例）東京都新宿区西新宿2-8-1">
                                            @if ($errors->has('address1'))
                                                <p class="invalid-feedback">{{ $errors->first('address1') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-col">
                                        <div class="input-group">
                                            <label for="address2" class="label">{{ __('住所2') }}</label>
                                            <input type="text" class="form-control sm{{ $errors->has('address2') ? ' is-invalid' : '' }}" name="address2" value="{{ $user->address2 }}" placeholder="例）西新宿ビル1階">
                                            @if ($errors->has('address2'))
                                                <p class="invalid-feedback">{{ $errors->first('address2') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="input-group">
                                    <label for="phone" class="label">{{ __('連絡先') }}</label>
                                    <input type="text" class="form-control sm{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ $user->phone }}" placeholder="例）03-1234-5678">
                                    @if ($errors->has('phone'))
                                        <p class="invalid-feedback">{{ $errors->first('phone') }}</p>
                                    @endif
                                </div>
                            </li>
                            <li>
                                <div class="input-group">
                                    <label for="email" class="label">{{ __('メールアドレス') }}</label>
                                    <input type="email" class="form-control md{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->email }}" placeholder="例）info@example.com">
                                    @if ($errors->has('email'))
                                        <p class="invalid-feedback">{{ $errors->first('email') }}</p>
                                    @endif
                                </div>
                            </li>
                            <li>
                                <div class="input-group">
                                    <label for="name" class="label">{{ __('担当者') }}</label>
                                    <input type="text" class="form-control sm{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $user->name }}" placeholder="例）山田太郎">
                                    @if ($errors->has('name'))
                                        <p class="invalid-feedback">{{ $errors->first('name') }}</p>
                                    @endif
                                </div>
                            </li>
                        </ul>
                        <div class="form-action">
                            {!! Form::button(trans('profile.buttons.update'), array('class' => 'btn btn-info', 'type' => 'submit' ) ) !!}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="form-card mb-50 mb-sp-40">
                <h3 class="card-title">{{ __('契約情報変更') }}</h3>
                <div class="card-body">
                    {!! Form::open(array('route' => ['profile.update', $user->uuid], 'method' => 'PATCH', 'role' => 'form', 'class' => 'form needs-validation')) !!}
                        {!! csrf_field() !!}
                        <input type="hidden" name="action" value="term">    
                        <ul class="form-group">
                            <li>
                                <div class="input-group">
                                    <label for="deadline" class="label">{{ __('締め日') }}</label>
                                    <ul class="choice-group">
                                        <li>
                                            <label class="form-radiobox">10日
                                                <input type="radio" name="deadline" value="10" @if((int)$user->term->deadline === 10) checked @endif>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="form-radiobox">20日
                                                <input type="radio" name="deadline" value="20" @if((int)$user->term->deadline === 20) checked @endif>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="form-radiobox">末日
                                                <input type="radio" name="deadline" value="30" @if((int)$user->term->deadline === 30) checked @endif>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>

                                    </ul>
                                    @if ($errors->has('deadline'))
                                        <p class="invalid-feedback">{{ $errors->first('deadline') }}</p>
                                    @endif

                                </div>
                            </li>
                            <li>
                                <div class="input-group">
                                    <label for="comment" class="label">{{ __('備考') }}</label>
                                    <textarea class="form-control xs{{ $errors->has('comment') ? ' is-invalid' : '' }}" name="comment" id="comment" rows="8" placeholder="ここに備考を入力してください">{{ $user->term->comment }}</textarea>
                                    @if ($errors->has('comment'))
                                        <p class="invalid-feedback">{{ $errors->first('comment') }}</p>
                                    @endif
                                </div>
                            </li>
                        </ul>
                        <div class="form-action">
                            {!! Form::button(trans('profile.buttons.update'), array('class' => 'btn btn-info', 'type' => 'submit' ) ) !!}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="form-card mb-50 mb-sp-40">
                <h3 class="card-title">{{ __('口座情報') }}</h3>
                <div class="card-body">
                    {!! Form::open(array('route' => ['profile.update', $user->uuid], 'method' => 'PATCH', 'role' => 'form', 'class' => 'form needs-validation')) !!}
                        {!! csrf_field() !!}
                        <input type="hidden" name="action" value="bank">    
                        <ul class="form-group">
                            <li>
                                <div class="input-group">
                                    <label for="name" class="label">{{ __('金融機関名') }}</label>
                                    <input type="text" class="form-control sm{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $user->bank->name }}" placeholder="{{ __('例）日本銀行') }}">
                                    @if ($errors->has('name'))
                                        <p class="invalid-feedback">{{ $errors->first('name') }}</p>
                                    @endif
                                </div>
                            </li>
                            <li>
                                <div class="input-group">
                                    <label for="branch" class="label">{{ __('支店名') }}</label>
                                    <input type="text" class="form-control sd{{ $errors->has('branch') ? ' is-invalid' : '' }}" name="branch" value="{{ $user->bank->branch }}" placeholder="{{ __('例）東京支店') }}">
                                    @if ($errors->has('branch'))
                                        <p class="invalid-feedback">{{ $errors->first('branch') }}</p>
                                    @endif
                                </div>
                            </li>
                            <li>
                                <div class="input-group">
                                    <label for="kind" class="label">{{ __('種別') }}</label>
                                    <input type="text" class="form-control sd{{ $errors->has('kind') ? ' is-invalid' : '' }}" name="kind" value="{{ $user->bank->kind }}" placeholder="{{ __('例）普通') }}">
                                    @if ($errors->has('kind'))
                                        <p class="invalid-feedback">{{ $errors->first('kind') }}</p>
                                    @endif
                                </div>
                            </li>
                            <li>
                                <div class="input-group">
                                    <label for="number" class="label">{{ __('口座番号') }}</label>
                                    <input type="text" class="form-control sm{{ $errors->has('number') ? ' is-invalid' : '' }}" name="number" value="{{ $user->bank->number }}" placeholder="{{ __('例）12345678') }}">
                                    @if ($errors->has('number'))
                                        <p class="invalid-feedback">{{ $errors->first('number') }}</p>
                                    @endif
                                </div>
                            </li>
                            <li>
                                <div class="input-group">
                                    <label for="holder" class="label">{{ __('口座名義') }}</label>
                                    <input type="text" class="form-control sm{{ $errors->has('holder') ? ' is-invalid' : '' }}" name="holder" value="{{ $user->bank->holder }}" placeholder="{{ __('例）ヤマダタロウ') }}">
                                    @if ($errors->has('holder'))
                                        <p class="invalid-feedback">{{ $errors->first('holder') }}</p>
                                    @endif
                                </div>
                            </li>
                        </ul>
                        <div class="form-action">
                            {!! Form::button(trans('profile.buttons.update'), array('class' => 'btn btn-info', 'type' => 'submit' ) ) !!}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="form-card">
                <h3 class="card-title">{{ __('パスワード変更') }}</h3>
                <div class="card-body">
                    {!! Form::open(array('route' => ['profile.update', $user->uuid], 'method' => 'PATCH', 'role' => 'form', 'class' => 'form needs-validation')) !!}
                        {!! csrf_field() !!}
                        <input type="hidden" name="action" value="password">    
                        <ul class="form-group">
                            <li>
                                <div class="input-group">
                                    <label for="old_password" class="label">{{ __('現在のパスワード') }}</label>
                                    <input type="password" class="form-control sm{{ $errors->has('old_password') ? ' is-invalid' : '' }}" name="old_password" value="{{ old('old_password') }}">
                                    @if ($errors->has('old_password'))
                                        <p class="invalid-feedback">{{ $errors->first('old_password') }}</p>
                                    @endif
                                </div>
                            </li>
                            <li>
                                <div class="input-group">
                                    <label for="password" class="label">{{ __('新しいパスワード') }}</label>
                                    <input type="password" class="form-control sm{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="{{ old('password') }}">
                                    @if ($errors->has('password'))
                                        <p class="invalid-feedback">{{ $errors->first('password') }}</p>
                                    @endif
                                </div>
                            </li>
                            <li>
                                <div class="input-group">
                                    <label for="password_confirmation" class="label">{{ __('新しいパスワード（確認）') }}</label>
                                    <input type="password" class="form-control sm{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" value="{{ old('password_confirmation') }}">
                                    @if ($errors->has('password_confirmation'))
                                        <p class="invalid-feedback">{{ $errors->first('password_confirmation') }}</p>
                                    @endif
                                </div>
                            </li>
                        </ul>
                        <div class="form-action">
                            {!! Form::button(trans('profile.buttons.update'), array('class' => 'btn btn-info', 'type' => 'submit' ) ) !!}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@include('modals.modal-delete')

@endsection

@section('footer_scripts')
@include('scripts.delete-modal-script')
@if(config('usersmanagement.tooltipsEnabled'))
@include('scripts.tooltips')
@endif
@endsection
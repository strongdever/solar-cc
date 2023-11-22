@extends('layouts.app')

@section('template_title')
    {!! trans('usersmanagement.menu-alt') !!}
@endsection

@section('template_linked_css')
@endsection

@section('content')

    <div class="dashboard-card">
        <div class="common-caption">
            <h3 class="label y-padding">{!! trans('usersmanagement.titles.edit-alt') !!}</h3>
            <ul class="actions">
                <li>
                    <a class="btn btn-secondary text-white" href="{{ route('stores') }}">
                        {!! trans('usersmanagement.buttons.back-to-list') !!}
                    </a>
                </li>
            </ul>
        </div>
        <div class="common-form">
            <div class="form-card mb-40 mb-sp-30">
                {!! Form::open(array('route' => ['stores.update', $user->id], 'method' => 'PUT', 'role' => 'form', 'class' => 'form needs-validation')) !!}
                    {!! csrf_field() !!}
                    <h3 class="card-title">{{ __('販売店情報') }}</h3>
                    <div class="card-body">
                        <input type="hidden" name="action" value="update">
                        <table class="form-table">
                            <tbody>
                                <tr>
                                    <th>{{ __('販売店ID') }}</th>
                                    <td>
                                        <div class="form-input">
                                            <input type="text" class="form-control{{ $errors->has('uuid') ? ' is-invalid' : '' }}" name="uuid" value="{{ $user->uuid }}" placeholder="{{ __('例）carport123') }}" autofocus>
                                            @if ($errors->has('uuid'))
                                                <p class="invalid-feedback">{{ $errors->first('uuid') }}</p>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('販売店名称') }}</th>
                                    <td>
                                        <div class="form-input">
                                            <input type="text" class="form-control{{ $errors->has('company') ? ' is-invalid' : '' }}" name="company" value="{{ $user->company }}" placeholder="{{ __('例）株式会社株式会社ティーエムユニオン') }}">
                                            @if ($errors->has('company'))
                                                <p class="invalid-feedback">{{ $errors->first('company') }}</p>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('郵便番号') }}</th>
                                    <td>
                                        <div class="form-input">
                                            <input type="text" class="form-control{{ $errors->has('zipcode') ? ' is-invalid' : '' }}" name="zipcode" value="{{ $user->zipcode }}" placeholder="{{ __('例）310-0851') }}">
                                            @if ($errors->has('zipcode'))
                                                <p class="invalid-feedback">{{ $errors->first('zipcode') }}</p>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('住所1') }}</th>
                                    <td>
                                        <div class="form-input">
                                            <input type="text" class="form-control{{ $errors->has('address1') ? ' is-invalid' : '' }}" name="address1" value="{{ $user->address1 }}" placeholder="{{ __('例）茨城県水戸市千波町1950') }}">
                                            @if ($errors->has('address1'))
                                                <p class="invalid-feedback">{{ $errors->first('address1') }}</p>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('住所2') }}</th>
                                    <td>
                                        <div class="form-input">
                                            <input type="text" class="form-control{{ $errors->has('address2') ? ' is-invalid' : '' }}" name="address2" value="{{ $user->address2 }}" placeholder="{{ __('例）ウェーブ21ビル2F') }}">
                                            @if ($errors->has('address2'))
                                                <p class="invalid-feedback">{{ $errors->first('address2') }}</p>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('連絡先') }}</th>
                                    <td>
                                        <div class="form-input">
                                            <input type="tel" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ $user->phone }}" placeholder="{{ __('例）029-303-8581') }}">
                                            @if ($errors->has('phone'))
                                                <p class="invalid-feedback">{{ $errors->first('phone') }}</p>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('メールアドレス') }}</th>
                                    <td>
                                        <div class="form-input">
                                            <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->email }}" placeholder="{{ __('例）info@example.com') }}">
                                            @if ($errors->has('email'))
                                                <p class="invalid-feedback">{{ $errors->first('email') }}</p>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('担当者') }}</th>
                                    <td>
                                        <div class="form-input">
                                            <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $user->name }}" placeholder="{{ __('例）山田太郎') }}">
                                            @if ($errors->has('name'))
                                                <p class="invalid-feedback">{{ $errors->first('name') }}</p>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('権限') }}</th>
                                    <td>
                                        <div class="form-input">
                                            <select name="role" id="role">
                                                <option value="">{{ trans('forms.create_user_ph_role') }}</option>
                                                @if ($roles)
                                                    @foreach($roles as $role)
                                                    <option value="{{ $role->id }}"
                                                        {{ $currentRole->id == $role->id ? 'selected="selected"' : '' }}>
                                                        {{ $role->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @if ($errors->has('role'))
                                                <p class="invalid-feedback">{{ $errors->first('role') }}</p>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-action">
                            {!! Form::button(trans('forms.update'), array('class' => 'btn form-btn btn-info btn-save','type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#confirmSave', 'data-title' => '販売店情報変更', 'data-message' => trans('usersmanagement.modals.edit_message'))) !!}
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
            <div class="form-card mb-40 mb-sp-30">
                {!! Form::open(array('route' => ['stores.update', $user->id], 'method' => 'PUT', 'role' => 'form', 'class' => 'form needs-validation')) !!}
                    {!! csrf_field() !!}
                    <h3 class="card-title">{{ __('契約情報') }}</h3>
                    <div class="card-body">
                        <input type="hidden" name="action" value="term">
                        <table class="form-table">
                            <tbody>
                                <tr>
                                    <th>{{ __('締め日') }}</th>
                                    <td>
                                        <div class="form-input">
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
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('備考') }}</th>
                                    <td>
                                        <div class="form-input">
                                            <textarea class="form-control{{ $errors->has('comment') ? ' is-invalid' : '' }}" name="comment" id="comment" rows="8" placeholder="{{ __('ここに備考を入力してください') }}">{{ $user->term->comment }}</textarea>
                                            @if ($errors->has('comment'))
                                                <p class="invalid-feedback">{{ $errors->first('comment') }}</p>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-action">
                            {!! Form::button(trans('forms.update'), array('class' => 'btn form-btn btn-info btn-save','type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#confirmSave', 'data-title' => '契約情報変更', 'data-message' => trans('usersmanagement.modals.edit_message'))) !!}
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
            <div class="form-card mb-40 mb-sp-30">
                {!! Form::open(array('route' => ['stores.update', $user->id], 'method' => 'PUT', 'role' => 'form', 'class' => 'form needs-validation')) !!}
                    {!! csrf_field() !!}
                    <h3 class="card-title">{{ __('口座情報') }}</h3>
                    <div class="card-body">
                        <input type="hidden" name="action" value="bank">
                        <table class="form-table">
                            <tbody>
                                <tr>
                                    <th>{{ __('金融機関名') }}</th>
                                    <td>
                                        <div class="form-input">
                                            <input type="text" class="form-control{{ $errors->has('bank_name') ? ' is-invalid' : '' }}" name="bank_name" value="{{ $user->bank->name }}" placeholder="{{ __('例）日本銀行') }}">
                                            @if ($errors->has('bank_name'))
                                                <p class="invalid-feedback">{{ $errors->first('bank_name') }}</p>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('支店名') }}</th>
                                    <td>
                                        <div class="form-input">
                                            <input type="text" class="form-control{{ $errors->has('bank_branch') ? ' is-invalid' : '' }}" name="bank_branch" value="{{ $user->bank->branch }}" placeholder="{{ __('例）東京支店') }}">
                                            @if ($errors->has('bank_branch'))
                                                <p class="invalid-feedback">{{ $errors->first('bank_branch') }}</p>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('種別') }}</th>
                                    <td>
                                        <div class="form-input">
                                            <input type="text" class="form-control{{ $errors->has('bank_kind') ? ' is-invalid' : '' }}" name="bank_kind" value="{{ $user->bank->kind }}" placeholder="{{ __('例）普通') }}">
                                            @if ($errors->has('bank_kind'))
                                                <p class="invalid-feedback">{{ $errors->first('bank_kind') }}</p>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('口座番号') }}</th>
                                    <td>
                                        <div class="form-input">
                                            <input type="text" class="form-control{{ $errors->has('bank_number') ? ' is-invalid' : '' }}" name="bank_number" value="{{ $user->bank->number }}" placeholder="{{ __('例）12345678') }}">
                                            @if ($errors->has('bank_number'))
                                                <p class="invalid-feedback">{{ $errors->first('bank_number') }}</p>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('口座名義') }}</th>
                                    <td>
                                        <div class="form-input">
                                            <input type="text" class="form-control{{ $errors->has('bank_holder') ? ' is-invalid' : '' }}" name="bank_holder" value="{{ $user->bank->holder }}" placeholder="{{ __('例）ヤマダタロウ') }}">
                                            @if ($errors->has('bank_holder'))
                                                <p class="invalid-feedback">{{ $errors->first('bank_holder') }}</p>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>
                        <div class="form-action">
                            {!! Form::button(trans('forms.update'), array('class' => 'btn form-btn btn-info btn-save','type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#confirmSave', 'data-title' => 'パスワード変更', 'data-message' => trans('usersmanagement.modals.edit_message'))) !!}
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
            <div class="form-card mb-40 mb-sp-30">
                {!! Form::open(array('route' => ['stores.update', $user->id], 'method' => 'PUT', 'role' => 'form', 'class' => 'form needs-validation')) !!}
                    {!! csrf_field() !!}
                    <h3 class="card-title">{{ __('パスワード設定') }}</h3>
                    <div class="card-body">
                        <input type="hidden" name="action" value="password">
                        <table class="form-table">
                            <tbody>
                                <tr>
                                    <th>{{ __('新しいパスワード') }}</th>
                                    <td>
                                        <div class="form-input">
                                            <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="{{ old('password') }}">
                                            @if ($errors->has('password'))
                                                <p class="invalid-feedback">{{ $errors->first('password') }}</p>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('新しいパスワード（確認）') }}</th>
                                    <td>
                                        <div class="form-input">
                                            <input type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" value="{{ old('password_confirmation') }}">
                                            @if ($errors->has('password_confirmation'))
                                                <p class="invalid-feedback">{{ $errors->first('password_confirmation') }}</p>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-action">
                            {!! Form::button(trans('forms.update'), array('class' => 'btn form-btn btn-info btn-save','type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#confirmSave', 'data-title' => 'パスワード変更', 'data-message' => trans('usersmanagement.modals.edit_message'))) !!}
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
            
        </div>
    </div>

@include('modals.modal-save')
@include('modals.modal-delete')

@endsection

@section('footer_scripts')
@include('scripts.delete-modal-script')
@include('scripts.save-modal-script')
@include('scripts.check-changed')
<script type="text/javascript" src="https://ajaxzip3.github.io/ajaxzip3.js"></script>
@endsection
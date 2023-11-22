@extends('layouts.app')

@section('template_title')
    {!! trans('usersmanagement.menu-alt') !!}
@endsection

@php
$levelAmount = trans('usersmanagement.labelUserLevel');
if ($user->level() >= 2) {
    $levelAmount = trans('usersmanagement.labelUserLevels');
}
@endphp

@section('content')

    <div class="dashboard-card">
        <div class="common-caption">
            <h3 class="label y-padding">{!! trans('usersmanagement.titles.show-alt') !!}</h3>
            <ul class="actions">
                <li>
                    <a class="btn btn-secondary text-white" href="{{ url('/stores') }}">
                        {!! trans('usersmanagement.buttons.back-to-list') !!}
                    </a>
                </li>
            </ul>
        </div>
        <div class="common-form show-form">
            <div class="form-card mb-40 mb-sp-30">
                <h3 class="card-title">{{ __('販売店情報') }}</h3>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>
                                {{ __('販売店ID') }}
                            </strong>
                            <div>
                                {{ $user->uuid }}
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>
                                {{ __('販売店名称') }}
                            </strong>
                            <div>
                                {{ $user->company }}
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>
                                {{ __('郵便番号') }}
                            </strong>
                            <div>
                                {{ $user->zipcode }}
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>
                                {{ __('住所1') }}
                            </strong>
                            <div>
                                {{ $user->address1 }}
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>
                                {{ __('住所1') }}
                            </strong>
                            <div>
                                {{ $user->address2 }}
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>
                                {{ __('連絡先') }}
                            </strong>
                            <div>
                                <a href="tel:{{ $user->phone }}" title="tel {{ $user->phone }}">{{ $user->phone }}</a>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>
                                {{ __('メールアドレス') }}
                            </strong>
                            <div>
                                <a href="mailto:{{ $user->email }}" title="email {{ $user->email }}">{{ $user->email }}</a>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>
                                {{ __('担当者') }}
                            </strong>
                            <div>
                                {{ $user->name }}
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>
                                {{ __('権限') }}
                            </strong>
                            <div>
                                @foreach ($user->roles as $user_role)

                                    @if ($user_role->name == 'User')
                                        @php $badgeClass = 'primary' @endphp

                                    @elseif ($user_role->name == 'Admin')
                                        @php $badgeClass = 'warning' @endphp

                                    @elseif ($user_role->name == 'Unverified')
                                        @php $badgeClass = 'danger' @endphp

                                    @else
                                        @php $badgeClass = 'default' @endphp

                                    @endif

                                    <span class="badge badge-{{$badgeClass}}">{{ $user_role->name }}</span>

                                @endforeach
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>
                                {{ __('状態') }}
                            </strong>
                            <div>
                                @if ($user->activated == 1)
                                    <span class="badge badge-success">
                                        Activated
                                    </span>
                                @else
                                    <span class="badge badge-danger">
                                        Not-Activated
                                    </span>
                                @endif
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>
                                {{ __('レベル') }}
                            </strong>
                            <div>
                                @if($user->level() >= 5)
                                    <span class="badge badge-primary mr_5">5</span>
                                @endif

                                @if($user->level() >= 4)
                                    <span class="badge badge-info mr_5">4</span>
                                @endif

                                @if($user->level() >= 3)
                                    <span class="badge badge-success mr_5">3</span>
                                @endif

                                @if($user->level() >= 2)
                                    <span class="badge badge-warning mr_5">2</span>
                                @endif

                                @if($user->level() >= 1)
                                    <span class="badge badge-secondary mr_5">1</span>
                                @endif
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>
                                {{ __('権限') }}
                            </strong>
                            <div>
                                @if($user->canViewUsers())
                                <span class="badge badge-primary mr_5">
                                    {{ trans('permsandroles.permissionView') }}
                                </span>
                                @endif

                                @if($user->canCreateUsers())
                                <span class="badge badge-info mr_5">
                                    {{ trans('permsandroles.permissionCreate') }}
                                </span>
                                @endif

                                @if($user->canEditUsers())
                                <span class="badge badge-warning mr_5">
                                    {{ trans('permsandroles.permissionEdit') }}
                                </span>
                                @endif

                                @if($user->canDeleteUsers())
                                <span class="badge badge-danger mr_5">
                                    {{ trans('permsandroles.permissionDelete') }}
                                </span>
                                @endif
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>
                                {{ __('登録日') }}
                            </strong>
                            <div>
                                {{date_format($user->created_at,"Y年m月d日")}}
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>
                                {{ __('更新日') }}
                            </strong>
                            <div>
                                {{date_format($user->updated_at,"Y年m月d日")}}
                            </div>
                        </li>
                        @if ($user->signup_ip_address)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>
                                    {{ __('メール登録IP') }}
                                </strong>
                                <div>
                                    {{ $user->signup_ip_address }}
                                </div>
                            </li>
                        @endif
                        @if ($user->signup_confirmation_ip_address)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>
                                    {{ __('メール確認IP') }}
                                </strong>
                                <div>
                                    {{ $user->signup_confirmation_ip_address }}
                                </div>
                            </li>
                        @endif
                        @if ($user->updated_ip_address)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>
                                    {{ __('最終更新IP') }}
                                </strong>
                                <div>
                                    {{ $user->updated_ip_address }}
                                </div>
                            </li>
                        @endif
                        
                    </ul>
                </div>
            </div>

            <div class="form-card mb-40 mb-sp-30">
                <h3 class="card-title">{{ __('口座情報') }}</h3>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>
                                {{ __('金融機関名') }}
                            </strong>
                            <div>
                                {{ $user->bank->name }}
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>
                                {{ __('支店名') }}
                            </strong>
                            <div>
                                {{ $user->bank->branch }}
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>
                                {{ __('種別') }}
                            </strong>
                            <div>
                                {{ $user->bank->kind }}
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>
                                {{ __('口座番号') }}
                            </strong>
                            <div>
                                {{ $user->bank->number }}
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>
                                {{ __('口座名義') }}
                            </strong>
                            <div>
                                {{ $user->bank->holder }}
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="form-card mb-40 mb-sp-30">
                <h3 class="card-title">{{ __('契約情報') }}</h3>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>
                                {{ __('締め日') }}
                            </strong>
                            <div>
                                {{ $user->term->deadline }}
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>
                                {{ __('備考') }}
                            </strong>
                            <div>
                                {{ $user->term->comment }}
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <ul class="btn-group form-bottom">
                <li>
                    <a class="btn form-btn btn-info text-white" href="{{ URL::to('stores/' . $user->id . '/edit') }}">
                        {!! trans("usersmanagement.buttons.edit-alt") !!}
                    </a>
                </li>
                <li>
                    {!! Form::open(array('url' => 'stores/' . $user->id, 'class' => '')) !!}
                        {!! Form::hidden('_method', 'DELETE') !!}
                        {!! Form::button(trans('usersmanagement.buttons.delete-alt'), array('class' => 'btn form-btn btn-danger text-white','type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => trans("usersmanagement.modals.delete_title"), 'data-message' => trans("usersmanagement.modals.delete_message"))) !!}
                    {!! Form::close() !!}
                </li>
            </ul>
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
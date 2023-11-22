@extends('layouts.app')

@section('template_title')
    {!! trans('contract_type.title-alt') !!}
@endsection

@section('content')

    <div class="dashboard-card">
        <div class="common-caption">
            <h3 class="label y-padding">{!! trans('contract_type.titles.create-alt') !!}</h3>
            <ul class="actions">
                <li>
                    <a class="btn btn-secondary text-white" href="{{ route('contract_types') }}">
                        {!! trans('contract_type.buttons.back-to-list') !!}
                    </a>
                </li>
            </ul>
        </div>
        <div class="form-card">
            <div class="common-form">
                {!! Form::open(array('route' => 'contract_types.store', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')) !!}
                    {!! csrf_field() !!}
                    <table class="form-table">
                        <tbody>
                            <tr>
                                <th>{!! trans('contract_type.labels.name') !!}</th>
                                <td>
                                    <div class="form-input">
                                        @isset($contract_type)
                                            <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $contract_type->name }}" autofocus>
                                        @else
                                            <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" autofocus>
                                        @endisset
                                        @if ($errors->has('name'))
                                            <p class="invalid-feedback">{{ $errors->first('name') }}</p>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>{!! trans('contract_type.labels.comment') !!}</th>
                                <td>
                                    <div class="form-input">
                                        @isset($contract_type)
                                            <textarea class="form-control{{ $errors->has('comment') ? ' is-invalid' : '' }}" name="comment" rows="8">{{ $contract_type->comment }}</textarea>
                                        @else
                                            <textarea class="form-control{{ $errors->has('comment') ? ' is-invalid' : '' }}" name="comment" rows="8">{{ old('comment') }}</textarea>
                                        @endisset
                                        @if ($errors->has('comment'))
                                            <p class="invalid-feedback">{{ $errors->first('comment') }}</p>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <ul class="btn-group form-bottom">
                        <li>
                            {!! Form::button(trans('contract_type.buttons.create-alt'), array('class' => 'btn form-btn btn-success btn-block text-white','type' => 'submit' )) !!}
                        </li>
                    </ul>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection

@section('footer_scripts')
    @if(config('options.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
@endsection
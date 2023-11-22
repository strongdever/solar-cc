@extends('layouts.app')

@section('template_title')
    {!! trans('contract_type.title-alt') !!}
@endsection

@section('content')

<div class="dashboard-card">
    <div class="common-caption">
        <h3 class="label y-padding">{!! trans('contract_type.titles.show-alt') !!}</h3>
        <ul class="actions">
            <li>
                <a class="btn btn-secondary text-white" href="{{ url('/contract_types/create') }}">
                    {!! trans('contract_type.buttons.create') !!}
                </a>
            </li>
        </ul>
    </div>
    <div class="common-form show-form">
        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <strong>
                    {!! trans('contract_type.labels.id') !!}
                </strong>
                <div>
                    {{ $contract_type->id }}
                </div>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <strong>
                    {!! trans('contract_type.labels.name') !!}
                </strong>
                <div>
                    {{ $contract_type->name }}
                </div>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <strong>
                    {!! trans('contract_type.labels.comment') !!}
                </strong>
                <div>
                    {{ $contract_type->comment }}
                </div>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <strong>
                    {!! trans('contract_type.labels.created') !!}
                </strong>
                <div>
                    {!! $contract_type->created_at->format('Y年m月d日') !!}
                </div>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <strong>
                    {!! trans('contract_type.labels.updated') !!}
                </strong>
                <div>
                    {!! $contract_type->updated_at->format('Y年m月d日') !!}
                </div>
            </li>
        </ul>
        <ul class="btn-group form-bottom">
            <li>
                <a class="btn form-btn btn-info text-white" href="{{ URL::to('contract_types/' . $contract_type->id . '/edit') }}">
                    {!! trans("contract_type.buttons.edit-alt") !!}
                </a>
            </li>
            <li>
                {!! Form::open(array('url' => 'contract_types/' . $contract_type->id, 'class' => '')) !!}
                    {!! Form::hidden('_method', 'DELETE') !!}
                    {!! Form::button(trans('contract_type.buttons.delete-alt'), array('class' => 'btn form-btn btn-danger text-white','type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => trans("contract_type.modals.delete_title"), 'data-message' => trans("contract_type.modals.delete_message"))) !!}
                {!! Form::close() !!}
            </li>
        </ul>
    </div>
</div>

@include('modals.modal-delete')

@endsection

@section('footer_scripts')
    @include('scripts.delete-modal-script')
    @if(config('options.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
@endsection
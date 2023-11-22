@extends('layouts.app')

@section('template_title')
    {!! trans('contract_type.title-alt') !!}
@endsection

@section('template_linked_css')
    <link rel="stylesheet" type="text/css" href="{{ config('options.datatablesCssCDN') }}">
@endsection

@section('content')

    <div class="dashboard-card">
        <div class="common-caption">
            <h3 class="label y-padding">{!! trans('contract_type.title-alt') !!}</h3>
            <ul class="actions">
                <li>
                    <a class="btn btn-secondary text-white" href="{{ url('/contract_types/create') }}">
                        {!! trans('contract_type.buttons.create') !!}
                    </a>
                </li>
            </ul>
        </div>
        <div class="common-form">
            <div class="table-responsive contractTypes-table">
                <table class="table table-sm table-striped data-table">
                    <caption id="contractTypes-count">
                        {!! trans_choice('contract_type.list-table.caption', 1, ['count' => $contract_types->count()]) !!}
                    </caption>
                    <thead class="thead">
                        <tr>
                            <th scope="col" width="60px">
                                {!! trans('contract_type.list-table.id') !!}
                            </th>
                            <th scope="col" width="150px">
                                {!! trans('contract_type.list-table.name') !!}
                            </th>
                            <th scope="col" width="240px">
                                {!! trans('contract_type.list-table.comment') !!}
                            </th>
                            <th scope="col" class="hidden-xs hidden-sm hidden-md">
                                {!! trans('contract_type.list-table.created') !!}
                            </th>
                            <th scope="col" class="hidden-xs hidden-sm hidden-md">
                                {!! trans('contract_type.list-table.updated') !!}
                            </th>
                            <th class="no-search no-sort" colspan="3">
                                {!! trans('contract_type.list-table.actions') !!}
                            </th>
                        </tr>
                    </thead>
                    <tbody class="contractTypes-table-body">
                        @if($contract_types->count() > 0)
                            @foreach($contract_types as $contract_type)
                                <tr>
                                    <td>
                                        {!! $contract_type->id !!}
                                    </td>
                                    <td>
                                        {!! $contract_type->name !!}
                                    </td>
                                    <td>
                                        {!! $contract_type->comment !!}
                                    </td>
                                    <td class="hidden-xs hidden-sm hidden-md">
                                        {!! $contract_type->created_at->format('Y年m月d日') !!}
                                    </td>
                                    <td class="hidden-xs hidden-sm hidden-md">
                                        {!! $contract_type->updated_at->format('Y年m月d日') !!}
                                    </td>
                                    <td class="action-td">
                                        <a class="btn btn-sm btn-success btn-block text-white" href="{{ URL::to('contract_types/' . $contract_type->id) }}">
                                            {!! trans('contract_type.buttons.show') !!}
                                        </a>
                                    </td>
                                    <td class="action-td">
                                        <a class="btn btn-sm btn-info btn-block text-white" href="{{ URL::to('contract_types/' . $contract_type->id . '/edit') }}">
                                            {!! trans('contract_type.buttons.edit') !!}
                                        </a>
                                    </td>
                                    <td class="action-td">
                                        {!! Form::open(array('url' => 'contract_types/' . $contract_type->id, 'class' => '')) !!}
                                            {!! Form::hidden('_method', 'DELETE') !!}
                                            {!! Form::button(trans('contract_type.buttons.delete'), array('class' => 'btn btn-sm btn-danger btn-block','type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => trans("contract_type.modals.delete_title"), 'data-message' => trans("contract_type.modals.delete_message"))) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="9">{!! trans("contract_type.list-table.none") !!}</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <div class="table-pagination data-table">
                    {{ $contract_types->links() }}
                </div>
            </div>
        </div>
    </div>

    @include('modals.modal-delete')

@endsection

@section('footer_scripts')
    @if ((count($contract_types) > config('options.datatablesJsStartCount')))
        @include('scripts.datatables')
    @endif
    @include('scripts.delete-modal-script')
    @if(config('options.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
@endsection
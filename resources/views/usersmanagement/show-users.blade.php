@extends('layouts.app')

@section('template_title')
    {!! trans('usersmanagement.menu-alt') !!}
@endsection

@section('template_linked_css')
    <link rel="stylesheet" type="text/css" href="{{ config('usersmanagement.datatablesCssCDN') }}">
@endsection

@section('content')

    <div class="dashboard-card">
        <div class="common-caption">
            <h3 class="label y-padding" id="card-title">{!! trans('usersmanagement.menu-alt') !!}</h3>
            <ul class="actions">
                <li>
                    <a class="btn btn-secondary text-white" href="{{ url('/stores/create') }}">
                        {!! trans('usersmanagement.buttons.create-new') !!}
                    </a>
                </li>
            </ul>
        </div>
        <div class="common-form">
            <div class="p-users-search mb-30">
                @if(config('usersmanagement.enableSearchUsers'))
                    @include('partials.search-users-form')
                @endif
            </div>
            <div class="table-responsive">
                <table class="table table-sm data-table">
                    <caption id="users-count">
                        {{ trans_choice('usersmanagement.list-table.caption', 1, ['count' => $users->count()]) }}
                    </caption>
                    <thead class="thead">
                        <tr>
                            <th scope="col" width="100px">
                                {!! trans('usersmanagement.list-table.uuid') !!}
                            </th>
                            <th scope="col" width="180px">
                                {!! trans('usersmanagement.list-table.company') !!}
                            </th>
                            <th scope="col" width="150px" class="hidden-xs hidden-sm hidden-md">
                                {!! trans('usersmanagement.list-table.email') !!}
                            </th>
                            <th scope="col" width="80px">
                                {!! trans('usersmanagement.list-table.role') !!}
                            </th>
                            <th scope="col" class="hidden-xs hidden-sm hidden-md">
                                {!! trans('usersmanagement.list-table.created') !!}
                            </th>
                            <th scope="col" class="hidden-xs hidden-sm hidden-md">
                                {!! trans('usersmanagement.list-table.updated') !!}
                            </th>
                            <th class="no-search no-sort" colspan="3">
                                {!! trans('usersmanagement.list-table.actions') !!}
                            </th>
                        </tr>
                    </thead>
                    <tbody id="users-table">
                        @if($users->count() > 0)
                            @foreach($users as $user)
                            <tr>
                                <td>
                                    {{$user->uuid}}
                                </td>
                                <td>
                                    {{$user->company}}
                                </td>
                                <td class="hidden-xs hidden-sm hidden-md">
                                    <a href="mailto:{{ $user->email }}" title="email {{ $user->email }}">{{ $user->email }}</a>
                                </td>
                                <td>
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
                                </td>
                                <td class="hidden-sm hidden-xs hidden-md">
                                    {{date_format($user->created_at,"Y年m月d日")}}
                                </td>
                                <td class="hidden-sm hidden-xs hidden-md">
                                    {{date_format($user->updated_at,"Y年m月d日")}}
                                </td>
                                <td class="action-td">
                                    {!! Form::open(array('url' => 'stores/' . $user->id, 'class' => '')) !!}
                                        {!! Form::hidden('_method', 'DELETE') !!}
                                        {!! Form::button(trans('usersmanagement.buttons.delete'), array('class' => 'btn btn-sm btn-danger btn-block','type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => trans('usersmanagement.modals.delete_title'), 'data-message' => trans('usersmanagement.modals.delete_message'))) !!}
                                    {!! Form::close() !!}
                                </td>
                                <td class="action-td">
                                    <a class="btn btn-sm btn-success btn-block" href="{{ URL::to('stores/' . $user->id) }}">
                                        {!! trans('usersmanagement.buttons.show') !!}
                                    </a>
                                </td>
                                <td class="action-td">
                                    <a class="btn btn-sm btn-info btn-block" href="{{ URL::to('stores/' . $user->id . '/edit') }}">
                                        {!! trans('usersmanagement.buttons.edit') !!}
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7">{!! trans("usersmanagement.list-table.none") !!}</td>
                            </tr>
                        @endif
                    </tbody>
                    @if(config('usersmanagement.enableSearchUsers'))
                    <tbody id="search-results"></tbody>
                    @endif
                </table>
            </div>
            <div class="table-pagination data-table" id="users-pagination">
                {{ $users->links() }}
            </div>
        </div>
    </div>

@include('modals.modal-delete')

@endsection

@section('footer_scripts')
    @if ((count($users) > config('usersmanagement.datatablesJsStartCount')))
        @include('scripts.datatables')
    @endif
    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')
    @if(config('usersmanagement.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
    @if(config('usersmanagement.enableSearchUsers'))
        @include('scripts.search-users')
    @endif
@endsection
@extends('layouts.app')

@section('template_title')
    {!! trans('carport.titles.list-alt') !!}
@endsection

@section('template_linked_css')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
@endsection

@section('content')
    <div class="dashboard-card">
        <div class="card-header">
            <h3 class="lead">{{ __('カーポート一覧') }}</h3>
        </div>
        <div class="card-body">
            <div class="form-card card-sm mb-50 mb-sp-40">
                <h3 class="card-title">{{ __('新規カーポートの登録') }}</h3>
                <div class="card-body">
                    <div class="description mb-20">{{ __('新規でカーポートができたらこちらから登録を行ってください。') }}</div>
                    <div class="action">
                        <a href="#carport-new-modal" class="link-btn carportNewModalLink text-white" data-target="#carportNewModal" data-toggle="modal">{{ __('新規カーポートを登録する') }}</a>
                    </div>
                </div>
            </div>
            {!! Form::open(array('route' => 'carport.show', 'method' => 'GET', 'role' => 'form', 'class' => 'requests-search-form needs-validation mb-30')) !!}
                <div class="form-inner-row">
                    <div class="inner-left">
                        <ul class="form-group">
                            <li class="x">
                                <div class="input-group">
                                    <label for="keyword">{{ __('キーワード検索') }}</label>
                                    <input type="text" class="form-control m" name="keyword" placeholder="ID、名前、住所"  value="{!! $searchData['keyword'] !!}">
                                </div>
                            </li>
                            <li class="x">
                                <div class="input-group">
                                    <label for="contract_type_id">{{ __('契約形態') }}</label>
                                    <select name="contract_type_id" class="form-control sm">
                                        <option value="">{{ __('選択してください') }}</option>
                                        @if (get_carport_types())
                                            @foreach(get_carport_types() as $carport_type)
                                            <option value="{{ $carport_type->id }}"  {{ $searchData['contract_type_id'] == $carport_type->id ? 'selected="selected"' : '' }}>{{ $carport_type->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="inner-right">
                        <div class="form-submit">
                            <button type="submit" class="btn btn-outline">{{ __('絞り込んで検索') }}</button>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
            <div class="table-responsive carports-table">
                <table class="table table-sm data-table">
                    <thead class="thead">
                        <tr>
                            <th class="id">{{ __('ID') }}</th>
                            <th>{{ __('名前') }}</th>
                            <th class="date">{{ __('登録日') }}</th>
                            <th class="date">{{ __('開始日') }}</th>
                            <th>{{ __('契約形態') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        @if($carports->count() > 0)
                            @foreach($carports as $carport)
                                <tr>
                                    <td>{!! $carport->uuid !!}</td>
                                    <td>{!! $carport->company !!}</td>
                                    <td>{!! $carport->registered_at->format('Y年m月d日') !!}</td>
                                    <td>{!! $carport->started_at->format('Y年m月d日') !!}</td>
                                    <td>{!! $carport->contract_type->name !!}</td>
                                    <td class="action">
                                        <button class="btn btn-sm btn-info btn-outline" data-target="#carportDetailModal{{ $carport->id }}" data-toggle="modal">{{ __('詳細') }}</button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="no-result">{{ __('データがありません。') }}</td>
                            </tr>
                        @endif
                    </tbody>
                    <tbody id="search-results"></tbody>
                </table>
            </div>
            <div id="search-pagination" class="table-pagination data-table">
                {{ $carports->links() }}
            </div>
        </div>
    </div>

    @if($carports->count() > 0)
        @foreach($carports as $carport)
            @include('modals.modal-carport-detail', ['carport' => $carport])
        @endforeach
    @endif

    @include('modals.modal-carport-new')

@endsection

@section('footer_scripts')
    
    @include('scripts.datapicker-script')

    @include('scripts.save-modal-carport-script')

@endsection
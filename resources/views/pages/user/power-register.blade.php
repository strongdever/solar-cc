@extends('layouts.app')

@section('template_title')
    {!! trans('power.titles.create-alt') !!}
@endsection

@section('template_linked_css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.css">
@endsection

@section('content')
    <div class="dashboard-card">
        <div class="card-header">
            <h3 class="lead">{{ __('電力データ登録') }}</h3>
        </div>
        <div class="card-body">
            <h4 class="caption">{{ __('電力データのアップロード') }}</h4>
            <div class="csv-dropzone-upload mb-50 mb-sp-40">
                <form action="{{route('dropzone.store')}}" method="post" name="file" files="true" enctype="multipart/form-data" class="dropzone" id="csv-dropzone" >
                    {!! csrf_field() !!}
                    <div class="dz-message">
                        <span class="lead">{{ __('ここにファイルをドラッグ＆ドロップ') }}</span>
                        <div class="sep">{{ __('または') }}</div>
                        <span class="btn">{{ __('ファイルを選択') }}</span>
                    </div>
                </form>
                <div class="csv-meta">@if($files->count() > 0) 前回のアップロード日：{!! $files[0]->uploaded_at->format('Y年m月d日') !!} @endif</div>
            </div>
            <h4 class="caption">{{ __('アップロード履歴') }}</h4>
            <div class="table-responsive power-history-table">
                <table class="table table-sm data-table">
                    <thead class="thead">
                        <tr>
                            <th>{{ __('ファイル名') }}</th>
                            <th>{{ __('アップロード日') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="csv-table">
                        @if($files->count() > 0)
                            @foreach($files as $file)
                                <tr>
                                    <td>{!! $file->name !!}</td>
                                    <td>{!! $file->uploaded_at->format('Y年m月d日') !!}</td>
                                    <td class="action">
                                        <a href="{{ asset($file->path) }}" class="btn btn-sm btn-info btn-outline" download="{!! $file->name !!}">
                                            <i class="icon-download" aria-hidden="true"></i>
                                            <span>{{ __('ダウンロード') }}</span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr id="no-result">
                                <td colspan="3" class="no-result">{{ __('データがありません。') }}</td>
                            </tr>
                        @endif
                    </tbody>
                    <tbody id="search_results"></tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@section('footer_scripts')

    @include('scripts.dropzone-script')

@endsection
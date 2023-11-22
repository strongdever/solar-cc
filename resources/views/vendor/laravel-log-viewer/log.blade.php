@extends('layouts.app')

@section('template_title')
  {!! trans('titles.adminLogs') !!}
@endsection



@section('template_linked_css')

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
  <style>
    .dataTables_wrapper {
      padding-left: 0;
      padding-right: 0; 
    }
  </style>
@endsection

@section('content')

  <div class="logs-container">
    <div class="common-caption">
      <h3 class="label y-padding">ログファイル</h3>
    </div>
    <div class="common-form">
      <div class="table-container">
        @if ($logs === null)
          <div>ログ ファイルが 50M を超えています。ダウンロードしてください。</div>
        @else
        <table id="table-log" class="table table-sm table-striped">
          <thead>
            <tr>
              <th width="60px">Level</th>
              <th width="100px">Context</th>
              <th width="150px">Date</th>
              <th width="*">Content</th>
            </tr>
          </thead>
          <tbody>
            @foreach($logs as $key => $log)
            <tr>
              <td class="text-{{{$log['level_class']}}}"><span class="glyphicon glyphicon-{{{$log['level_img']}}}-sign" aria-hidden="true"></span> &nbsp;{{$log['level']}}</td>
              <td class="text">{{$log['context']}}</td>
              <td class="date">{{$log['date']}}</td>
              <td class="text">
                @if ($log['stack']) <a class="pull-right expand btn btn-default btn-xs" data-display="stack{{{$key}}}"><span class="glyphicon glyphicon-search"></span></a>@endif
                {{{$log['text']}}}
                @if (isset($log['in_file'])) <br />{{{$log['in_file']}}}@endif
                @if ($log['stack']) <div class="stack" id="stack{{{$key}}}" style="display: none; white-space: pre-wrap;">{{{ trim($log['stack']) }}}</div>@endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        @endif
        <ul class="btn-group form-bottom">
          @if($current_file)
            <li>
              <a href="?dl={{ \Illuminate\Support\Facades\Crypt::encrypt($current_file) }}" class="btn form-btn btn-primary">
                <i class="fa fa-download" aria-hidden="true"></i>
                ダウンロード
              </a>
            </li>
            <li>
              <a id="delete-log" data-toggle="modal" data-target="#confirmDelete" data-href="?del={{ \Illuminate\Support\Facades\Crypt::encrypt($current_file) }}" data-title="確認" data-message="本気ですか？" class="btn form-btn text-white btn-danger">
                <i class="fa fa-trash-o" aria-hidden="true"></i>
                削除する
              </a>
            </li>
            @if(count($files) > 1)
              <li>
                <a id="delete-all-log" data-toggle="modal" data-target="#confirmDelete" data-href="?delall=true" data-title="確認" data-message="本気ですか？" class="btn form-btn text-white btn-danger">
                  <i class="fa fa-trash" aria-hidden="true"></i>
                  すべて削除する
                </a>
              </li>
            @endif
          @endif
        </ul>
      </div>

    </div>
  </div>

  @include('modals.modal-delete')

@endsection

@section('footer_scripts')

  @include('scripts.datatables')

  <script>
    $(document).ready(function(){
      $('#table-log').DataTable({
        'language' : {
            "emptyTable": "テーブルにデータがありません",
            "info": " _TOTAL_ 件中 _START_ から _END_ まで表示",
            "infoEmpty": " 0 件中 0 から 0 まで表示",
            "infoFiltered": "（全 _MAX_ 件より抽出）",
            "infoThousands": ",",
            "lengthMenu": "_MENU_ 件表示",
            "loadingRecords": "読み込み中...",
            "processing": "処理中...",
            "search": "検索:",
            "zeroRecords": "一致するレコードがありません",
            "paginate": {
                "first": "先頭",
                "last": "最終",
                "next": "次",
                "previous": "前"
            },
            "aria": {
                "sortAscending": ": 列を昇順に並べ替えるにはアクティブにする",
                "sortDescending": ": 列を降順に並べ替えるにはアクティブにする"
            },
            "thousands": ",",
            "buttons": {
                "colvis": "項目の表示\/非表示",
                "csv": "CSVをダウンロード"
            },
            "searchBuilder": {
                "add": "条件を追加",
                "button": {
                    "0": "カスタムサーチ",
                    "_": "カスタムサーチ (%d)"
                },
                "clearAll": "すべての条件をクリア",
                "condition": "条件",
                "conditions": {
                    "date": {
                        "after": "次の日付以降",
                        "before": "次の日付以前",
                        "between": "次の期間に含まれる",
                        "empty": "空白",
                        "equals": "次の日付と等しい",
                        "not": "次の日付と等しくない",
                        "notBetween": "次の期間に含まれない",
                        "notEmpty": "空白ではない"
                    },
                    "number": {
                        "between": "次の値の間に含まれる",
                        "empty": "空白",
                        "equals": "次の値と等しい",
                        "gt": "次の値よりも大きい",
                        "gte": "次の値以上",
                        "lt": "次の値未満",
                        "lte": "次の値以下",
                        "not": "次の値と等しくない",
                        "notBetween": "次の値の間に含まれない",
                        "notEmpty": "空白ではない"
                    },
                    "string": {
                        "contains": "次の文字を含む",
                        "empty": "空白",
                        "endsWith": "次の文字で終わる",
                        "equals": "次の文字と等しい",
                        "not": "次の文字と等しくない",
                        "notEmpty": "空白ではない",
                        "startsWith": "次の文字から始まる",
                        "notContains": "次の文字を含まない",
                        "notStartsWith": "次の文字で始まらない",
                        "notEndsWith": "次の文字で終わらない"
                    }
                },
                "data": "項目",
                "title": {
                    "0": "カスタムサーチ",
                    "_": "カスタムサーチ (%d)"
                },
                "value": "値"
            }
        },
        "order": [ 1, 'desc' ],
        "stateSave": true,
        "stateSaveCallback": function (settings, data) {
          window.localStorage.setItem("datatable", JSON.stringify(data));
        },
        "stateLoadCallback": function (settings) {
          var data = JSON.parse(window.localStorage.getItem("datatable"));
          if (data) data.start = 0;
          return data;
        }
      });

      $('.table-container').on('click', '.expand', function(){
        $('#' + $(this).data('display')).toggle();
      });

      // Delete Logs Modal
      $('#confirmDelete').on('show.bs.modal', function (e) {
        var message = $(e.relatedTarget).attr('data-message');
        var title = $(e.relatedTarget).attr('data-title');
        var href = $(e.relatedTarget).attr('data-href');
        $(this).find('.modal-body p').text(message);
        $(this).find('.modal-title').text(title);
        $(this).find('#confirm').data('href', href);
      });
      $('#confirmDelete').find('#confirm').on('click', function(){
        window.location = $(this).data('href');
      });

    });
  </script>

@endsection

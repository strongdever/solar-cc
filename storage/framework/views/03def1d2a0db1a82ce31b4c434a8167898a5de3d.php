<?php $__env->startSection('template_title'); ?>
  <?php echo trans('titles.adminLogs'); ?>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('template_linked_css'); ?>

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
  <style>
    .dataTables_wrapper {
      padding-left: 0;
      padding-right: 0; 
    }
  </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

  <div class="logs-container">
    <div class="common-caption">
      <h3 class="label y-padding">ログファイル</h3>
    </div>
    <div class="common-form">
      <div class="table-container">
        <?php if($logs === null): ?>
          <div>ログ ファイルが 50M を超えています。ダウンロードしてください。</div>
        <?php else: ?>
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
            <?php $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td class="text-<?php echo e($log['level_class']); ?>"><span class="glyphicon glyphicon-<?php echo e($log['level_img']); ?>-sign" aria-hidden="true"></span> &nbsp;<?php echo e($log['level']); ?></td>
              <td class="text"><?php echo e($log['context']); ?></td>
              <td class="date"><?php echo e($log['date']); ?></td>
              <td class="text">
                <?php if($log['stack']): ?> <a class="pull-right expand btn btn-default btn-xs" data-display="stack<?php echo e($key); ?>"><span class="glyphicon glyphicon-search"></span></a><?php endif; ?>
                <?php echo e($log['text']); ?>

                <?php if(isset($log['in_file'])): ?> <br /><?php echo e($log['in_file']); ?><?php endif; ?>
                <?php if($log['stack']): ?> <div class="stack" id="stack<?php echo e($key); ?>" style="display: none; white-space: pre-wrap;"><?php echo e(trim($log['stack'])); ?></div><?php endif; ?>
              </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
        <?php endif; ?>
        <ul class="btn-group form-bottom">
          <?php if($current_file): ?>
            <li>
              <a href="?dl=<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($current_file)); ?>" class="btn form-btn btn-primary">
                <i class="fa fa-download" aria-hidden="true"></i>
                ダウンロード
              </a>
            </li>
            <li>
              <a id="delete-log" data-toggle="modal" data-target="#confirmDelete" data-href="?del=<?php echo e(\Illuminate\Support\Facades\Crypt::encrypt($current_file)); ?>" data-title="確認" data-message="本気ですか？" class="btn form-btn text-white btn-danger">
                <i class="fa fa-trash-o" aria-hidden="true"></i>
                削除する
              </a>
            </li>
            <?php if(count($files) > 1): ?>
              <li>
                <a id="delete-all-log" data-toggle="modal" data-target="#confirmDelete" data-href="?delall=true" data-title="確認" data-message="本気ですか？" class="btn form-btn text-white btn-danger">
                  <i class="fa fa-trash" aria-hidden="true"></i>
                  すべて削除する
                </a>
              </li>
            <?php endif; ?>
          <?php endif; ?>
        </ul>
      </div>

    </div>
  </div>

  <?php echo $__env->make('modals.modal-delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>

  <?php echo $__env->make('scripts.datatables', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cptc/www/resources/views/vendor/laravel-log-viewer/log.blade.php ENDPATH**/ ?>
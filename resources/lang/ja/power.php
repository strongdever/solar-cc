<?php

return [

    'menu-alt'                  => '電力データ登録',
    
    // Titles
    'titles' => [
      'create-alt'               => '電力データ登録',
      'edit-alt'                 => '電力データ編集',
      'show-alt'                 => '電力データ管理',
      'list-alt'                 => '電力データ一覧',
    ],

    // Flash Messages
    'alerts' => [
      'createSuccess'            => '正常に追加されました。',
      'updateSuccess'            => '正常に更新されました。',
      'deleteSuccess'            => '正常に削除されました。',
    ],
    
    'labels' => [
      'id'                       => 'ID',
      'name'                     => '名前',
      'comment'                  => '備考',
      'created'                  => '登録日',
      'updated'                  => '更新日',
    ],

    'list-table' => [
      'caption'                  => '全:count件',
      'id'                       => 'ID',
      'name'                     => '名前',
      'comment'                  => '備考',
      'created'                  => '登録日',
      'updated'                  => '更新日',
      'actions'                  => '',
      'none'                     => '契約形態データはありません。',
    ],

    'buttons' => [
      'create'                   => '<i class="fa fa-fw fa-plus" aria-hidden="true"></i><span class="hidden-xs hidden-sm"> 新規追加</span>',
      'delete'                   => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i><span class="hidden-xs hidden-sm">削除</span>',
      'show'                     => '<i class="fa fa-eye fa-fw" aria-hidden="true"></i><span class="hidden-xs hidden-sm">表示</span>',
      'edit'                     => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i><span class="hidden-xs hidden-sm">編集</span>',
      'back-to-list'             => '<i class="fa fa-fw fa-reply-all" aria-hidden="true"></i><span class="hidden-sm hidden-xs"> 契約形態一覧</span>',
      'delete-alt'               => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i><span class="hidden-xs"> 削除する</span>',
      'edit-alt'                 => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i><span class="hidden-xs"> 編集する</span>',
      'create-alt'               => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i><span class="hidden-xs"> 追加する</span>',
    ],

    'messages' => [
      'fileRequired'             => 'CSVファイルをアップロードしてください。',
      'fileMimes'               => 'CSVファイルのみがアップロードできます。',
      'fileMax'               => '最大ファイルサイズは50MBです。',
    ],

    'search'  => [
      'title'                    => '検索結果の表示',
      'found-footer'             => '件見つかりました。',
      'no-results'               => '検索結果はありません。',
      'search-users-ph'          => 'カテゴリ検索',
    ],

    'modals' => [
      'delete_title'             => '削除',
      'delete_message'           => '本当に削除してもよろしいですか？',
      'confirm_title'            => '編集',
      'confirm_message'          => '本当に変更してもよろしいですか？',
    ],
];
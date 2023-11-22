<?php

return [

    'menu-alt'                  => 'カーポート管理',
    
    // Titles
    'titles' => [
      'create-alt'               => '新規カーポート',
      'edit-alt'                 => 'カーポート編集',
      'show-alt'                 => 'カーポート管理',
      'list-alt'                 => 'カーポート一覧',
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
      'nameRequired'             => '契約形態名を入力してください。',
      'nameUnique'               => '契約形態がすでに存在しています。',
    ],

    'search'  => [
      'title'                    => '検索結果の表示',
      'found-footer'             => '件見つかりました。',
      'no-results'               => '検索結果はありません。',
      'search-users-ph'          => 'カテゴリ検索',
    ],

    'modals' => [
      'delete_title'             => '契約形態削除',
      'delete_message'           => '本当に削除してもよろしいですか？',
      'confirm_title'            => '契約形態編集',
      'confirm_message'          => '本当に変更してもよろしいですか？',
    ],
];
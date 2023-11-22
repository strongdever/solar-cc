<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel Blocker Blades Language Lines - laravelblocker
    |--------------------------------------------------------------------------
    */

    'blocked-items-title'           => 'ブロッカー',
    'blocked-item-title'            => 'ブロッカー',
    'blocked-item-deleted-title'    => '削除されたブロッカー',
    'edit-blocked-item-title'       => 'ブロッカー編集',
    'blocked-items-deleted-title'   => '削除されたブロッカー',
    'users-menu-alt'                => 'メニュー',

    'na'                        => 'N/A',
    'none'                      => 'None',

    'titles' => [
        'show-blocked'      => 'ブロッカー',
        'show-blocked-item' => 'ブロッカー',
        'create-blocked'    => 'ブロッカー追加',
    ],

    'buttons' => [
        'create-new-blocked'        => 'ブロッカーを追加',
        'show-deleted-blocked'      => '削除されたブロッカーを表示',
        'back-to-blocked'           => '戻る',
        'back-to-blocked-deleted'   => '戻る',
        'show'                      => '<i class="fa fa-eye fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">表示</span>',
        'edit'                      => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">編集</span>',
        'delete'                    => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">削除</span>',
        'destroy'                   => '<i class="fa fa-trash fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">破壊</span>',
        'save-larger'               => '<i class="fa fa-save fa-fw" aria-hidden="true"></i> 保存する',
        'create-larger'             => '<i class="fa fa-save fa-fw" aria-hidden="true"></i> 新規ブロッカー追加',
        'show-larger'               => '<i class="fa fa-eye fa-fw" aria-hidden="true"></i> 表示',
        'edit-larger'               => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i> 編集',
        'delete-larger'             => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i> 削除する',
        'destroy-larger'            => '<i class="fa fa-trash fa-fw" aria-hidden="true"></i> 破壊',
        'destroy-all'               => 'すべてを破壊',
        'restore-all-blocked'       => 'すべてを復元',
        'restore-blocked-item'      => '<i class="fa fa-fw fa-history" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">復元</span>',
        'restore-blocked-item-full' => '<i class="fa fa-fw fa-history" aria-hidden="true"></i> 復元',
    ],

    'tooltips' => [
        'delete'                    => '削除',
        'show'                      => '表示',
        'edit'                      => '編集',
        'create-new'                => '新規追加',
        'back-blocked'              => '戻る',
        'back-blocked-deleted'      => '戻る',
        'submit-search'             => '検索',
        'clear-search'              => 'クリア',
        'destroy_blocked_tooltip'   => '破壊',
        'restoreItem'               => '復元',
    ],

    'blocked-table' => [
        'caption'   => '全:blockedcount件',
        'id'        => 'ID',
        'type'      => 'タイプ',
        'value'     => '値',
        'note'      => '要項',
        'userId'    => '販売店ID',
        'createdAt' => '登録日',
        'updatedAt' => '更新日',
        'deletedAt' => '削除日',
        'actions'   => '',
        'none'      => 'ブロッカーはありません。',
    ],

    'forms' => [
        'search-blocked-ph' => 'キーワード',
        'blockedTypeLabel'  => 'タイプ',
        'blockedTypeSelect' => 'ブロッカー タイプの選択',
        'blockedValueLabel' => '値',
        'blockedValuePH'    => 'ブロッカー値',
        'blockedNoteLabel'  => '要項',
        'blockedNotePH'     => 'ノート入力',
        'blockedUserLabel'  => 'ユーザー',
        'blockedUserSelect' => 'ユーザーを選択',
    ],

    'search'  => [
        'title'             => '検索結果を表示',
        'title-deleted'     => '検索結果を表示',
        'found-footer'      => ' 件を見つけました。',
        'no-results'        => '検索結果がありません。',
        'search-users-ph'   => 'キーワード',
        'required'          => 'キーワードを入力してください。',
        'string'            => 'キーワードに無効な文字が含まれています。',
        'max'               => 'キーワードの文字数が多すぎます。',
    ],

    'modals' => [
        'delete_blocked_title'          => '確認',
        'destroy_blocked_title'         => '確認',
        'delete_blocked_message'        => '本当に削除してもよろしいですか？',
        'destroy_blocked_message'       => '本当に削除してもよろしいですか？',
        'delete_blocked_btn_cancel'     => 'キャンセル',
        'delete_blocked_btn_confirm'    => '確認',
        'destroy_all_blocked_title'     => '確認',
        'destroy_all_blocked_message'   => '本当に削除してもよろしいですか？',
        'resotreAllBlockedTitle'        => '確認',
        'resotreAllBlockedMessage'      => '本当に削除してもよろしいですか？',
        'resotreBlockedItemTitle'       => '確認',
        'resotreBlockedItemMessage'     => '本当に削除してもよろしいですか？',
        'btnConfirm'                    => '確認する',
        'btnCancel'                     => 'キャンセル',
    ],

    'messages' => [
        'blocked-creation-success'  => 'ブロッカーが正常に登録されました。',
        'delete-success'            => 'ブロッカーが正常に削除されました。',
        'update-success'            => 'ブロッカーが正常に編集されました。',
        'successRestoredItem'       => 'ブロッカーが正常に復元されました。',
        'successRestoredAllItems'   => 'ブロッカーが正常に復元されました。',
        'successDestroyedItem'      => 'ブロッカーが正常に破壊されました。',
        'successDestroyedAllItems'  => 'ブロッカーが正常に破壊されました。',
    ],

    'validation' => [
        'blockedTypeRequired'   => 'ブロッカー タイプは必須です。',
        'blockedValueRequired'  => 'ブロッカーの値は必須です。',
        'blockedExists'         => ':attribute は既に存在します。',
        'email'                 => '有効なメール アドレスを入力してください。',
    ],

    'errors' => [
        'errorBlockerNotFound' => 'ブロッカーが見つかりません。',
    ],

    'flash-messages' => [
        'close'         => 'Close',
        'success'       => 'Success',
        'error'         => 'Error',
        'whoops'        => 'Whoops! ',
        'someProblems'  => '入力内容に問題がありました。',

    ],

];

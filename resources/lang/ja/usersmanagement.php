<?php

return [

    'menu-alt'                  => '販売店情報管理',
    
    // Titles
    'titles' => [
      'create-alt'               => '新規販売店情報',
      'edit-alt'                 => '販売店情報編集',
      'show-alt'                 => '販売店情報管理',
      'show-deleted-alt'         => '削除された販売店',
    ],

    // Flash Messages
    'alerts' => [
        'createSuccess'   => '正常に追加されました。',
        'updateSuccess'   => '正常に更新されました。',
        'deleteSuccess'   => '正常に削除されました。',
        'deleteSelfError' => '自分自身を削除することはできません。',
    ],

    // Show User Tab
    'viewProfile'            => 'プロフィール',
    'editUser'               => '編集',
    'deleteUser'             => '削除',
    'usersBackBtn'           => 'ユーザー一覧',
    'usersPanelTitle'        => 'User Information',
    'labelUserName'          => 'Username:',
    'labelEmail'             => 'Email:',
    'labelFirstName'         => 'First Name:',
    'labelLastName'          => 'Last Name:',
    'labelRole'              => 'Role:',
    'labelStatus'            => 'Status:',
    'labelAccessLevel'       => 'Access',
    'labelPermissions'       => 'Permissions:',
    'labelCreatedAt'         => 'Created At:',
    'labelUpdatedAt'         => 'Updated At:',
    'labelIpEmail'           => 'Email Signup IP:',
    'labelIpConfirm'         => 'Confirmation IP:',
    'labelIpSocial'          => 'Socialite Signup IP:',
    'labelIpAdmin'           => 'Admin Signup IP:',
    'labelIpUpdate'          => 'Last Update IP:',
    'labelDeletedAt'         => 'Deleted on',
    'labelIpDeleted'         => 'Deleted IP:',
    'usersDeletedPanelTitle' => 'Deleted User Information',
    'usersBackDelBtn'        => 'Back to Deleted Users',

    'successRestore'    => 'User successfully restored.',
    'successDestroy'    => 'User record successfully destroyed.',
    'errorUserNotFound' => 'User not found.',

    'labelUserLevel'  => 'Level',
    'labelUserLevels' => 'Levels',

    'list-table' => [
        'caption'   => '全:count件',
        'id'        => 'ID',
        'uuid'      => '販売店ID',
        'company'   => '販売店名称',
        'address'   => '住所',
        'phone'     => '連絡先',
        'email'     => 'メール',
        'name'      => '担当者',
        'role'      => '権限',
        'created'   => '登録日',
        'updated'   => '更新日',
        'actions'   => '',
    ],

    'buttons' => [
        'create-new'    => '<i class="fa fa-fw fa-user-plus" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">新規追加</span>',
        'delete'        => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i><span class="hidden-xs hidden-sm">削除</span>',
        'show'          => '<i class="fa fa-eye fa-fw" aria-hidden="true"></i><span class="hidden-xs hidden-sm">表示</span>',
        'edit'          => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i><span class="hidden-xs hidden-sm">編集</span>',
        'back-to-list'  => '<i class="fa fa-fw fa-reply-all" aria-hidden="true"></i> <span class="hidden-sm hidden-xs">販売店一覧</span>',
        'delete-alt'    => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i> <span class="hidden-sm hidden-xs">削除する</span>',
        'edit-alt'      => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i> <span class="hidden-sm hidden-xs">編集する</span>',
        'create-alt'    => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i> <span class="hidden-xs">追加する</span>',
        'back-to-deleted' => '<i class="fa fa-fw fa-group" aria-hidden="true"></i> <span class="hidden-xs">削除された販売店</span>',
    ],

    'tooltips' => [
        'delete'        => 'Delete',
        'show'          => 'Show',
        'edit'          => 'Edit',
        'create-new'    => 'Create New User',
        'back-users'    => 'Back to users',
        'email-user'    => 'Email :user',
        'submit-search' => 'Submit Users Search',
        'clear-search'  => 'Clear Search Results',
    ],

    'messages' => [
        'userNameTaken'          => 'Username is taken',
        'userNameRequired'       => 'Username is required',
        'fNameRequired'          => 'First Name is required',
        'lNameRequired'          => 'Last Name is required',
        'emailRequired'          => 'Email is required',
        'emailInvalid'           => 'Email is invalid',
        'passwordRequired'       => 'Password is required',
        'PasswordMin'            => 'Password needs to have at least 6 characters',
        'PasswordMax'            => 'Password maximum length is 20 characters',
        'captchaRequire'         => 'Captcha is required',
        'CaptchaWrong'           => 'Wrong captcha, please try again.',
        'roleRequired'           => 'User role is required.',
        'user-creation-success'  => 'Successfully created user!',
        'update-user-success'    => 'Successfully updated user!',
        'delete-success'         => 'Successfully deleted the user!',
        'cannot-delete-yourself' => 'You cannot delete yourself!',
    ],

    'search'  => [
        'title'             => '検索結果の表示',
        'found-footer'      => '件見つかりました。',
        'no-results'        => '検索結果はありません。',
        'search-users-ph'   => 'ユーザー検索',
    ],

    'modals' => [
        'delete_title'      => '販売店情報削除',
        'delete_message'    => '本当に削除してもよろしいですか？',
        'edit_title'      => '販売店情報変更',
        'edit_message'    => '本当に変更してもよろしいですか？',
    ],
];

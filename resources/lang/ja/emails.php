<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Emails Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used for various emails that
    | we need to display to the user. You are free to modify these
    | language lines according to your application's requirements.
    |
    */

    // Activate new user account email.
    'activationSubject'  => '【オフィス機器】メールアドレス登録',
    'activationGreeting' => 'はじめまして！',
    'activationMessage'  => 'すべてのサービスを利用するには、メールアドレスを有効にする必要があります。',
    'activationButton'   => '有効化',
    'activationThanks'   => 'よろしくお願い致します。',

    // Goobye email.
    'goodbyeSubject'  => 'Sorry to see you go...',
    'goodbyeGreeting' => 'Hello :username,',
    'goodbyeMessage'  => 'We are very sorry to see you go. We wanted to let you know that your account has been deleted. Thank for the time we shared. You have '.config('settings.restoreUserCutoff').' days to restore your account.',
    'goodbyeButton'   => 'Restore Account',
    'goodbyeThanks'   => 'We hope to see you again!',

];

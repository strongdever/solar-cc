<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'failed'   => 'ログイン情報が無効です。',
    'throttle' => 'ログイン試行回数が多すぎます。 :seconds 秒後にもう一度お試しください。',

    // Activation items
    'sentEmail'        => ':email にメールを送信しました。',
    'clickInEmail'     => 'その中のリンクをクリックして、アカウントを有効にしてください。',
    'anEmailWasSent'   => 'メールが :email に :date に送信されました。',
    'clickHereResend'  => '再送信する',
    'successActivated' => 'アカウントが有効になりました。',
    'unsuccessful'     => 'アカウントを有効にできませんでした。 もう一度お試しください。',
    'notCreated'       => 'アカウントを登録できませんでした。 もう一度お試しください。',
    'tooManyEmails'    => ':email に送信された有効化メールが多すぎます。<br />:hours 時間後にもう一度お試しください。',
    'regThanks'        => 'ご登録ありがとうございます。',
    'invalidToken'     => '有効化トークンが無効です。',
    'activationSent'   => '有効化メールを送信しました。',
    'alreadyActivated' => 'すでに有効化されています。',

    // Validators
    'emailRequired'    => 'メールアドレスを入力してください。',
    'emailInvalid'     => 'メールアドレスが無効です。',
    'emailUnique'     => 'すでに登録されているメールアドレスです。',

    'passwordRequired' => 'パスワードを入力してください。',
    'newPasswordRequired' => '新しいパスワードを入力してください。',
    'PasswordMin'      => 'パスワードは8文字以上で設定してください。',
    'PasswordMax'      => 'パスワードは20文字以下で設定してください。',
    'passwordConfirm'  => 'パスワード確認が一致しません。',
    'passwordConfirmRequired' => 'パスワード確認を入力してください。',
    'passwordSame'     => 'パスワードが一致しません。',
    'doubleAccept'     => 'すでに登録されています。',

    'userNameTaken'    => '販売店IDは既に存在します。',
    'userNameRequired' => '販売店IDを入力してください。',
    'CompanyRequired'  => '販売店名称を入力してください。',
    'ZipcodeRequired'  => '郵便番号を入力してください。',
    'ZipcodeInvalid'  => '郵便番号が無効です。',
    'AddressRequired'  => '住所を入力してください。',
    'Address1Required'  => '住所1を入力してください。',
    'Address2Required'  => '住所2を入力してください。',
    'PhoneRequired'    => '連絡先を入力してください。',
    'PhoneInvalid'    => '連絡先が無効です。',
    'NameRequired'      => '担当者を入力してください。',
    'DeadlineRequired'  => '締め日を選択してください。',
    'BankNameRequired'  => '金融機関名を入力してください。',
    'BankBranchRequired'  => '支店名を入力してください。',
    'BankKindRequired'  => '種別を入力してください。',
    'BankNumberRequired'  => '口座番号を入力してください。',
    'BankHolderRequired'  => '口座名義を入力してください。',
    'roleRequired'     => '権限を選択してください。',
    'loginRequered'     => 'ログインしてください。',
    'passwordInvalid' => 'パスワードが無効です。',
    'CarportTypeRequired' => '契約形態を選択してください。',
    'StartedAtRequired' => '開始日を入力してください。',
    'StartedAtInvalid' => '開始日を正確に入力してください。',
    'CarportUuidRequired'  => '商品IDを入力してください。',
    'CarportUuidTaken'  => '商品IDは既に存在します。',
    'CarportCompanyRequired'  => '発電所登録名を入力してください。',
    'CarportAddressRequired'  => '設置場所を入力してください。',
    'UnitPriceRequired' => '自家消費分販売電力単価を入力してください。',
    'BillNameRequired' => '請求先名を入力してください。',
    'BillZipcodeRequired' => '請求先郵便番号を入力してください。',
    'BillZipcodeInvalid' => '請求先郵便番が無効です。',
    'BillAddress1Required' => '請求先住所１を入力してください。',
    'BillAddress2Required' => '請求先住所２を入力してください。',
];

<div class="modal fade" id="carportDetailModal{!! $carport->id !!}" role="dialog" aria-labelledby="carportNewModal{!! $carport->id !!}" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog">
        {!! Form::open(array('route' => ['carport.update', $carport->id], 'method' => 'PUT', 'role' => 'form', 'class' => 'modal-content needs-validation', 'id' => 'carportUpdateModalForm')) !!}
            <div class="modal-header">
                <h4 class="modal-title">{!! $carport->company !!}{{ __('の詳細') }}</h4>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><i class="icon-close" aria-hidden="true"></i></button>
            </div>
            <div class="modal-body">
                <div class="modal-scroll">
                    <div class="form">
                        {!! csrf_field() !!}
                        <h3 class="form-lead">{{ __('基本情報') }}</h3>
                        <div class="form-card card-sm mb-40 mb-sp-30">
                            <div class="card-body">
                                <ul class="form-group">
                                    <li>
                                        <div class="input-group">
                                            <label for="uuid" class="label">{{ __('商品ID') }}</label>
                                            <input type="text" class="form-control ss" name="uuid" placeholder="{{ __('例）10001') }}" value="{!! $carport->uuid !!}">
                                            <p class="help">※通知された商品IDを入力してください</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="input-group">
                                            <label for="company" class="label">{{ __('発電所登録名') }}</label>
                                            <input type="text" class="form-control md" name="company" placeholder="{{ __('例）株式会社カーポートソーラーシステム') }}" value="{!! $carport->company !!}">
                                        </div>
                                    </li>
                                    <li>
                                        <div class="input-group">
                                            <label for="address" class="label">{{ __('設置場所') }}</label>
                                            <input type="text" class="form-control xs" name="address" placeholder="{{ __('例）東京都新宿区西新宿2-8-1 西新宿ビル1階') }}" value="{!! $carport->address !!}">
                                        </div>
                                    </li>
                                    <li>
                                        <div class="input-group">
                                            <label for="phone" class="label">{{ __('電話番号') }}</label>
                                            <input type="text" class="form-control sm" name="phone" placeholder="{{ __('例）03-1234-5678') }}" value="{!! $carport->phone !!}">
                                        </div>
                                    </li>
                                    <li>
                                        <div class="input-group">
                                            <label for="email" class="label">{{ __('メールアドレス') }}</label>
                                            <input type="email" class="form-control md" name="email" placeholder="{{ __('例）info@example.com') }}" value="{!! $carport->email !!}">
                                        </div>
                                    </li>
                                    <li>
                                        <div class="input-group">
                                            <label for="manager" class="label">{{ __('担当者') }}</label>
                                            <input type="text" class="form-control md" name="manager" placeholder="{{ __('例）山田太郎') }}" value="{!! $carport->manager !!}">
                                        </div>
                                    </li>
                                    <li>
                                        <div class="input-group">
                                            <label for="contract_type_id" class="label">{{ __('契約形態') }}</label>
                                            <select name="contract_type_id" id="contract_type_id" class="form-control sm">
                                                <option>選択してください</option>
                                                @if (get_carport_types())
                                                    @foreach(get_carport_types() as $carport_type)
                                                        <option value="{{ $carport_type->id }}" @if( $carport_type->id === $carport->contract_type_id ) selected @endif>{{ $carport_type->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-row">
                                            <div class="form-col">
                                                <div class="input-group">
                                                    <label for="name" class="label">{{ __('登録日') }}</label>
                                                    <p class="noinput">{!! $carport->registered_at->format('Y年m月d日') !!}</p>
                                                </div>
                                            </div>
                                            <div class="form-col">
                                                <div class="input-group">
                                                    <label for="name" class="label">{{ __('開始日') }}</label>
                                                    <p class="noinput">{!! $carport->started_at->format('Y年m月d日') !!}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="input-group">
                                            <label for="unit_price" class="label">{{ __('自家消費分販売電力単価（税込）') }}</label>
                                            <div class="input-inline">
                                                <input type="text" class="form-control sd" name="unit_price" value="{!! $carport->unit_price !!}">
                                                <span class="text">円 / 1kwh</span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <h3 class="form-lead">{{ __('請求先情報') }}</h3>
                        <div class="form-card card-sm mb-40 mb-sp-30">
                            <div class="card-body">
                                <ul class="form-group">
                                    <li>
                                        <div class="input-group">
                                            <label for="bill_name" class="label">{{ __('請求先名') }}</label>
                                            <input type="text" class="form-control md" name="bill_name" placeholder="{{ __('例）株式会社カーポートソーラーシステム') }}" value="{!! $carport->bill->name !!}">
                                        </div>
                                    </li>
                                    <li>
                                        <div class="input-group">
                                            <label for="bill_zipcode" class="label">{{ __('請求先郵便番号') }}</label>
                                            <input type="text" class="form-control sd" name="bill_zipcode" placeholder="{{ __('例）123-4567') }}" value="{!! $carport->bill->zipcode !!}">
                                        </div>
                                    </li>
                                    <li>
                                        <div class="input-group">
                                            <label for="bill_address1" class="label">{{ __('請求先住所1') }}</label>
                                            <input type="text" class="form-control xs" name="bill_address1" placeholder="{{ __('例）東京都新宿区西新宿2-8-1') }}" value="{!! $carport->bill->address1 !!}">
                                        </div>
                                    </li>
                                    <li>
                                        <div class="input-group">
                                            <label for="bill_address2" class="label">{{ __('請求先住所2') }}</label>
                                            <input type="text" class="form-control xs" name="bill_address2" placeholder="{{ __('例）西新宿ビル1階') }}" value="{!! $carport->bill->address2 !!}">
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <h3 class="form-lead">{{ __('その他請求項目') }}</h3>
                        <div class="form-card card-sm">
                            <div class="card-body">
                                <ul class="form-group">
                                    <li>
                                        <div class="carport-other-fee-wrapper">
                                            @php
                                                $feeItems = $carport->fee->get_data();
                                            @endphp
                                            <div class="form-row mb-0">
                                                @foreach( $feeItems as $feeItem )
                                                <div class="form-col mb-24 mb-sp-20">
                                                    <div class="input-group">
                                                        <label for="fee_value" class="label">{{ $feeItem->name }}</label>
                                                        <div class="input-inline">
                                                            <input type="hidden" name="fee_name[]" value="{{ $feeItem->name }}">
                                                            <input type="hidden" name="fee_unit[]" value="{{ $feeItem->unit }}">
                                                            <input type="number" class="form-control sd" name="fee_value[]" value="{{ $feeItem->value }}">
                                                            <span class="text">円</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="carport-other-fee-add mt-0">
                                            <button type="button" class="btn btn-sm btn-info btn-outline"><i class="icon-plus" aria-hidden="true"></i>{{ __('請求項目の追加') }}</button>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="input-group">
                                            <label for="fee_comment" class="label">{{ __('備考') }}</label>
                                            <textarea name="fee_comment" id="fee_comment" rows="6" class="xs" placeholder="{{ __('ここに備考を入力してください') }}">{{$carport->fee->comment}}</textarea>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="updateCarportBtn" class="btn btn-info">{{ __('更新する') }}</button>
            </div>
        {!! Form::close() !!}
    </div>
</div>
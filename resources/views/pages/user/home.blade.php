@extends('layouts.app')

@section('template_linked_css')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
@endsection

@section('content')
    <div class="dashboard-card mb-50 mb-sp-40">
        <div class="card-header">
            <h3 class="lead"><i class="icon-carport" aria-hidden="true"></i>{{ __('新規カーポートの登録') }}</h3>
        </div>
        <div class="card-body">
            <div class="description mb-24 mb-sp-20">{{ __('新規でカーポートができたらこちらから登録を行ってください。') }}</div>
            <div class="action">
                <a href="#carport-new-modal" class="link-btn carportNewModalLink text-white" data-target="#carportNewModal" data-toggle="modal">{{ __('新規カーポートを登録する') }}</a>
            </div>
        </div>
    </div>
    <div class="dashboard-card mb-50 mb-sp-40">
        <div class="card-header">
            <h3 class="lead"><i class="icon-upload" aria-hidden="true"></i>{{ __('電力データのアップロード') }}</h3>
        </div>
        <div class="card-body">
            <div class="description mb-24 mb-sp-20">{{ __('請求用の電力データのアップロードはこちらから行ってください。') }}</div>
            <div class="action">
                <a href="{{ url('/power-register') }}" class="link-btn">{{ __('電力データをアップロードする') }}</a>
            </div>
        </div>
    </div>
    <div class="dashboard-card">
        <div class="card-header">
            <h3 class="lead"><i class="icon-list" aria-hidden="true"></i>{{ __('請求一覧') }}</h3>
        </div>
        <div class="card-body">
            <!-- @if( !empty( $latestInvoiceData ) )
                <h4 class="caption">{!! $latestInvoiceData['label'] !!}<small>{!! '（' . $latestInvoiceData['period'] . '）' !!}</small></h4>
                <div class="describe-panel mb-50 mb-sp-30">
                    <div class="inner-row">
                        <div class="inner-left">
                            <ul class="describe-list">
                                <li>
                                    <div class="describe-item">
                                        <h4 class="label">{{ __('件数') }}</h4>
                                        <div class="value"><strong>{!! number_format( $latestInvoiceData['count'], 0 ) !!}</strong><small>{{ __('件') }}</small></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="describe-item">
                                        <h4 class="label">{{ __('総自家消費電力量') }}</h4>
                                        <div class="value"><strong>{!! number_format( $latestInvoiceData['amount'], 4 ) !!}</strong><small>{{ __('kWh') }}</small></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="describe-item">
                                        <h4 class="label">{{ __('総請求額') }}</h4>
                                        <div class="value"><strong>{!! number_format( $latestInvoiceData['price'], 0 ) !!}</strong><small>{{ __('円') }}</small></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="inner-right">
                            <div class="download-action">
                                {!! Form::open(array('route' => 'invoice.zipfile', 'method' => 'POST', 'role' => 'form', 'class' => '')) !!}
                                    {!! csrf_field() !!}
                                    {!! Form::hidden('uuidsJson', $latestInvoiceData['uuidJson']) !!}
                                    
                                    {!! Form::button('<i class="icon-download" aria-hidden="true"></i><span>一括ダウンロード</span>', array('class' => 'link-btn','type' => 'submit' )) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            @endif -->
            <h4 class="caption mb-16 mb-sp-12">全カーポート 当月請求データ総計</h4>
            @if(count( $powerInvoices ) > 0)
                @if( !empty( $selectedInvoiceData ) )
                <div class="describe-panel mb-50 mb-sp-30">
                    @if( !empty( $invoiceIDs ) )
                    <select name="invoice_id" id="invoice_id" class="invoice-select">
                        @foreach( $invoiceIDs as $invoiceID )
                        @php
                        $year = explode('-', $invoiceID)[0];
                        $month = explode('-', $invoiceID)[1];
                        $currentUser = Auth::user();
                        $label = $currentUser->term->get_invoice_label($year, $month);
                        $period = $currentUser->term->get_invoice_period($year, $month);
                        @endphp
                        <option value="{{ $invoiceID }}" {{ $searchData['invoice_id'] == $invoiceID ? 'selected="selected"' : '' }}>{!! $label . '（' . $period . '）' !!}</option>
                        @endforeach
                    </select>
                    @endif
                    <div class="inner-row">
                        <div class="inner-left">
                            <ul class="describe-list">
                                <li>
                                    <div class="describe-item">
                                        <h4 class="label">{{ __('件数') }}</h4>
                                        <div class="value"><strong>{!! number_format( $selectedInvoiceData['count'], 0 ) !!}</strong><small>{{ __('件') }}</small></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="describe-item">
                                        <h4 class="label">{{ __('総自家消費電力量') }}</h4>
                                        <div class="value"><strong>{!! number_format( $selectedInvoiceData['amount'], 4 ) !!}</strong><small>{{ __('kWh') }}</small></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="describe-item">
                                        <h4 class="label">{{ __('総請求額') }}</h4>
                                        <div class="value"><strong>{!! number_format( round($selectedInvoiceData['price'], 0), 0 ) !!}</strong><small>{{ __('円') }}</small></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="inner-right">
                            <div class="download-action">
                                {!! Form::open(array('route' => 'invoice.zipfile', 'method' => 'POST', 'role' => 'form', 'class' => '')) !!}
                                    {!! csrf_field() !!}
                                    {!! Form::hidden('uuidsJson', $selectedInvoiceData['uuidJson']) !!}
                                    
                                    {!! Form::button('<i class="icon-download" aria-hidden="true"></i><span>一括ダウンロード</span>', array('class' => 'link-btn','type' => 'submit' )) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            @else
                <div class="describe-panel mb-50 mb-sp-30">
                    <div class="title">{{ __('データがありません。') }}</div>
                    <div class="content">{!! __('電力データ登録画面から、電力データをアップロードしてください。<br>請求データとしてこちらに反映されます。') !!}</div>
                </div>
            @endif

            <h4 class="caption">{{ __('カーポート別 当月請求データ一覧') }}</h4>
            <div class="table-responsive requests-table">
                <table class="table table-sm data-table">
                    <thead class="thead">
                        <tr>
                            <th class="id">{{ __('ID') }}</th>
                            <th>{{ __('名前') }}</th>
                            <th>{{ __('請求月') }}</th>
                            <th>{{ __('請求額') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        @if(count( $powerInvoices ) > 0)
                            @foreach($powerInvoices as $powerInvoiceItem)
                                <tr>
                                    <td>{!! $powerInvoiceItem->carport->uuid !!}</td>
                                    <td>{!! $powerInvoiceItem->carport->company !!}</td>
                                    <td>{!! $powerInvoiceItem->user->term->get_invoice_label($powerInvoiceItem->year, $powerInvoiceItem->month) !!}</td>
                                    @php
                                        $feeSum = 0.0;
                                        foreach( $powerInvoiceItem->carport->fee->get_data() as $feeItem ) {
                                            $feeSum += $feeItem->value;
                                        }
                                        $totalPrice = $powerInvoiceItem->used_amount * $powerInvoiceItem->carport->unit_price + $feeSum;
                                    @endphp
                                    <td>{!! number_format( intval( $totalPrice ), 0 ) . '円' !!}</td>
                                    <td class="action">
                                        @php
                                            $invoiceUuid = $powerInvoiceItem->user->id . '_' . $powerInvoiceItem->file_id . '_' . $powerInvoiceItem->carport_id . '_' . $powerInvoiceItem->year . '_' . $powerInvoiceItem->month;
                                        @endphp
                                        <button class="btn btn-sm btn-info btn-outline invoiceDetailModalLink" data-target="#invoiceDetailModal_{!! $invoiceUuid !!}" data-toggle="modal">{{ __('詳細を確認') }}</button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="no-result">{{ __('データがありません。') }}</td>
                            </tr>
                        @endif
                    </tbody>
                    <tbody id="search-results"></tbody>
                </table>
            </div>
            @if(count( $powerInvoices ) > 0)
                @if( $powerInvoices->total() > 6 )
                <div class="table-action text-right">
                    <a href="{{ url('/invoice') }}" class="viewmore"><span>{{ __('全ての請求データを見る') }}</span><i class="icon-right" aria-hidden="true"></i></a>
                </div>
                @endif
            @endif
        </div>
    </div>

    @if(count( $powerInvoices ) > 0)
        @foreach($powerInvoices as $powerInvoiceItem)
            @include('modals.modal-invoice', ['powerInvoiceItem' => $powerInvoiceItem])
        @endforeach
    @endif

    @include('modals.modal-carport-new')

@endsection

@section('footer_scripts')
    
    @include('scripts.datapicker-script')

    @include('scripts.save-modal-carport-script')

    @include('scripts.home-select')

@endsection
@extends('layouts.app')

@section('template_title')
    {!! trans('invoice.titles.list-alt') !!}
@endsection

@section('template_linked_css')
@endsection

@section('content')
    <div class="dashboard-card">
        <div class="card-header">
            <h3 class="lead">{{ __('請求一覧') }}</h3>
        </div>
        <div class="card-body">
            <h4 class="caption mb-16 mb-sp-12">全カーポート 当月請求データ総計</h4>
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
            
            <h4 class="caption">{{ __('カーポート別 当月請求データ一覧') }}</h4>
            {!! Form::open(array('route' => 'invoice.show', 'method' => 'GET', 'role' => 'form', 'class' => 'requests-search-form needs-validation mb-30')) !!}
                <div class="form-inner-row">
                    <div class="inner-left">
                        <ul class="form-group">
                            <li>
                                <div class="input-group">
                                    <label for="keyword">{{ __('キーワード検索') }}</label>
                                    <input type="text" class="form-control m" name="keyword" placeholder="ID、名前、住所" value="{!! $searchData['keyword'] !!}">
                                </div>
                            </li>
                            <li>
                                <div class="input-group">
                                    <label for="year">{{ __('請求年') }}</label>
                                    @php
                                        $maxYear = (int)date('Y');
                                    @endphp
                                    <select name="year" class="form-control s">
                                        <option value="">年を選択</option>
                                        @for ($year = $maxYear; $year > $maxYear - 10; $year--) 
                                            <option value="{{$year}}" {{ $searchData['year'] == $year ? 'selected="selected"' : '' }}>{{ $year . '年' }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </li>
                            <li>
                                <div class="input-group">
                                    <label for="month">{{ __('請求月') }}</label>
                                    <select name="month" class="form-control s">
                                        <option value="">月を選択</option>
                                        @for ($month = 1; $month <= 12; $month++)
                                            <option value="{{$month}}" {{ $searchData['month'] == $month ? 'selected="selected"' : '' }}>{{ $month . '月' }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="inner-right">
                        <div class="form-submit">
                            <button type="submit" class="btn btn-outline">{{ __('絞り込んで検索') }}</button>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}

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
                                        $totalPrice = round($powerInvoiceItem->used_amount * $powerInvoiceItem->carport->unit_price, 0) + $feeSum;
                                    @endphp
                                    <td>{!! number_format( round($totalPrice, 0), 0 ) . '円' !!}</td>
                                    <td class="action">
                                        @php
                                            $invoiceUuid = $powerInvoiceItem->user->id . '_' . $powerInvoiceItem->file_id . '_' . $powerInvoiceItem->carport_id . '_' . $powerInvoiceItem->year . '_' . $powerInvoiceItem->month;
                                        @endphp
                                        <button class="btn btn-sm btn-info btn-outline invoiceDetailModalLink" data-target="#invoiceDetailModal_{!! $invoiceUuid !!}" data-toggle="modal">{{ __('詳細') }}</button>
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
            <div id="search-pagination" class="table-pagination data-table">
                {{ $powerInvoices->links() }}
            </div>
            @endif
        </div>
    </div>

    @if(count( $powerInvoices ) > 0)
        @foreach($powerInvoices as $powerInvoiceItem)
            @include('modals.modal-invoice', ['powerInvoiceItem' => $powerInvoiceItem])
        @endforeach
    @endif

@endsection

@section('footer_scripts')

    @include('scripts.invoice-select')

@endsection
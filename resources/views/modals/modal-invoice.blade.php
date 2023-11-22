@php
    $invoiceUuid = $powerInvoiceItem->user->id . '_' . $powerInvoiceItem->file_id . '_' . $powerInvoiceItem->carport_id . '_' . $powerInvoiceItem->year . '_' . $powerInvoiceItem->month;
@endphp
<div class="modal fade" id="invoiceDetailModal_{!! $invoiceUuid !!}" role="dialog" aria-labelledby="invoiceDetailModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog">
        {!! Form::open(array('route' => 'invoice.update', 'method' => 'PUT', 'role' => 'form', 'class' => 'modal-content needs-validation', 'id' => 'invoiceModalForm')) !!}
            <div class="modal-header">
                <h4 class="modal-title">{!! $powerInvoiceItem->carport->company !!}{{ __('の請求情報') }}</h4>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><i class="icon-close" aria-hidden="true"></i></button>
            </div>
            <div class="modal-body">
                {!! csrf_field() !!}
                {!! Form::hidden('uuid', $invoiceUuid) !!}
                {!! Form::hidden('year', $powerInvoiceItem->year) !!}
                {!! Form::hidden('month', $powerInvoiceItem->month) !!}
                {!! Form::hidden('user_id', $powerInvoiceItem->user->id) !!}
                {!! Form::hidden('file_id', $powerInvoiceItem->file_id) !!}
                {!! Form::hidden('carport_id', $powerInvoiceItem->carport_id) !!}
                <div class="modal-scroll">
                    <div class="form">
                        <ul class="form-group">
                            <li>
                                <p class="bill-address fw-600">{!! $powerInvoiceItem->carport->address !!}</p>
                            </li>
                            <li>
                                <div class="scroll">
                                    @php
                                        $totalPrice = 0.0;
                                    @endphp
                                    <table class="bill-table">
                                        <thead>
                                            <tr>
                                                <th>{!! __('品名') !!}</th>
                                                <th>{!! __('数量') !!}</th>
                                                <th>{!! __('単位') !!}</th>
                                                <th>{!! __('単価') !!}</th>
                                                <th>{!! __('金額') !!}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{!! __('自家消費電力') !!}</td>
                                                <td>{!! number_format( $powerInvoiceItem->used_amount, 4 ) !!}</td>
                                                <td>{!! __('kWh') !!}</td>
                                                <td>{!! '¥'.number_format( $powerInvoiceItem->carport->unit_price, 2 ) !!}</td>
                                                <td>{!! '¥'.number_format( round( $powerInvoiceItem->carport->unit_price * $powerInvoiceItem->used_amount, 0 ), 0 ) !!}</td>
                                            </tr>
                                            @php
                                                $totalPrice += round($powerInvoiceItem->carport->unit_price * $powerInvoiceItem->used_amount, 0);
                                            @endphp
                                            @foreach( $powerInvoiceItem->carport->fee->get_data() as $feeItem )
                                            <tr>
                                                <td>{!! $feeItem->name !!}</td>
                                                <td>{!! __(1) !!}</td>
                                                <td>{!! $feeItem->unit !!}</td>
                                                <td>{!! '¥'. $feeItem->value !!}</td>
                                                <td>{!! '¥'. $feeItem->value * 1 !!}</td>
                                            </tr>
                                            @php
                                                $totalPrice += $feeItem->value * 1;
                                            @endphp
                                            @endforeach
                                            <tr>
                                                <td>総請求額</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>{!! '¥'.number_format( round($totalPrice, 0), 0 ) !!}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li>
                                <div class="input-group">
                                    <label for="name" class="label">{{ __('備考') }}</label>
                                    <textarea name="comment" id="comment" rows="6" class="xs" placeholder="{{ __('ここに備考を入力してください') }}">{!! get_invoice_comment( $invoiceUuid ) !!}</textarea>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="{{ route('invoice.download', $invoiceUuid) }}" class="btn btn-info btn-outline"><i class="icon-download" aria-hidden="true"></i><span class="hidden-sm">請求データの</span>ダウンロード</a>
                <button type="submit" id="updateInvoiceBtn" class="btn btn-info">{{ __('更新する') }}</button>
            </div>
        {!! Form::close() !!}
    </div>
</div>
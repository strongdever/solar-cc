

<?php $__env->startSection('template_title'); ?>
    <?php echo trans('invoice.titles.list-alt'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_linked_css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="dashboard-card">
        <div class="card-header">
            <h3 class="lead"><?php echo e(__('請求一覧')); ?></h3>
        </div>
        <div class="card-body">
            <h4 class="caption mb-16 mb-sp-12">全カーポート 当月請求データ総計</h4>
            <?php if( !empty( $selectedInvoiceData ) ): ?>
            <div class="describe-panel mb-50 mb-sp-30">
                <?php if( !empty( $invoiceIDs ) ): ?>
                <select name="invoice_id" id="invoice_id" class="invoice-select">
                    <?php $__currentLoopData = $invoiceIDs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoiceID): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                    $year = explode('-', $invoiceID)[0];
                    $month = explode('-', $invoiceID)[1];
                    $currentUser = Auth::user();
                    $label = $currentUser->term->get_invoice_label($year, $month);
                    $period = $currentUser->term->get_invoice_period($year, $month);
                    ?>
                    <option value="<?php echo e($invoiceID); ?>" <?php echo e($searchData['invoice_id'] == $invoiceID ? 'selected="selected"' : ''); ?>><?php echo $label . '（' . $period . '）'; ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php endif; ?>
                <div class="inner-row">
                    <div class="inner-left">
                        <ul class="describe-list">
                            <li>
                                <div class="describe-item">
                                    <h4 class="label"><?php echo e(__('件数')); ?></h4>
                                    <div class="value"><strong><?php echo number_format( $selectedInvoiceData['count'], 0 ); ?></strong><small><?php echo e(__('件')); ?></small></div>
                                </div>
                            </li>
                            <li>
                                <div class="describe-item">
                                    <h4 class="label"><?php echo e(__('総自家消費電力量')); ?></h4>
                                    <div class="value"><strong><?php echo number_format( $selectedInvoiceData['amount'], 4 ); ?></strong><small><?php echo e(__('kWh')); ?></small></div>
                                </div>
                            </li>
                            <li>
                                <div class="describe-item">
                                    <h4 class="label"><?php echo e(__('総請求額')); ?></h4>
                                    <div class="value"><strong><?php echo number_format( round($selectedInvoiceData['price'], 0), 0 ); ?></strong><small><?php echo e(__('円')); ?></small></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="inner-right">
                        <div class="download-action">
                            <?php echo Form::open(array('route' => 'invoice.zipfile', 'method' => 'POST', 'role' => 'form', 'class' => '')); ?>

                                <?php echo csrf_field(); ?>

                                <?php echo Form::hidden('uuidsJson', $selectedInvoiceData['uuidJson']); ?>

                                
                                <?php echo Form::button('<i class="icon-download" aria-hidden="true"></i><span>一括ダウンロード</span>', array('class' => 'link-btn','type' => 'submit' )); ?>

                            <?php echo Form::close(); ?>

                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            
            <h4 class="caption"><?php echo e(__('カーポート別 当月請求データ一覧')); ?></h4>
            <?php echo Form::open(array('route' => 'invoice.show', 'method' => 'GET', 'role' => 'form', 'class' => 'requests-search-form needs-validation mb-30')); ?>

                <div class="form-inner-row">
                    <div class="inner-left">
                        <ul class="form-group">
                            <li>
                                <div class="input-group">
                                    <label for="keyword"><?php echo e(__('キーワード検索')); ?></label>
                                    <input type="text" class="form-control m" name="keyword" placeholder="ID、名前、住所" value="<?php echo $searchData['keyword']; ?>">
                                </div>
                            </li>
                            <li>
                                <div class="input-group">
                                    <label for="year"><?php echo e(__('請求年')); ?></label>
                                    <?php
                                        $maxYear = (int)date('Y');
                                    ?>
                                    <select name="year" class="form-control s">
                                        <option value="">年を選択</option>
                                        <?php for($year = $maxYear; $year > $maxYear - 10; $year--): ?> 
                                            <option value="<?php echo e($year); ?>" <?php echo e($searchData['year'] == $year ? 'selected="selected"' : ''); ?>><?php echo e($year . '年'); ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </li>
                            <li>
                                <div class="input-group">
                                    <label for="month"><?php echo e(__('請求月')); ?></label>
                                    <select name="month" class="form-control s">
                                        <option value="">月を選択</option>
                                        <?php for($month = 1; $month <= 12; $month++): ?>
                                            <option value="<?php echo e($month); ?>" <?php echo e($searchData['month'] == $month ? 'selected="selected"' : ''); ?>><?php echo e($month . '月'); ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="inner-right">
                        <div class="form-submit">
                            <button type="submit" class="btn btn-outline"><?php echo e(__('絞り込んで検索')); ?></button>
                        </div>
                    </div>
                </div>
            <?php echo Form::close(); ?>


            <div class="table-responsive requests-table">
                <table class="table table-sm data-table">
                    <thead class="thead">
                        <tr>
                            <th class="id"><?php echo e(__('ID')); ?></th>
                            <th><?php echo e(__('名前')); ?></th>
                            <th><?php echo e(__('請求月')); ?></th>
                            <th><?php echo e(__('請求額')); ?></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <?php if(count( $powerInvoices ) > 0): ?>
                            <?php $__currentLoopData = $powerInvoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $powerInvoiceItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo $powerInvoiceItem->carport->uuid; ?></td>
                                    <td><?php echo $powerInvoiceItem->carport->company; ?></td>
                                    <td><?php echo $powerInvoiceItem->user->term->get_invoice_label($powerInvoiceItem->year, $powerInvoiceItem->month); ?></td>
                                    <?php
                                        $feeSum = 0.0;
                                        foreach( $powerInvoiceItem->carport->fee->get_data() as $feeItem ) {
                                            $feeSum += $feeItem->value;
                                        }
                                        $totalPrice = round($powerInvoiceItem->used_amount * $powerInvoiceItem->carport->unit_price, 0) + $feeSum;
                                    ?>
                                    <td><?php echo number_format( round($totalPrice, 0), 0 ) . '円'; ?></td>
                                    <td class="action">
                                        <?php
                                            $invoiceUuid = $powerInvoiceItem->user->id . '_' . $powerInvoiceItem->file_id . '_' . $powerInvoiceItem->carport_id . '_' . $powerInvoiceItem->year . '_' . $powerInvoiceItem->month;
                                        ?>
                                        <button class="btn btn-sm btn-info btn-outline invoiceDetailModalLink" data-target="#invoiceDetailModal_<?php echo $invoiceUuid; ?>" data-toggle="modal"><?php echo e(__('詳細')); ?></button>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="no-result"><?php echo e(__('データがありません。')); ?></td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                    <tbody id="search-results"></tbody>
                </table>
            </div>
            <?php if(count( $powerInvoices ) > 0): ?>
            <div id="search-pagination" class="table-pagination data-table">
                <?php echo e($powerInvoices->links()); ?>

            </div>
            <?php endif; ?>
        </div>
    </div>

    <?php if(count( $powerInvoices ) > 0): ?>
        <?php $__currentLoopData = $powerInvoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $powerInvoiceItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $__env->make('modals.modal-invoice', ['powerInvoiceItem' => $powerInvoiceItem], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>

    <?php echo $__env->make('scripts.invoice-select', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\solar-cc\resources\views/pages/user/invoice.blade.php ENDPATH**/ ?>
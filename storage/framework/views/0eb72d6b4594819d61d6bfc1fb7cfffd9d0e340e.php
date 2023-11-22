<?php
    $invoiceUuid = $powerInvoiceItem->user->id . '_' . $powerInvoiceItem->file_id . '_' . $powerInvoiceItem->carport_id . '_' . $powerInvoiceItem->year . '_' . $powerInvoiceItem->month;
?>
<div class="modal fade" id="invoiceDetailModal_<?php echo $invoiceUuid; ?>" role="dialog" aria-labelledby="invoiceDetailModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog">
        <?php echo Form::open(array('route' => 'invoice.update', 'method' => 'PUT', 'role' => 'form', 'class' => 'modal-content needs-validation', 'id' => 'invoiceModalForm')); ?>

            <div class="modal-header">
                <h4 class="modal-title"><?php echo $powerInvoiceItem->carport->company; ?><?php echo e(__('の請求情報')); ?></h4>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><i class="icon-close" aria-hidden="true"></i></button>
            </div>
            <div class="modal-body">
                <?php echo csrf_field(); ?>

                <?php echo Form::hidden('uuid', $invoiceUuid); ?>

                <?php echo Form::hidden('year', $powerInvoiceItem->year); ?>

                <?php echo Form::hidden('month', $powerInvoiceItem->month); ?>

                <?php echo Form::hidden('user_id', $powerInvoiceItem->user->id); ?>

                <?php echo Form::hidden('file_id', $powerInvoiceItem->file_id); ?>

                <?php echo Form::hidden('carport_id', $powerInvoiceItem->carport_id); ?>

                <div class="modal-scroll">
                    <div class="form">
                        <ul class="form-group">
                            <li>
                                <p class="bill-address fw-600"><?php echo $powerInvoiceItem->carport->address; ?></p>
                            </li>
                            <li>
                                <div class="scroll">
                                    <?php
                                        $totalPrice = 0.0;
                                    ?>
                                    <table class="bill-table">
                                        <thead>
                                            <tr>
                                                <th><?php echo __('品名'); ?></th>
                                                <th><?php echo __('数量'); ?></th>
                                                <th><?php echo __('単位'); ?></th>
                                                <th><?php echo __('単価'); ?></th>
                                                <th><?php echo __('金額'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><?php echo __('自家消費電力'); ?></td>
                                                <td><?php echo number_format( $powerInvoiceItem->used_amount, 4 ); ?></td>
                                                <td><?php echo __('kWh'); ?></td>
                                                <td><?php echo '¥'.number_format( $powerInvoiceItem->carport->unit_price, 2 ); ?></td>
                                                <td><?php echo '¥'.number_format( round( $powerInvoiceItem->carport->unit_price * $powerInvoiceItem->used_amount, 0 ), 0 ); ?></td>
                                            </tr>
                                            <?php
                                                $totalPrice += round($powerInvoiceItem->carport->unit_price * $powerInvoiceItem->used_amount, 0);
                                            ?>
                                            <?php $__currentLoopData = $powerInvoiceItem->carport->fee->get_data(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feeItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo $feeItem->name; ?></td>
                                                <td><?php echo __(1); ?></td>
                                                <td><?php echo $feeItem->unit; ?></td>
                                                <td><?php echo '¥'. $feeItem->value; ?></td>
                                                <td><?php echo '¥'. $feeItem->value * 1; ?></td>
                                            </tr>
                                            <?php
                                                $totalPrice += $feeItem->value * 1;
                                            ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td>総請求額</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td><?php echo '¥'.number_format( round($totalPrice, 0), 0 ); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li>
                                <div class="input-group">
                                    <label for="name" class="label"><?php echo e(__('備考')); ?></label>
                                    <textarea name="comment" id="comment" rows="6" class="xs" placeholder="<?php echo e(__('ここに備考を入力してください')); ?>"><?php echo get_invoice_comment( $invoiceUuid ); ?></textarea>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="<?php echo e(route('invoice.download', $invoiceUuid)); ?>" class="btn btn-info btn-outline"><i class="icon-download" aria-hidden="true"></i><span class="hidden-sm">請求データの</span>ダウンロード</a>
                <button type="submit" id="updateInvoiceBtn" class="btn btn-info"><?php echo e(__('更新する')); ?></button>
            </div>
        <?php echo Form::close(); ?>

    </div>
</div><?php /**PATH E:\xampp\htdocs\carport-club\resources\views/modals/modal-invoice.blade.php ENDPATH**/ ?>
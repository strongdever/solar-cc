<?php $__env->startSection('template_linked_css'); ?>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="dashboard-card mb-50 mb-sp-40">
        <div class="card-header">
            <h3 class="lead"><i class="icon-carport" aria-hidden="true"></i><?php echo e(__('新規カーポートの登録')); ?></h3>
        </div>
        <div class="card-body">
            <div class="description mb-24 mb-sp-20"><?php echo e(__('商品IDが届きましたらカーポート登録を行ってください。')); ?></div>
            <div class="action">
                <a href="#carport-new-modal" class="link-btn carportNewModalLink text-white" data-target="#carportNewModal" data-toggle="modal"><?php echo e(__('新規カーポートを登録する')); ?></a>
            </div>
        </div>
    </div>
    <div class="dashboard-card mb-50 mb-sp-40">
        <div class="card-header">
            <h3 class="lead"><i class="icon-upload" aria-hidden="true"></i><?php echo e(__('電力データのアップロード')); ?></h3>
        </div>
        <div class="card-body">
            <div class="description mb-24 mb-sp-20"><?php echo e(__('請求用の電力データのアップロードはこちらから行ってください。')); ?></div>
            <div class="action">
                <a href="<?php echo e(url('/power-register')); ?>" class="link-btn"><?php echo e(__('電力データをアップロードする')); ?></a>
            </div>
        </div>
    </div>
    <div class="dashboard-card">
        <div class="card-header">
            <h3 class="lead"><i class="icon-list" aria-hidden="true"></i><?php echo e(__('請求一覧')); ?></h3>
        </div>
        <div class="card-body">
            <?php if( !empty( $latestInvoiceData ) ): ?>
                <h4 class="caption"><?php echo $latestInvoiceData['label']; ?><small><?php echo '（' . $latestInvoiceData['period'] . '）'; ?></small></h4>
                <div class="describe-panel mb-50 mb-sp-30">
                    <div class="inner-row">
                        <div class="inner-left">
                            <ul class="describe-list">
                                <li>
                                    <div class="describe-item">
                                        <h4 class="label"><?php echo e(__('件数')); ?></h4>
                                        <div class="value"><strong><?php echo number_format( $latestInvoiceData['count'], 0 ); ?></strong><small><?php echo e(__('件')); ?></small></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="describe-item">
                                        <h4 class="label"><?php echo e(__('総自家消費電力量')); ?></h4>
                                        <div class="value"><strong><?php echo number_format( $latestInvoiceData['amount'], 4 ); ?></strong><small><?php echo e(__('kWh')); ?></small></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="describe-item">
                                        <h4 class="label"><?php echo e(__('総請求額')); ?></h4>
                                        <div class="value"><strong><?php echo number_format( $latestInvoiceData['price'], 0 ); ?></strong><small><?php echo e(__('円')); ?></small></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="inner-right">
                            <div class="download-action">
                                <?php echo Form::open(array('route' => 'invoice.zipfile', 'method' => 'POST', 'role' => 'form', 'class' => '')); ?>

                                    <?php echo csrf_field(); ?>

                                    <?php echo Form::hidden('uuidsJson', $latestInvoiceData['uuidJson']); ?>

                                    
                                    <?php echo Form::button('<i class="icon-download" aria-hidden="true"></i><span>一括ダウンロード</span>', array('class' => 'link-btn','type' => 'submit' )); ?>

                                <?php echo Form::close(); ?>

                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <h4 class="caption"><?php echo e(__('カーポート別 当月請求データ一覧')); ?></h4>
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
                                        $totalPrice = $powerInvoiceItem->used_amount * $powerInvoiceItem->carport->unit_price + $feeSum;
                                    ?>
                                    <td><?php echo number_format( intval( $totalPrice ), 0 ) . '円'; ?></td>
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
                <?php if( $powerInvoices->total() > 6 ): ?>
                <div class="table-action text-right">
                    <a href="<?php echo e(url('/invoice')); ?>" class="viewmore"><span><?php echo e(__('全ての請求データを見る')); ?></span><i class="icon-right" aria-hidden="true"></i></a>
                </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>

    <?php if(count( $powerInvoices ) > 0): ?>
        <?php $__currentLoopData = $powerInvoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $powerInvoiceItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $__env->make('modals.modal-invoice', ['powerInvoiceItem' => $powerInvoiceItem], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>

    <?php echo $__env->make('modals.modal-carport-new', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
    
    <?php echo $__env->make('scripts.datapicker-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('scripts.save-modal-carport-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cptc/www/resources/views/pages/user/home.blade.php ENDPATH**/ ?>
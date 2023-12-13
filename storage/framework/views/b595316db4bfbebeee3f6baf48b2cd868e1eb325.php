

<?php $__env->startSection('template_title'); ?>
    <?php echo trans('carport.titles.list-alt'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_linked_css'); ?>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="dashboard-card">
        <div class="card-header">
            <h3 class="lead"><?php echo e(__('カーポート一覧')); ?></h3>
        </div>
        <div class="card-body">
            <div class="form-card card-sm mb-50 mb-sp-40">
                <h3 class="card-title"><?php echo e(__('新規カーポートの登録')); ?></h3>
                <div class="card-body">
                    <div class="description mb-20"><?php echo e(__('新規でカーポートができたらこちらから登録を行ってください。')); ?></div>
                    <div class="action">
                        <a href="#carport-new-modal" class="link-btn carportNewModalLink text-white" data-target="#carportNewModal" data-toggle="modal"><?php echo e(__('新規カーポートを登録する')); ?></a>
                    </div>
                </div>
            </div>
            <?php echo Form::open(array('route' => 'carport.show', 'method' => 'GET', 'role' => 'form', 'class' => 'requests-search-form needs-validation mb-30')); ?>

                <div class="form-inner-row">
                    <div class="inner-left">
                        <ul class="form-group">
                            <li class="x">
                                <div class="input-group">
                                    <label for="keyword"><?php echo e(__('キーワード検索')); ?></label>
                                    <input type="text" class="form-control m" name="keyword" placeholder="ID、名前、住所"  value="<?php echo $searchData['keyword']; ?>">
                                </div>
                            </li>
                            <li class="x">
                                <div class="input-group">
                                    <label for="contract_type_id"><?php echo e(__('契約形態')); ?></label>
                                    <select name="contract_type_id" class="form-control sm">
                                        <option value=""><?php echo e(__('選択してください')); ?></option>
                                        <?php if(get_carport_types()): ?>
                                            <?php $__currentLoopData = get_carport_types(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $carport_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($carport_type->id); ?>"  <?php echo e($searchData['contract_type_id'] == $carport_type->id ? 'selected="selected"' : ''); ?>><?php echo e($carport_type->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
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

            <div class="table-responsive carports-table">
                <table class="table table-sm data-table">
                    <thead class="thead">
                        <tr>
                            <th class="id"><?php echo e(__('ID')); ?></th>
                            <th><?php echo e(__('名前')); ?></th>
                            <th class="date"><?php echo e(__('登録日')); ?></th>
                            <th class="date"><?php echo e(__('開始日')); ?></th>
                            <th><?php echo e(__('契約形態')); ?></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <?php if($carports->count() > 0): ?>
                            <?php $__currentLoopData = $carports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $carport): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo $carport->uuid; ?></td>
                                    <td><?php echo $carport->company; ?></td>
                                    <td><?php echo $carport->registered_at->format('Y年m月d日'); ?></td>
                                    <td><?php echo $carport->started_at->format('Y年m月d日'); ?></td>
                                    <td><?php echo $carport->contract_type->name; ?></td>
                                    <td class="action">
                                        <button class="btn btn-sm btn-info btn-outline" data-target="#carportDetailModal<?php echo e($carport->id); ?>" data-toggle="modal"><?php echo e(__('詳細')); ?></button>
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
            <div id="search-pagination" class="table-pagination data-table">
                <?php echo e($carports->links()); ?>

            </div>
        </div>
    </div>

    <?php if($carports->count() > 0): ?>
        <?php $__currentLoopData = $carports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $carport): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $__env->make('modals.modal-carport-detail', ['carport' => $carport], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>

    <?php echo $__env->make('modals.modal-carport-new', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
    
    <?php echo $__env->make('scripts.datapicker-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('scripts.save-modal-carport-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\solar-cc\resources\views/pages/user/carport.blade.php ENDPATH**/ ?>
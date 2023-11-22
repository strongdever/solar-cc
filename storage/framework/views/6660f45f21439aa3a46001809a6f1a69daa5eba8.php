

<?php $__env->startSection('template_title'); ?>
    <?php echo trans('power.titles.create-alt'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_linked_css'); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="dashboard-card">
        <div class="card-header">
            <h3 class="lead"><?php echo e(__('電力データ登録')); ?></h3>
        </div>
        <div class="card-body">
            <h4 class="caption"><?php echo e(__('電力データのアップロード')); ?></h4>
            <div class="csv-dropzone-upload mb-50 mb-sp-40">
                <form action="<?php echo e(route('dropzone.store')); ?>" method="post" name="file" files="true" enctype="multipart/form-data" class="dropzone" id="csv-dropzone" >
                    <?php echo csrf_field(); ?>

                    <div class="dz-message">
                        <span class="lead"><?php echo e(__('ここにファイルをドラッグ＆ドロップ')); ?></span>
                        <div class="sep"><?php echo e(__('または')); ?></div>
                        <span class="btn"><?php echo e(__('ファイルを選択')); ?></span>
                    </div>
                </form>
                <div class="csv-meta"><?php if($files->count() > 0): ?> 前回のアップロード日：<?php echo $files[0]->uploaded_at->format('Y年m月d日'); ?> <?php endif; ?></div>
            </div>
            <h4 class="caption"><?php echo e(__('アップロード履歴')); ?></h4>
            <div class="table-responsive power-history-table">
                <table class="table table-sm data-table">
                    <thead class="thead">
                        <tr>
                            <th><?php echo e(__('ファイル名')); ?></th>
                            <th><?php echo e(__('アップロード日')); ?></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="csv-table">
                        <?php if($files->count() > 0): ?>
                            <?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo $file->name; ?></td>
                                    <td><?php echo $file->uploaded_at->format('Y年m月d日'); ?></td>
                                    <td class="action">
                                        <a href="<?php echo e(asset($file->path)); ?>" class="btn btn-sm btn-info btn-outline" download="<?php echo $file->name; ?>">
                                            <i class="icon-download" aria-hidden="true"></i>
                                            <span><?php echo e(__('ダウンロード')); ?></span>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <tr id="no-result">
                                <td colspan="3" class="no-result"><?php echo e(__('データがありません。')); ?></td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                    <tbody id="search_results"></tbody>
                </table>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>

    <?php echo $__env->make('scripts.dropzone-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\carport-club\resources\views/pages/user/power-register.blade.php ENDPATH**/ ?>
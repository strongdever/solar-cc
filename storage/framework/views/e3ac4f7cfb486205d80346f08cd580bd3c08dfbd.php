

<?php $__env->startSection('template_title'); ?>
    <?php echo trans('contract_type.title-alt'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="dashboard-card">
    <div class="common-caption">
        <h3 class="label y-padding"><?php echo trans('contract_type.titles.show-alt'); ?></h3>
        <ul class="actions">
            <li>
                <a class="btn btn-secondary text-white" href="<?php echo e(url('/contract_types/create')); ?>">
                    <?php echo trans('contract_type.buttons.create'); ?>

                </a>
            </li>
        </ul>
    </div>
    <div class="common-form show-form">
        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <strong>
                    <?php echo trans('contract_type.labels.id'); ?>

                </strong>
                <div>
                    <?php echo e($contract_type->id); ?>

                </div>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <strong>
                    <?php echo trans('contract_type.labels.name'); ?>

                </strong>
                <div>
                    <?php echo e($contract_type->name); ?>

                </div>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <strong>
                    <?php echo trans('contract_type.labels.comment'); ?>

                </strong>
                <div>
                    <?php echo e($contract_type->comment); ?>

                </div>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <strong>
                    <?php echo trans('contract_type.labels.created'); ?>

                </strong>
                <div>
                    <?php echo $contract_type->created_at->format('Y年m月d日'); ?>

                </div>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <strong>
                    <?php echo trans('contract_type.labels.updated'); ?>

                </strong>
                <div>
                    <?php echo $contract_type->updated_at->format('Y年m月d日'); ?>

                </div>
            </li>
        </ul>
        <ul class="btn-group form-bottom">
            <li>
                <a class="btn form-btn btn-info text-white" href="<?php echo e(URL::to('contract_types/' . $contract_type->id . '/edit')); ?>">
                    <?php echo trans("contract_type.buttons.edit-alt"); ?>

                </a>
            </li>
            <li>
                <?php echo Form::open(array('url' => 'contract_types/' . $contract_type->id, 'class' => '')); ?>

                    <?php echo Form::hidden('_method', 'DELETE'); ?>

                    <?php echo Form::button(trans('contract_type.buttons.delete-alt'), array('class' => 'btn form-btn btn-danger text-white','type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => trans("contract_type.modals.delete_title"), 'data-message' => trans("contract_type.modals.delete_message"))); ?>

                <?php echo Form::close(); ?>

            </li>
        </ul>
    </div>
</div>

<?php echo $__env->make('modals.modal-delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
    <?php echo $__env->make('scripts.delete-modal-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php if(config('options.tooltipsEnabled')): ?>
        <?php echo $__env->make('scripts.tooltips', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\SuzukiWork\2023-02-28(laravel)\WORK\laravel-auth\resources\views/contract_types/show.blade.php ENDPATH**/ ?>
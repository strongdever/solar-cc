

<?php $__env->startSection('template_title'); ?>
    <?php echo trans('contract_type.title-alt'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="dashboard-card">
        <div class="common-caption">
            <h3 class="label y-padding"><?php echo trans('contract_type.titles.create-alt'); ?></h3>
            <ul class="actions">
                <li>
                    <a class="btn btn-secondary text-white" href="<?php echo e(route('contract_types')); ?>">
                        <?php echo trans('contract_type.buttons.back-to-list'); ?>

                    </a>
                </li>
            </ul>
        </div>
        <div class="form-card">
            <div class="common-form">
                <?php echo Form::open(array('route' => 'contract_types.store', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')); ?>

                    <?php echo csrf_field(); ?>

                    <table class="form-table">
                        <tbody>
                            <tr>
                                <th><?php echo trans('contract_type.labels.name'); ?></th>
                                <td>
                                    <div class="form-input">
                                        <?php if(isset($contract_type)): ?>
                                            <input type="text" class="form-control<?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>" name="name" value="<?php echo e($contract_type->name); ?>" autofocus>
                                        <?php else: ?>
                                            <input type="text" class="form-control<?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>" name="name" value="<?php echo e(old('name')); ?>" autofocus>
                                        <?php endif; ?>
                                        <?php if($errors->has('name')): ?>
                                            <p class="invalid-feedback"><?php echo e($errors->first('name')); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th><?php echo trans('contract_type.labels.comment'); ?></th>
                                <td>
                                    <div class="form-input">
                                        <?php if(isset($contract_type)): ?>
                                            <textarea class="form-control<?php echo e($errors->has('comment') ? ' is-invalid' : ''); ?>" name="comment" rows="8"><?php echo e($contract_type->comment); ?></textarea>
                                        <?php else: ?>
                                            <textarea class="form-control<?php echo e($errors->has('comment') ? ' is-invalid' : ''); ?>" name="comment" rows="8"><?php echo e(old('comment')); ?></textarea>
                                        <?php endif; ?>
                                        <?php if($errors->has('comment')): ?>
                                            <p class="invalid-feedback"><?php echo e($errors->first('comment')); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <ul class="btn-group form-bottom">
                        <li>
                            <?php echo Form::button(trans('contract_type.buttons.create-alt'), array('class' => 'btn form-btn btn-success btn-block text-white','type' => 'submit' )); ?>

                        </li>
                    </ul>
                <?php echo Form::close(); ?>

            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
    <?php if(config('options.tooltipsEnabled')): ?>
        <?php echo $__env->make('scripts.tooltips', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\SuzukiWork\2023-02-28(laravel)\WORK\laravel-auth\resources\views/contract_types/create.blade.php ENDPATH**/ ?>
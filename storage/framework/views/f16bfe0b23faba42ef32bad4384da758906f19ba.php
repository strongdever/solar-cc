

<?php $__env->startSection('template_title'); ?>
    <?php echo trans('usersmanagement.menu-alt'); ?>

<?php $__env->stopSection(); ?>

<?php
$levelAmount = trans('usersmanagement.labelUserLevel');
if ($user->level() >= 2) {
    $levelAmount = trans('usersmanagement.labelUserLevels');
}
?>

<?php $__env->startSection('content'); ?>

    <div class="dashboard-card">
        <div class="common-caption">
            <h3 class="label y-padding"><?php echo trans('usersmanagement.titles.show-alt'); ?></h3>
            <ul class="actions">
                <li>
                    <a class="btn btn-secondary text-white" href="<?php echo e(url('/stores')); ?>">
                        <?php echo trans('usersmanagement.buttons.back-to-list'); ?>

                    </a>
                </li>
            </ul>
        </div>
        <div class="common-form show-form">
            <div class="form-card mb-40 mb-sp-30">
                <h3 class="card-title"><?php echo e(__('販売店情報')); ?></h3>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>
                                <?php echo e(__('販売店ID')); ?>

                            </strong>
                            <div>
                                <?php echo e($user->uuid); ?>

                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>
                                <?php echo e(__('販売店名称')); ?>

                            </strong>
                            <div>
                                <?php echo e($user->company); ?>

                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>
                                <?php echo e(__('郵便番号')); ?>

                            </strong>
                            <div>
                                <?php echo e($user->zipcode); ?>

                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>
                                <?php echo e(__('住所1')); ?>

                            </strong>
                            <div>
                                <?php echo e($user->address1); ?>

                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>
                                <?php echo e(__('住所1')); ?>

                            </strong>
                            <div>
                                <?php echo e($user->address2); ?>

                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>
                                <?php echo e(__('連絡先')); ?>

                            </strong>
                            <div>
                                <a href="tel:<?php echo e($user->phone); ?>" title="tel <?php echo e($user->phone); ?>"><?php echo e($user->phone); ?></a>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>
                                <?php echo e(__('メールアドレス')); ?>

                            </strong>
                            <div>
                                <a href="mailto:<?php echo e($user->email); ?>" title="email <?php echo e($user->email); ?>"><?php echo e($user->email); ?></a>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>
                                <?php echo e(__('担当者')); ?>

                            </strong>
                            <div>
                                <?php echo e($user->name); ?>

                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>
                                <?php echo e(__('権限')); ?>

                            </strong>
                            <div>
                                <?php $__currentLoopData = $user->roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user_role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <?php if($user_role->name == 'User'): ?>
                                        <?php $badgeClass = 'primary' ?>

                                    <?php elseif($user_role->name == 'Admin'): ?>
                                        <?php $badgeClass = 'warning' ?>

                                    <?php elseif($user_role->name == 'Unverified'): ?>
                                        <?php $badgeClass = 'danger' ?>

                                    <?php else: ?>
                                        <?php $badgeClass = 'default' ?>

                                    <?php endif; ?>

                                    <span class="badge badge-<?php echo e($badgeClass); ?>"><?php echo e($user_role->name); ?></span>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>
                                <?php echo e(__('状態')); ?>

                            </strong>
                            <div>
                                <?php if($user->activated == 1): ?>
                                    <span class="badge badge-success">
                                        Activated
                                    </span>
                                <?php else: ?>
                                    <span class="badge badge-danger">
                                        Not-Activated
                                    </span>
                                <?php endif; ?>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>
                                <?php echo e(__('レベル')); ?>

                            </strong>
                            <div>
                                <?php if($user->level() >= 5): ?>
                                    <span class="badge badge-primary mr_5">5</span>
                                <?php endif; ?>

                                <?php if($user->level() >= 4): ?>
                                    <span class="badge badge-info mr_5">4</span>
                                <?php endif; ?>

                                <?php if($user->level() >= 3): ?>
                                    <span class="badge badge-success mr_5">3</span>
                                <?php endif; ?>

                                <?php if($user->level() >= 2): ?>
                                    <span class="badge badge-warning mr_5">2</span>
                                <?php endif; ?>

                                <?php if($user->level() >= 1): ?>
                                    <span class="badge badge-secondary mr_5">1</span>
                                <?php endif; ?>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>
                                <?php echo e(__('権限')); ?>

                            </strong>
                            <div>
                                <?php if($user->canViewUsers()): ?>
                                <span class="badge badge-primary mr_5">
                                    <?php echo e(trans('permsandroles.permissionView')); ?>

                                </span>
                                <?php endif; ?>

                                <?php if($user->canCreateUsers()): ?>
                                <span class="badge badge-info mr_5">
                                    <?php echo e(trans('permsandroles.permissionCreate')); ?>

                                </span>
                                <?php endif; ?>

                                <?php if($user->canEditUsers()): ?>
                                <span class="badge badge-warning mr_5">
                                    <?php echo e(trans('permsandroles.permissionEdit')); ?>

                                </span>
                                <?php endif; ?>

                                <?php if($user->canDeleteUsers()): ?>
                                <span class="badge badge-danger mr_5">
                                    <?php echo e(trans('permsandroles.permissionDelete')); ?>

                                </span>
                                <?php endif; ?>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>
                                <?php echo e(__('登録日')); ?>

                            </strong>
                            <div>
                                <?php echo e(date_format($user->created_at,"Y年m月d日")); ?>

                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>
                                <?php echo e(__('更新日')); ?>

                            </strong>
                            <div>
                                <?php echo e(date_format($user->updated_at,"Y年m月d日")); ?>

                            </div>
                        </li>
                        <?php if($user->signup_ip_address): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>
                                    <?php echo e(__('メール登録IP')); ?>

                                </strong>
                                <div>
                                    <?php echo e($user->signup_ip_address); ?>

                                </div>
                            </li>
                        <?php endif; ?>
                        <?php if($user->signup_confirmation_ip_address): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>
                                    <?php echo e(__('メール確認IP')); ?>

                                </strong>
                                <div>
                                    <?php echo e($user->signup_confirmation_ip_address); ?>

                                </div>
                            </li>
                        <?php endif; ?>
                        <?php if($user->updated_ip_address): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>
                                    <?php echo e(__('最終更新IP')); ?>

                                </strong>
                                <div>
                                    <?php echo e($user->updated_ip_address); ?>

                                </div>
                            </li>
                        <?php endif; ?>
                        
                    </ul>
                </div>
            </div>

            <div class="form-card mb-40 mb-sp-30">
                <h3 class="card-title"><?php echo e(__('口座情報')); ?></h3>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>
                                <?php echo e(__('金融機関名')); ?>

                            </strong>
                            <div>
                                <?php echo e($user->bank->name); ?>

                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>
                                <?php echo e(__('支店名')); ?>

                            </strong>
                            <div>
                                <?php echo e($user->bank->branch); ?>

                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>
                                <?php echo e(__('種別')); ?>

                            </strong>
                            <div>
                                <?php echo e($user->bank->kind); ?>

                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>
                                <?php echo e(__('口座番号')); ?>

                            </strong>
                            <div>
                                <?php echo e($user->bank->number); ?>

                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>
                                <?php echo e(__('口座名義')); ?>

                            </strong>
                            <div>
                                <?php echo e($user->bank->holder); ?>

                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="form-card mb-40 mb-sp-30">
                <h3 class="card-title"><?php echo e(__('契約情報')); ?></h3>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>
                                <?php echo e(__('締め日')); ?>

                            </strong>
                            <div>
                                <?php echo e($user->term->deadline); ?>

                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>
                                <?php echo e(__('備考')); ?>

                            </strong>
                            <div>
                                <?php echo e($user->term->comment); ?>

                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <ul class="btn-group form-bottom">
                <li>
                    <a class="btn form-btn btn-info text-white" href="<?php echo e(URL::to('stores/' . $user->id . '/edit')); ?>">
                        <?php echo trans("usersmanagement.buttons.edit-alt"); ?>

                    </a>
                </li>
                <li>
                    <?php echo Form::open(array('url' => 'stores/' . $user->id, 'class' => '')); ?>

                        <?php echo Form::hidden('_method', 'DELETE'); ?>

                        <?php echo Form::button(trans('usersmanagement.buttons.delete-alt'), array('class' => 'btn form-btn btn-danger text-white','type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => trans("usersmanagement.modals.delete_title"), 'data-message' => trans("usersmanagement.modals.delete_message"))); ?>

                    <?php echo Form::close(); ?>

                </li>
            </ul>
        </div>
    </div>

<?php echo $__env->make('modals.modal-delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
    <?php echo $__env->make('scripts.delete-modal-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php if(config('usersmanagement.tooltipsEnabled')): ?>
        <?php echo $__env->make('scripts.tooltips', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cptc/www/resources/views/usersmanagement/show-user.blade.php ENDPATH**/ ?>
<?php $__env->startSection(config('roles.titleExtended')); ?>
    <?php echo trans('laravelroles::laravelroles.titles.roles-card'); ?>

<?php $__env->stopSection(); ?>

<?php
    switch (config('roles.bootstapVersion')) {
        case '3':
            $containerClass = 'panel';
            $containerHeaderClass = 'panel-heading';
            $containerBodyClass = 'panel-body';
            break;
        case '4':
        default:
            $containerClass = 'card';
            $containerHeaderClass = 'card-header';
            $containerBodyClass = 'card-body';
            break;
    }
    $bootstrapCardClasses = (is_null(config('roles.bootstrapCardClasses')) ? '' : config('roles.bootstrapCardClasses'));
?>

<?php $__env->startSection(config('roles.bladePlacementCss')); ?>
    <?php if(config('roles.enabledDatatablesJs')): ?>
        <link rel="stylesheet" type="text/css" href="<?php echo e(config('roles.datatablesCssCDN')); ?>">
    <?php endif; ?>
    <?php if(config('roles.enableFontAwesomeCDN')): ?>
        <link rel="stylesheet" type="text/css" href="<?php echo e(config('roles.fontAwesomeCDN')); ?>">
    <?php endif; ?>
    <?php echo $__env->make('laravelroles::laravelroles.partials.styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('laravelroles::laravelroles.partials.bs-visibility-css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('laravelroles::laravelroles.partials.flash-messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="dashboard-card">
        <div class="common-caption">
            <h3 class="label y-padding">
                <?php if(isset($typeDeleted)): ?>
                    <?php echo trans('laravelroles::laravelroles.titles.show-role-deleted', ['name' => $item->name]); ?>

                <?php else: ?>
                    <?php echo trans('laravelroles::laravelroles.titles.show-role', ['name' => $item->name]); ?>

                <?php endif; ?>
            </h3>
            <ul class="actions">
                <li>
                    <?php if(isset($typeDeleted)): ?>
                        <a href="<?php echo e(route('laravelroles::roles-deleted')); ?>" class="btn btn-danger float-right" data-toggle="tooltip" data-placement="left" title="<?php echo e(trans('laravelroles::laravelroles.tooltips.back-roles-deleted')); ?>">
                            <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                            <?php echo trans('laravelroles::laravelroles.buttons.back-to-roles-deleted'); ?>

                        </a>
                    <?php else: ?>
                        <a href="<?php echo e(route('laravelroles::roles.index')); ?>" class="btn btn-secondary float-right" data-toggle="tooltip" data-placement="left" title="<?php echo e(trans('laravelroles::laravelroles.tooltips.back-roles')); ?>">
                            <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                            <?php echo trans('laravelroles::laravelroles.buttons.back-to-roles'); ?>

                        </a>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
        <div class="common-form show-form">
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <strong>
                        <?php echo trans('laravelroles::laravelroles.cards.role-info-card.role-id'); ?>

                    </strong>
                    <div>
                        <?php echo e($item->id); ?>

                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <strong>
                        <?php echo trans('laravelroles::laravelroles.cards.role-info-card.role-name'); ?>

                    </strong>
                    <div>
                        <?php echo e($item->name); ?>

                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <strong>
                        <?php echo trans('laravelroles::laravelroles.cards.role-info-card.role-desc'); ?>

                    </strong>
                    <div>
                        <?php if($item->desc): ?>
                            <?php echo e($item->desc); ?>

                        <?php else: ?>
                            <span class="text-muted">
                                <?php echo trans('laravelroles::laravelroles.cards.role-info-card.none'); ?>

                            </span>
                        <?php endif; ?>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <strong>
                        <?php echo trans('laravelroles::laravelroles.cards.role-info-card.role-level'); ?>

                    </strong>
                    <div>
                        <?php if($item->level): ?>
                            <?php echo e($item->level); ?>

                        <?php else: ?>
                            <span class="text-muted">
                                <?php echo trans('laravelroles::laravelroles.cards.role-info-card.none'); ?>

                            </span>
                        <?php endif; ?>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <strong>
                        <?php echo trans('laravelroles::laravelroles.cards.role-info-card.role-permissions'); ?>

                    </strong>
                    <?php if($item['permissions']->count() > 0): ?>
                        <div>
                            <?php $__currentLoopData = $item['permissions']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemUserKey => $itemValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="badge badge-pill badge-primary float-right">
                                    <?php echo e($itemValue->name); ?>

                                </span>
                                <br />
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php else: ?>
                        <span class="text-muted">
                            <?php echo trans('laravelroles::laravelroles.cards.none-count'); ?>

                        </span>
                    <?php endif; ?>
                </li>
                <li id="accordion_roles_users" class="list-group-item accordion <?php if($item['users']->count() > 0): ?> list-group-item-action accordion-item collapsed <?php endif; ?>" data-toggle="collapse" href="#collapse_roles_users">
                    <div class="d-flex justify-content-between align-items-center" <?php if($item['users']->count() > 0): ?> data-toggle="tooltip" title="<?php echo e(trans("laravelroles::laravelroles.tooltips.show-hide")); ?>" <?php endif; ?>>
                        <strong>
                            <?php echo trans('laravelroles::laravelroles.cards.role-info-card.role-users'); ?>

                        </strong>
                        <span class="badge badge-pill badge-dark">
                            <?php if($item['users']->count() > 0): ?>
                                <?php echo trans_choice('laravelroles::laravelroles.cards.users-count', count($item['users']), ['count' => count($item['users'])]); ?>

                            <?php else: ?>
                                <?php echo trans('laravelroles::laravelroles.cards.none-count'); ?>

                            <?php endif; ?>
                        </span>
                    </div>
                    <?php if($item['users']->count() > 0): ?>
                        <div id="collapse_roles_users" class="collapse" data-parent="#accordion_roles_users" >
                            <table class="table table-striped table-sm mt-3">
                                <caption>
                                    <?php echo trans('laravelroles::laravelroles.cards.role-card.table-users-caption', ['role' => $item->name]); ?>

                                </caption>
                                <thead>
                                    <tr>
                                        <th><?php echo trans('laravelroles::laravelroles.cards.role-card.user-id'); ?></th>
                                        <th><?php echo trans('laravelroles::laravelroles.cards.role-card.user-name'); ?></th>
                                        <th><?php echo trans('laravelroles::laravelroles.cards.role-card.user-email'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($item['users']->count() > 0): ?>
                                        <?php $__currentLoopData = $item['users']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemUserKey => $itemUser): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($itemUser->id); ?></td>
                                                <td><?php echo e($itemUser->name); ?></td>
                                                <td><?php echo e($itemUser->email); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="3">
                                                <?php echo trans('laravelroles::laravelroles.cards.none-count'); ?>

                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </li>
                <li id="accordion_roles_permissions" class="list-group-item accordion <?php if($item['permissions']->count() > 0): ?> list-group-item-action accordion-item collapsed <?php endif; ?>" data-toggle="collapse" href="#collapse_roles_permissions">
                    <div class="d-flex justify-content-between align-items-center" <?php if($item['permissions']->count() > 0): ?> data-toggle="tooltip" title="<?php echo e(trans("laravelroles::laravelroles.tooltips.show-hide")); ?>" <?php endif; ?>>
                        <strong>
                            <?php echo trans('laravelroles::laravelroles.cards.role-info-card.role-permissions'); ?>

                        </strong>
                        <span class="badge badge-pill badge-dark">
                            <?php if($item['permissions']->count() > 0): ?>
                                <?php echo trans_choice('laravelroles::laravelroles.cards.permissions-count', count($item['permissions']), ['count' => count($item['permissions'])]); ?>

                            <?php else: ?>
                                <?php echo trans('laravelroles::laravelroles.cards.none-count'); ?>

                            <?php endif; ?>
                        </span>
                    </div>
                    <?php if($item['permissions']->count() > 0): ?>
                        <div id="collapse_roles_permissions" class="collapse" data-parent="#accordion_roles_permissions" >
                            <table class="table table-striped table-sm mt-3">
                                <caption>
                                    <?php echo trans('laravelroles::laravelroles.cards.role-card.table-permissions-caption', ['role' => $item->name]); ?>

                                </caption>
                                <thead>
                                    <tr>
                                        <th><?php echo trans('laravelroles::laravelroles.cards.role-card.permissions-id'); ?></th>
                                        <th><?php echo trans('laravelroles::laravelroles.cards.role-card.permissions-name'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $item['permissions']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemUserKey => $itemUser): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($itemUser->id); ?></td>
                                            <td><?php echo e($itemUser->name); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <strong>
                        <?php echo trans('laravelroles::laravelroles.cards.role-info-card.created'); ?>

                    </strong>
                    <div>
                        <?php echo $item->created_at->format(trans('laravelroles::laravelroles.date-format')); ?>

                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <strong>
                        <?php echo trans('laravelroles::laravelroles.cards.role-info-card.updated'); ?>

                    </strong>
                    <div>
                        <?php echo $item->updated_at->format(trans('laravelroles::laravelroles.date-format')); ?>

                    </div>
                </li>
                <?php if($item->deleted_at): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <strong>
                            <?php echo trans('laravelroles::laravelroles.cards.role-info-card.deleted'); ?>

                        </strong>
                        <div>
                            <?php echo $item->deleted_at->format(trans('laravelroles::laravelroles.date-format')); ?>

                        </div>
                    </li>
                <?php endif; ?>
            </ul>
            <ul class="btn-group form-bottom">
                <li>
                    <?php if(isset($typeDeleted)): ?>
                        <?php echo $__env->make('laravelroles::laravelroles.forms.restore-item', ['style' => 'large', 'type' => 'role', 'item' => $item], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php else: ?>
                        <a class="btn form-btn btn-info text-white mb-0" href="<?php echo e(route('laravelroles::roles.edit', $item->id)); ?>">
                            <?php echo trans("laravelroles::laravelroles.buttons.edit-larger"); ?>

                        </a>
                    <?php endif; ?>
                </li>
                <li>
                    <?php if(isset($typeDeleted)): ?>
                        <?php echo $__env->make('laravelroles::laravelroles.forms.destroy-sm', ['large' => 'large', 'type' => 'Role' ,'item' => $item], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php else: ?>
                        <?php echo $__env->make('laravelroles::laravelroles.forms.delete-sm', ['type' => 'Role' ,'item' => $item, 'large' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </div>

    <?php echo $__env->make('laravelroles::laravelroles.modals.confirm-modal',[
        'formTrigger' => 'confirmRestore',
        'modalClass' => 'success',
        'actionBtnIcon' => 'fa-check'
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('laravelroles::laravelroles.modals.confirm-modal',[
        'formTrigger' => 'confirmDelete',
        'modalClass' => 'danger',
        'actionBtnIcon' => 'fa-trash-o'
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('laravelroles::laravelroles.modals.confirm-modal',[
        'formTrigger' => 'confirmDestroyRoles',
        'modalClass' => 'danger',
        'actionBtnIcon' => 'fa-trash-o'
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('laravelroles::laravelroles.modals.confirm-modal',[
        'formTrigger' => 'confirmRestoreRoles',
        'modalClass' => 'success',
        'actionBtnIcon' => 'fa-check'
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection(config('roles.bladePlacementJs')); ?>
    
    <?php echo $__env->make('laravelroles::laravelroles.scripts.confirm-modal', ['formTrigger' => '#confirmDelete'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('laravelroles::laravelroles.scripts.confirm-modal', ['formTrigger' => '#confirmDestroyRoles'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('laravelroles::laravelroles.scripts.confirm-modal', ['formTrigger' => '#confirmRestoreRoles'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php if(config('roles.enabledDatatablesJs')): ?>
        <?php echo $__env->make('laravelroles::laravelroles.scripts.datatables', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    <?php if(config('roles.tooltipsEnabled')): ?>
        <?php echo $__env->make('laravelroles::laravelroles.scripts.tooltips', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->yieldContent('inline_template_linked_css'); ?>
<?php echo $__env->yieldContent('inline_footer_scripts'); ?>

<?php echo $__env->make(config('roles.bladeExtended'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cptc/www/vendor/jeremykenedy/laravel-roles/src/resources/views//laravelroles/crud/roles/show.blade.php ENDPATH**/ ?>
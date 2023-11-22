<?php $__env->startSection(config('roles.titleExtended')); ?>
    <?php echo trans('laravelroles::laravelroles.titles.permissions-card'); ?>

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
                    <?php echo trans('laravelroles::laravelroles.titles.show-permission-deleted', ['name' => $item->name]); ?>

                <?php else: ?>
                    <?php echo trans('laravelroles::laravelroles.titles.show-permission', ['name' => $item['permission']->name]); ?>

                <?php endif; ?>
            </h3>
            <ul class="actions">
                <li>
                    <?php if(isset($typeDeleted)): ?>
                        <a href="<?php echo e(route('laravelroles::permissions-deleted')); ?>" class="btn btn-danger">
                            <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                            <?php echo trans('laravelroles::laravelroles.buttons.back-to-permissions-deleted'); ?>

                        </a>
                    <?php else: ?>
                        <a href="<?php echo e(route('laravelroles::roles.index')); ?>" class="btn btn-secondary">
                            <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                            <?php echo trans('laravelroles::laravelroles.buttons.back-to-permissions'); ?>

                        </a>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
        <div class="common-form show-form">
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?php echo trans('laravelroles::laravelroles.cards.permission-info-card.permission-id'); ?>

                    <div>
                        <?php if(isset($typeDeleted)): ?>
                            <?php echo e($item->id); ?>

                        <?php else: ?>
                            <?php echo e($item['permission']->id); ?>

                        <?php endif; ?>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?php echo trans('laravelroles::laravelroles.cards.permission-info-card.permission-name'); ?>

                    <div>
                        <?php if(isset($typeDeleted)): ?>
                            <?php echo e($item->name); ?>

                        <?php else: ?>
                            <?php echo e($item['permission']->name); ?>

                        <?php endif; ?>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?php echo trans('laravelroles::laravelroles.cards.permission-info-card.permission-slug'); ?>

                    <div>
                        <?php if(isset($typeDeleted)): ?>
                            <?php echo e($item->slug); ?>

                        <?php else: ?>
                            <?php echo e($item['permission']->slug); ?>

                        <?php endif; ?>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?php echo trans('laravelroles::laravelroles.cards.permission-info-card.permission-model'); ?>

                    <div>
                        <?php if(isset($typeDeleted)): ?>
                            <?php echo e($item->model); ?>

                        <?php else: ?>
                            <?php echo e($item['permission']->model); ?>

                        <?php endif; ?>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?php echo trans('laravelroles::laravelroles.cards.permission-info-card.permission-desc'); ?>

                    <div>
                        <?php if(isset($typeDeleted)): ?>
                            <?php if($item->desc): ?>
                                <?php echo e($item->desc); ?>

                            <?php else: ?>
                                <span class="text-muted">
                                    <?php echo trans('laravelroles::laravelroles.cards.permission-info-card.none'); ?>

                                </span>
                            <?php endif; ?>
                        <?php else: ?>
                            <?php if($item['permission']->desc): ?>
                                <?php echo e($item['permission']->desc); ?>

                            <?php else: ?>
                                <span class="text-muted">
                                    <?php echo trans('laravelroles::laravelroles.cards.permission-info-card.none'); ?>

                                </span>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?php echo trans('laravelroles::laravelroles.cards.permission-info-card.permission-roles'); ?>

                    <?php if(isset($typeDeleted)): ?>
                        <?php if($item->roles()->count() > 0): ?>
                            <div>
                                <?php $__currentLoopData = $item->roles()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemUserKey => $itemValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                    <?php else: ?>
                        <?php if($item['roles']->count() > 0): ?>
                            <div>
                                <?php $__currentLoopData = $item['roles']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemUserKey => $itemValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                    <?php endif; ?>
                </li>
                <li id="accordion_roles_users" class="list-group-item accordion <?php if($item['users']->count() > 0): ?> list-group-item-action accordion-item collapsed <?php endif; ?>" data-toggle="collapse" href="#collapse_roles_users">
                    <div class="d-flex justify-content-between align-items-center" <?php if($item['users']->count() > 0): ?> data-toggle="tooltip" title="<?php echo e(trans("laravelroles::laravelroles.tooltips.show-hide")); ?>" <?php endif; ?>>
                        <?php echo trans('laravelroles::laravelroles.cards.permission-info-card.permission-users'); ?>

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
                                    <?php if(isset($typeDeleted)): ?>
                                        <?php echo trans('laravelroles::laravelroles.cards.permissions-card.permissions-table-users-caption', ['permission' => $item->name]); ?>

                                    <?php else: ?>
                                        <?php echo trans('laravelroles::laravelroles.cards.permissions-card.permissions-table-users-caption', ['permission' => $item['permission']->name]); ?>

                                    <?php endif; ?>
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
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?php echo trans('laravelroles::laravelroles.cards.role-info-card.created'); ?>

                    <div>
                        <?php if(isset($typeDeleted)): ?>
                            <?php echo $item->created_at->format(trans('laravelroles::laravelroles.date-format')); ?>

                        <?php else: ?>
                            <?php echo $item['permission']->created_at->format(trans('laravelroles::laravelroles.date-format')); ?>

                        <?php endif; ?>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?php echo trans('laravelroles::laravelroles.cards.role-info-card.updated'); ?>

                    <div>
                        <?php if(isset($typeDeleted)): ?>
                            <?php echo $item->updated_at->format(trans('laravelroles::laravelroles.date-format')); ?>

                        <?php else: ?>
                            <?php echo $item['permission']->updated_at->format(trans('laravelroles::laravelroles.date-format')); ?>

                        <?php endif; ?>
                    </div>
                </li>
                <?php if(isset($typeDeleted)): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?php echo trans('laravelroles::laravelroles.cards.role-info-card.deleted'); ?>

                        <div>
                            <?php echo $item->deleted_at->format(trans('laravelroles::laravelroles.date-format')); ?>

                        </d>
                    </li>
                <?php endif; ?>
            </ul>
            <ul class="btn-group form-bottom">
                <li>
                    <?php if(isset($typeDeleted)): ?>
                        <?php echo $__env->make('laravelroles::laravelroles.forms.restore-item', ['style' => 'large', 'type' => 'permission', 'item' => $item], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php else: ?>
                        <a class="btn form-btn btn-secondary text-white mb-0" href="<?php echo e(route('laravelroles::permissions.edit', $item['permission']->id)); ?>">
                            <?php echo trans("laravelroles::laravelroles.buttons.edit-larger"); ?>

                        </a>
                    <?php endif; ?>
                </li>
                <li>
                    <?php if(isset($typeDeleted)): ?>
                        <?php echo $__env->make('laravelroles::laravelroles.forms.destroy-sm', ['large' => 'large', 'type' => 'Permission' ,'item' => $item], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php else: ?>
                        <?php echo $__env->make('laravelroles::laravelroles.forms.delete-sm', ['type' => 'Permission' ,'item' => $item['permission'], 'large' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
        'formTrigger' => 'confirmRestorePermissions',
        'modalClass' => 'success',
        'actionBtnIcon' => 'fa-check'
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('laravelroles::laravelroles.modals.confirm-modal',[
        'formTrigger' => 'confirmDestroyPermissions',
        'modalClass' => 'danger',
        'actionBtnIcon' => 'fa-trash-o'
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection(config('roles.bladePlacementJs')); ?>
    <?php echo $__env->make('laravelroles::laravelroles.scripts.confirm-modal', ['formTrigger' => '#confirmRestore'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('laravelroles::laravelroles.scripts.confirm-modal', ['formTrigger' => '#confirmDelete'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('laravelroles::laravelroles.scripts.confirm-modal', ['formTrigger' => '#confirmRestorePermissions'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('laravelroles::laravelroles.scripts.confirm-modal', ['formTrigger' => '#confirmDestroyPermissions'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php if(config('roles.enabledDatatablesJs')): ?>
        <?php echo $__env->make('laravelroles::laravelroles.scripts.datatables', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    <?php if(config('roles.tooltipsEnabled')): ?>
        <?php echo $__env->make('laravelroles::laravelroles.scripts.tooltips', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->yieldContent('inline_template_linked_css'); ?>
<?php echo $__env->yieldContent('inline_footer_scripts'); ?>

<?php echo $__env->make(config('roles.bladeExtended'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\SuzukiWork\2023-02-28(laravel)\WORK\laravel-auth\vendor\jeremykenedy\laravel-roles\src/resources/views//laravelroles/crud/permissions/show.blade.php ENDPATH**/ ?>
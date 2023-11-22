<div class="table-responsive permissions-table">
    <table class="table table-sm table-striped data-table permissions-table">
        <caption class="p-1 pb-0">
            <?php if($tabletype == 'normal'): ?>
                <?php echo trans_choice('laravelroles::laravelroles.permissions-table.caption', $items->count(), ['count' => $items->count()]); ?>

            <?php endif; ?>
            <?php if($tabletype == 'deleted'): ?>
                <?php echo trans_choice('laravelroles::laravelroles.permissions-deleted-table.caption', $items->count(), ['count' => $items->count()]); ?>

            <?php endif; ?>
        </caption>
        <thead class="thead">
            <tr>
                <th scope="col" width="40px">
                    <?php echo trans('laravelroles::laravelroles.permissions-table.id'); ?>

                </th>
                <th scope="col" width="150px">
                    <?php echo trans('laravelroles::laravelroles.permissions-table.name'); ?>

                </th>
                <th scope="col" width="150px">
                    <?php echo trans('laravelroles::laravelroles.permissions-table.slug'); ?>

                </th>
                <th scope="col" class="hidden-xs" width="150px">
                    <?php echo trans('laravelroles::laravelroles.permissions-table.desc'); ?>

                </th>
                <th scope="col" class="hidden-xs hidden-sm" width="100px">
                    <?php echo trans('laravelroles::laravelroles.permissions-table.roles'); ?>

                </th>
                <th scope="col" class="hidden-xs hidden-sm" width="160px">
                    <?php echo trans('laravelroles::laravelroles.permissions-table.createdAt'); ?>

                </th>
                <th scope="col" class="hidden-xs hidden-sm" width="160px">
                    <?php echo trans('laravelroles::laravelroles.permissions-table.updatedAt'); ?>

                </th>
                <?php if($tabletype == 'deleted'): ?>
                    <th scope="col" class="hidden-xs hidden-sm" width="160px">
                        <?php echo trans('laravelroles::laravelroles.permissions-table.deletedAt'); ?>

                    </th>
                <?php endif; ?>
                <th class="no-search no-sort " colspan="3">
                    <?php echo trans('laravelroles::laravelroles.permissions-table.actions'); ?>

                </th>
            </tr>
        </thead>
        <tbody class="permissions-table-body">
            <?php if($items->count() > 0): ?>
                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <?php if($tabletype == 'normal'): ?>
                                <?php echo e($item['permission']->id); ?>

                            <?php endif; ?>
                            <?php if($tabletype == 'deleted'): ?>
                                <?php echo e($item->id); ?>

                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($tabletype == 'normal'): ?>
                                <?php echo e($item['permission']->name); ?>

                            <?php endif; ?>
                            <?php if($tabletype == 'deleted'): ?>
                                <?php echo e($item->name); ?>

                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($tabletype == 'normal'): ?>
                                <?php echo e($item['permission']->slug); ?>

                            <?php endif; ?>
                            <?php if($tabletype == 'deleted'): ?>
                                <?php echo e($item->slug); ?>

                            <?php endif; ?>
                        </td>
                        <td class="hidden-xs">
                            <?php if($tabletype == 'normal'): ?>
                                <?php echo e($item['permission']->description); ?>

                            <?php endif; ?>
                            <?php if($tabletype == 'deleted'): ?>
                                <?php echo e($item->description); ?>

                            <?php endif; ?>
                        </td>
                        <td class="hidden-xs hidden-sm">
                            <?php if($tabletype == 'normal'): ?>
                                <?php if($item['roles']->count() > 0): ?>
                                    <?php $__currentLoopData = $item['roles']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemUserKey => $subItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span class="badge badge-pill badge-secondary mb-1">
                                            <?php echo e($subItem->name); ?>

                                        </span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <span class="badge badge-pill badge-default">
                                        <?php echo trans('laravelroles::laravelroles.cards.none-count'); ?>

                                    </span>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if($tabletype == 'deleted'): ?>
                                <?php if($item->roles()->count() > 0): ?>
                                    <?php $__currentLoopData = $item->roles()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemUserKey => $subItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span class="badge badge-pill badge-secondary mb-1">
                                            <?php echo e($subItem->name); ?>

                                        </span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <span class="badge badge-pill badge-default">
                                        <?php echo trans('laravelroles::laravelroles.cards.none-count'); ?>

                                    </span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </td>
                        <td class="hidden-xs hidden-sm">
                            <?php if($tabletype == 'normal'): ?>
                                <?php echo e($item['permission']->created_at->format(trans('laravelroles::laravelroles.date-format'))); ?>

                            <?php endif; ?>
                            <?php if($tabletype == 'deleted'): ?>
                                <?php echo e($item->created_at->format(trans('laravelroles::laravelroles.date-format'))); ?>

                            <?php endif; ?>
                        </td>
                        <td class="hidden-xs hidden-sm">
                            <?php if($tabletype == 'normal'): ?>
                                <?php echo e($item['permission']->updated_at->format(trans('laravelroles::laravelroles.date-format'))); ?>

                            <?php endif; ?>
                            <?php if($tabletype == 'deleted'): ?>
                                <?php echo e($item->updated_at->format(trans('laravelroles::laravelroles.date-format'))); ?>

                            <?php endif; ?>
                        </td>
                        <?php if($tabletype == 'deleted'): ?>
                            <td class="hidden-xs hidden-sm">
                                <?php echo e($item->deleted_at->format(trans('laravelroles::laravelroles.date-format'))); ?>

                            </td>
                        <?php endif; ?>
                        <?php if($tabletype == 'normal'): ?>
                            <td class="action-td">
                                <a class="btn btn-sm btn-success btn-block" href="<?php echo e(route('laravelroles::permissions.show', $item['permission']->id)); ?>">
                                    <?php echo trans("laravelroles::laravelroles.buttons.show"); ?>

                                </a>
                            </td>
                            <td class="action-td">
                                <a class="btn btn-sm btn-info btn-block" href="<?php echo e(route('laravelroles::permissions.edit', $item['permission']->id)); ?>">
                                    <?php echo trans("laravelroles::laravelroles.buttons.edit"); ?>

                                </a>
                            </td>
                            <td class="action-td">
                                <?php echo $__env->make('laravelroles::laravelroles.forms.delete-sm', ['type' => 'Permission' ,'item' => $item['permission']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </td>
                        <?php endif; ?>
                        <?php if($tabletype == 'deleted'): ?>
                            <td class="action-td">
                                <a class="btn btn-sm btn-info btn-block" href="<?php echo e(route('laravelroles::permission-show-deleted', $item->id)); ?>" data-toggle="tooltip" title="<?php echo e(trans('laravelroles::laravelroles.tooltips.show-deleted-permission')); ?>">
                                    <i class="fa fa-eye fa-fw" aria-hidden="true"></i>    
                                    <?php echo trans("laravelroles::laravelroles.buttons.show-deleted-permission"); ?>

                                </a>
                            </td>
                            <td class="action-td">
                                <?php echo $__env->make('laravelroles::laravelroles.forms.restore-item', ['style' => 'small', 'type' => 'permission', 'item' => $item], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </td>
                            <td class="action-td">
                                <?php echo $__env->make('laravelroles::laravelroles.forms.destroy-sm', ['type' => 'Permission' ,'item' => $item], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </td>

                        <?php endif; ?>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <tr>
                    <td><?php echo trans("laravelroles::laravelroles.permissions-table.none"); ?></td>
                    <td></td>
                    <td></td>
                    <td class="hidden-xs"></td>
                    <td class="hidden-xs hidden-sm"></td>
                    <td class="hidden-xs hidden-sm"></td>
                    <td class="hidden-xs hidden-sm"></td>
                    <?php if($tabletype == 'deleted'): ?>
                        <td class="hidden-sm hidden-xs"></td>
                    <?php endif; ?>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?php /**PATH E:\WORK(2022)\SuzukiWork\11-3(Laravel)\WORK\laravel-auth\vendor\jeremykenedy\laravel-roles\src/resources/views//laravelroles/tables/permission-items-table.blade.php ENDPATH**/ ?>
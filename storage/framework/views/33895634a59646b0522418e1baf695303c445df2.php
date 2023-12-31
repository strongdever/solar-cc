<div class="table-responsive roles-table">
    <table class="table table-sm table-striped data-table roles-table">
        <caption class="pt-10 pb-12 pr-12">
            <?php if($tabletype == 'normal'): ?>
                <?php echo trans_choice('laravelroles::laravelroles.roles-table.caption', $items->count(), ['count' => $items->count()]); ?>

            <?php endif; ?>
            <?php if($tabletype == 'deleted'): ?>
                <?php echo trans_choice('laravelroles::laravelroles.roles-deleted-table.caption', $items->count(), ['count' => $items->count()]); ?>

            <?php endif; ?>
        </caption>
        <thead class="thead">
            <tr>
                <th scope="col" width="40px">
                    <?php echo trans('laravelroles::laravelroles.roles-table.id'); ?>

                </th>
                <th scope="col" width="90px">
                    <?php echo trans('laravelroles::laravelroles.roles-table.name'); ?>

                </th>
                <th scope="col" class="hidden-xs" width="120px">
                    <?php echo trans('laravelroles::laravelroles.roles-table.desc'); ?>

                </th>
                <th scope="col" width="80px">
                    <?php echo trans('laravelroles::laravelroles.roles-table.level'); ?>

                </th>
                <th scope="col" class="hidden-xs hidden-sm" width="<?php echo e($tabletype == 'deleted' ? '200px' : '240px'); ?>">
                    <?php echo trans('laravelroles::laravelroles.roles-table.permissons'); ?>

                </th>
                <th scope="col" class="hidden-xs hidden-sm" width="130px">
                    <?php echo trans('laravelroles::laravelroles.roles-table.createdAt'); ?>

                </th>
                <th scope="col" class="hidden-xs hidden-sm" width="130px">
                    <?php echo trans('laravelroles::laravelroles.roles-table.updatedAt'); ?>

                </th>
                <?php if($tabletype == 'deleted'): ?>
                    <th scope="col" class="hidden-xs hidden-sm" width="130px">
                        <?php echo trans('laravelroles::laravelroles.roles-table.deletedAt'); ?>

                    </th>
                <?php endif; ?>
                <th class="no-search no-sort " colspan="3" width="270px">
                    <?php echo trans('laravelroles::laravelroles.roles-table.actions'); ?>

                </th>
            </tr>
        </thead>
        <tbody class="roles-table-body">
            <?php if($items->count() > 0): ?>
                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <?php if($tabletype == 'normal'): ?>
                                <?php echo e($item['role']->id); ?>

                            <?php endif; ?>
                            <?php if($tabletype == 'deleted'): ?>
                                <?php echo e($item->id); ?>

                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($tabletype == 'normal'): ?>
                                <?php echo e($item['role']->name); ?>

                            <?php endif; ?>
                            <?php if($tabletype == 'deleted'): ?>
                                <?php echo e($item->name); ?>

                            <?php endif; ?>
                        </td>
                        <td class="hidden-xs">
                            <?php if($tabletype == 'normal'): ?>
                                <?php echo e($item['role']->description); ?>

                            <?php endif; ?>
                            <?php if($tabletype == 'deleted'): ?>
                                <?php echo e($item->description); ?>

                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($tabletype == 'normal'): ?>
                                <?php echo e($item['role']->level); ?>

                            <?php endif; ?>
                            <?php if($tabletype == 'deleted'): ?>
                                <?php echo e($item->level); ?>

                            <?php endif; ?>
                        </td>
                        <td class="hidden-xs hidden-sm">
                            <?php if($tabletype == 'normal'): ?>
                                <?php if($item['permissions']->count() > 0): ?>
                                    <?php $__currentLoopData = $item['permissions']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemPermKey => $itemPerm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span class="badge badge-pill badge-primary mb-1">
                                            <?php echo e($itemPerm->name); ?>

                                        </span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <span class="badge badge-pill badge-default">
                                        <?php echo trans('laravelroles::laravelroles.cards.none-count'); ?>

                                    </span>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if($tabletype == 'deleted'): ?>
                                <?php if($item->permissions()->count() > 0): ?>
                                    <?php $__currentLoopData = $item->permissions()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemPermKey => $itemPerm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span class="badge badge-pill badge-primary mb-1">
                                            <?php echo e($itemPerm->name); ?>

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
                                <?php echo e($item['role']->created_at->format(trans('laravelroles::laravelroles.date-format'))); ?>

                            <?php endif; ?>
                            <?php if($tabletype == 'deleted'): ?>
                                <?php echo e($item->created_at->format(trans('laravelroles::laravelroles.date-format'))); ?>

                            <?php endif; ?>
                        </td>
                        <td class="hidden-xs hidden-sm">
                            <?php if($tabletype == 'normal'): ?>
                                <?php echo e($item['role']->updated_at->format(trans('laravelroles::laravelroles.date-format'))); ?>

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
                                <a class="btn btn-sm btn-success btn-block" href="<?php echo e(route('laravelroles::roles.show', $item['role']->id)); ?>">
                                    <?php echo trans("laravelroles::laravelroles.buttons.show"); ?>

                                </a>
                            </td>
                            <td class="action-td">
                                <a class="btn btn-sm btn-info btn-block" href="<?php echo e(route('laravelroles::roles.edit', $item['role']->id)); ?>">
                                    <?php echo trans("laravelroles::laravelroles.buttons.edit"); ?>

                                </a>
                            </td>
                            <td class="action-td">
                                <?php echo $__env->make('laravelroles::laravelroles.forms.delete-sm', ['type' => 'Role' ,'item' => $item['role']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </td>
                        <?php endif; ?>
                        <?php if($tabletype == 'deleted'): ?>
                            <td class="action-td">
                                <a class="btn btn-sm btn-info btn-block" href="<?php echo e(route('laravelroles::role-show-deleted', $item->id)); ?>">
                                    <i class="fa fa-eye fa-fw" aria-hidden="true"></i>    
                                    <?php echo trans("laravelroles::laravelroles.buttons.show-deleted-role"); ?>

                                </a>
                            </td>
                            <td class="action-td">
                                <?php echo $__env->make('laravelroles::laravelroles.forms.restore-item', ['style' => 'small', 'type' => 'role', 'item' => $item], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </td>
                            <td class="action-td">
                                <?php echo $__env->make('laravelroles::laravelroles.forms.destroy-sm', ['type' => 'Role' ,'item' => $item], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <tr>
                    <td><?php echo trans("laravelroles::laravelroles.roles-table.none"); ?></td>
                    <td></td>
                    <td class="hidden-xs"></td>
                    <td class="hidden-xs"></td>
                    <td class="hidden-xs"></td>
                    <td class="hidden-sm hidden-xs"></td>
                    <td class="hidden-sm hidden-xs hidden-md"></td>
                    <td class="hidden-sm hidden-xs hidden-md"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?php /**PATH E:\xampp\htdocs\solar-cc\vendor\jeremykenedy\laravel-roles\src/resources/views//laravelroles/tables/role-items-table.blade.php ENDPATH**/ ?>
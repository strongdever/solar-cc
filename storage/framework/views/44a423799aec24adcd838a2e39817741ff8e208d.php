

<?php $__env->startSection('template_title'); ?>
    <?php echo trans('usersmanagement.menu-alt'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_linked_css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(config('usersmanagement.datatablesCssCDN')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="dashboard-card">
        <div class="common-caption">
            <h3 class="label y-padding" id="card-title"><?php echo trans('usersmanagement.menu-alt'); ?></h3>
            <ul class="actions">
                <li>
                    <a class="btn btn-secondary text-white" href="<?php echo e(url('/stores/create')); ?>">
                        <?php echo trans('usersmanagement.buttons.create-new'); ?>

                    </a>
                </li>
            </ul>
        </div>
        <div class="common-form">
            <div class="p-users-search mb-30">
                <?php if(config('usersmanagement.enableSearchUsers')): ?>
                    <?php echo $__env->make('partials.search-users-form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
            </div>
            <div class="table-responsive">
                <table class="table table-sm data-table">
                    <caption id="users-count">
                        <?php echo e(trans_choice('usersmanagement.list-table.caption', 1, ['count' => $users->count()])); ?>

                    </caption>
                    <thead class="thead">
                        <tr>
                            <th scope="col" width="100px">
                                <?php echo trans('usersmanagement.list-table.uuid'); ?>

                            </th>
                            <th scope="col" width="180px">
                                <?php echo trans('usersmanagement.list-table.company'); ?>

                            </th>
                            <th scope="col" width="150px" class="hidden-xs hidden-sm hidden-md">
                                <?php echo trans('usersmanagement.list-table.email'); ?>

                            </th>
                            <th scope="col" width="80px">
                                <?php echo trans('usersmanagement.list-table.role'); ?>

                            </th>
                            <th scope="col" class="hidden-xs hidden-sm hidden-md">
                                <?php echo trans('usersmanagement.list-table.created'); ?>

                            </th>
                            <th scope="col" class="hidden-xs hidden-sm hidden-md">
                                <?php echo trans('usersmanagement.list-table.updated'); ?>

                            </th>
                            <th class="no-search no-sort" colspan="3">
                                <?php echo trans('usersmanagement.list-table.actions'); ?>

                            </th>
                        </tr>
                    </thead>
                    <tbody id="users-table">
                        <?php if($users->count() > 0): ?>
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <?php echo e($user->uuid); ?>

                                </td>
                                <td>
                                    <?php echo e($user->company); ?>

                                </td>
                                <td class="hidden-xs hidden-sm hidden-md">
                                    <a href="mailto:<?php echo e($user->email); ?>" title="email <?php echo e($user->email); ?>"><?php echo e($user->email); ?></a>
                                </td>
                                <td>
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
                                </td>
                                <td class="hidden-sm hidden-xs hidden-md">
                                    <?php echo e(date_format($user->created_at,"Y年m月d日")); ?>

                                </td>
                                <td class="hidden-sm hidden-xs hidden-md">
                                    <?php echo e(date_format($user->updated_at,"Y年m月d日")); ?>

                                </td>
                                <td class="action-td">
                                    <?php echo Form::open(array('url' => 'stores/' . $user->id, 'class' => '')); ?>

                                        <?php echo Form::hidden('_method', 'DELETE'); ?>

                                        <?php echo Form::button(trans('usersmanagement.buttons.delete'), array('class' => 'btn btn-sm btn-danger btn-block','type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => trans('usersmanagement.modals.delete_title'), 'data-message' => trans('usersmanagement.modals.delete_message'))); ?>

                                    <?php echo Form::close(); ?>

                                </td>
                                <td class="action-td">
                                    <a class="btn btn-sm btn-success btn-block" href="<?php echo e(URL::to('stores/' . $user->id)); ?>">
                                        <?php echo trans('usersmanagement.buttons.show'); ?>

                                    </a>
                                </td>
                                <td class="action-td">
                                    <a class="btn btn-sm btn-info btn-block" href="<?php echo e(URL::to('stores/' . $user->id . '/edit')); ?>">
                                        <?php echo trans('usersmanagement.buttons.edit'); ?>

                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7"><?php echo trans("usersmanagement.list-table.none"); ?></td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                    <?php if(config('usersmanagement.enableSearchUsers')): ?>
                    <tbody id="search-results"></tbody>
                    <?php endif; ?>
                </table>
            </div>
            <div class="table-pagination data-table" id="users-pagination">
                <?php echo e($users->links()); ?>

            </div>
        </div>
    </div>

<?php echo $__env->make('modals.modal-delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
    <?php if((count($users) > config('usersmanagement.datatablesJsStartCount'))): ?>
        <?php echo $__env->make('scripts.datatables', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    <?php echo $__env->make('scripts.delete-modal-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('scripts.save-modal-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php if(config('usersmanagement.tooltipsEnabled')): ?>
        <?php echo $__env->make('scripts.tooltips', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    <?php if(config('usersmanagement.enableSearchUsers')): ?>
        <?php echo $__env->make('scripts.search-users', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cptc/www/resources/views/usersmanagement/show-users.blade.php ENDPATH**/ ?>
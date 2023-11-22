<?php $__env->startSection('template_title'); ?>
    <?php echo trans('contract_type.title-alt'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_linked_css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(config('options.datatablesCssCDN')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="dashboard-card">
        <div class="common-caption">
            <h3 class="label y-padding"><?php echo trans('contract_type.title-alt'); ?></h3>
            <ul class="actions">
                <li>
                    <a class="btn btn-secondary text-white" href="<?php echo e(url('/contract_types/create')); ?>">
                        <?php echo trans('contract_type.buttons.create'); ?>

                    </a>
                </li>
            </ul>
        </div>
        <div class="common-form">
            <div class="table-responsive contractTypes-table">
                <table class="table table-sm table-striped data-table">
                    <caption id="contractTypes-count">
                        <?php echo trans_choice('contract_type.list-table.caption', 1, ['count' => $contract_types->count()]); ?>

                    </caption>
                    <thead class="thead">
                        <tr>
                            <th scope="col" width="60px">
                                <?php echo trans('contract_type.list-table.id'); ?>

                            </th>
                            <th scope="col" width="150px">
                                <?php echo trans('contract_type.list-table.name'); ?>

                            </th>
                            <th scope="col" width="240px">
                                <?php echo trans('contract_type.list-table.comment'); ?>

                            </th>
                            <th scope="col" class="hidden-xs hidden-sm hidden-md">
                                <?php echo trans('contract_type.list-table.created'); ?>

                            </th>
                            <th scope="col" class="hidden-xs hidden-sm hidden-md">
                                <?php echo trans('contract_type.list-table.updated'); ?>

                            </th>
                            <th class="no-search no-sort" colspan="3">
                                <?php echo trans('contract_type.list-table.actions'); ?>

                            </th>
                        </tr>
                    </thead>
                    <tbody class="contractTypes-table-body">
                        <?php if($contract_types->count() > 0): ?>
                            <?php $__currentLoopData = $contract_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contract_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <?php echo $contract_type->id; ?>

                                    </td>
                                    <td>
                                        <?php echo $contract_type->name; ?>

                                    </td>
                                    <td>
                                        <?php echo $contract_type->comment; ?>

                                    </td>
                                    <td class="hidden-xs hidden-sm hidden-md">
                                        <?php echo $contract_type->created_at->format('Y年m月d日'); ?>

                                    </td>
                                    <td class="hidden-xs hidden-sm hidden-md">
                                        <?php echo $contract_type->updated_at->format('Y年m月d日'); ?>

                                    </td>
                                    <td class="action-td">
                                        <a class="btn btn-sm btn-success btn-block text-white" href="<?php echo e(URL::to('contract_types/' . $contract_type->id)); ?>">
                                            <?php echo trans('contract_type.buttons.show'); ?>

                                        </a>
                                    </td>
                                    <td class="action-td">
                                        <a class="btn btn-sm btn-info btn-block text-white" href="<?php echo e(URL::to('contract_types/' . $contract_type->id . '/edit')); ?>">
                                            <?php echo trans('contract_type.buttons.edit'); ?>

                                        </a>
                                    </td>
                                    <td class="action-td">
                                        <?php echo Form::open(array('url' => 'contract_types/' . $contract_type->id, 'class' => '')); ?>

                                            <?php echo Form::hidden('_method', 'DELETE'); ?>

                                            <?php echo Form::button(trans('contract_type.buttons.delete'), array('class' => 'btn btn-sm btn-danger btn-block','type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => trans("contract_type.modals.delete_title"), 'data-message' => trans("contract_type.modals.delete_message"))); ?>

                                        <?php echo Form::close(); ?>

                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="9"><?php echo trans("contract_type.list-table.none"); ?></td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <div class="table-pagination data-table">
                    <?php echo e($contract_types->links()); ?>

                </div>
            </div>
        </div>
    </div>

    <?php echo $__env->make('modals.modal-delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
    <?php if((count($contract_types) > config('options.datatablesJsStartCount'))): ?>
        <?php echo $__env->make('scripts.datatables', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    <?php echo $__env->make('scripts.delete-modal-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php if(config('options.tooltipsEnabled')): ?>
        <?php echo $__env->make('scripts.tooltips', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cptc/www/resources/views/contract_types/index.blade.php ENDPATH**/ ?>
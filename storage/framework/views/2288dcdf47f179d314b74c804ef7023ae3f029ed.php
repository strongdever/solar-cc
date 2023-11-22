<div class="common-form">
    <form action="<?php echo e(route('laravelroles::permissions.update', $id)); ?>" method="POST" accept-charset="utf-8" id="edit_permission_form" class="mb-0 needs-validation" enctype="multipart/form-data" role="form" >
        <?php echo e(method_field('PATCH')); ?>

        <input type="hidden" name="id" value="<?php echo e($id); ?>">
        <?php echo $__env->make('laravelroles::laravelroles.forms.permission-form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <ul class="btn-group form-bottom">
            <li>
                <button type="submit" class="form-btn btn-success" value="save" name="action">
                    <i class="fa fa-save fa-fw"></i>
                    <?php echo trans("laravelroles::laravelroles.forms.permissions-form.buttons.update-permission.name"); ?>

                </button>
            </li>
        </ul>
    </form>
</div>

<?php /**PATH E:\WORK(2022)\SuzukiWork\11-3(Laravel)\WORK\laravel-auth\vendor\jeremykenedy\laravel-roles\src/resources/views//laravelroles/forms/edit-permission-form.blade.php ENDPATH**/ ?>